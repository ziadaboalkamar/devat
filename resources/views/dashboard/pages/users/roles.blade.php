{{-- @extends('dashboard.layouts.master')
@section('title','الصلاحيات')
@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/css-rtl/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/app-user.css')}}">
    <!-- END: Page CSS-->
@stop

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">الصلاحيات</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- users edit start -->
                <section class="app-user-edit">
                    <div class="card">
                        <div class="card-body">
                            <!-- users edit account form start -->
                            <form class="form-validate" novalidate="novalidate" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username">الاسم كامل</label>
                                            <label for="" class="form-control"
                                                   style="font-size: 30px; border: none"> {{ $user->firstname.' '.$user->lastname  }} </label>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="card bg-secondary text-white" style="margin-top: 50px">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card ">
                                                            <div class="card-header">
                                                                <label for="">{{ $user->roles->role_name }}</label>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach($user->roles->route as $route)
                                                                    <div
                                                                        class="custom-control custom-checkbox custom-control-inline">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                               id="email-cb{{$route->id}}"
                                                                               checked disabled/>
                                                                        <label class="custom-control-label"
                                                                               for="email-cb{{$route->id}}">{{ $route->route_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="card ">
                                                            <div class="card-header">
                                                                <label for="">anther routes</label>
                                                            </div>
                                                            <form action="{{ route('user.role-update', $user->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                <div class="card-body">
                                                                    @foreach($routes as $route)
                                                                        <div class="custom-control custom-checkbox custom-control-inline">

                                                                            <input type="checkbox" value="{{$route->id}}"
                                                                                   class="custom-control-input"
                                                                                   name="roles[]"
                                                                                   @if($user->id == Auth::id()) disabled
                                                                                   @endif
                                                                                   id="email-cb{{$route->id}}" />
                                                                            <label class="custom-control-label"
                                                                                   for="email-cb{{$route->id}}">{{ $route->route_name }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                    @foreach($user_routes as $route)
                                                                        <div class="custom-control custom-checkbox custom-control-inline">

                                                                            <input type="checkbox" checked
                                                                                   value="{{$route->id}}"
                                                                                   class="custom-control-input"
                                                                                   name="roles[]"
                                                                                   @if($user->id ==    Auth::id()) disabled
                                                                                   @endif
                                                                                   id="email-cb{{$route->id}}"/>
                                                                            <label class="custom-control-label"
                                                                                   for="email-cb{{$route->id}}">{{ $route->route_name }}</label>
                                                                        </div>
                                                                    @endforeach


                                                                </div>
                                                                @if($user->id != Auth::id())
                                                                    <div class="card-footer ">
                                                                        <button type="submit"
                                                                                class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">
                                                                            {{__('dashboard.save_change')}}
                                                                        </button>
                                                                        <button type="reset"
                                                                                class="btn btn-outline-secondary waves-effect">{{__('dashboard.reset')}}</button>
                                                                    </div>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">

                                    </div>
                                </div>
                            </form>
                            <!-- users edit account form ends -->

                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js"')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/components/components-navs.js')}}"></script>
    <!-- END: Page JS-->


@stop --}}
