@extends('dashboard.layouts.master')
@section('title','create')
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
                            <h2 class="content-header-title float-left mb-0">اضافة مؤسسة</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المؤسسات</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضافة اضافة مؤسسة
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
                                    <h4 class="card-title">اضافة مؤسسة</h4>
                                </div>
                                <div class="card-body">
                                    <form class="row" action="{{ route('main-branches.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المؤسسة</label>
                                            <input type="text" name="name" class="form-control credit-card-mask" placeholder="اسم المؤسسة" id="credit-card" />
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الشعار</label>
                                            <input type="file" name="logo" class="form-control credit-card-mask" placeholder="الشعار" id="credit-card" />
                                            @error('logo')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                     
                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                                <a href="{{ route('main-branches.index') }}" class="btn btn-outline-secondary">اغلاق</a>
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
