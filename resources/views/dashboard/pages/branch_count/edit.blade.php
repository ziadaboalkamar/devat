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
                            <h2 class="content-header-title float-left mb-0">تخصيص مشروع </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">تخصيص مشروع</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضافة تخصيص مشروع
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
                                    <h4 class="card-title">اضافة تخصيص</h4>
                                </div>
                                <div class="card-body">

                                    <form class="row invoice-repeater" action="{{route('projects.branchCount.update',$branchesCount->id)}}" method="POST" id="create_new">
                                        @csrf
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <div data-repeater-list="invoice">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="category_attachment_id">الفرع</label>
                                                                <select name="branch_id" class="form-control form-control-lg">
                                                                    <option value=""> --- </option>
                                                                    @if($branches && $branches -> count() > 0)
                                                                        @foreach($branches as $branch)
                                                                            <option @if($branch -> id == $branchesCount->branch_id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>

                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                @error('branch_id')<span class="text-danger">{{ $message }}</span>@enderror
                                                            </div></div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="customFile">عدد المستفيدين</label>
                                                                <input type="number" value="{{$branchesCount->beneficiaries_count}}" name="beneficiaries_count" placeholder="عدد المستفيدين" class="form-control prefix-mask" id="basicInputFile" />

                                                                @error('beneficiaries_count')<span class="text-danger">{{ $message }}</span>@enderror

                                                            </div></div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="customFile">الكمية المخصصة</label>
                                                                <input type="text" value="{{$branchesCount->count}}" name="count" class="form-control credit-card-mask" placeholder="الكمية المخصصة" id="credit-card" />
                                                                @error('count')<span class="text-danger">{{ $message }}</span>@enderror

                                                            </div></div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="customFile">تاريخ الانتهاء</label>
                                                                <input type="date" value="{{$branchesCount->deadline_date}}" name="deadline_date" class="form-control credit-card-mask" placeholder="الكمية المخصصة" id="credit-card" />
                                                                @error('deadline_date')<span class="text-danger">{{ $message }}</span>@enderror

                                                            </div></div>

                                                    </div>
                                                </div>
                                                <hr />
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
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/forms/form-repeater.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
@stop
