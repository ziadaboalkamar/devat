@extends('dashboard.layouts.master')
@section('title','تعديل مستفيد')
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
                            <h2 class="content-header-title float-left mb-0">تعديل مستفيد</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المستفيدين</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل مستفيد
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
                                    <form class="row" action="{{ route('beneficiareis.update',$beneficiary->id) }}" method="POST" id="create_new">
                                        @csrf
                                        @method('put')
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم الاول</label>
                                            <input type="text" name="firstName" value="{{ old('firstName',$beneficiary->firstName) }}" class="form-control credit-card-mask" placeholder="اسم الاول"  />
                                            @error('firstName')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم الاب</label>
                                            <input type="text" name="secondName" value="{{ old('secondName',$beneficiary->secondName) }}" class="form-control credit-card-mask" placeholder="اسم الاب"  />
                                            @error('secondName')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم الجد</label>
                                            <input type="text" name="thirdName" value="{{ old('thirdName',$beneficiary->thirdName) }}" class="form-control credit-card-mask" placeholder="اسم الجد"  />
                                            @error('thirdName')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم العائلة</label>
                                            <input type="text" name="lastName" value="{{ old('lastName',$beneficiary->lastName) }}" class="form-control credit-card-mask" placeholder="اسم العائلة"  />
                                            @error('lastName')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="basicInput">الجنس</label>
                                                <select name="gender" class="form-control">
                                                    <option value="" selected disabled>.......</option>
                                                    @foreach ($getPossibleGender as $getPossiblegender)
                                                    <option value="{{ $getPossiblegender }}" {{ $getPossiblegender == $beneficiary->gender ? 'selected':'' }}> {{ $getPossiblegender }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">رقم الهوية</label>
                                            <input type="text" name="id_number" value="{{ old('id_number',$beneficiary->id_number) }}" class="form-control credit-card-mask" placeholder="رقم الهوية"  />
                                            @error('id_number')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">رقم الهاتف</label>
                                            <input type="text" name="PhoneNumber" value="{{ old('PhoneNumber',$beneficiary->PhoneNumber) }}" class="form-control credit-card-mask" placeholder="رقم الهاتف"  />
                                            @error('PhoneNumber')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">عدد افراد الاسرة</label>
                                            <select name="family_member" class="form-control">
                                                <option value="" selected disabled>اختر العدد</option>
                                                @foreach ($family_members as $family_member)
                                                <option value="{{ $family_member }}" {{ old('family_member',$beneficiary->family_member) == $family_member ? 'selected' : null }}>{{ $family_member }}</option>
                                                @endforeach
                                            </select>
                                            @error('family_member')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="basicInput">المدينة</label>
                                                <select name="city_id" class="form-control">
                                                    <option value="" selected disabled>اختر المدينة</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" {{ $city->id == $beneficiary->city_id ? 'selected':'' }}> {{ $city->city_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الحالة الاجتماعية</label>
                                            <select name="maritial" class="form-control">
                                                <option value="اعزب" {{ old('maritial',$beneficiary->maritial) == 'اعزب' ? 'selected' : null }}>اعزب</option>
                                                <option value="متزوج" {{ old('maritial',$beneficiary->maritial) == 'متزوج' ? 'selected' : null }}>متزوج</option>
                                                <option value="مطلق" {{ old('maritial',$beneficiary->maritial) == 'مطلق' ? 'selected' : null }}>مطلق</option>
                                                <option value="ارمل" {{ old('maritial',$beneficiary->maritial) == 'ارمل' ? 'selected' : null }}>ارمل</option>
                                            </select>
                                            @error('maritial')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-8 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">العنوان</label>
                                            <input type="text" name="address" value="{{ old('address',$beneficiary->address) }}" class="form-control credit-card-mask" placeholder="العنوان"  />
                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>


                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('beneficiareis.index') }}" class="btn btn-outline-secondary">اغلاق</a>
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
