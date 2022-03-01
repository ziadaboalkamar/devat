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

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
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
            <a href="{{ route('projects.beneficiareis.get', $project_id) }}" class="btn btn-outline-secondary">اغلاق</a>

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
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
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
                url: '{{ route('beneficiareis.get') }}',
                data: {'project_id': {{ $project_id }}}
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
                    data: '',

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

                        var isadded = full['isadded'];

                        if(isadded == 0 ) {
                        return (
                            '<div class="btn-group time-selector">' +
                            '<form id="saveFormBen'+id+'" method="post">' + '@csrf' +
                            '<input type="hidden" name="benficary_id"  value="' + id + '">' +
                            '<input type="hidden" name="project_id"  value="{{$project_id}}">' +
                            '<button id="save_ben' + id + '" value="' + id +
                               '" class="btn btn-outline-primary btn-sm rounded-pill beneficiary-check">اعتماد</button>' +
                            '</form>' +
                            ' </div>' +
                            '</div>' +
                            '</div>'
                        );
                    }else
                        {

                            return (
                                '<div class="btn-group time-selector">' +
                                '<form id="saveFormBen'+id+'" method="post">' + '@csrf' +
                                '<input type="hidden" name="benficary_id"  value="' + id + '">' +
                                '<input type="hidden" name="project_id"  value="{{$project_id}}">' +
                                '<button id="delete_ben' + id + '"  value="' + id +
                                '" class="btn btn-outline-danger btn-sm rounded-pill beneficiary-check">الغاء الاعتماد</button>' +
                                '</form>' +
                                ' </div>' +
                                '</div>' +
                                '</div>'
                            );


                        }


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
        var buttonApprove = document.getElementById('save_ben');
        var buttonDelete = document.getElementById('delete_ben');
        @foreach (\App\Models\Beneficiary::all() as $x)
            $(document).on('click', '#save_ben{{ $x->id }}', function (e) {
            e.preventDefault();
            console.log('hi');
            var saveFormBen = new FormData($('#saveFormBen{{$x->id}}')[0])
            $.ajax({
            type: 'post',
            url: "{{ route('beneficiareisProjects.store',$x->id) }}",
            data: saveFormBen,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
            if(data.status == 200){
            data.msg;
                $('#save_ben{{ $x->id }}').remove();
                var txt2 = $("<button id='delete_ben{{$x->id}}' class='btn btn-outline-danger btn-sm rounded-pill beneficiary-check'></button>").text("الغاء الاعتماد");  // Create text with jQuery

                $('#saveFormBen{{$x->id}}').append(txt2);
            toastr['success']('تم اضافة بنجاح', 'Progress Bar', {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,

            });



            }
            },
            error: function (project) {

            }
            })
            });
        @endforeach
    </script>

    <script>
        var buttonApprove = document.getElementById('save_ben');
        var buttonDelete = document.getElementById('delete_ben');
        @foreach (\App\Models\Beneficiary::all() as $x)
            $(document).on('click', '#delete_ben{{ $x->id }}', function (e) {
            e.preventDefault();
            var saveFormBen = new FormData($('#saveFormBen{{$x->id}}')[0])
            $.ajax({
            type: 'post',
            url: "{{ route('beneficiareisProjects.destroy',$x->id) }}",
            data: saveFormBen,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
            if(data.status == 200){
            data.msg;

            $('#delete_ben{{ $x->id }}').remove();
                var txt2 = $("<button id='save_ben{{ $x->id }}' class='btn btn-outline-primary btn-sm rounded-pill beneficiary-check'></button>").text("اعتماد");  // Create text with jQuery

                $('#saveFormBen{{$x->id}}').append(txt2);
            toastr['success']('تم الحذف بنجاح', 'Progress Bar', {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,

            });


            }
            },
            error: function (project) {

            }
            })
            });
        @endforeach
    </script>


@stop
