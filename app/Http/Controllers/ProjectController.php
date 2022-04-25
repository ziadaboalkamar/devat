<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Imports\ProjectImport;
use App\Models\AttachmentCategory;
use App\Models\BeneficiariesProject;
use App\Models\Beneficiary;
use App\Models\Branches;
use App\Models\CategoriesOfProject;
use App\Models\Currency;
use App\Models\Donor;
use App\Models\ImageAttachment;
use App\Models\MainBranche;
use App\Models\Project;
use App\Models\ProjectAttachment;
use App\Models\ProjectBranchCount;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

use Image;

class ProjectController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $project = Project::where('setting_status', auth()->user()->setting_status)->get();

            return DataTables::of($project)
                ->addIndexColumn()
                ->editColumn('main_branch_id', function (Project $project) {
                    return $project->mainBranches->name;
                })
                ->editColumn('category_id', function (Project $project) {

                    return $project->category->name;
                })
                ->editColumn('active', function (Project $project) {
                    return $project->getActive();
                })
                ->make(true);
        }


        return view('dashboard.pages.projects.index', [
            'projects' => Project::get(),
        ]);
    }


    public function create()
    {
        $categories = CategoriesOfProject::get();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $mainBranches = MainBranche::all();
        $donors = Donor::all();

        return view('dashboard.pages.projects.create', compact('categories', 'donors', 'mainBranches', 'categories_attachment', 'attachments', 'currencies'));
    }

    public function store(ProjectRequest $request)
    {
        // return $request;
        try {
            $data = array();
            $data['main_branch_id'] = $request->main_branch_id;
            $data['project_name'] = $request->project_name;
            $data['grant_date'] = $request->grant_date;
            $data['category_id'] = $request->category_id;
            $data['grant_value'] = $request->grant_value;
            $data['currency_id'] = $request->currency_id;
            $data['exchange_amount'] = $request->exchange_amount;
            $data['managerial_fees'] = $request->managerial_fees;
            $data['start_date'] = $request->start_date;
            $data['donor_id'] = $request->donor_id;
            $data['status'] = 1;
            $data['type'] = $request->type;
            $pro = Project::insertGetId($data);

            $img_path = null;
            if ($request->hasFile('image_one') && $request->file('image_one')->isValid()) {
                $img = $request->file('image_one');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_one'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_two') && $request->file('image_two')->isValid()) {
                $img = $request->file('image_two');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_two'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_three') && $request->file('image_three')->isValid()) {
                $img = $request->file('image_three');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_three'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_fore') && $request->file('image_fore')->isValid()) {
                $img = $request->file('image_fore');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_fore'] = $img_path;
            $img_path = null;
            if ($request->hasFile('image_five') && $request->file('image_five')->isValid()) {
                $img = $request->file('image_five');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_five'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_six') && $request->file('image_six')->isValid()) {
                $img = $request->file('image_six');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_six'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_seven') && $request->file('image_seven')->isValid()) {
                $img = $request->file('image_seven');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_seven'] = $img_path;

            $img_path = null;
            if ($request->hasFile('image_eight') && $request->file('image_eight')->isValid()) {
                $img = $request->file('image_eight');
                $img_path = $img->store('/projects', 'public');
            }
            $data['image_eight'] = $img_path;

            ImageAttachment::create([
                'project_id' => $pro,
                'image_one' => $data['image_one'],
                'image_two' => $data['image_two'],
                'image_three' => $data['image_three'],
                'image_fore' => $data['image_fore'],
                'image_five' => $data['image_five'],
                'image_six' => $data['image_six'],
                'image_seven' => $data['image_seven'],
                'image_eight' => $data['image_eight'],
            ]);

            // $project = Project::insertGetId([
            //     'main_branch_id' => $request->main_branch_id,
            //     'project_name' => $request->project_name,
            //     'grant_date' => $request->grant_date,
            //     'category_id' => $request->category_id,
            //     'grant_value' => $request->grant_value,
            //     'currency_id' => $request->currency_id,
            //     'exchange_amount' => $request->exchange_amount,
            //     'managerial_fees' => $request->managerial_fees,
            //     'start_date' => $request->start_date,
            //     'donor_id' => $request->donor_id,
            //     'status' => 1
            // ]);


            // $attachment_array = $request->invoice;

            // for ($i = 0; $i < count($attachment_array); $i++) {
            //     $file_attachment = null;
            //     if (isset($attachment_array[$i]['file'])) {
            //         $file_attachment = $attachment_array[$i]['file'];
            //         $file_attachment_path = $file_attachment->store('/Attachment_Project', 'public');

            //     } else {
            //         $file_attachment_path = null;
            //     }
            //     ProjectAttachment::create([
            //         'project_id' => $project,
            //         'category_id' => $attachment_array[$i]["category_attachment_id"],
            //         'file' => $file_attachment_path,
            //         'url' => $attachment_array[$i]["url"],
            //         'add_by' => Auth::user()->id,

            //     ]);
            // }

            toastr()->success(__('تم حفظ البيانات بنجاح'));
            return redirect()->route('projects.index');
        } catch (\Exception $ex) {

            return ($ex);
            // return redirect()->route('projects.index');
        }
    }

    public function edit($id)
    {
        //  return ImageAttachment::where('project_id',$id)->get();
        $projects = Project::select()->find($id);
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $imageAttachment = ImageAttachment::where('project_id', $id)->first();
        $donors = Donor::all();
        $mainBranches = MainBranche::all();

        return view('dashboard.pages.projects.edit', compact('projects', 'donors', 'mainBranches', 'imageAttachment', 'currencies', 'attachments', 'categories', 'categories_attachment'));
    }

    public function update($id, Request $request)
    {
        //    return $request;
        try {
        $project = Project::with('image')->find($id);
        // dd($project);
        if (!$project) {
            return redirect()->route('projects.index');
        }

        Project::where('id', $id)->update([
            'main_branch_id' => $request->main_branch_id,
            'project_name' => $request->project_name,
            'grant_date' => $request->grant_date,
            'category_id' => $request->category_id,
            'grant_value' => $request->grant_value,
            'currency_id' => $request->currency_id,
            'exchange_amount' => $request->exchange_amount,
            'managerial_fees' => $request->managerial_fees,
            'start_date' => $request->start_date,
            'donor_id' => $request->donor_id,
            'type' => $request->type,


        ]);

        $imag = ImageAttachment::where('project_id', $id)->first();
        $img_path = $project->image->image_one ?? null;
        if ($request->hasFile('image_one') && $request->file('image_one')->isValid()) {
            $imag = $request->file('image_one');
            if ($request->image_one && Storage::disk('public')->exists($request->image_one)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_one), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_one'] = $img_path;

        $img_path = $project->image->image_two ?? null;
        if ($request->hasFile('image_two') && $request->file('image_two')->isValid()) {
            $imag = $request->file('image_two');
            if ($request->image_two && Storage::disk('public')->exists($request->image_two)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_two), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_two'] = $img_path;

        $img_path = $project->image->image_three ?? null;
        if ($request->hasFile('image_three') && $request->file('image_three')->isValid()) {
            $imag = $request->file('image_three');
            if ($request->image_three && Storage::disk('public')->exists($request->image_three)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_three), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_three'] = $img_path;

        $img_path = $project->image->image_fore ?? null;
        if ($request->hasFile('image_fore') && $request->file('image_fore')->isValid()) {
            $imag = $request->file('image_fore');
            if ($request->image_fore && Storage::disk('public')->exists($request->image_fore)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_fore), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_fore'] = $img_path;

        $img_path = $project->image->image_five ?? null;
        if ($request->hasFile('image_five') && $request->file('image_five')->isValid()) {
            $imag = $request->file('image_five');
            if ($request->image_five && Storage::disk('public')->exists($request->image_five)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_five), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_five'] = $img_path;

        $img_path = $project->image->image_six ?? null;

        if ($request->hasFile('image_six') && $request->file('image_six')->isValid()) {
            $imag = $request->file('image_six');
            if ($request->image_six && Storage::disk('public')->exists($request->image_six)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_six), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_six'] = $img_path;

        $img_path = $project->image->image_seven ?? null;
        if ($request->hasFile('image_seven') && $request->file('image_seven')->isValid()) {
            $imag = $request->file('image_seven');
            if ($request->image_seven && Storage::disk('public')->exists($request->image_seven)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_seven), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_seven'] = $img_path;

        $img_path = $project->image->image_eight ?? null;
        if ($request->hasFile('image_eight') && $request->file('image_eight')->isValid()) {
            $imag = $request->file('image_eight');
            if ($request->image_eight && Storage::disk('public')->exists($request->image_seven)) {
                $img_path = $imag->storeAs('/projects', basename($imag->image_eight), 'public');
            } else {
                $img_path = $imag->store('/projects', 'public');
            }
        }
        $data['image_eight'] = $img_path;

        $imgAt = ImageAttachment::where('project_id', $id)->first();
        if ($imgAt == null) {
            ImageAttachment::create([
                'project_id' => $id,
                'image_one' => $data['image_one'],
                'image_two' => $data['image_two'],
                'image_three' => $data['image_three'],
                'image_fore' => $data['image_fore'],
                'image_five' => $data['image_five'],
                'image_six' => $data['image_six'],
                'image_seven' => $data['image_seven'],
                'image_eight' => $data['image_eight'],
            ]);
        } else {
            ImageAttachment::where('project_id', $id)->first()->update([
                'project_id' => $id,
                'image_one' => $data['image_one'],
                'image_two' => $data['image_two'],
                'image_three' => $data['image_three'],
                'image_fore' => $data['image_fore'],
                'image_five' => $data['image_five'],
                'image_six' => $data['image_six'],
                'image_seven' => $data['image_seven'],
                'image_eight' => $data['image_eight'],
            ]);
        }



        // $attachment_array = $request->invoice;
        // if ($attachment_array[0]["category_attachment_id"] != null) {
        //     for ($i = 0; $i < count($attachment_array); $i++) {
        //         $file_attachment = null;
        //         if (isset($attachment_array[$i]['file'])) {
        //             $file_attachment = $attachment_array[$i]['file'];
        //             $file_attachment_path = $file_attachment->store('/Attachment_Project', 'public');
        //         } else {
        //             $file_attachment_path = null;
        //         }
        //         ProjectAttachment::create([
        //             'project_id' => $id,
        //             'category_id' => $attachment_array[$i]["category_attachment_id"],
        //             'file' => $file_attachment_path,
        //             'url' => $attachment_array[$i]["url"],
        //             'add_by' => Auth::user()->id,

        //         ]);
        //     }
        // }
        toastr()->success(__('تم تحديث البيانات بنجاح'));
        return redirect()->route('projects.index');
        } catch (\Exception $exception) {

        toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('projects.index');
        }
    }

    public function deleteImag($id)
    {
        $gallery = ImageAttachment::findOrFail($id);
        // return $gallery;
        if(request()->query('image_one'))
        $gallery->image_one = null;
        if(request()->query('image_two'))
        $gallery->image_two = null;
        if(request()->query('image_three'))
        $gallery->image_three = null;
        if(request()->query('image_fore'))
        $gallery->image_fore = null;
        if(request()->query('image_five'))
        $gallery->image_five = null;
        if(request()->query('image_six'))
        $gallery->image_six = null;
        if(request()->query('image_seven'))
        $gallery->image_seven = null;
        if(request()->query('image_eight'))
        $gallery->image_eight = null;
        
        $gallery->save();
        Storage::disk('public')->delete($gallery->image_one);
        return redirect()->back();
    }
    public function delete($id)
    {
        try {
            $project = Project::find($id);
            $benefactoryPoject = BeneficiariesProject::where('project_id', '=', $id)->get();
            if (!$project) {
                toastr()->error(__('يوجد خطاء ما'));
                return redirect()->route('projects.index');
            }
            if (count($benefactoryPoject) > 0) {
                toastr()->error(__('هذا المشروع يحتوي على مستفيدين لا يمكن حذفه'));
                return redirect()->route('projects.index');
            }
            $imageAttachment = ImageAttachment::where('project_id', $id)->first();
            if(!empty($imageAttachment)){
                $imageAttachment->delete();
            }
            // if (File::exists('public/' . $imageAttachment->file)) {
            //     unlink('public/' . $imageAttachment->file);
            // }
            $project->delete();

            toastr()->success(__('تم حذف المشروع بنجاح'));
            return back();
        } catch (\Exception $ex) {
            return $ex;
            toastr()->error(__('يوجد خطاء ما'));
            return back();
        }
    }

    // public function deleteAttachment(ProjectAttachment $projectAttachment)
    // {
    //     if (File::exists('public/' . $projectAttachment->file)) {
    //         unlink('public/' . $projectAttachment->file);
    //     }
    //     $projectAttachment->delete();
    // }


    // public function deleteaa()
    // {
    // }

    public function benefactoryPoject($id, Request $request)
    {
        $user = Auth::user()->branch_id;

        if ($request->ajax()) {
            $user = Auth::user()->branch_id;

            $beneficiariesProject = BeneficiariesProject::where('project_id', '=', $id)->where('branch_id', '=', $user)->get();


            return DataTables::of($beneficiariesProject)
                ->addIndexColumn()
                ->editColumn('created_at', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->created_at->format('Y-m-d');
                })
                ->editColumn('active', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->getActive();
                })->editColumn('maritial', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->maritial;
                })
                ->editColumn('branch_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->branchs->name;
                })
                ->editColumn('id_number', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->id_number;
                })
                ->editColumn('beneficiary_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->firstName . ' ' . $beneficiariesProject->beneficiaries->lastName;
                })
                ->make(true);
        }

        return view('dashboard.pages.beneficiaries_projects.index', [
            'beneficiariesProjects' => BeneficiariesProject::where('project_id', '=', $id)->get(),
            'project_id' => $id,
            'project' => Project::find($id),
            'branchCount' => ProjectBranchCount::where('project_id', '=', $id)->where('branch_id', $user)->first(),
            'beneficiariesCount' => BeneficiariesProject::where('project_id', '=', $id)->where('branch_id', '=', $user)->count()

        ]);
    }

    public function benefactoryPojectForBranch($id, Request $request)
    {

        $project_branch_count = ProjectBranchCount::find($id);
        $project_id = $project_branch_count->project_id;


        if ($request->ajax()) {
            $project_branch_count = ProjectBranchCount::find($id);
            $project_id = $project_branch_count->project_id;
            $branch_id = $project_branch_count->branch_id;

            $beneficiariesProject = BeneficiariesProject::where('project_id', '=', $project_id)->where('branch_id', '=', $branch_id)->get();

            return DataTables::of($beneficiariesProject)
                ->addIndexColumn()
                ->editColumn('created_at', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->created_at->format('Y-m-d');
                })
                ->editColumn('active', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->getActive();
                })->editColumn('maritial', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->maritial;
                })
                ->editColumn('branch_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->branchs->name;
                })
                ->editColumn('beneficiary_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->firstName . ' ' . $beneficiariesProject->beneficiaries->lastName;
                })
                ->make(true);
        }

        return view('dashboard.pages.branch_count.beneficiaries_of_project', [
            'beneficiariesProjects' => BeneficiariesProject::where('project_id', '=', $id)->get(),
            'project_id' => $project_id,
            'project' => Project::find($project_id),
            'id' => $id
        ]);
    }

    public function allBenefactoryPoject($id, Request $request)
    {


        if ($request->ajax()) {
            $beneficiariesProject = BeneficiariesProject::where('project_id', '=', $id)->where('branch_status', 3)->get();


            return DataTables::of($beneficiariesProject)
                ->addIndexColumn()
                ->editColumn('created_at', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->created_at->format('Y-m-d');
                })
                ->editColumn('status', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->getActive();
                })
                ->editColumn('maritial', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->maritial;
                })
                ->editColumn('id_number', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->id_number;
                })
                ->editColumn('branch_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->branchs->name;
                })
                ->editColumn('beneficiary_name', function (BeneficiariesProject $beneficiariesProject) {
                    return $beneficiariesProject->beneficiaries->firstName . ' ' . $beneficiariesProject->beneficiaries->lastName;
                })
                ->make(true);
        }

        return view('dashboard.pages.beneficiaries_projects.showAll', [
            'beneficiariesProjects' => BeneficiariesProject::where('project_id', '=', $id)->get(),
            'project_id' => $id,
            'project' => Project::find($id)
        ]);
    }

    public function updateStatus(Request $request)
    {
        $b = Project::findorfail($request->id);
        $b->update([
            'status' => $request->status
        ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $projects = Project::select()->find($id);
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $projectsAttachment = ProjectAttachment::select()->where('project_id', '=', $id)->get();
        $donors = Donor::all();
        $mainBranches = MainBranche::all();


        return view('dashboard.pages.projects.show', compact('projects', 'donors', 'mainBranches', 'projectsAttachment', 'currencies', 'attachments', 'categories', 'categories_attachment'));
    }

    public function branchCount($id, Request $request)
    {
        $branch = ProjectBranchCount::where("project_id", "=", $id)->get();
        $project = Project::find($id);
        $ben = 0;
        $count = 0;
        foreach ($branch as $bran) {
            $ben += $bran->beneficiaries_count;
        }
        foreach ($branch as $bran) {
            $count += $bran->count;
        }

        $project_id = $id;

        if ($request->ajax()) {
            $branch = ProjectBranchCount::where("project_id", "=", $id)->get();

            return DataTables::of($branch)
                ->addIndexColumn()
                ->editColumn('branch_id', function (ProjectBranchCount $branchCount) {
                    return $branchCount->branches->name;
                })
                ->editColumn('active', function (ProjectBranchCount $branchCount) {
                    return $branchCount->getActive();
                })
                ->make(true);
        }

        return view('dashboard.pages.branch_count.index', compact('branch', 'project_id', 'project','ben','count'));
    }

    public function storeBranchCount($id, Request $request)
    {
        $branch = ProjectBranchCount::where("project_id", "=", $id)->get();
        $project = Project::find($id);
        $project_id = $id;
        $attachment_array = $request->invoice;

        $branch_id = [];
        foreach ($branch as $br) {
            $branch_id[] = $br->branch_id;
        }
        for ($i = 0; $i < count($attachment_array); $i++) {
            if (in_array($attachment_array[$i]["branch_id"], $branch_id)) {
                toastr()->error(__('لا يمكنك تخصيصه مجددا'));
                return redirect()->route('projects.branchCount.index', $project_id)->with([$project_id, $branch, $project]);
            } else {
                ProjectBranchCount::create([
                    'branch_id' => $attachment_array[$i]["branch_id"],
                    'beneficiaries_count' => $attachment_array[$i]["beneficiaries_count"],
                    'count' => $attachment_array[$i]["count"],
                    'deadline_date' => $attachment_array[$i]["deadline_date"],
                    'project_id' => $project_id,
                    'status_id' => 1
                ]);
            }
        }
        toastr()->success(__('تم اضافة تخصيص الفروع بنجاح'));
        return redirect()->route('projects.branchCount.index', $project_id)->with([$project_id, $branch, $project]);
    }
    function import(Request $request)
    {
        // return $request;
        $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();
        Excel::import(new ProjectImport, $path);
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}