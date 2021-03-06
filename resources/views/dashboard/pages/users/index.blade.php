@extends('dashboard.layouts.master')
@section('title','المستخدمين')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
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
                                    <h2 class="content-header-title float-left mb-0">المستخدمين</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-body">
                        <section class="app-user-list">
                           
                            <div class="card">
                                <div class="card-datatable table-responsive pt-0">
                                    <table class="user-list-table table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الوظيفة</th>
                                            <th>الأيميل</th>
                                            <th>رقم الهاتف </th>
                                            <th>الصلاحيات</th>
                                            <th>الفرع</th>
                                            <th>الحالة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                            <!-- list section end -->
                        </section>
                        <!-- users list ends -->
                        <form action="{{route('users.create')}}" method="get" class="d-none" id="create_new">
                            @csrf
                            <button type="submit"></button>
                        </form>
                        @foreach ($users as $user)
                            <!-- Modal -->
                          <div class="modal fade" id="update_status{{ $user->id }}" tabindex="-1" role="dialog"
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
            <form action="{{ route('users.update.status') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">{{__('Status')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{__('اختر')}}--</option>
                            <option value="1" {{ old('status',$user->status) == 1 ? 'selected' : null }}>فعال</option>
                            <option value="0" {{ old('status',$user->status) == 0 ? 'selected' : null }}>غير فعال</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> حذف المستخدم <span class="text-primary">{{ $user->firstname }}</span></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <h5>هل انت متاكد من حذف البيانات</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
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
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

    <!-- END: Page Vendor JS-->

    <script>

        let project_table = $('.user-list-table').DataTable({
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
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
                url: '{{ route('users.index') }}',
            },
            columns: [
                {data: 'firstname', name:'firstname',searchable: true},
                {data: 'jobName',name:'jobName',searchable: true},
                {data: 'email',name:'email',searchable: true},
                {data: 'phoneNumber',name:'phoneNumber',searchable: true},
                {data: 'role_id',name:'role_id',searchable: false},
                {data: 'branch_id',name:'branch_id',searchable: false},
                {data: 'active', name:'active',searchable: false},
                {data: ''}




            ],

            order: [1, 'desc'],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle mr-2 mt-50',
                    text: feather.icons['share'].toSvg({class: 'font-small-4 mr-50'}) + 'تصدير',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({class: 'font-small-4 mr-50'}) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: {columns: [0, 1, 2, 3, 4]}
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({class: 'font-small-4 mr-50'}) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {columns: [0, 1, 2, 3, 4]}
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({class: 'font-small-4 mr-50'}) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {columns: [0, 1, 2, 3, 4]}
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({class: 'font-small-4 mr-50'}) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {columns: [0, 1, 2, 3, 4]}
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({class: 'font-small-4 mr-50'}) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {columns: [0, 1, 2, 3, 4]}
                        }
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },

                {
                    text: 'اضافة جديد',
                    className: 'add-new btn btn-primary mt-50',
                    onclick: "",
                    attr: {
                        'onclick': "document.getElementById('create_new').submit()",
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
                ,
            ],
            columnDefs:[
                {
                    // Actions
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var id = full['id'];
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({class: 'font-small-4'}) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="users/roles/' + id + '" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({class: 'font-small-4 mr-50'}) +
                            'الصلاحيات</a>'+
                            '<a href="users/edit/' + id + '" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({class: 'font-small-4 mr-50'}) +
                            'تعديل</a>' +

                            '<a href="javascript:void()" class="dropdown-item delete-record" data-toggle="modal" data-target="#delete' + id + '">' +
                            feather.icons['trash-2'].toSvg({class: 'font-small-4 mr-50'}) +

                            'حذف</a>'+

                            '<a href="javascript:void()" class="dropdown-item" data-toggle="modal"' +
                            ' data-target="#update_status' + id + '">' +
                            feather.icons['trash-2'].toSvg({
                                class: 'font-small-4 mr-50'
                            }) +
                            'تغيير الحالة</a> </div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ]


        });


    </script>

@stop
