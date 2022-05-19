<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.roles.index',[
            'roles' => Role::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.roles.create');
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
            'name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);

        try {
            $role = $this->process(new Role, $request);
            if ($role){
                toastr()->success(__('تم الحفظ البيانات بنجاح'));
                return redirect()->route('roles.index');
            }
            else{
                toastr()->error(__('يوجد خطا ما'));
                return redirect()->route('roles.index');
            }
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('role')->find($id);
        return view('dashboard.pages.roles.show',[
            'user' => $user->role
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.pages.roles.edit',[
            'role' => $role,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {
            $role = $this->process($role, $request);
            if ($role){
                toastr()->success(__('تم التعديل البيانات بنجاح'));
                return redirect()->route('roles.index');
            }
            else{
                toastr()->error(__('يوجد خطا ما'));
                return redirect()->route('roles.index');
            }
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('roles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }
}
