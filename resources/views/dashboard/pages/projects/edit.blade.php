@extends('dashboard.layouts.master')
@section('title', 'تعديل مشروع خيري')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/jstree.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/plugins/extensions/ext-component-tree.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/app-file-manager.css') }}" />
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
                            <h2 class="content-header-title float-left mb-0">تعديل مشروع</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">المشاريع</a>
                                    </li>
                                    <li class="breadcrumb-item active">تعديل مشروع
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
                                    <h4 class="card-title">تعديل مشروع</h4>
                                </div>
                                <div class="card-body">
                                    <form class="row invoice-repeater"
                                        action="{{ route('projects.update', $projects->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <label for="date">اسم المشروع</label>
                                            <input name="project_name" value="{{ $projects->project_name }}" type="text"
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
                                                        <option @if ($mainBranch->id == $projects->main_branch_id) selected @endif
                                                            value="{{ $mainBranch->id }}">{{ $mainBranch->name }}
                                                        </option>
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
                                                        <option @if ($donor->id == $projects->donor_id) selected @endif
                                                            value="{{ $donor->id }}">{{ $donor->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('project_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="time">تاريخ المنحة</label>
                                            <input type="date" value="{{ $projects->grant_date }}" name="grant_date"
                                                class="form-control time-mask" placeholder="hh:mm:ss" id="time" />
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
                                                        <option @if ($category->id == $projects->category_id) selected @endif
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="numeral-formatting">قيمة المنحة</label>
                                            <input value="{{ $projects->grant_value }}" type="text" name="grant_value"
                                                class="form-control numeral-mask" placeholder="10,000" id="قيمة المنحة" />
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
                                                        <option @if ($currency->id == $projects->currency_id) selected @endif
                                                            value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('currency_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="delimiters">سعر الصرف</label>
                                            <input value="{{ $projects->exchange_amount }}" type="text"
                                                name="exchange_amount" class="form-control delimiter-mask"
                                                placeholder="سعر الصرف" id="delimiters" />
                                            @error('exchange_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="prefix">الاداريات</label>
                                            <input value="{{ $projects->managerial_fees }}" type="text"
                                                name="managerial_fees" class="form-control prefix-mask" id="prefix" />
                                            @error('managerial_fees')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <select name="type" class="form-control">
                                                <option value="" disabled>---</option>
                                                <option value="fixed" {{ old('type', $projects->type) == 'fixed' ? 'selected' : null }}>ثابت</option>
                                                <option value="percentage" {{ old('type', $projects->type) == 'percentage' ? 'selected' : null }}>نسبة مؤوية</option>
                                            </select>
                                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="custom-delimiters">تاريخ بداء التنفيذ</label>
                                            <input value="{{ $projects->start_date }}" type="date" name="start_date"
                                                class="form-control custom-delimiter-mask" placeholder=""
                                                id="custom-delimiters" />
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                                            <!-- BEGIN: Content-->
                                            <h4 class="card-title">المرفقات</h4>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label> ورقة التخصيص <span class="tx-danger">*</span></label>
                                                <label class="custom-file">
                                                    <input type="file" id="file_id"
                                                        class="form-control custom-delimiter-mask" name="image_one"
                                                        onchange="readURL(this);">
                                                    <span class="custom-file-control"></span>

                                                    @if (isset($imageAttachment->image_one))
                                                        <img width="80" height="80"
                                                            src="{{ asset('storage/' . $imageAttachment->image_one) }}"
                                                            id="one" style="display: block;" alt="لا توجد صورة">
                                                        {{-- <button type="button" id="btn_one" class="btn btn-danger btn-sm"
                                                            onclick="delete1()">حذف</button> --}}<a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_one=true">حذف</a>
                                                    @else
                                                        <img width="80" height="80" src="#" id="one" style="display: none;"
                                                            alt="لا توجد صورة">
                                                        <button type="button" style="display: none" id="btn_one"
                                                            class="btn btn-danger btn-sm" onclick="delete1()">حذف</button>
                                                        <span class="text-danger" id="hint">لم يتم اختيار صورة</span>
                                                        <button type="button" id="btn_one" class="btn btn-danger btn-sm"
                                                            onclick="delete1()" style="display: none">حذف</button>
                                                    @endif


                                                </label>

                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label"> بدء التنفيذ: <span
                                                        class="tx-danger">*</span></label>
                                                <label class="custom-file">
                                                    <input type="file" id="file_id2"
                                                        class="form-control custom-delimiter-mask" name="image_two"
                                                        onchange="readURL2(this);">
                                                    <span class="custom-file-control"></span>
                                                    @if (isset($imageAttachment->image_two))
                                                        <img width="80" height="80"
                                                            src="{{ asset('storage/' . $imageAttachment->image_two) }}"
                                                            id="two" style="display: block;" alt="لا توجد صورة">
                                                            <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_two=true">حذف</a>
                                                    @else
                                                        <img width="80" height="80" src="#" id="two" style="display: none;"
                                                            alt="لا توجد صورة">
                                                        <button type="button" style="display: none" id="btn_two"
                                                            class="btn btn-danger btn-sm" onclick="delete2()">حذف</button>
                                                        <span class="text-danger" id="hint2">لم يتم اختيار صورة</span>
                                                        <button type="button" id="btn_two" class="btn btn-danger btn-sm"
                                                            onclick="delete2()" style="display: none">حذف</button>
                                                    @endif
                                                </label>

                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <label class="form-control-label"> عروض السعر: <span
                                                    class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file_id3" class="form-control custom-delimiter-mask"
                                                    name="image_three" onchange="readURL3(this);">
                                                <span class="custom-file-control"></span>
                                                @if (isset($imageAttachment->image_three))
                                                    <img width="80" height="80"
                                                        src="{{ asset('storage/' . $imageAttachment->image_three) }}"
                                                        id="three" style="display: block;" alt="لا توجد صورة">
                                                        <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_three=true">حذف</a>
                                                @else
                                                    <img width="80" height="80" src="#" id="three" style="display: none;"
                                                        alt="لا توجد صورة">
                                                    <button type="button" style="display: none" id="btn_three"
                                                        class="btn btn-danger btn-sm" onclick="delete3()">حذف</button>
                                                    <span class="text-danger" id="hint3">لم يتم اختيار صورة</span>
                                                    <button type="button" id="btn_three" class="btn btn-danger btn-sm"
                                                        onclick="delete3()" style="display: none">حذف</button>
                                                @endif
                                            </label>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>محضر الفتح<span class="tx-danger">*</span></label>
                                                <label class="custom-file">
                                                    <input type="file" id="file_id4"
                                                        class="form-control custom-delimiter-mask" name="image_fore"
                                                        onchange="readURL4(this);">
                                                    <span class="custom-file-control"></span>
                                                    @if (isset($imageAttachment->image_fore))
                                                        <img width="80" height="80"
                                                            src="{{ asset('storage/' . $imageAttachment->image_fore) }}"
                                                            id="fore" style="display: block;" alt="لا توجد صورة">
                                                            <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_fore=true">حذف</a>
                                                    @else
                                                        <img width="80" height="80" src="#" id="fore" style="display: none;"
                                                            alt="لا توجد صورة">
                                                        <button type="button" style="display: none" id="btn_fore"
                                                            class="btn btn-danger btn-sm" onclick="delete4()">حذف</button>
                                                        <span class="text-danger" id="hint4">لم يتم اختيار صورة</span>
                                                        <button type="button" id="btn_fore" class="btn btn-danger btn-sm"
                                                            onclick="delete4()" style="display: none">حذف</button>
                                                    @endif
                                                </label>

                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">محضر الترشيح : <span
                                                        class="tx-danger">*</span></label>
                                                <label class="custom-file">
                                                    <input type="file" id="file_id5"
                                                        class="form-control custom-delimiter-mask" name="image_five"
                                                        onchange="readURL5(this);">
                                                    <span class="custom-file-control"></span>
                                                    @if (isset($imageAttachment->image_five))
                                                        <img width="80" height="80"
                                                            src="{{ asset('storage/' . $imageAttachment->image_five) }}"
                                                            id="five" style="display: block;" alt="لا توجد صورة">
                                                            <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_five=true">حذف</a>
                                                    @else
                                                        <img width="80" height="80" src="#" id="five" style="display: none;"
                                                            alt="لا توجد صورة">
                                                        <button type="button" style="display: none" id="btn_five"
                                                            class="btn btn-danger btn-sm" onclick="delete5()">حذف</button>
                                                        <span class="text-danger" id="hint5">لم يتم اختيار صورة</span>
                                                        <button type="button" id="btn_five" class="btn btn-danger btn-sm"
                                                            onclick="delete5()" style="display: none">حذف</button>
                                                    @endif
                                                </label>

                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <label class="form-control-label"> كشف المستفيدين: <span
                                                    class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file_id6" class="form-control custom-delimiter-mask"
                                                    name="image_six" onchange="readURL6(this);">
                                                <span class="custom-file-control"></span>
                                                @if (isset($imageAttachment->image_six))
                                                    <img width="80" height="80"
                                                        src="{{ asset('storage/' . $imageAttachment->image_six) }}"
                                                        id="six" style="display: block;" alt="لا توجد صورة">
                                                        <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_six=true">حذف</a>
                                                @else
                                                    <img width="80" height="80" src="#" id="six" style="display: none;"
                                                        alt="لا توجد صورة">
                                                    <button type="button" style="display: none" id="btn_six"
                                                        class="btn btn-danger btn-sm" onclick="delete6()">حذف</button>
                                                    <span class="text-danger" id="hint6">لم يتم اختيار صورة</span>
                                                    <button type="button" id="btn_six" class="btn btn-danger btn-sm"
                                                        onclick="delete6()" style="display: none">حذف</button>
                                                @endif
                                            </label>

                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-control-label"> سند القبض: <span
                                                    class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file_id7" class="form-control custom-delimiter-mask"
                                                    name="image_seven" onchange="readURL7(this);">
                                                <span class="custom-file-control"></span>
                                                @if (isset($imageAttachment->image_seven))
                                                    <img width="80" height="80"
                                                        src="{{ asset('storage/' . $imageAttachment->image_seven) }}"
                                                        id="seven" style="display: block;" alt="لا توجد صورة">
                                                        <a class="btn btn-danger btn-sm" style="margin-bottom: 30px" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_seven=true">حذف</a>
                                                @else
                                                    <img width="80" height="80" src="#" id="seven" style="display: none;"
                                                        alt="لا توجد صورة">
                                                    <button type="button" style="display: none" id="btn_seven"
                                                        class="btn btn-danger btn-sm" onclick="delete7()">حذف</button>
                                                    <span class="text-danger" id="hint7">لم يتم اختيار صورة</span>
                                                    <button type="button" id="btn_seven" class="btn btn-danger btn-sm"
                                                        onclick="delete7()" style="display: none;margin-bottom: 30px">حذف</button>
                                                @endif
                                            </label>

                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-control-label"> تقرير ختامي: <span
                                                    class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file_id8" class="form-control custom-delimiter-mask"
                                                    name="image_eight" onchange="readURL8(this);">
                                                <span class="custom-file-control"></span>
                                                @if (isset($imageAttachment->image_eight))
                                                    <img width="80" height="80"
                                                        src="{{ asset('storage/' . $imageAttachment->image_eight) }}"
                                                        id="eight" style="display: block;" alt="لا توجد صورة">
                                                        <a class="btn btn-danger btn-sm" href="{{route('projects.deleteImag',[$imageAttachment->id])}}?image_eight=true">حذف</a>
                                                @else
                                                    <img width="80" height="80" src="#" id="eight" style="display: none;"
                                                        alt="لا توجد صورة">
                                                    <button type="button" style="display: none" id="btn_eight"
                                                        class="btn btn-danger btn-sm" onclick="delete8()">حذف</button>
                                                    <span class="text-danger" id="hint8">لم يتم اختيار صورة</span>
                                                    <button type="button" id="btn_eight" class="btn btn-danger btn-sm"
                                                        onclick="delete8()" style="display: none">حذف</button>
                                                @endif
                                            </label>

                                        </div>

                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit"
                                                class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <button type="reset" class="btn btn-outline-secondary"><a
                                                    href="{{ route('projects.index') }}">اغلاق</a></button>
                                        </div>
                                    </form>
                                    <!--<form method="post" enctype="multipart/form-data" action="{{ route('import_excel.import') }}">-->
                                    <!--    {{ csrf_field() }}-->
                                    <!--    <div class="form-group">-->
                                    <!--        <table class="table">-->
                                    <!--            <tr>-->
                                    <!--                <td width="40%" align="right"><label>Select File for Upload</label></td>-->
                                    <!--                <td width="30">-->
                                    <!--                    <input type="file" name="select_file" />-->
                                    <!--                </td>-->
                                    <!--                <td width="30%" align="left">-->
                                    <!--                    <input type="submit" name="upload" class="btn btn-primary" value="Upload">-->
                                    <!--                </td>-->
                                    <!--            </tr>-->
                                    <!--            <tr>-->
                                    <!--                <td width="40%" align="right"></td>-->
                                    <!--                <td width="30"><span class="text-muted">.xls, .xslx</span></td>-->
                                    <!--                <td width="30%" align="left"></td>-->
                                    <!--            </tr>-->
                                    <!--        </table>-->
                                    <!--    </div>-->
                                    <!--</form>-->
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

    <script src="{{ asset('app-assets/vendors/js/extensions/jstree.min.js') }}"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-file-manager.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '#delete_attachment', function() {

            var delete_id = $(this).attr('data-id');
            var delete_element = document.getElementById('file-manager-item');
            var $ele = $(this).parent().parent().parent();
            swal.fire({
                html: 'هل انت متأكد<b>بحذف<b/> هذا المرفق',
                icon: 'warning',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'الغاء',
                confirmButtonText: 'نعم,حذف',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',

                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('delete.attachment') }}" + '/' + delete_id,

                        success: function(data) {
                            $ele.fadeOut().remove();

                        },
                        error: function(data) {
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
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint').hide();
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#one').show();
                    $('#btn_one').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete1() {
            $('#hint').show();
            $('#one').hide();
            $('#btn_one').hide();
            $('#file_id').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint2').hide();
                    $('#two')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#two').show();
                    $('#btn_two').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete2() {
            $('#hint2').show();
            $('#two').hide();
            $('#btn_two').hide();
            $('#file_id2').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint3').hide();

                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#three').show();
                    $('#btn_three').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete3() {
            $('#hint3').show();
            $('#three').hide();
            $('#btn_three').hide();
            $('#file_id3').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint4').hide();

                    $('#fore')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#fore').show();
                    $('#btn_fore').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete4() {
            $('#hint4').show();
            $('#fore').hide();
            $('#btn_fore').hide();
            $('#file_id4').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint5').hide();

                    $('#five')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#five').show();
                    $('#btn_five').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete5() {
            $('#hint5').show();
            $('#five').hide();
            $('#btn_five').hide();
            $('#file_id5').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint6').hide();
                    $('#six')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#six').show();
                    $('#btn_six').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete6() {
            $('#hint6').show();
            $('#six').hide();
            $('#btn_six').hide();
            $('#file_id6').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL7(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint7').hide();

                    $('#seven')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#seven').show();
                    $('#btn_seven').show();

                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete7() {
            $('#hint7').show();
            $('#seven').hide();
            $('#btn_seven').hide();
            $('#file_id7').val('');
        }
    </script>
    <script type="text/javascript">
        function readURL8(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hint8').hide();

                    $('#eight')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                    $('#eight').show();
                    $('#btn_eight').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function delete8() {
            $('#hint8').show();
            $('#eight').hide();
            $('#btn_eight').hide();
            $('#file_id8').val('');
        }
    </script>

@stop