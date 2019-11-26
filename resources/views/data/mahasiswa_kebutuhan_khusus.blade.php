@extends('layout.app')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                            Mahasiswa </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                Data Orangtua
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
                <!--Begin:: App Aside Mobile Toggle-->
                <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                    <i class="la la-close"></i>
                </button>

                <!--End:: App Aside Mobile Toggle-->

                <!--Begin:: App Aside-->
                <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

                    <!--begin:: Widgets/Applications/User/Profile1-->
                    <div class="kt-portlet kt-portlet--height-fluid-">
                        <div class="kt-portlet__head  kt-portlet__head--noborder">
                            <div class="kt-portlet__head-label"></div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit-y">

                            <!--begin::Widget -->
                            @include('layout.mahasiswa_profile')
                            <!--end::Widget -->

                        </div>
                    </div>

                    <!--end:: Widgets/Applications/User/Profile1-->
                </div>

                <!--End:: App Aside-->

                <!--Begin:: App Content-->
                <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">Kebutuhan Khusus <small> formulir perubahan data kebutuhan khusus mahasiswa</small></h3>
                                    </div>
                                </div>

                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <input type="hidden" name="mahasiswa_id" value="{{$data['id']}}">
                                                <div class="row">
                                                    {{--<label class="col-xl-3"></label>--}}
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Mahasiswa : </h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    $kebmahasiswa = json_decode($kebutuhan_selected['kebutuhan_mahasiswa'] , true);
                                                    ?>
                                                    <?php
                                                    $kebutuhan =  array_chunk($master['kebutuhan']->toArray() , 6 , true);
                                                    ?>
                                                    @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" value="{{$value['id']}}" name="mahasiswa_kh[]" {{in_array($value['id'] , $kebmahasiswa['mahasiswa']) ? 'checked' : ''}} > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                                <div class="row">
                                                    {{--<label class="col-xl-3"></label>--}}
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Ayah : </h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    $kebAyah = json_decode($kebutuhan_selected['kebutuhan_ayah'] , true);
                                                    ?>
                                                    <?php
                                                    $kebutuhan =  array_chunk($master['kebutuhan']->toArray() , 6 , true);
                                                    ?>
                                                    @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" value="{{$value['id']}}" name="ayah_kh[]" {{in_array($value['id'] , $kebAyah['ayah']) ? 'checked' : ''}} > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                                <div class="row">
                                                    {{--<label class="col-xl-3"></label>--}}
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Ibu : </h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    $kebIbu = json_decode($kebutuhan_selected['kebutuhan_ibu'] , true);
                                                    ?>
                                                    <?php
                                                    $kebutuhan =  array_chunk($master['kebutuhan']->toArray() , 6 , true);
                                                    ?>
                                                    @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" value="{{$value['id']}}" name="ibu_kh[]" {{in_array($value['id'] , $kebIbu['ibu']) ? 'checked' : ''}} > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                {{--<div class="col-lg-3 col-xl-3">--}}
                                                {{--</div>--}}
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="button" id="btn_edit_kebutuhan_khusus" class="btn btn-success">Ubah</button>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--End:: App Content-->
            </div>
        </div>
        <!-- end:: Content -->
    </div>

@section('js')
    <script src="{{asset('/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/js/pages/profile/mahasiswa.js')}}" type="text/javascript"></script>
@stop

@endsection
