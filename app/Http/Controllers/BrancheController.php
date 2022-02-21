<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $branch = Branches::all();

            return DataTables::of($branch)
                ->addIndexColumn()

                ->editColumn('city_name', function (Branches $branch) {
                    return $branch->cities->city_name;
                })
                ->make(true);

        }

        return view('dashboard.pages.branches.index',[
            'branhes' => Branches::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.branches.create',[
            'cities' => City::get(),
        ]);
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
            'name' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'phoneNumber' => 'required|Digits:10|numeric|unique:branches',
            'email' => 'required|unique:branches|email',
            'manager_name' => 'required|string|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'city_id' => 'required',
        ]);
        //  return $request;
        $data = [];
        $data['name'] = $request->name;
        $data['phoneNumber'] = $request->phoneNumber;
        $data['email'] = $request->email;
        $data['manager_name'] = $request->manager_name;
        $data['city_id'] = $request->city_id;

        Branches::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('branches.index') ;
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
    public function edit(Branches $branch)
    {
        return view('dashboard.pages.branches.edit',[
            'branch' => $branch,
            'cities' => City::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branches $branch)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'phoneNumber' => 'required|numeric|unique:branches,phoneNumber,'. $branch->id,
            'email' => 'required|email|unique:branches,email,'.$branch->id,
            'manager_name' => 'required|string|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'city_id' => 'required',
        ]);
        //  return $request;
        $data = [];
        $data['name'] = $request->name;
        $data['phoneNumber'] = $request->phoneNumber;
        $data['email'] = $request->email;
        $data['manager_name'] = $request->manager_name;
        $data['city_id'] = $request->city_id;

        $branch->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('branches.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branches $branch)
    {
        $branch->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('branches.index') ;
    }
}
