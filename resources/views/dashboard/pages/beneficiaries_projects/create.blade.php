@extends('dashboard.layouts.master')
@section('title', 'اضافة مشروع مستفيد')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    {{-- @toastr_css --}}
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
                            <h2 class="content-header-title float-left mb-0">اضافة مشروع مستفيد</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">مشروع المستفيد</a>
                                    </li>
                                    <li class="breadcrumb-item active">اضافة مشروع مستفيد
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
                                <h5 class="card-header">Search Filter</h5>
                                <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
                                    <div class="col-md-3 user_name"></div>
                                    <div class="col-md-3 famely_num"></div>
                                    <div class="col-md-3 metr"></div>
                                    <div class="col-md-3 gender"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">اضافة مستفيد</h4>
                                </div>
                                <div class="card-body">
                                    @foreach ($beneficiaries as $beneficiariesProject)
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $beneficiariesProject->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المستفيد <span
                                                            class="text-primary"></span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('beneficiareis-projects.destroy', $beneficiariesProject->id) }}"
                                                    method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                                                        <input type="hidden" name="projec" value="{{ $beneficiariesProject->id }}">
                                                        <h5>هل انت متاكد من حذف البيانات</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('Close') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ __('submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @include('dashboard.pages.beneficiareis.updateStatus') --}}
                                @endforeach
                                    {{-- <form class="row" action="{{ route('beneficiareis-projects.store') }}" method="POST" id="create_new">
                                        @csrf
                                       
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <div class="form-group">
                                                <label for="basicInput">اسم الفرع</label>
                                                <select name="branch_id" class="form-control">
                                                    <option value="" selected disabled>اختر الفرع</option>
                                                    @foreach ($brnches as $brnch)
                                                    <option value="{{ $brnch->id }}" {{ old('branch_id') == $brnch->id ? 'selected' : null }}> {{ $brnch->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('branch_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">اسم المتلقي</label>
                                            <input type="text" name="recever_name" value="{{ old('recever_name') }}" class="form-control credit-card-mask" placeholder="اسم المتلقي"  />
                                            @error('recever_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">عدد افراد الاسرة</label>
                                            <select name="family_member_count" class="form-control">
                                                <option value="" selected disabled>اختر العدد</option>
                                                @foreach ($family_members as $family_member)
                                                <option value="{{ $family_member }}" {{ old('family_member_count') == $family_member ? 'selected' : null }}>{{ $family_member }}</option>
                                                @endforeach
                                            </select>

                                            @error('family_member_count')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">تاريخ التسليم</label>
                                            <input type="date" name="delivery_date" value="{{ old('delivery_date') }}" class="form-control credit-card-mask" placeholder="تاريخ التسليم"  />
                                            @error('delivery_date')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">أضيف من قبل</label>
                                            <input type="text" name="add_by" value="{{ old('add_by') }}" class="form-control credit-card-mask" placeholder="اضيف من قبل"  />
                                            @error('add_by')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label for="credit-card">الموظف الذي تم تسليمه</label>
                                            <input type="text" name="employee_who_delivered" value="{{ old('employee_who_delivered') }}" class="form-control credit-card-mask" placeholder="الموظف الذي تم تسليمه"  />
                                            @error('employee_who_delivered')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ</button>
                                            <a href="{{ route('beneficiareis-projects.index') }}" class="btn btn-outline-secondary">اغلاق</a>
                                        </div>
                                    </form> --}}

                                    <section class="app-user-list">
                                        <div class="card">
                                            <div class="card-datatable table-responsive pt-0">
                                                <table id="example" class="project-list-table table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>الاسم كاملا</th>
                                                            <th>الجنس</th>
                                                            <th>رقم الهوية</th>
                                                            <th>رقم الجوال</th>
                                                            <th>عدد افراد الاسرة</th>
                                                            <th>اسم الفرع</th>
                                                            <th>الحالة الاجتماعية</th>
                                                            <th>الحالة</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- list section end -->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            {{-- <button class="btn btn-success btn-save-project-beneficiaries">حفظ</button> --}}
            <a href="{{ route('projects.beneficiareis.get',$project_id) }}" class="btn btn-outline-secondary">اغلاق</a>

            </section>

        </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> --}}
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        let project_table = $('.project-list-table').DataTable({

            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('app-assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('beneficiareis.index') }}',
            },
            columns: [

                {
                    data: 'FullName',
                    name: 'FullName',
                    searchable: true
                },
                {
                    data: 'gender',
                    name: 'gender',
                    searchable: true
                },

                {
                    data: 'id_number',
                    name: 'id_number',
                    searchable: true
                },
                {
                    data: 'PhoneNumber',
                    name: 'PhoneNumber',
                    searchable: true
                },
                {
                    data: 'family_member',
                    name: 'family_member',
                    searchable: true
                },
                {
                    data: 'branch_name',
                    name: 'branch_name',
                    searchable: true
                },


                {
                    data: 'maritial',
                    name: 'maritial',
                    searchable: true
                },
                {
                    data: 'active',
                    name: 'active',
                    searchable: true
                },
                {
                    data: ''
                }
            ],
            order: [0, 'desc'],



            columnDefs: [
                // Actions
                {
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var id = full['id'];

                        return (
                            '<div class="btn-group time-selector">' +'<form id="saveFormBen" method="post">'+'@csrf'+
                                '<input type="hidden" name="benficary_id"  value="'+id+'">'+
                                '<input type="hidden" name="project_id"  value="{{$project_id}}">'+
                            '<button id="save_ben" value="'+id+'" class="btn btn-outline-primary btn-sm rounded-pill beneficiary-check">اعتماد</button>'
                            
                            +'</form>'+
                            ' </div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ],
            initComplete: function() {
                this.api()
                    .columns(4)
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value="">عدد ارفراد الاسرة</option></select>'
                            )
                            .appendTo('.famely_num')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                console.log(val);
                                column.search(val ? val : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d +
                                    '</option>');
                            });
                    });

                this.api()
                    .columns(6)
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> الحالة الاجتماعية </option></select>'
                            )
                            .appendTo('.metr')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                console.log(val);
                                column.search(val ? val : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d +
                                    '</option>');
                            });
                    });
                this.api()
                    .columns(1)
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> الجنس  </option></select>'
                            )
                            .appendTo('.gender')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                console.log(val);
                                column.search(val ? val : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d +
                                    '</option>');
                            });
                    });

                this.api()
                    .columns(0)
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<input value="" id="plan" class="form-control text-capitalize mb-md-0 mb-2" placeholder="الاسم كاملا">'
                            )
                            .appendTo('.user_name')
                            .on('keyup', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                console.log(val);
                                column.search(val ? val : '', true, false).draw();
                            });


                    });


            }


        });
    </script>
    <script>
            $(document).on('click', '#save_ben', function (e) {
        e.preventDefault();
       var saveFormBen = new FormData($('#saveFormBen')[0])
        $.ajax({
            type: 'post',
            url: "{{route('beneficiareisProjects.store')}}",
            data: saveFormBen,
            processData: false,
            contentType: false,
            cache: false,     
            success: function (data) {
                if(data.status == 200){
                   data.msg;
                }
            },
            error: function (project) {

            }
        })
    })
    </script>
    <script>
        $('.btn-save-project-beneficiaries').on('click', function(){
            var beneficiaries = Array();
            $('table .beneficiary-check').each(function(e){
                if($(this).prop('checked')){
                    beneficiaries.push($(this).val());
                }
            });
            
            $.ajax({
                type: "POST",
                url: "{{ route('beneficiareis-projects.store') }}",
                data: { beneficiaries: beneficiaries},
                dataType: 'json'
            }).done(function (data) {
                
            });
        })
    </script>
@stop
