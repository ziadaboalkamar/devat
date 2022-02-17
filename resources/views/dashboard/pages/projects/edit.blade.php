@extends('dashboard.layouts.master')
@section('title','تعديل مشروع خيري')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/select/select2.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/jstree.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/ext-component-tree.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/app-file-manager.css')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />





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
                                    <form class="row invoice-repeater" action="{{route('projects.update',$projects->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المؤسسة</label>
                                            <select name="main_branch_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>
                                                @if($mainBranches && $mainBranches -> count() > 0)
                                                    @foreach($mainBranches as $mainBranch)
                                                        <option @if($mainBranch->id == $projects->main_branch_id ) selected @endif value="{{$mainBranch->id}}">{{$mainBranch->name}}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('main_branch_id')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="date">اسم المشروع</label>
                                            <input name="project_name" value="{{$projects->project_name}}"  type="text" class="form-control date-mask" placeholder="اسم المشروع"  />
                                            @error('project_name')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="time">تاريخ المنحة</label>
                                            <input type="date" value="{{$projects->grant_date}}"  name="grant_date" class="form-control time-mask" placeholder="hh:mm:ss" id="time" />
                                            @error('grant_date')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <!-- Basic -->
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label>نوع المنحة</label>
                                            <select name="category_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>
                                                @if($categories && $categories -> count() > 0)
                                                    @foreach($categories as $category)
                                                        <option @if($category -> id == $projects->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="numeral-formatting">قيمة المنحة</label>
                                            <input value="{{$projects->grant_value}}"  type="text" name="grant_value" class="form-control numeral-mask" placeholder="10,000" id="قيمة المنحة" />
                                            @error('grant_value')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label>العملة</label>
                                            <select name="currency_id" class="select2 form-control form-control-lg">
                                                <option value=""> --- </option>
                                                @if($currencies && $currencies -> count() > 0)
                                                    @foreach($currencies as $currency)
                                                        <option  @if($currency -> id == $projects->currency_id) selected @endif  value="{{$currency->id}}">{{$currency->name}}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('currency_id')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="delimiters">سعر الصرف</label>
                                            <input value="{{$projects->exchange_amount}}" type="text" name="exchange_amount" class="form-control delimiter-mask" placeholder="سعر الصرف" id="delimiters" />
                                            @error('exchange_amount')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="prefix">الاداريات</label>
                                            <input value="{{$projects->managerial_fees}}"  type="text" name="managerial_fees" class="form-control prefix-mask" id="prefix" />
                                            @error('managerial_fees')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="custom-delimiters">تاريخ بداء التنفيذ</label>
                                            <input value="{{$projects->start_date}}"  type="date" name="start_date" class="form-control custom-delimiter-mask" placeholder="" id="custom-delimiters" />
                                            @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <!-- BEGIN: Content-->
                                            <div class="file-manager-application">
                                                <div class="content-area-wrapper">

                                                    <div class="content-right">
                                                        <div class="content-wrapper">
                                                            <div class="content-header row">
                                                            </div>
                                                            <div class="content-body">
                                                                <!-- overlay container -->
                                                                <div class="body-content-overlay"></div>

                                                                <!-- file manager app content starts -->
                                                                <div class="file-manager-main-content">
                                                                    <!-- search area start -->
                                                                    <div class="file-manager-content-header d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="sidebar-toggle d-block d-xl-none float-left align-middle ml-1">
                                                                                <i data-feather="menu" class="font-medium-5"></i>
                                                                            </div>
                                                                            <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
                                                                                <div class="input-group-prepend">
                                            <span class="input-group-text border-0">
                                                <i data-feather="search"></i>
                                            </span>
                                                                                </div>
                                                                                <input type="text" class="form-control files-filter border-0 bg-transparent" placeholder="Search" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="file-actions">
                                                                                <i data-feather="arrow-down-circle" class="font-medium-2 cursor-pointer d-sm-inline-block d-none mr-50"></i>
                                                                                <i data-feather="trash" class="font-medium-2 cursor-pointer d-sm-inline-block d-none mr-50"></i>
                                                                                <i data-feather="alert-circle" class="font-medium-2 cursor-pointer d-sm-inline-block d-none" data-toggle="modal" data-target="#app-file-manager-info-sidebar"></i>
                                                                                <div class="dropdown d-inline-block">
                                                                                    <i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button" id="fileActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    </i>
                                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="fileActions">
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="move" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Open with</span>
                                                                                        </a>
                                                                                        <a class="dropdown-item d-sm-none d-block" href="javascript:void(0);" data-toggle="modal" data-target="#app-file-manager-info-sidebar">
                                                                                            <i data-feather="alert-circle" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">More Options</span>
                                                                                        </a>
                                                                                        <a class="dropdown-item d-sm-none d-block" href="javascript:void(0);">
                                                                                            <i data-feather="trash" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Delete</span>
                                                                                        </a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="plus" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Add shortcut</span>
                                                                                        </a>
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="folder-plus" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Move to</span>
                                                                                        </a>
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="star" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Add to starred</span>
                                                                                        </a>
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="droplet" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Change color</span>
                                                                                        </a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                                                            <i data-feather="download" class="cursor-pointer mr-50"></i>
                                                                                            <span class="align-middle">Download</span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-group btn-group-toggle view-toggle ml-50" data-toggle="buttons">
                                                                                <label class="btn btn-outline-primary p-50 btn-sm active">
                                                                                    <input type="radio" name="view-btn-radio" data-view="grid" checked />
                                                                                    <i data-feather="grid"></i>
                                                                                </label>
                                                                                <label class="btn btn-outline-primary p-50 btn-sm">
                                                                                    <input type="radio" name="view-btn-radio" data-view="list" />
                                                                                    <i data-feather="list"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- search area ends here -->

                                                                    <div class="file-manager-content-body">


                                                                        <!-- Folders Container Starts -->
                                                                        <div class="view-container">
                                                                            <h6 class="files-section-title mt-25 mb-75">Folders</h6>
                                                                            <div class="files-header">
                                                                                <h6 class="font-weight-bold mb-0">Filename</h6>
                                                                                <div>
                                                                                    <h6 class="font-weight-bold file-item-size d-inline-block mb-0">Size</h6>
                                                                                    <h6 class="font-weight-bold file-last-modified d-inline-block mb-0">Last modified</h6>
                                                                                    <h6 class="font-weight-bold d-inline-block mr-1 mb-0">Actions</h6>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card file-manager-item folder level-up" >
                                                                                <div class="card-img-top file-logo-wrapper">
                                                                                    <div class="d-flex align-items-center justify-content-center w-100">
                                                                                        <i data-feather="arrow-up"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body pl-2 pt-0 pb-1">
                                                                                    <div class="content-wrapper">
                                                                                        <p class="card-text file-name mb-0">...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @foreach($projectsAttachment as $project1)
                                                                            <div class="card file-manager-item folder" id="file-manager-item">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                                                </div>
                                                                                <div class="card-img-top file-logo-wrapper">
                                                                                    <div class="dropdown float-right">
                                                                                        <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                                    </div>
                                                                                    <div class="d-flex align-items-center justify-content-center w-100">
                                                                                        <i data-feather="folder"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body">

                                                                                        <div class="content-wrapper">
                                                                                            <p class="card-text file-name mb-0">
                                                                                                <a @if($project1->file) href="{{asset('assets/'.$project1->file)}}" @else href="{{asset($project1->url)}}" @endif target="_blank">{{$project1->categoryAttachment->name}}</a></p>


                                                                                        </div>

                                                                                    @if($project1->file)
                                                                                        @for($i = 1; $i < count(explode('.', $project1->file)); $i++)
                                                                                    <small class="file-accessed text-muted">{{explode('.', $project1->file)[$i]}}</small>
                                                                                        @endfor
                                                                                    @endif
                                                                                    @if($project1->url)
                                                                                        <small class="file-accessed text-muted">url</small>
                                                                                    @endif
                                                                                    <small class="file-accessed text-muted">

                                                                                            <button id="delete_attachment" data-id="{{$project1->id}}" type="button" class="btn btn-danger">حذف</button>
                                                                                    </small>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                            <div class="d-none flex-grow-1 align-items-center no-result mb-3">
                                                                                <i data-feather="alert-circle" class="mr-50"></i>
                                                                                No Results
                                                                            </div>
                                                                        </div>
                                                                        <!-- /Folders Container Ends -->
                                                                    </div>
                                                                </div>
                                                                <!-- file manager app content ends -->

                                                                <!-- File Info Sidebar Starts-->
                                                                <div class="modal modal-slide-in fade show" id="app-file-manager-info-sidebar">
                                                                    <div class="modal-dialog sidebar-lg">
                                                                        <div class="modal-content p-0">
                                                                            <div class="modal-header d-flex align-items-center justify-content-between mb-1 p-2">
                                                                                <h5 class="modal-title">menu.js</h5>
                                                                                <div>
                                                                                    <i data-feather="trash" class="cursor-pointer mr-50" data-dismiss="modal"></i>
                                                                                    <i data-feather="x" class="cursor-pointer" data-dismiss="modal"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body flex-grow-1 pb-sm-0 pb-1">
                                                                                <ul class="nav nav-tabs tabs-line" role="tablist">
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link active" data-toggle="tab" href="#details-tab" role="tab" aria-controls="details-tab" aria-selected="true">
                                                                                            <i data-feather="file"></i>
                                                                                            <span class="align-middle ml-25">Details</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link" data-toggle="tab" href="#activity-tab" role="tab" aria-controls="activity-tab" aria-selected="true">
                                                                                            <i data-feather="activity"></i>
                                                                                            <span class="align-middle ml-25">Activity</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                                <div class="tab-content" id="myTabContent">
                                                                                    <div class="tab-pane fade show active" id="details-tab" role="tabpanel" aria-labelledby="details-tab">
                                                                                        <div class="d-flex flex-column justify-content-center align-items-center py-5">
                                                                                            <img src="{{asset('app-assets/images/icons/js.png')}}" alt="file-icon" height="64" />
                                                                                            <p class="mb-0 mt-1">54kb</p>
                                                                                        </div>
                                                                                        <h6 class="file-manager-title my-2">Settings</h6>
                                                                                        <ul class="list-unstyled">
                                                                                            <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                                <span>File Sharing</span>
                                                                                                <div class="custom-control custom-switch">
                                                                                                    <input type="checkbox" class="custom-control-input" id="sharing" />
                                                                                                    <label class="custom-control-label" for="sharing"></label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                                <span>Synchronization</span>
                                                                                                <div class="custom-control custom-switch">
                                                                                                    <input type="checkbox" class="custom-control-input" checked id="sync" />
                                                                                                    <label class="custom-control-label" for="sync"></label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                                <span>Backup</span>
                                                                                                <div class="custom-control custom-switch">
                                                                                                    <input type="checkbox" class="custom-control-input" id="backup" />
                                                                                                    <label class="custom-control-label" for="backup"></label>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <hr class="my-2" />
                                                                                        <h6 class="file-manager-title my-2">Info</h6>
                                                                                        <ul class="list-unstyled">
                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Type</p>
                                                                                                <p class="font-weight-bold">JS</p>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Size</p>
                                                                                                <p class="font-weight-bold">54kb</p>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Location</p>
                                                                                                <p class="font-weight-bold">Files > Documents</p>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Owner</p>
                                                                                                <p class="font-weight-bold">Sheldon Cooper</p>
                                                                                            </li>
                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Modified</p>
                                                                                                <p class="font-weight-bold">12th Aug, 2020</p>
                                                                                            </li>

                                                                                            <li class="d-flex justify-content-between align-items-center">
                                                                                                <p>Created</p>
                                                                                                <p class="font-weight-bold">01 Oct, 2019</p>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab">
                                                                                        <h6 class="file-manager-title my-2">Today</h6>
                                                                                        <div class="media align-items-center mb-2">
                                                                                            <div class="avatar avatar-sm mr-50">
                                                                                                <img src="{{asset('app-assets/images/avatars/5-small.png')}}" alt="avatar" width="28" />
                                                                                            </div>
                                                                                            <div class="media-body">
                                                                                                <p class="mb-0">
                                                                                                    <span class="font-weight-bold">Mae</span>
                                                                                                    shared the file with
                                                                                                    <span class="font-weight-bold">Howard</span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="media align-items-center">
                                                                                            <div class="avatar avatar-sm bg-light-primary mr-50">
                                                                                                <span class="avatar-content">SC</span>
                                                                                            </div>
                                                                                            <div class="media-body">
                                                                                                <p class="mb-0">
                                                                                                    <span class="font-weight-bold">Sheldon</span>
                                                                                                    updated the file
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h6 class="file-manager-title mt-3 mb-2">Yesterday</h6>
                                                                                        <div class="media align-items-center mb-2">
                                                                                            <div class="avatar avatar-sm bg-light-success mr-50">
                                                                                                <span class="avatar-content">LH</span>
                                                                                            </div>
                                                                                            <div class="media-body">
                                                                                                <p class="mb-0">
                                                                                                    <span class="font-weight-bold">Leonard</span>
                                                                                                    renamed this file to
                                                                                                    <span class="font-weight-bold">menu.js</span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="media align-items-center">
                                                                                            <div class="avatar avatar-sm mr-50">
                                                                                                <img src="{{asset('app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="Avatar" width="28" />
                                                                                            </div>
                                                                                            <div class="media-body">
                                                                                                <p class="mb-0">
                                                                                                    <span class="font-weight-bold">You</span>
                                                                                                    shared this file with Leonard
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h6 class="file-manager-title mt-3 mb-2">3 days ago</h6>
                                                                                        <div class="media">
                                                                                            <div class="avatar avatar-sm mr-50">
                                                                                                <img src="{{asset('app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="Avatar" width="28" />
                                                                                            </div>
                                                                                            <div class="media-body">
                                                                                                <p class="mb-50">
                                                                                                    <span class="font-weight-bold">You</span>
                                                                                                    uploaded this file
                                                                                                </p>
                                                                                                <img src="{{asset('app-assets/images/icons/js.png')}}" alt="Avatar" class="mr-50" height="24" />
                                                                                                <span class="font-weight-bold">app.js</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- File Info Sidebar Ends -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <!-- END: Content-->
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <div data-repeater-list="invoice">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="category_attachment_id">نوع الملف</label>
                                                                <select name="category_attachment_id" class="form-control form-control-lg">
                                                                    <option value=""> --- </option>
                                                                    @if($categories_attachment && $categories_attachment -> count() > 0)
                                                                        @foreach($categories_attachment as $category_attachment)
                                                                            <option value="{{$category_attachment->id}}">{{$category_attachment->name}}</option>

                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                @error('category_attachment_id')<span class="text-danger">{{ $message }}</span>@enderror
                                                            </div></div>

                                                        <div class="col-md-3">  <div class="form-group">
                                                                <label for="customFile">ارفاق رابط</label>
                                                                <input type="url" name="url" class="form-control prefix-mask" id="basicInputFile" />

                                                                @error('url')<span class="text-danger">{{ $message }}</span>@enderror

                                                            </div></div>
                                                        <div class="col-md-3"><div class="form-group">
                                                                <label for="customFile">ارفاق ملف</label>
                                                                <input type="file" name="file" class="form-control credit-card-mask" placeholder="المرفق" id="credit-card" />
                                                                @error('file')<span class="text-danger">{{ $message }}</span>@enderror

                                                            </div></div>
                                                        <div class="col-md-2 col-12 mb-50">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
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

    <script src="{{asset('app-assets/vendors/js/extensions/jstree.min.js')}}"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset("app-assets/vendors/js/forms/select/select2.full.min.js")}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset("app-assets/js/scripts/forms/form-select2.js")}}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/forms/form-repeater.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/app-file-manager.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click','#delete_attachment', function () {

            var delete_id = $(this).attr('data-id');
            var delete_element =document.getElementById('file-manager-item');
            var $ele = $(this).parent().parent().parent();
            swal.fire({
                html:'هل انت متأكد<b>بحذف<b/> هذا المرفق',
                icon: 'warning',
                showCancelButton:true,
                showCloseButton:true,
                cancelButtonText:'الغاء',
                confirmButtonText:'نعم,حذف',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#556ee6',

                allowOutsideClick:false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        url: "{{route('delete.attachment')}}"+ '/' + delete_id,

                        success: function (data) {
                                $ele.fadeOut().remove();

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    Swal.fire(
                        'تم الحذف بنجاح',

                    )
                }
            });

        });


    </script>


@stop
