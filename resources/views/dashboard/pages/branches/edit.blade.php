@extends('dashboard.layouts.master')
@section('title','edit')
@section('css')
@stop
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">تعديل فرع</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">الفروع</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل فرع
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Input Mask start -->
                <section id="input-mask-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">تعديل فرع</h4>
                                </div>
                                <div class="card-body">
                                    <form class="row" action="{{ route('branches.update',$branch->id) }}" method="POST" id="create_new">
                                        @csrf
                                        @method('put')
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم الفرع</label>
                                            <input type="text" name="name" value="{{ old('name',$branch->name) }}" class="form-control credit-card-mask" placeholder="اسم الفرع"  />
                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">رقم الهاتف</label>
                                            <input type="text" name="phoneNumber" value="{{ old('phoneNumber',$branch->phoneNumber) }}" class="form-control credit-card-mask" placeholder="رقم الهاتف"  />
                                            @error('phoneNumber')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">البريد الالكتروني</label>
                                            <input type="email" name="email" value="{{ old('email',$branch->email) }}" class="form-control credit-card-mask" placeholder="البريد الالكتروني"  />
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                       
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المدير</label>
                                            <input type="text" name="manager_name" value="{{ old('manager_name',$branch->manager_name) }}" class="form-control credit-card-mask" placeholder="اسم المدير"  />
                                            @error('manager_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
 
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="basicInput">المدينة</label>
                                                <select name="city_id" class="form-control">
                                                    <option value="" selected disabled>اختر المدينة</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" {{ old('city_id',$branch->city_id) == $city->id ? 'selected' : null }}> {{ $city->city_name }}</option>                                                      
                                                    @endforeach
                                                </select>
                                                @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
 
                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('branches.index') }}" class="btn btn-outline-secondary">اغلاق</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Input Mask End -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
@stop
