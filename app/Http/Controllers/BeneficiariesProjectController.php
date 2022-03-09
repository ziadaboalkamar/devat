<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiariesProjectRequest;
use App\Models\BeneficiariesProject;
use App\Models\Beneficiary;
use App\Models\Branches;
use App\Models\Project;
use App\Models\ProjectBranchCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BeneficiariesProjectController extends Controller
{
    public $project_id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project_id = $request->project_id;

        if ($request->ajax()) {
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

        return view('dashboard.pages.beneficiaries_projects.index', [
            'beneficiariesProjects' => BeneficiariesProject::get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user()->branch_id;

        $this->project_id = $request->project_id;
        if ($request->ajax()) {
            $user = Auth::user()->branch_id;
            $project_id = $this->project_id;
            $beneficiary = Beneficiary::where('branch_id', '=', $user)->where('status_id', 1)->get();
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
                ->editColumn('isadded', function (Beneficiary $beneficiary) use ($project_id) {

                    $exist = BeneficiariesProject::where('project_id', '=', $project_id)->where('beneficiary_id', '=', $beneficiary->id)->get();
                    if (count($exist) == 0) {
                        return 0;
                    } else {
                        return 1;
                    }
                })
                ->make(true);
        }

        for ($i = 1; $i < 16; $i++) {
            $n[] = $i;
        }
        return view('dashboard.pages.beneficiaries_projects.create', [

            'project_id' => $this->project_id,
            'family_members' => $n,
            'branchCount' => ProjectBranchCount::where('project_id','=', $this->project_id)->where('branch_id',$user)->first(),
            'beneficiariesCount' =>BeneficiariesProject::where('project_id', '=', $this->project_id)->where('branch_id', '=', $user)->count()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $beneficiary = Beneficiary::find($id);
        $branch_id = $beneficiary->branch_id;
        $project_id = $request->project_id;
        $branch_count = ProjectBranchCount::where('branch_id', $branch_id)->where('project_id', $project_id)->first();
        $beneficiaryCount = $branch_count->beneficiaries_count;
        $beneficiaryProject = BeneficiariesProject::where('project_id', $project_id)->where('branch_id', $branch_id)->count();
        if ($beneficiaryProject < $beneficiaryCount) {
            $data = [];
            $data['project_id'] = $request->project_id;

            $data['beneficiary_id'] = $id;
            $data['branch_id'] = $beneficiary->branch_id;
            $data['recever_name'] = null;
            $data['family_member_count'] = $beneficiary->family_member;
            $data['delivery_date'] = null;
            $data['employee_who_delivered'] = null;
            $data['status_id'] = 0;
            $success = BeneficiariesProject::create($data);

            if ($success) {

                return response()->json([
                    'status' => 200,
                ]);
            }
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }
    // return redirect()->route('projects.beneficiareis.get', $project_id)->with([$project_id, $beneficiariesProjects, $project]);




    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BeneficiariesProject $beneficiareis_project)
    {
        for ($i = 1; $i < 16; $i++) {
            $n[] = $i;
        }
        return view('dashboard.pages.beneficiaries_projects.edit', [
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
        return redirect()->route('beneficiareis-projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //  find($id)->delete()


        $data = BeneficiariesProject::where('project_id', '=', $request->project_id)->where('beneficiary_id', '=', $id)->delete();

        if ($data) {
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $b = BeneficiariesProject::findorfail($request->id);
        $b->update([
            'status_id' => $request->status_id
        ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('beneficiareis.index');
    }
    public function submitAll(Request $request){
        try {
            $branch_id = \auth()->user()->branch_id;

            $branchCount = ProjectBranchCount::where('project_id','=', $request->project_id)->where('branch_id',$branch_id)->first();
            if ($branchCount->status_id == 1){
                if ($request->ajax()){
                    $branch_id = \auth()->user()->branch_id;

                    $branchCount = ProjectBranchCount::where('project_id','=', $request->project_id)->where('branch_id',$branch_id)->first();
                    ProjectBranchCount::where('project_id', $request->project_id)->where('branch_id',$branch_id)->update([
                        'status_id' => 2,
                    ]);
                    return response()->json([
                        'status' => 200,
                    ]);
                }else{
                    ProjectBranchCount::where('project_id', $request->project_id)->where('branch_id',$branch_id)->update([
                        'status_id' => 2,
                    ]);

                    toastr()->success(__('تم اعتماد المستفدين بنجاح'));
                    return redirect()->back();
                }

            }




        }catch (\Exception $exception){
            toastr()->success(__('يوجد خطاء في الاعتماد'));
            return redirect()->back();
        }

    }
}
