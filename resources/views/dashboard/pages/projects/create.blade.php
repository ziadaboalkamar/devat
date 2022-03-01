@extends('dashboard.layouts.master')
@section('title', 'اضافة مشروع خيري جديد')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">

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
                            <h2 class="content-header-title float-left mb-0">اضافة مشروع</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المشاريع</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضافة مشروع
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
                                    <h4 class="card-title">اضافة مشروع</h4>
                                </div>
                                <div class="card-body">
                                    <form class="row invoice-repeater" action="{{ route('projects.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <label for="date">اسم المشروع</label>

                                            <input name="project_name" type="text" value="{{ old('project_name') }}"
                                                class="form-control date-mask" placeholder="اسم المشروع" />
                                            @error('project_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الجمعية الرئيسية</label>
                                            <select name="main_branch_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>

                                                @if ($mainBranches && $mainBranches->count() > 0)
                                                    @foreach ($mainBranches as $mainBranch)
                                                        <option value="{{ $mainBranch->id }}"
                                                            {{ old('main_branch_id') == $mainBranch->id ? 'selected' : null }}>
                                                            {{ $mainBranch->name }}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('main_branch_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="date">المؤسسات الداعمة</label>
                                            <select name="donor_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>

                                                @if ($donors && $donors->count() > 0)
                                                    @foreach ($donors as $donor)
                                                        <option value="{{ $donor->id }}"
                                                            {{ old('donor_id') == $donor->id ? 'selected' : null }}>
                                                            {{ $donor->name }}</option>

                                                    @endforeach
                                                @endif

                                            </select> @error('project_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="time">تاريخ المنحة</label>

                                            <input type="date" name="grant_date" value="{{ old('grant_date') }}" class="form-control time-mask"
                                                placeholder="hh:mm:ss" id="time" />
                                            @error('grant_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <!-- Basic -->
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label>نوع المنحة</label>
                                            <select name="category_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>

                                                @if ($categories && $categories->count() > 0)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':null }}>{{ $category->name }}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="numeral-formatting">قيمة المنحة</label>

                                            <input type="text" name="grant_value" value="{{ old('grant_value') }}" class="form-control numeral-mask"
                                                placeholder="10,000" id="قيمة المنحة" />
                                            @error('grant_value')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label>العملة</label>
                                            <select name="currency_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>
                                                @if ($currencies && $currencies->count() > 0)
                                                    @foreach ($currencies as $currency)
                                                        <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' :null }}>{{ $currency->name }}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('currency_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="delimiters">سعر الصرف</label>

                                            <input type="text" name="exchange_amount" value="{{ old('exchange_amount') }}" class="form-control delimiter-mask"
                                                placeholder="سعر الصرف" id="delimiters" />
                                            @error('exchange_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="prefix">الاداريات</label>

                                            <input type="text" name="managerial_fees" value="{{ old('managerial_fees') }}" class="form-control prefix-mask"
                                                id="prefix" />
                                            @error('managerial_fees')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="custom-delimiters">تاريخ بداء التنفيذ</label>

                                            <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control custom-delimiter-mask"
                                                placeholder="" id="custom-delimiters" />
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">

                                            <h4 class="card-title">المرفقات</h4>

                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <div data-repeater-list="invoice">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="category_attachment_id">نوع الملف</label>
                                                                <select name="category_attachment_id"
                                                                    class="form-control form-control-lg">
                                                                    <option value=""> --- </option>
                                                                    @if ($categories_attachment && $categories_attachment->count() > 0)
                                                                        @foreach ($categories_attachment as $category_attachment)
                                                                            <option value="{{ $category_attachment->id }}">
                                                                                {{ $category_attachment->name }}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                @error('category_attachment_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="customFile">ارفاق رابط</label>
                                                                <input type="url" name="url"
                                                                    class="form-control prefix-mask" value="{{ old('url') }}" id="basicInputFile" />

                                                                @error('url')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="customFile">ارفاق ملف</label>
                                                                <input type="file" name="file" value="null"
                                                                    class="form-control credit-card-mask"
                                                                    placeholder="المرفق" id="credit-card" />
                                                                @error('file')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-12 mb-50">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-danger text-nowrap px-1"
                                                                    data-repeater-delete type="button">
                                                                    <i data-feather="x" class="mr-25"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                    <button type="reset" class="btn btn-outline-secondary">اغلاق</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </section>

        </div>
        <!-- Input Mask End -->

    </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')



    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

@stop
