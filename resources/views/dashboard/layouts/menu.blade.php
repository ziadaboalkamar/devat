<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href=""><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                                y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                                y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                              d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                              style="fill:currentColor"></path>
                                        <path id="Path1"
                                              d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                              fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                 points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                 points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                 points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                                                      data-i18n="Dashboards">الرئسية</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                                                data-i18n="Analytics">عرض الرئيسية</span></a>
                    </li>

                </ul>
            </li>

            @can('المستخدمين')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">المستخدمين</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\User::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('users.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">جميع
                                    المستخدمين</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('users.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                                    data-i18n="Preview">اضافة مستخدم</span></a>
                        </li>


                    </ul>
                </li>
            @endcan

            @can('الصلاحيات')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">الصلاحيات</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1"></span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('roles.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة الصلاحيات</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('roles.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                صلاحية</span></a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('الجمعيات الرئيسية')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="award"></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">الجمعية الرئيسية</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\MainBranche::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('main-branches.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة
                                    الجمعيات</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('main-branches.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    جمعية</span></a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('المدن')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='truck'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">المدن</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\City::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('cities.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة
                                    المدن</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('cities.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    المدينة</span></a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('فرع')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather="file-text"></i><span class="menu-title text-truncate"
                                                               data-i18n="Invoice">الفروع</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\Branches::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('branches.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة
                                    الفروع</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('branches.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    فرع</span></a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('المؤسسات الداعمة')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather='briefcase'></i><span class="menu-title text-truncate" data-i18n="Invoice">المؤسسات
                            الداعمة</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\Donor::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('donors.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة
                                    المؤسسات</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('donors.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    مؤسسة</span></a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('المستفيدين')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">المستفيدين</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\Beneficiary::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('beneficiareis.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة
                                    المستفيدين</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('beneficiareis.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    مستفيد</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('المشاريع')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='monitor'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">المشاريع الخيرية</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\Project::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('projects.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">عرض
                                    جميع المشاريع </span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('projects.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">انشاء
                                    مشروع جديد</span></a>
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                    data-feather="file-text"></i><span class="menu-title text-truncate"
                                                                       data-i18n="Invoice">اقسام المشاريع الخيرية</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center"
                                       href="{{ route('category-of-projects.index') }}"><i
                                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                                            data-i18n="List">كافة الاقسام</span></a>
                                <li><a class="d-flex align-items-center"
                                       href="{{ route('category-of-projects.create') }}"><i
                                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                                            data-i18n="List">انشاء قسم جديد</span></a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('الاعدادات')
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('settings.index') }}"><i
                            data-feather="settings"></i><span class="menu-title text-truncate"
                                                              data-i18n="Invoice">الاعدادات</span></a>
            @endcan
            @can('ادارة المشاريع الخيرية')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather='briefcase'></i><span class="menu-title text-truncate" data-i18n="Invoice">مشاريع الفرع</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1">{{ \App\Models\Donor::count() }}</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('projects.management.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">كافة المشاريع</span></a>
                        </li>
                    </ul>
                </li>
                @endcan</li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
