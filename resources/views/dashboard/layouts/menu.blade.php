<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <span class="brand-logo">
                        @if (auth()->user()->setting_status == 0)
                            <img src="{{ asset('/assets/logo/' . App\Models\Setting::where('key', 'logo')->first()->value) }}"
                                alt="" srcset="">
                        @else
                            <img src="{{ asset('/assets/logo/' . App\Models\Setting2::where('key', 'logo')->first()->value) }}"
                                alt="" srcset="">
                        @endif
                    </span>
                    <h2 class="brand-text" style="font-size: 18px">
                        @if (auth()->user()->setting_status == 0)
                            {{ App\Models\Setting::where('key', 'title')->first()->value }}
                    </h2>
                @else
                    {{ App\Models\Setting2::where('key', 'title')->first()->value }}</h2>
                    @endif
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
                        data-i18n="Dashboards">??????????????</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Analytics">?????? ????????????????</span></a>
                    </li>

                </ul>
            </li>

            @can('????????????????????')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">????????????????????</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('users.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">????????
                                    ????????????????????</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('users.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Preview">?????????? ????????????</span></a>
                        </li>


                    </ul>
                </li>
            @endcan

            @can('??????????????????')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">??????????????????</span><span
                            class="badge badge-light-warning badge-pill ml-auto mr-1"></span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('roles.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">????????
                                    ??????????????????</span></a>
                        <li><a class="d-flex align-items-center" href="{{ route('roles.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">??????????
                                    ????????????</span></a>
                        </li>
                    </ul>
                </li>
            @endcan





            @can('????????????????????')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">????????????????????</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('beneficiareis.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="List">????????????????
                                    ??????????</span></a>

                        <li><a class="d-flex align-items-center" href="{{ route('beneficiareis.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">??????????
                                    ????????????</span></a>

                        </li>
                        <li>
                            @can('??????????????????')
                                <a class="d-flex align-items-center" href="{{ route('beneficiareis.allBeneficiaries') }}"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">????????
                                        ????????????????????</span></a>
                            @endcan

                        </li>
                    </ul>
                </li>
            @endcan
            @can('????????????????')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='monitor'></i><span
                            class="menu-title text-truncate" data-i18n="Invoice">???????????????? ??????????????</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('projects.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">??????
                                    ???????? ???????????????? </span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('projects.create') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">??????????
                                    ?????????? ????????</span></a>
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                    data-feather="file-text"></i><span class="menu-title text-truncate"
                                    data-i18n="Invoice">?????????? ???????????????? ??????????????</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center"
                                        href="{{ route('category-of-projects.index') }}"><i
                                            data-feather="circle"></i><span class="menu-item text-truncate"
                                            data-i18n="List">???????? ??????????????</span></a>
                                <li><a class="d-flex align-items-center"
                                        href="{{ route('category-of-projects.create') }}"><i
                                            data-feather="circle"></i><span class="menu-item text-truncate"
                                            data-i18n="List">?????????? ?????? ????????</span></a>
                                </li>

                            </ul>
                        </li>

                    </ul>

                </li>
            @endcan
            @if (auth()->user()->setting_status == 0)
                @can('??????????????????')
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                data-feather='monitor'></i><span class="menu-title text-truncate"
                                data-i18n="Invoice">?????????????????? ????????????</span></a>
                        <ul class="menu-content">
                            <li class=" nav-item"><a class="d-flex align-items-center"
                                    href="{{ route('settings.index') }}"><i data-feather="settings"></i><span
                                        class="menu-title text-truncate" data-i18n="Invoice">??????????????????</span></a>

                                @can('???????????????? ????????????????')
                                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                            data-feather="award"></i><span class="menu-title text-truncate"
                                            data-i18n="Invoice">?????????????? ????????????????</span></a>
                                    <ul class="menu-content">
                                        <li><a class="d-flex align-items-center" href="{{ route('main-branches.index') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">????????
                                                    ????????????????</span></a>
                                        <li><a class="d-flex align-items-center"
                                                href="{{ route('main-branches.create') }}"><i data-feather="circle"></i><span
                                                    class="menu-item text-truncate" data-i18n="List">??????????
                                                    ??????????</span></a>
                                        </li>

                                    </ul>
                                </li>
                            @endcan
                            @can('??????????')
                                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                            data-feather='truck'></i><span class="menu-title text-truncate"
                                            data-i18n="Invoice">??????????</span></a>
                                    <ul class="menu-content">
                                        <li><a class="d-flex align-items-center" href="{{ route('cities.index') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">????????
                                                    ??????????</span></a>
                                        <li><a class="d-flex align-items-center" href="{{ route('cities.create') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">??????????
                                                    ??????????????</span></a>
                                        </li>

                                    </ul>
                                </li>
                            @endcan
                            @can('??????')
                                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                            data-feather="file-text"></i><span class="menu-title text-truncate"
                                            data-i18n="Invoice">????????????</span></a>
                                    <ul class="menu-content">
                                        <li><a class="d-flex align-items-center" href="{{ route('branches.index') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">????????
                                                    ????????????</span></a>
                                        <li><a class="d-flex align-items-center" href="{{ route('branches.create') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">??????????
                                                    ??????</span></a>
                                        </li>

                                    </ul>
                                </li>
                            @endcan
                            @can('???????????????? ??????????????')
                                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                                            data-feather='briefcase'></i><span class="menu-title text-truncate"
                                            data-i18n="Invoice">????????????????
                                            ??????????????</span></a>
                                    <ul class="menu-content">
                                        <li><a class="d-flex align-items-center" href="{{ route('donors.index') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">????????
                                                    ????????????????</span></a>
                                        <li><a class="d-flex align-items-center" href="{{ route('donors.create') }}"><i
                                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                                    data-i18n="List">??????????
                                                    ??????????</span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>

                    </li>
                @endcan
            @else
                @can('??????????????????')
                    <li class=" nav-item"><a class="d-flex align-items-center"
                            href="{{ route('settings2.index') }}"><i data-feather="settings"></i><span
                                class="menu-title text-truncate" data-i18n="Invoice">??????????????????</span></a>
                    @endcan
            @endif


            @can('?????????? ???????????????? ??????????????')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                            data-feather='briefcase'></i><span class="menu-title text-truncate" data-i18n="Invoice">????????????
                            ??????????</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('projects.management.index') }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">????????
                                    ????????????????</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
