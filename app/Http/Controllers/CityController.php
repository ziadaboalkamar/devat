<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $cities = City::all();

            return DataTables::of($cities)
                ->addIndexColumn()
                ->editColumn('created_at', function (City $cities) {
                    return $cities->created_at->format('Y-m-d');
                })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }

        return view('dashboard.pages.cities.index',[
            'cities' => City::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.cities.create');
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
            'city_name' => 'required|string',
        ],[
            'city_name.required' => 'هذا الحقل مطلوب',
            'city_name.string' => 'يجب ان يكون الحقل نصي',
        ]);

        $data = [];
        $data['city_name'] = $request->city_name;
        City::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('cities.index') ;

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
    public function edit(City $city)
    {
        return view('dashboard.pages.cities.edit',[
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'city_name' => 'required|string',
        ],[
            'city_name.required' => 'هذا الحقل مطلوب',
            'city_name.string' => 'يجب ان يكون الحقل نصي',
        ]);

        $data = [];
        $data['city_name'] = $request->city_name;
        $city->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('cities.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if(count($city->beneficiaries) > 0){
            toastr()->error(__('لايمكنك حذف هذه المدينة'));
            return redirect()->route('cities.index') ;
        }else{
            $city->delete();
            toastr()->success(__('تم حذف البيانات بنجاح'));

            return redirect()->route('cities.index') ;
        }

    }
}
