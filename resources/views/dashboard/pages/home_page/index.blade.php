@extends('dashboard.layouts.master')

@section('title','الصفحة الرئيسية')


@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">



                    </div>

                    <div class="row match-height">
                        <div class="col-lg-12 col-12">
                            <div class="row match-height">
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-3 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-body pb-50" style="background: #5463FF">
                                            <h6 style="color: white">المشاريع</h6>
                                            <h2 style="color: white" class="font-weight-bolder mb-1">{{\App\Models\Project::count()}}</h2>
                                            <div id="statistics-order-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-3 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-body pb-50" style="background: #FFC300">
                                            <h6 style="color: white">المستفدين</h6>
                                            <h2 style="color: white"  class="font-weight-bolder mb-1">{{\App\Models\Beneficiary::count()}}</h2>
                                            <div id="statistics-order-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-3 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-body pb-50" style="background: #FF1818">
                                            <h6 style="color: white">الفروع</h6>
                                            <h2 style="color: white" class="font-weight-bolder mb-1">{{\App\Models\Branches::count()}}</h2>
                                            <div id="statistics-order-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->

                                <!-- Line Chart - Profit -->
                                <div class="col-lg-3 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats">
                                        <div class="card-body pb-50" style="background: #42C2FF">
                                            <h6 style="color: white">المشاريع الفعالة</h6>
                                            <h2 style="color: white" class="font-weight-bolder mb-1">{{\App\Models\Project::where('status','=',1)->count()}}</h2>
                                            <div id="statistics-profit-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Line Chart - Profit -->
                            </div>
                        </div>

                    </div>

                    <div class="row match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>الفرع</th>
                                                <th>اسم المشروع</th>
                                                <th>عدد المستفيدين</th>
                                                <th>الحالة</th>
                                                <th>Sales</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/toolbox.svg"
                                                                     alt="Toolbar svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Dixons</div>
                                                            <div class="font-small-2 text-muted">meguc@ruj.io</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Technology</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">23.4k</span>
                                                        <span class="font-small-2 text-muted">in 24 hours</span>
                                                    </div>
                                                </td>
                                                <td>$891.2</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/parachute.svg"
                                                                     alt="Parachute svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Motels</div>
                                                            <div class="font-small-2 text-muted">vecav@hodzi.co.uk
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-success mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Grocery</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">78k</span>
                                                        <span class="font-small-2 text-muted">in 2 days</span>
                                                    </div>
                                                </td>
                                                <td>$668.51</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/brush.svg"
                                                                     alt="Brush svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Zipcar</div>
                                                            <div class="font-small-2 text-muted">davcilse@is.gov
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td>$522.29</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/star.svg"
                                                                     alt="Star svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Owning</div>
                                                            <div class="font-small-2 text-muted">us@cuhil.gov</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Technology</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">214</span>
                                                        <span class="font-small-2 text-muted">in 24 hours</span>
                                                    </div>
                                                </td>
                                                <td>$291.01</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/book.svg"
                                                                     alt="Book svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Cafés</div>
                                                            <div class="font-small-2 text-muted">pudais@jife.com
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-success mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Grocery</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">208</span>
                                                        <span class="font-small-2 text-muted">in 1 week</span>
                                                    </div>
                                                </td>
                                                <td>$783.93</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/rocket.svg"
                                                                     alt="Rocket svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Kmart</div>
                                                            <div class="font-small-2 text-muted">bipri@cawiw.com
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">990</span>
                                                        <span class="font-small-2 text-muted">in 1 month</span>
                                                    </div>
                                                </td>
                                                <td>$780.05</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/icons/speaker.svg"
                                                                     alt="Speaker svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Payers</div>
                                                            <div class="font-small-2 text-muted">luk@izug.io</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">12.9k</span>
                                                        <span class="font-small-2 text-muted">in 12 hours</span>
                                                    </div>
                                                </td>
                                                <td>$531.49</td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->

                        <!-- Developer Meetup Card -->

                        <!-- Transaction Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h4 class="card-title">الاشعارات</h4>
                                    <div class="dropdown chart-dropdown">
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"
                                           data-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-primary rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Wallet</h6>
                                                <small>Starbucks</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-success rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Bank Transfer</h6>
                                                <small>Add Money</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-danger rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Paypal</h6>
                                                <small>Add Money</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-warning rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Mastercard</h6>
                                                <small>Ordered Food</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-info rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Transfer</h6>
                                                <small>Refund</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Transaction Card -->
                        <!--/ Developer Meetup Card -->



                        <!-- Transaction Card -->
                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>اسم المؤسسة</th>
                                                <th>اسم المشروع</th>
                                                <th>تاريخ المنحة</th>
                                                <th>نوع المنحة</th>
                                                <th>قيمة المنحة</th>
                                                <th>تاريخ بداء التنفيذ</th>
                                                <th>الحالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->                        <!--/ Transaction Card -->
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection


