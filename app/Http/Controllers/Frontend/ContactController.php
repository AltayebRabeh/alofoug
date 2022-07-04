<?php

namespace App\Http\Controllers\Frontend;

use Pusher\Pusher;
use App\Models\Contact;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Events\ContactsNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request) {

        $contact_count = Contact::whereIpAddress(request()->ip())->whereDay('created_at', date('d'))->count();


        if($contact_count >= Cache::get('cache_settings')->contact_count) {
            Alert::warning(__('warning'), __('You have exceeded the number of daily messages allowed'));
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:5000'
        ], [
            '*.required' => __('The field is required'),
            '*.max' => __('The field must not exceed 255 characters'),
            'message.max' => __('The field must not exceed 5000 characters'),
            'email.email' => __('The field must be email')
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


        $agent = new Agent();

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => request()->ip(),
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
        ]);

        // event(new ContactsNotify($contact->name));


        Alert::success(__('Success'), __('Your Message is Sended Successfuly'));
        return redirect()->back();
    }
}
