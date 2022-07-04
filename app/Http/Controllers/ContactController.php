<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Contact;
use Jenssegers\Agent\Agent;
use App\Models\ContactReply;
use App\Mail\ReplyForContact;
use App\Events\ContactsNotify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->with('replies')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.contacts.index', compact('contacts'));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $this->read($contact);
        $contact = Contact::with('replies')->findOrFail($contact->id);

        return view('backend.contacts.show', compact('contact'));
    }

    /**
     * Show the form for replaying the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function reply(Contact $contact)
    {
        $this->read($contact);
        $contact = Contact::with('replies')->findOrFail($contact->id);

        return view('backend.contacts.reply', compact('contact'));
    }

    /**
     * Replay the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecontactRequest  $request
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function sendReply(UpdateContactRequest $request, Contact $contact)
    {
        $this->read($contact);

        $reply = ContactReply::create([
            'message' => $request->message,
            'contact_id' => $contact->id,
            'user_id' => auth()->user()->id
        ]);

        $reply = ContactReply::with('contact')->findOrFail($reply->id);

        Mail::to($reply->contact->email)->send(new ReplyForContact($reply));

        Alert::success('نجاح','تم الرد بنجاح');
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        Contact::findOrFail($contact->id)->delete();

        Alert::success('نجاح','تم حذف المراسلة بنجاح');
        return redirect()->route('contacts.index');
    }

    private function read(Contact $contact)
    {
        $contact->read = true;
        $contact->save();
    }
}
