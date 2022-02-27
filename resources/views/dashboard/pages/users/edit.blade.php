@extends('dashboard.layouts.master')
@section('title','تعديل مستخدم')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/select/select2.min.css")}}">

    @stop
@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <form action="{{route('users.update',$user->id)}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الاسم الاول') }}</label>
                                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname',$user->firstname) }}" placeholder="ادحل الاسم الاول" />
                                        @error('firstname')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الاسم الاخير') }}</label>
                                        <input type="text" class="form-control" name="lastname" value="{{ old('lastname',$user->lastname) }}" placeholder="ادحل الاسم الاخير" />
                                        @error('lastname')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('اسم الوظيفة') }}</label>
                                        <input type="text" class="form-control" name="jobName" value="{{ old('jobName',$user->jobName) }}" placeholder="ادخل اسم الوظيفة"/>
                                        @error('jobName')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('البريد الالكتروني') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}" placeholder="ادخل البريد الالكتروني" />
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">

                                    <div class="form-group">
                                        <label for="basicInput">{{ __('رقم الجوال') }}</label>
                                        <input type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber',$user->phoneNumber) }}" placeholder="ادخل رقم الجوال" />
                                        @error('phoneNumber')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الصلاحيات') }}</label>
                                        <select name="rolle_id" class="form-control">
                                            <option value=""> --- </option>
                                            @if($roles && $roles -> count() > 0)
                                                @foreach($roles as $role)
                                                    <option @if($role -> id == $user->role_id) selected @endif value="{{$role->id}}">{{$role->name}}</option>

                                                @endforeach

                                            @endif
                                        </select>
                                        @error('rolle_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الفروع') }}</label>
                                        <select name="branch_id" class="form-control">
                                            <option value=""> --- </option>
                                            @if($branches && $branches -> count() > 0)
                                                @foreach($branches as $branch)
                                                    <option @if($branch -> id == $user->branch_id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>

                                                @endforeach

                                            @endif
                                        </select>
                                        @error('branch_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">بيانات التسجيل</h4>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="basicInput">{{ __('اسم المستخدم') }}</label>
                                            <input type="text" disabled class="form-control" name="userName" value="{{ old('userName',$user->userName) }}" placeholder="ادخل اسم المستخدم" />
                                            @error('userName')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">

                                        <div class="form-group">
                                            <label for="basicInput">{{ __('كلمة المرور') }}</label>
                                            <input type="password" class="form-control" name="password" value="{{ old('password','password') }}" placeholder="ادخل كلمة المرور" />
                                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">اغلاق</a>


                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')



    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset("app-assets/vendors/js/forms/select/select2.full.min.js")}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset("app-assets/js/scripts/forms/form-select2.js")}}"></script>
@stop
