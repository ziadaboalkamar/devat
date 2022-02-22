@extends('dashboard.layouts.master')
@section('title','اضافة مستخدم جديد')
@section('css')

@endsection
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <form action="{{route("users.store")}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">البيانات الاساسية</h4>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الاسم الاول') }}</label>
                                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="ادحل الاسم الاول" />
                                        @error('firstname')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('الاسم الاخير') }}</label>
                                        <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="ادحل الاسم الاخير" />
                                        @error('lastname')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('اسم الوظيفة') }}</label>
                                        <input type="text" class="form-control" name="jobName" value="{{ old('jobName') }}" placeholder="ادخل اسم الوظيفة"/>
                                        @error('jobName')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="basicInput">{{ __('البريد الالكتروني') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ادخل البريد الالكتروني" />
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">

                                    <div class="form-group">
                                        <label for="basicInput">{{ __('رقم الجوال') }}</label>
                                        <input type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="ادخل رقم الجوال" />
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
                                                    <option value="{{$role->id}}" {{ old('rolle_id')== $role->id ? 'selected' : null}} >{{$role->name}}</option>

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
                                                    <option value="{{$branch->id}}" {{ old('branch_id') == $branch->id?'selected': null }}>{{$branch->name}}</option>

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
                                        <input type="text" class="form-control" {{ old('userName') }} name="userName" placeholder="ادخل اسم المستخدم" />
                                        @error('userName')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">

                                    <div class="form-group">
                                        <label for="basicInput">{{ __('كلمة المرور') }}</label>
                                        <input type="password" class="form-control" {{ old('password') }} name="password" placeholder="ادخل كلمة المرور" />
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

@endsection
