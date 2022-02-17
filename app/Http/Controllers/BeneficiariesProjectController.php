<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiariesProjectRequest;
use App\Models\BeneficiariesProject;
use App\Models\Beneficiary;
use App\Models\Branches;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BeneficiariesProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $beneficiariesProject = BeneficiariesProject::all();

            return DataTables::of($beneficiariesProject)
                ->addIndexColumn()
                ->editColumn('created_at', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->created_at->format('Y-m-d');
                })

                ->editColumn('active', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->getActive();
                })
                ->editColumn('branch_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->branchs->address;
                })
                ->editColumn('beneficiary_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->address;
                })
                // ->editColumn('project_name', function (BeneficiariesProject $beneficiariesProject) {
                //     return $beneficiariesProject->projects->company_name;
                // })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);

        }

        return view('dashboard.pages.beneficiaries_projects.index',[
            'beneficiariesProjects' => BeneficiariesProject::get(),
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
        return view('dashboard.pages.beneficiaries_projects.create',[
            'projects' => Project::get(),
            'brnches' => Branches::get(),
            'beneficiaries' => Beneficiary::get(),
            'family_members' => $n,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiariesProjectRequest $request)
    {
        $data = [];
        $data['project_id'] = $request->project_id;
        $data['beneficiary_id'] = $request->beneficiary_id;
        $data['branch_id'] = $request->branch_id;
        $data['recever_name'] = $request->recever_name;
        $data['family_member_count'] = $request->family_member_count;
        $data['add_by'] = $request->add_by;
        $data['delivery_date'] = $request->delivery_date;
        $data['employee_who_delivered'] = $request->employee_who_delivered;
        $data['status'] = 1;
        
        BeneficiariesProject::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));
        return redirect()->route('beneficiareis-projects.index') ;
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
    public function edit(BeneficiariesProject $beneficiareis_project)
    {
        for($i = 1 ; $i < 16 ; $i++)
        {
            $n[] = $i;
        }
        return view('dashboard.pages.beneficiaries_projects.edit',[
            'projects' => Project::get(),
            'brnches' => Branches::get(),
            'beneficiaries' => Beneficiary::get(),
            'family_members' => $n,
            'beneficiareisProject' => $beneficiareis_project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiariesProjectRequest $request, BeneficiariesProject $beneficiareis_project)
    {
        $data = [];
        $data['project_id'] = $request->project_id;
        $data['beneficiary_id'] = $request->beneficiary_id;
        $data['branch_id'] = $request->branch_id;
        $data['recever_name'] = $request->recever_name;
        $data['family_member_count'] = $request->family_member_count;
        $data['add_by'] = $request->add_by;
        $data['delivery_date'] = $request->delivery_date;
        $data['employee_who_delivered'] = $request->employee_who_delivered;
        // $data['status_id'] = 1;

        $beneficiareis_project->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));
        return redirect()->route('beneficiareis-projects.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeneficiariesProject $beneficiareis_project)
    {
        $beneficiareis_project->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('beneficiareis-projects.index') ;
    }

    public function updateStatus(Request $request)
     {
        $b = BeneficiariesProject::findorfail($request->id);
            $b->update([
                'status_id'=>$request->status_id
            ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('beneficiareis.index') ;   
     }
}
