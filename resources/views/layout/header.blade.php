<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                <div class="kt-section__content kt-section__content--solid">
                    <h3 style="line-height: 64px;color:#23714f;">
                        SIAPDUDIK
                        <small class="text-muted">Sistem Aplikasi Terpadu Pendidikan</small>
                    </h3>
                </div>

            </div>
        </div>
        <div class="kt-header__topbar">
            <div class="kt-header__topbar-item dropdown">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
                    <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                            </g>
                        </svg> <span class="kt-pulse__ring"></span>
                    </span>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                    <form>

                        <!--begin: Head -->
                        <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}})">
                            <h3 class="kt-head__title" style="text-align: left!important;text-indent: 20px;">
                                Notifikasi Kalender
                                &nbsp;
                                {{--<span class="btn btn-success btn-sm btn-bold btn-font-md">23 new</span>--}}
                            </h3>
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Agenda</a>
                                </li>
                            </ul>
                        </div>

                        <!--end: Head -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                    <div id="notif_calender">

                                    </div>
                                    <a href="/" class="kt-notification__item">
                                        <div class="kt-notification__item-details" style="color: #607D8B;">
                                            Lihat Semua
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--end: Notifications -->

            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                        <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                        <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->nama }} </span>
                        <img class="kt-hidden" alt="Pic" src="{{asset('/assets/media/users/300_25.jpg')}}" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ substr(Auth::user()->nama, 0, 1)}}</span>
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}})">
                        <div class="kt-user-card__avatar">
                            <img class="kt-hidden" alt="Pic" src="{{asset('/assets/media/users/300_25.jpg')}}" />

                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ substr(Auth::user()->nama, 0, 1)}}</span>
                        </div>
                        <div class="kt-user-card__name">
                           {{Auth::user()->nama}}
                        </div>
                        <div class="kt-user-card__badge">
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">{{Auth::user()->id}}</span>
                        </div>
                    </div>

                    <!--end: Head -->

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <a href="/" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-architecture-and-city kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Dashboard
                                </div>
                                <div class="kt-notification__item-time">
                                    Data profile dan kalender
                                </div>
                            </div>
                        </a>
                        @if(Auth::user()->login_type == 'admin' || Auth::user()->login_type == 'jurusan')
                            <a href="javascript:void(0)" id="ganti_password_admin" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="flaticon2-menu-4 kt-font-success"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title kt-font-bold">
                                        Ganti Password
                                    </div>
                                    <div class="kt-notification__item-time">
                                        Ubah password anda
                                    </div>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->login_type != 'admin' && Auth::user()->login_type != 'jurusan')
                        <a href="{{url('/data/'.Auth::user()->login_type .'/profile')}}" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Profil Saya
                                </div>
                                <div class="kt-notification__item-time">
                                    Ubah data dan biodata
                                </div>
                            </div>
                        </a>
                        <a href="{{url('/data/'.Auth::user()->login_type .'/gantipassword')}}" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-menu-4 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Ganti Password
                                </div>
                                <div class="kt-notification__item-time">
                                    Ubah password anda
                                </div>
                            </div>
                        </a>
                        @endif
                        <a href="javascript:void(0)" id="ganti_password_admin" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-download kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Panduan
                                </div>
                                <div class="kt-notification__item-time">
                                    Download Panduan Penggunaan
                                </div>
                            </div>
                        </a>
                        <div class="kt-notification__custom kt-space-between">

                            @guest
                            @else
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="btn btn-outline-success pull-right"><i class="fa fa-sign-out-alt"></i> Keluar</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            @endguest

                            
                        </div>
                    </div>

                    <!--end: Navigation -->
                </div>
            </div>

            <!--end: User Bar -->
        </div>

        <!-- end:: Header Topbar -->
    </div>
