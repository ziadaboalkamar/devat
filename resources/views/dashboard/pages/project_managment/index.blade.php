@extends('dashboard.layouts.master')
@section('title', 'ادارة مشاريع خيرية')
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
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="content-wrapper">
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-left mb-0">ادارة المشاريع</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-body">
                        <!-- users list start -->
                        <section class="app-user-list">
                            <div class="card">
                                <div class="card-datatable table-responsive pt-0">
                                    <table class="project-list-table table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>اسم المشروع</th>
                                            <th>الكمية المخصصة</th>
                                            <th> عدد المستفيدين</th>
                                            <th>تاريخ الانتهاء</th>
                                            <th>الحالة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- list section end -->
                        </section>
                        <form action="{{ route('projects.management.index') }}" method="get" class="d-none"
                              id="create_new">
                            @csrf
                            <button type="submit"></button>
                        </form>
                    @foreach ($branch as $branchOne)
                        <!-- Modal -->
                            <div class="modal fade" id="update_status{{ $branchOne->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                تغيير الحالة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('projects.management.update.status') }}" method="post"
                                              autocomplete="off">
                                            {{ csrf_field() }}
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="status">{{__('Status')}}</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="" selected disabled>--{{__('اختر')}}--</option>
                                                        <option
                                                            value="2" {{ old('status',$branchOne->status) == 2 ? 'selected' : null }}>
                                                            تم الاعتماد
                                                        </option>
                                                        <option
                                                            value="0" {{ old('status',$branchOne->status) == 0 ? 'selected' : null }}>
                                                            انتظار
                                                        </option>
                                                        <option
                                                            value="1" {{ old('status',$branchOne->status) == 1? 'selected' : null }}>
                                                            قيد المتابعة

                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $branchOne->id }}">

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('الغاء')}}</button>
                                                <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

    <!-- END: Page Vendor JS-->

    <script>
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
                url: '{{route('projects.management.index')}}',
            },
            columns: [{
                data: 'project_id',
                name: 'project_id',
                searchable: true
            },
                {
                    data: 'count',
                    name: 'count',
                    searchable: true
                },
                {
                    data: 'beneficiaries_count',
                    name: 'beneficiaries_count',
                    searchable: true
                },
                {
                    data: 'deadline_date',
                    name: 'deadline_date',
                    searchable: true
                },

                {
                    data: 'active',
                    name: 'active',
                    searchable: false
                },
                {
                    data: ''
                }
            ],
            order: [2, 'desc'],
            buttons: [{
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle mr-2 mt-50',
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 mr-50'
                }) + 'تصدير',
                buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 mr-50'
                    }) + 'Print',
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                    {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ],
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass(
                            'd-inline-flex');
                    }, 50);
                }
            },


            ],
            columnDefs: [
                // Actions
                {
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var id = full['id'];
                        var project_id = full['project_name'];
                        var date = full['date'];
                        var deadline_date = full['deadline_date'];
                         if (date <= deadline_date){
                                return (
                                    '<div class="btn-group">' +
                                    '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                                    feather.icons['more-vertical'].toSvg({
                                        class: 'font-small-4'
                                    }) +
                                    '</a>' +

                                    '<div class="dropdown-menu dropdown-menu-right">' +

                                    '<a href="beneficiareis/'+project_id+'" class="dropdown-item">' +
                                    feather.icons['archive'].toSvg({
                                        class: 'font-small-4 mr-50'
                                    }) +
                                    'عرض مستفيدين</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            }else{
                             return(
                                 'لقد انتهاء تاريخ اضافة المستفيدين'
                             );
                         }

                            }
                }
            ]


        });
    </script>
    {{-- @toastr_js
@toastr_render --}}
@stop
