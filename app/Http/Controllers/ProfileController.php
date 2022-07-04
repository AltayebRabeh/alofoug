<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(['permissions', 'roles'])->findOrFail(Auth::user()->id);

        return view('backend.profile', compact('user'));
    }

    public function editInfo(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,'. Auth::user()->id,
        ],[
            'name.required' => 'الحقل مطلوب',
            'name.min' => 'يجب إدخال 3 خانات على الاقل',
            'name.max' => 'يجب ان لايتعدى 255 خانة',
            'email.required' => 'الحقل مطلوب',
            'email.email' => 'يجب إدخال بريد الكتروني صالح',
            'email.max' => 'يجب ان لايتعدى 255 خانة',
            'email.unique' => 'هذا البريد مستخدم الرجاء إختيار بريد إلكتروني اخر',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        User::findOrFail(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Alert::success('نجاح','تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('profile.index');
    }

    public function editPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:255|confirmed',
        ],[
            'old_password.required' => 'الحقل مطلوب',
            'password.required' => 'الحقل مطلوب',
            'password.min' => 'يجب ان لايقل عن 6 خانات',
            'password.max' => 'يجب ان لايتعدى 255 خانة',
            'password.confirmed' => 'كلمات المرور غير متطابقة',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::findOrFail(Auth::user()->id);

        if(! password_verify($request->old_password, $user->password)) {
            Alert::error('خطا','الرجاء التأكد من كلمة المرور القديمة');
            return redirect()->route('profile.index');
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        Alert::success('نجاح','تم تحديث كلمة المرور بنجاح');
        return redirect()->route('profile.index');
    }
}
