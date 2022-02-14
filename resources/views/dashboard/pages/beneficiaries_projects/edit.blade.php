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
                            <h2 class="content-header-title float-left mb-0">تعديل مشروع مستفيد</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">مشروع المستفيد</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل مشروع مستفيد
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
                                    <h4 class="card-title">تعديل مستفيد</h4>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="row" action="{{ route('beneficiareis-projects.update',$beneficiareisProject->id) }}" method="POST" id="create_new">
                                        @csrf
                                        @method('put')
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المشروع</label>
                                            <select name="branch_id" class="form-control">
                                                <option value="" selected disabled>اختر المشروع</option>
                                                @foreach ($projects as $project)
                                                <option value="{{ $project->id }}" {{ old('project_id', $beneficiareisProject->project_id) == $project->id ? 'selected' : null }}> {{ $project->company_name }}</option>                                                      
                                                @endforeach
                                            </select>
                                            @error('project_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المستفيد</label>
                                            <select name="beneficiary_id" class="form-control">
                                                <option value="" selected disabled>اختر المستفيد</option>
                                                @foreach ($beneficiaries as $beneficiarie)
                                                <option value="{{ $beneficiarie->id }}" {{ old('project_id', $beneficiareisProject->beneficiary_id) == $beneficiarie->id ? 'selected' : null }}> {{ $beneficiarie->address }}</option>                                                      
                                                @endforeach
                                            </select>
                                            @error('beneficiary_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="basicInput">اسم الفرع</label>
                                                <select name="branch_id" class="form-control">
                                                    <option value="" selected disabled>اختر الفرع</option>
                                                    @foreach ($brnches as $brnch)
                                                    <option value="{{ $brnch->id }}" {{ old('project_id', $beneficiareisProject->branch_id) == $brnch->id ? 'selected' : null }}> {{ $brnch->address }}</option>                                                      
                                                    @endforeach
                                                </select>
                                                @error('branch_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المتلقي</label>
                                            <input type="text" name="recever_name" value="{{ old('recever_name',$beneficiareisProject->recever_name) }}" class="form-control credit-card-mask" placeholder="اسم المتلقي"  />
                                            @error('recever_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">عدد افراد الاسرة</label>
                                            <select name="family_member_count" class="form-control">
                                                <option value="" selected disabled>اختر العدد</option>
                                                @foreach ($family_members as $family_member)
                                                <option value="{{ $family_member }}" {{ old('family_member_count',$beneficiareisProject->family_member_count) == $family_member ? 'selected' : null }}>{{ $family_member }}</option>
                                                @endforeach
                                            </select>
                                           
                                            @error('family_member_count')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                       
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">تاريخ التسليم</label>
                                            <input type="date" name="delivery_date" value="{{ old('delivery_date',$beneficiareisProject->delivery_date) }}" class="form-control credit-card-mask" placeholder="تاريخ التسليم"  />
                                            @error('delivery_date')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">أضيف من قبل</label>
                                            <input type="text" name="add_by" value="{{ old('add_by',$beneficiareisProject->add_by) }}" class="form-control credit-card-mask" placeholder="اضيف من قبل"  />
                                            @error('add_by')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الموظف الذي تم تسليمه</label>
                                            <input type="text" name="employee_who_delivered" value="{{ old('employee_who_delivered',$beneficiareisProject->employee_who_delivered) }}" class="form-control credit-card-mask" placeholder="الموظف الذي تم تسليمه"  />
                                            @error('employee_who_delivered')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        
                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('beneficiareis-projects.index') }}" class="btn btn-outline-secondary">اغلاق</a>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
@stop
