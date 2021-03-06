<?php

namespace App\Http\Controllers;

use App\Models\Setting2;
use Illuminate\Http\Request;

class Setting2Controller extends Controller
{
    public function index()
    {

        $collection = Setting2::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('dashboard.pages.settings2.edit', $setting);
    }
   
    public function update(Request $request)
    {
        $info = $request->except('_token', '_method', 'logo');
        foreach ($info as $key => $value) {
            Setting2::where('key', $key)->update(['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $logo_name = $request->file('logo')->getClientOriginalName();
            Setting2::where('key', 'logo')->update(['value' => $logo_name]);
            $this->uploadFile($request, 'logo', 'logo');
        }

        toastr()->success(__('تم تعديل البيانات بنجاح'));
        return back();


    }
    public function uploadFile($request, $name, $folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('/'.$folder.'/', $file_name, 'public');
    }
}