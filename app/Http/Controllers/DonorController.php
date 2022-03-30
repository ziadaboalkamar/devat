<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $donor = Donor::all();
            return DataTables::of($donor)
                ->addIndexColumn()
                ->editColumn('created_at', function (Donor $donor) {
                    return $donor->created_at->format('Y-m-d');
                })
                ->editColumn('logo', function ($data) {
                    $url = asset('storage/' . $data->logo);
                    return '<img src="' . $url . '" border="0" width="80" class="img-rounded" align="center" />';
                })
                ->rawColumns(['logo', 'actions'])
                ->make(true);
        }

        return view('dashboard.pages.donors.index', [
            'donors' => Donor::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.donors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|Digits:10|numeric|unique:donors',
            'logo' => 'required|mimes:jpg,jpeg,png|max:2000',
            'email' => 'required|unique:donors|email',
        ],[
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'يجب ان يكون الحق نصي',
            'phone.digits' => 'يجب ان يكون عدد الارقام 10 ',
            'phone.numeric' => 'يجب ان يكون الحقل رقم',
            'phone.unique' => 'القيمة مستخدمة من قبل',
            'logo.required' => 'هذا الحقل مطلوب',
            'logo.mimes' => 'يجب ان تكون صيغة الملف jpg,jpeg,png ',
            'email.required' => 'هذا الحقل مطلوب',
            'email.unique' => 'القيمة مستخدمة من قبل',
            'email.email' => 'يجب ان تكون القيمة ايمبل صحيح',
        ]);
        //  return $request;
        $data = [];
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $img_path = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $img = $request->file('logo');
            $img_path = $img->store('Donors', 'public');
        }
        $data['logo'] = $img_path;
        Donor::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('donors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {

        return view('dashboard.pages.donors.edit', [
            'donor' => $donor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donor $donor)
    {
        // dd($request);
        // return $request;
        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|Digits:10|numeric|unique:donors,phone,' . $donor->id,
            'logo' => 'sometimes|mimes:jpg,jpeg,png|max:2000',
            'email' => 'required|email|unique:donors,email,' . $donor->id,
        ],[
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'يجب ان يكون الحق نصي',
            'phone.digits' => 'يجب ان يكون عدد الارقام 10 ',
            'phone.numeric' => 'يجب ان يكون الحقل رقم',
            'phone.unique' => 'القيمة مستخدمة من قبل',
            'logo.required' => 'هذا الحقل مطلوب',
            'logo.mimes' => 'يجب ان تكون صيغة الملف jpg,jpeg,png ',
            'email.required' => 'هذا الحقل مطلوب',
            'email.unique' => 'القيمة مستخدمة من قبل',
            'email.email' => 'يجب ان تكون القيمة ايمبل صحيح',
        ]);
        
        try{
            $data = [];
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $img_path = $donor->logo ?? null;
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                unlink('storage/' . $img_path);
                $imag = $request->file('logo');
               
                $img_path = $imag->store('Donors','public');
                
                $data['logo'] = $img_path;
            }
            $donor->update($data);
            toastr()->success(__('تم تعديل البيانات بنجاح'));
    
            return redirect()->route('donors.index');
        }catch (\Exception $ex) {
            toastr()->error(__('يوجد خطاء ما'));
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donor $donor)
    {
        if (File::exists('storage/' . $donor->logo)) {
            unlink('storage/' . $donor->logo);
        }
        if (count($donor->projects) > 0) {
            toastr()->error(__('لايمكنك حذف هذه المؤسسة'));
            return redirect()->route('donors.index');
        } else {
            $donor->delete();
            toastr()->success(__('تم حذف البيانات بنجاح'));
            return redirect()->route('donors.index');
        }
    }
}