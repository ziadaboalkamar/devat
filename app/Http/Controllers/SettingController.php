<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $collection = Setting::all();
        return $collection;
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('dashboard.pages.settings.edit', $setting);
    }
    public function edit(){
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('dashboard.layouts.menu',compact('setting'));
    }


    public function update(Request $request)
    {
        $info = $request->except('_token', '_method', 'logo');
        foreach ($info as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }



        if ($request->hasFile('logo')) {
            $logo_name = $request->file('logo')->getClientOriginalName();
            Setting::where('key', 'logo')->update(['value' => $logo_name]);
            $this->uploadFile($request, 'logo', 'logo');
        }

        toastr()->success(__('تم تعديل البيانات بنجاح'));
        return back();


    }
    public function uploadFile($request, $name, $folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('/'.$folder.'/', $file_name, 'assets');
    }
}
