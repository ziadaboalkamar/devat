@extends('dashboard.layouts.master')
@section('title','تعديل مؤسسة داعمة')
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
                            <h2 class="content-header-title float-left mb-0">تعديل المؤسسات الداعمة</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المؤسسة الداعمة</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل مؤسسة داعمة
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
                                    <h4 class="card-title">تعديل مؤسسة داعمة</h4>
                                </div>
                                <div class="card-body">
                                    <form class="row" action="{{ route('donors.update',$donor->id) }}" method="POST" id="create_new" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المؤسسةالداعمة</label>
                                            <input type="text" name="name" value="{{ old('name',$donor->name) }}" class="form-control credit-card-mask" placeholder="اسم المؤسسة الداعمة"  />
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">رقم الهاتف</label>
                                            <input type="text" name="phone" value="{{ old('phone',$donor->phone) }}" class="form-control credit-card-mask" placeholder="رقم الهاتف"  />
                                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                       
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الشعار</label>
                                            @if ($donor->logo)
                                            <img src="{{asset('assets/'.$donor->logo)}}" height="80" alt="" class="ml-auto">
                                           @endif     
                                           <input type="file" name="logo" class="form-control credit-card-mask" placeholder="الشعار" id="credit-card" />
                                           @error('logo')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">البريد الالكتروني</label>
                                            <input type="email" name="email" value="{{ old('email',$donor->email) }}" class="form-control credit-card-mask" placeholder="البريد الالكتروني"  />
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
 
                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('donors.index') }}" class="btn btn-outline-secondary">اغلاق</a>
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
