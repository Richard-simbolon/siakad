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
                            Dosen </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                Kebutuhan Khusus
                            </a>
                        </div>
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
                                @include('layout.dosen_profile')
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
                                        <h3 class="kt-portlet__head-title">Informasi Pribadi <small>formulir perubahan data mahasiswa</small></h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Mampu Menghandle Kebutuhan Khusus : </h3>
                                                        <?php
                                                            $kebdosen = json_decode($data['kebutuhan_khusus'] , true);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <?php
                                                    $kebutuhan =  array_chunk($master['kebutuhan']->toArray() , 6 , true);
                                                    ?>
                                                    @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" name="dosen_kh[]" value="{{$value['id']}}" {{in_array($value['id'] , $kebdosen['dosen']) ? 'checked' : ''}} > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Mampu Menghandle Kebutuhan Khusus : </h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="braile" value="{{$data['braile']}}" {{$data['braile']=='ya' ? 'checked':''}}> Ya
                                                                <span></span>
                                                            </label> &nbsp;
                                                            <label class="kt-radio">
                                                                <input type="radio" name="braile" value="{{$data['braile']}}" {{$data['braile']=='tidak' ? 'checked' :''}}> Tidak
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Mampu Menghandle Bahasa Isyarat ? </h3>
                                                    </div>
                                                </div>
                                                <div class="row form-group-last">
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="isyarat" value="{{$data['isyarat']}}" {{$data['isyarat']=='ya' ? 'checked':''}}> YA
                                                                <span></span>
                                                            </label> &nbsp;
                                                            <label class="kt-radio">
                                                                <input type="radio" name="isyarat" value="{{$data['isyarat']}}" {{$data['isyarat']=='tidak' ? 'checked' :''}}> Tidak
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="button" id="btn_edit_profile" class="btn btn-success">Ubah</button>&nbsp;
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
    <script src="{{asset('/assets/js/pages/profile/dosen.js')}}" type="text/javascript"></script>
@stop

@endsection
