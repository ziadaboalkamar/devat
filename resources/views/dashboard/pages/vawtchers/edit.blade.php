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
                            <h2 class="content-header-title float-left mb-0">تعديل قسيمة شرائية </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">القسائم الشرائية</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل قسيمة شرائية
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
                                    <h4 class="card-title">تعديل قسيمة شرائية</h4>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="row" action="{{ route('vawtchers.update',$vawtcher->id) }}" method="POST" id="create_new">
                                        @csrf
                                        @method('put')
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المستفيد</label>
                                            <select name="user_id" class="form-control">
                                                <option value="" selected disabled>اختر اسم المستفيد</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id',$vawtcher->user_id) == $user->id ? 'selected' : null }}> {{ $user->name }}</option>                                                      
                                                @endforeach
                                            </select>
                                            @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المشروع</label>
                                            <select name="project_id" class="form-control">
                                                <option value="" selected disabled>اختر المشروع</option>
                                                @foreach ($projects as $project)
                                                <option value="{{ $project->id }}" {{ old('project_id',$vawtcher->project_id) == $project->id ? 'selected' : null }}> {{ $project->name }}</option>                                                      
                                                @endforeach
                                            </select>
                                            @error('project_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">السعر</label>
                                            <input type="number" name="ammount" value="{{ old('ammount',$vawtcher->ammount) }}" class="form-control credit-card-mask" placeholder="السعر"  />
                                            @error('ammount')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-8 col-md-6 col-sm-12 mb-2">
                                           <div class="form-group">
                                                <label for="text">محتوى القسيمة الشرائية</label>
                                                <textarea class="form-control" name="text" id="text" rows="3" placeholder="محتوى القسيمة">{{ old('text',$vawtcher->text) }}</textarea>
                                                @error('text')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                           <div class="form-group">
                                                <label for="text">ملاحظة</label>
                                                <textarea class="form-control" name="note" id="text" rows="3" placeholder="ملاحظة ">{{ old('note',$vawtcher->note) }}</textarea>
                                                @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('vawtchers.index') }}" class="btn btn-outline-secondary">اغلاق</a>
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
