@extends('layout.app')

@section('content')
    <style>
        .error{
            color: red;
        }
    </style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Flaticon </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            Components </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            Icons </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            Flaticon </a>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url()->current()}}/create" class="btn btn-success">
                            <i class="flaticon-user-add"></i> Tambah Kelas &nbsp;
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content Head -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-menu__link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1" />
                                        </g>
                                    </svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    &nbsp; Daftar Kelas
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <div>
                                <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;" rowspan="2">NO</th>
                                        <th style="vertical-align: middle" rowspan="2">Jurusan</th>
                                        <th style="vertical-align: middle" rowspan="2">Nama Kelas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td align="center">1</td>
                                        <td>Penyuluhan Perkebunan Presisi</td>
                                        <td>A</td>

                                    </tr>
                                    <tr>
                                        <td align="center">2</td>
                                        <td>Penyuluhan Perkebunan Presisi</td>
                                        <td>B</td>
                                    </tr>
                                    <tr>
                                        <td align="center">3</td>
                                        <td>Penyuluhan Perkebunan Presisi</td>
                                        <td>C</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>

@section('js')

@stop

@endsection
