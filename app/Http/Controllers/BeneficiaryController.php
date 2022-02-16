<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryRequest;
use App\Models\Beneficiary;
use App\Models\Branches;
use App\Models\City;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function getPossibleGender(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM beneficiaries WHERE Field = "gender"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $beneficiary = Beneficiary::all();

            return DataTables::of($beneficiary)
                ->addIndexColumn()
                ->editColumn('created_at', function (Beneficiary $beneficiary) {
                    return $beneficiary->created_at->format('Y-m-d');
                })
                ->editColumn('city_name', function (Beneficiary $beneficiary) {
                    return $beneficiary->cities->city_name;
                })
                ->editColumn('active', function (Beneficiary $beneficiary) {
                    return $beneficiary->getActive();
                })
                ->editColumn('FullName', function (Beneficiary $beneficiary) {
                    return $beneficiary->getFullNameAttribute();
                })
                ->editColumn('branch_name', function (Beneficiary $beneficiary) {
                    return $beneficiary->branchs->name;
                })
                // ->editColumn('project_name', function (Beneficiary $beneficiary) {
                //     return $beneficiary->projects->company_name;
                // })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }

        return view('dashboard.pages.beneficiareis.index',[
            'beneficiareis' => Beneficiary::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        for($i = 1 ; $i < 16 ; $i++)
        {
            $n[] = $i;
        }
        return view('dashboard.pages.beneficiareis.create',[
            'cities' => City::get(),
            'projects' => Project::get(),
            'brnches' => Branches::get(),
            'getPossibleGender' =>BeneficiaryController::getPossibleGender(),
            'family_members' => $n,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiaryRequest $request)
    {
        $data = [];
        $data['firstName'] = $request->firstName;
        $data['secondName'] = $request->secondName;
        $data['thirdName'] = $request->thirdName;
        $data['lastName'] = $request->lastName;
        $data['gender'] = $request->gender;
        $data['id_number'] = $request->id_number;
        $data['PhoneNumber'] = $request->PhoneNumber;
        $data['family_member'] = $request->family_member;
        $data['branch_id'] = $request->branch_id;
        $data['city_id'] = $request->city_id;
        $data['address'] = $request->address;
        $data['maritial'] = $request->maritial;
        $data['status_id'] = 1;
        
        Beneficiary::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('beneficiareis.index') ;        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiary $beneficiarei)
    {
       return view('dashboard.pages.beneficiareis.show',[
           'beneficiary' => $beneficiarei,
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiary $beneficiarei)
    {
        for($i = 1 ; $i < 16 ; $i++)
        {
            $n[] = $i;
        }
        return view('dashboard.pages.beneficiareis.edit',[
            'cities' => City::get(),
            'projects' => Project::get(),
            'brnches' => Branches::get(),
            'getPossibleGender' => BeneficiaryController::getPossibleGender(),
            'beneficiary' => $beneficiarei,
            'family_members' => $n,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiaryRequest $request, Beneficiary $beneficiarei)
    {
        $data = [];
        $data['firstName'] = $request->firstName;
        $data['secondName'] = $request->secondName;
        $data['thirdName'] = $request->thirdName;
        $data['lastName'] = $request->lastName;
        $data['gender'] = $request->gender;
        $data['id_number'] = $request->id_number;
        $data['PhoneNumber'] = $request->PhoneNumber;
        $data['family_member'] = $request->family_member;
        $data['branch_id'] = $request->branch_id;
        $data['city_id'] = $request->city_id;
        $data['address'] = $request->address;
        $data['maritial'] = $request->maritial;
        
        $beneficiarei->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('beneficiareis.index') ;        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function updateStatus(Request $request)
     {
        $b = Beneficiary::findorfail($request->id);
            $b->update([
                'status_id'=>$request->status_id
            ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('beneficiareis.index') ;   
     }
    public function destroy(Beneficiary $beneficiarei)
    {
        $beneficiarei->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('beneficiareis.index') ;   
    }
}
