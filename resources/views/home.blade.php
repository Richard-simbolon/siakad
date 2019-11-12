@extends('layout.app')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Dashboard</h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>

        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media kt-hidden-">
                                    <img src="assets/media/users/100_13.jpg" alt="image">
                                </div>
                                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                    JM
                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" class="kt-widget__username">
                                                {{ Auth::user()->nama }} 
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        <div class="kt-widget__action">
                                            <button type="button" class="btn btn-label-success btn-sm btn-upper"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon-user"></i>07212.2080</a>
                                        <a href="#"><i class="flaticon2-new-email"></i>jason@siastudio.com</a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i>Kelas A</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="display: inline-block!important;width: 100%;">
                                            <!--<div class="kt-widget__subhead">-->
                                            <!--<a href="#"><i class="flaticon2-calendar-3"></i>Teknologi Produksi Tanaman Perkebunan</a>-->
                                            <!--</div>-->
                                            Angkatan 2019 <br/> Teknologi Produksi Tanaman Perkebunan <br/>

                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-medal"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">IP Kumulatif</span>
                                        <span class="kt-widget__value">3.51</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-customer"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">IP Semester</span>
                                        <span class="kt-widget__value">3.90</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Total SKS</span>
                                        <span class="kt-widget__value">130</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-time"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Sisa SKS</span>
                                        <span class="kt-widget__value">10</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>
        <!--<div class="row">-->
        <!--<div class="col-xl-3">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/1.png" alt="image">-->
        <!--&lt;!&ndash;<i class="la la-trash"></i>&ndash;&gt;-->
        <!--</span>-->
        <!--&lt;!&ndash;<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">&ndash;&gt;-->
        <!--&lt;!&ndash;<img src="assets/media/users/100_12.jpg" alt="image">&ndash;&gt;-->
        <!--&lt;!&ndash;</span>&ndash;&gt;-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--3.14-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Indeks Prestasi Kumulatif-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->

        <!--<div class="col-xl-3">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/1.png" alt="image">-->
        <!--</span>-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">-->
        <!--<img src="assets/media/users/100_12.jpg" alt="image">-->
        <!--</span>-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--3.4-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Indeks Prestasi Sementara-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->

        <!--<div class="col-xl-3">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/1.png" alt="image">-->
        <!--</span>-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">-->
        <!--<img src="assets/media/users/100_12.jpg" alt="image">-->
        <!--</span>-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--130-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Jumlah SKS-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->

        <!--<div class="col-xl-3">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/1.png" alt="image">-->
        <!--</span>-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">-->
        <!--<img src="assets/media/users/100_12.jpg" alt="image">-->
        <!--</span>-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--<h3>3</h3>-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Sisa SKS-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->
        <!--</div>-->

        <!--<div class="row">-->
        <!--<div class="col-xl-6">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/3.png" alt="image">-->
        <!--</span>-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">-->
        <!--<img src="assets/media/users/100_12.jpg" alt="image">-->
        <!--</span>-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--Pengumuman-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Creates Limitless possibilities-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->

        <!--<div class="kt-widget__body">-->
        <!--<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5">-->
        <!--Objecttives could be merely i distinguish three<br>-->
        <!--main text objective-->
        <!--</span>-->
        <!--<div class="kt-widget__stats kt-margin-t-20">-->
        <!--<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">-->
        <!--<span class="kt-widget__date kt-padding-0 kt-margin-r-10">-->
        <!--Start-->
        <!--</span>-->
        <!--<div class="kt-widget__label">-->
        <!--<span class="btn btn-label-brand btn-sm btn-bold btn-upper">14 dec, 18</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">-->
        <!--<span class="kt-widget__date kt-padding-0 kt-margin-r-10 ">-->
        <!--Due-->
        <!--</span>-->
        <!--<div class="kt-widget__label">-->
        <!--<span class="btn btn-label-danger btn-sm btn-bold btn-upper">07 oct, 18</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="kt-widget__stats kt-margin-t-20">-->
        <!--<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">-->
        <!--<span class="kt-widget__date kt-padding-0 kt-margin-r-10">-->
        <!--Start-->
        <!--</span>-->
        <!--<div class="kt-widget__label">-->
        <!--<span class="btn btn-label-brand btn-sm btn-bold btn-upper">14 dec, 18</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">-->
        <!--<span class="kt-widget__date kt-padding-0 kt-margin-r-10 ">-->
        <!--Due-->
        <!--</span>-->
        <!--<div class="kt-widget__label">-->
        <!--<span class="btn btn-label-danger btn-sm btn-bold btn-upper">07 oct, 18</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="kt-widget__container">-->
        <!--<span class="kt-widget__subtitel">Progress</span>-->
        <!--<div class="kt-widget__progress d-flex align-items-center flex-fill">-->
        <!--<div class="progress" style="height: 5px;width: 100%;">-->
        <!--<div class="progress-bar kt-bg-success" role="progressbar" style="width: 44%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>-->
        <!--</div>-->
        <!--<span class="kt-widget__stat">-->
        <!--44%-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->
        <!--<div class="col-xl-6">-->

        <!--&lt;!&ndash;begin:: Portlet&ndash;&gt;-->
        <!--<div class="kt-portlet kt-portlet&#45;&#45;height-fluid">-->
        <!--<div class="kt-portlet__body kt-portlet__body&#45;&#45;fit">-->

        <!--&lt;!&ndash;begin::Widget &ndash;&gt;-->
        <!--<div class="kt-widget kt-widget&#45;&#45;project-1">-->
        <!--<div class="kt-widget__head d-flex">-->
        <!--<div class="kt-widget__label">-->
        <!--<div class="kt-widget__media kt-widget__media&#45;&#45;m">-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden-">-->
        <!--<img src="assets/media/project-logos/3.png" alt="image">-->
        <!--</span>-->
        <!--<span class="kt-media kt-media&#45;&#45;md kt-media&#45;&#45;circle kt-hidden">-->
        <!--<img src="assets/media/users/100_12.jpg" alt="image">-->
        <!--</span>-->
        <!--</div>-->
        <!--<div class="kt-widget__info kt-padding-0 kt-margin-l-15">-->
        <!--<a href="#" class="kt-widget__title">-->
        <!--Kalender Akademik-->
        <!--</a>-->
        <!--<span class="kt-widget__desc">-->
        <!--Creates Limitless possibilities-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;end::Widget &ndash;&gt;-->

        <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;end:: Portlet&ndash;&gt;-->
        <!--</div>-->
        <!--</div>-->

        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-widget kt-widget--project-1">
                            <div class="kt-widget__head d-flex">
                                <div id="kt_calendar" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>

<style>
    .m-content{width:100%}
    </style>


@endsection

@section('js')

@endsection


