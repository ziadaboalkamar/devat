<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Branches;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::all();
        if($request->ajax()){
            $users = User::all();

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('created_at', function (User $users) {
                    return $users->created_at->format('Y-m-d');
                })
                ->editColumn('firstname', function (User $users) {
                    $firstName= $users->firstname;
                    $lastName= $users->lastname;

                    return $firstName.' '. $lastName;
                })
                ->editColumn('role_id', function (User $users) {

                    return $users->roles->role_name;
                })
                ->editColumn('active', function (User $user) {
                    return $user->getActive();
                })
                ->editColumn('branch_id', function (User $users) {
                    return $users->branches->name;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard.pages.users.index',compact('users'));
    }


    public function create(){
        try {
            $roles = Role::all();
            $branches = Branches::all();

            return view('dashboard.pages.users.create',compact('roles','branches'));
        }catch (\Exception $ex){

        }
        return view('dashboard.pages.users.create');
    }
    public function store(UserRequest $request){

        try {

            User::create([
                'firstname' => $request->firstname,
               'lastname' => $request->lastname,
               'jobName' => $request->jobName,
               'email' => $request->email,
               'phoneNumber' =>$request->phoneNumber ,
                'password' => bcrypt($request ->password) ,
               'role_id' => $request->rolle_id,
                'branch_id' => $request->branch_id,
                'userName'=>$request->userName,
                'status' => 1,
            ]);
            toastr()->success(__('تم حفظ البيانات بنجاح'));
            return redirect()->route('users.index');

        }catch (\Exception $ex){

            toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('users.index');
        }


    }
    public function edit($id){
        $user = User::select()->find($id);
        $roles = Role::all();
        $branches = Branches::all();
        if (!$user){
            return redirect()->route('users.index');
        }

        return view('dashboard.pages.users.edit' , compact('user','roles','branches'));
    }
    public function update(Request $request,$id){
        try {
            $user = User::select()->find($id);
            if (!$user){
                return redirect()->route('users.index');
            }
             $password = $request->password;
            if($password == "password"){
                   $password = $user->password;
            }

            else{
                $password = bcrypt($request ->password);
            }

            User::where('id' , $id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'jobName' => $request->jobName,
                'email' => $request->email,
                'phoneNumber' => $request -> phoneNumber ,
                'password' => $password,
                'role_id' => $request->rolle_id,
                'branch_id' => $request->branch_id,

            ]);
            toastr()->success(__('تم تحديث البيانات بنجاح'));
            return redirect()->route('users.index');

        }
        catch (\Exception $exception){
            return $exception;
            toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('users.index');

        }

    }

    public function destroy($id){
        try {
            $user= User::find($id);
            if (!$user){
                toastr()->error(__('يوجد خطاء ما'));
                return redirect()->route('user.index');
            }
            if (auth()->id() == $id){
                toastr()->error(__('لا يمكنك حذف نفسك'));
                return redirect()->route('user.index');
            }else{
                $user ->delete();
                toastr()->success(__('تم حذف المستخدم بنجاح'));
                return redirect()->route('users.index');

            }



        }catch (\Exception $ex){
            toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('users.index');
        }
    }

    public function updateStatus(Request $request)
     {
        $b = User::findorfail($request->id);
            $b->update([
                'status'=>$request->status
            ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('users.index') ;
     }
}
