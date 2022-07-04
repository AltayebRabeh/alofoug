<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();

        return view('backend.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        Setting::findOrFail(1)->update([
            'name' => [
                'ar' => $request->name,
                'en' => $request->name_en,
            ],
            'bio' => [
                'ar' => $request->bio,
                'en' => $request->bio_en,
            ],
            'logo' => $request->logo,
            'min_logo' => $request->min_logo,
            'address' => [
                'ar' => $request->address,
                'en' => $request->address_en,
            ]
        ]);

        $this->cache();

        Alert::success('نجاح','تم تحديث وسائل التواصل بنجاح بنجاح');
        return redirect()->route('settings.index');
    }

    public function contacts(Request $request)
    {
        Setting::findOrFail(1)->update([
            'social_media' => json_encode($request->repeater_group_social_media),
            'phone' => json_encode($request->repeater_group_tels),
            'email' => json_encode($request->repeater_group_emails),
        ]);

        $this->cache();

        Alert::success('نجاح','تم تحديث وسائل التواصل بنجاح بنجاح');
        return redirect()->route('settings.index');
    }

    public function statistics(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statistics.*.title.*' => 'required',
            'statistics.*.value' => 'required'
        ], [
            '*.required' => 'الحقل مطلوب',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        Setting::findOrFail(1)->update([
            'statistics' => json_encode($request->statistics)
        ]);

        $this->cache();

        Alert::success('نجاح','تم تحديث وسائل التواصل بنجاح بنجاح');
        return redirect()->route('settings.index');
    }

    public function another(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paginate' => 'required|int|min:1|max:200',
            'latest_posts_count' => 'required|int|min:1|max:50',
            'contact_count' => 'required|int|min:1|max:50'
        ], [
            '*.required' => 'الحقل مطلوب',
            '*.int' => 'يجب ان يكون رقم',
            '*.min' => 'لايجب ان تقل القيمة عن 1',
            'paginate.max' => 'اكبر رقم مسموح به هو 200',
            'latest_posts_count.max' => 'اكبر رقم مسموح به هو 50',
            'contact_count.max' => 'اكبر رقم مسموح به هو 50',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        Setting::findOrFail(1)->update([
            'latest_posts_count' => $request->latest_posts_count,
            'paginate' => $request->paginate,
            'contact_count' => $request->contact_count,
        ]);

        $this->cache();

        $latestPosts = new PostController();
        $latestPosts->cache();

        Alert::success('نجاح','تم تحديث وسائل التواصل بنجاح بنجاح');
        return redirect()->route('settings.index');
    }

    public function cache() {
        Cache::flush('cache_settings');
        Cache::rememberForever('cache_settings', function() {
            return Setting::find(1);
        });
    }
}
