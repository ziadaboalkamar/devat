@extends('dashboard.layouts.master')
@section('title','التفاصيل')
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
                            <h2 class="content-header-title float-left mb-0">تفاصيل مستفيد</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المستفيدين</a>
                                    </li>
                                    <li class="breadcrumb-item active">تفاصيل مستفيد
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
                                    <h4 class="card-title">عرض التفاصيل مستفيد</h4>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                            aria-labelledby="home-02-tab">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 border-right-2 border-right-blue-400">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('الاسم الاول')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->firstName }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('اسم الاب')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{$beneficiary->secondName}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('اسم الجد')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{$beneficiary->thirdName}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('اسم العائلة')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{$beneficiary->lastName}} </label>
                                                        </div>
                                                    </div>
                                                                                
                                                   
                                                                                
                                                             
                                                </div>
                                                <div class="col-lg-4 col-md-6 border-right-2 border-right-blue-400">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('الجنس')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->gender }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('رقم الهوية')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{$beneficiary->id_number}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('رقم الهاتف')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->PhoneNumber}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('عدد افراد الاسرة')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->family_member}} </label>
                                                        </div>
                                                    </div>
                                                                                
                                                   
                                                                                
                                                             
                                                </div>
                                                <div class="col-lg-4 col-md-6 border-right-2 border-right-blue-400">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('اسم الفرع')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->branchs->name }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('اسم المدينة')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->cities->city_name }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('العنوان')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->address }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('الحالة الاجتماعية')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->maritial }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label font-weight-semibold">{{__('الحالة ')}}</label>
                                                        <div class="col-lg-8">
                                                            <label class="col-lg-12 col-form-label font-weight-semibold">{{ $beneficiary->getActive() }} </label>
                                                        </div>
                                                    </div>
                                                                                
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="{{ route('beneficiareis.index') }}" class="btn btn-outline-secondary">اغلاق</a>
                                        </div>
            
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('js')
@stop
