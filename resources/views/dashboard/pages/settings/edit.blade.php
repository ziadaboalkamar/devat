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
                            <h2 class="content-header-title float-left mb-0">تعديل الاعدادات</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">الاعدادات</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل الاعدادات
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
                                    <h4 class="card-title">تعديل الاعدادات</h4>
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data" method="post" action="{{route('settings.update','test')}}">
                                        @csrf
                                        {{-- @method('PUT') --}}
                                        <div class="row">
                                            <div class="col-md-6 border-right-2 border-right-blue-400">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label font-weight-semibold">اسم الجمعية<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input name="title" value="{{ $setting['title'] }}" required type="text"
                                                            class="form-control" placeholder="العنوان">
                                                    </div>
                                                </div>
                                               
                                               
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label font-weight-semibold">الهاتف</label>
                                                    <div class="col-lg-8">
                                                        <input name="phone" value="{{ $setting['phone'] }}" type="text" class="form-control"
                                                            placeholder="Phone">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label font-weight-semibold">البريد الالكتروني</label>
                                                    <div class="col-lg-8">
                                                        <input name="email" value="{{ $setting['email'] }}" type="email"
                                                            class="form-control" placeholder="البريد الالكتروني">

                                                    </div>
                                                </div>
                                                
                                                
                    
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label font-weight-semibold">شعار الجمعية</label>
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <img style="width: 100px" height="100px"
                                                                src="{{ asset('assets/logo/'.$setting['logo']) }}" alt="">
                                                        </div>
                                                        <input name="logo" accept="image/*" type="file" class="file-input"
                                                            data-show-caption="false" data-show-upload="false" data-fouc>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>

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
