@extends('layout.app')

@section('content')

    <!-- end:: Header -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Akademik </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="{{url('data/aktivitasperkuliahan')}}" class="kt-subheader__breadcrumbs-link">
                            Aktivitas Perkuliahan </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            Ubah </a>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

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
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/>
                                        </g>
                                    </svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    &nbsp;Ubah Aktivitas Perkuliahan
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline show">
                                    <a href="data/aktivitasperkuliahan" class="btn btn-success">
                                        <i class="la la-bars"></i> Daftar &nbsp;
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <form class="kt-form kt-form--label-right" action="save" method="POST">
                                <input type="hidden" name="row_status" value="active" />
                                <input type="hidden" id="mahasiswa_id" name="id" value="{{$data['id']}}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>NIM</label>
                                                    <div class="input-group">
                                                        <input type="text"  id="nim" class="form-control" value="{{$data['nim']}}" placeholder="Cari Berdasarkan NIM"  disabled="disabled">
                                                        <input type="hidden" id="mahasiswa_id" name="mahasiswa_id" value="{{$data['mahasiswa_id']}}">
                                                        <input type="hidden" id="row_status" name="row_status" value="active">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>Nama</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="nama"  value="{{$data['nama']}}"disabled="disabled"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>Program Studi</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="jurusan" value="{{$data['jurusan']}}"  disabled="disabled" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Semester*</label>
                                                    <div class="form-group">
                                                        <input type="hidden" value="{{$data['semester_id']}}"  name="semester_id" >
                                                        <input type="text" class="form-control" value="{{$data['semester']}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status Mahasiswa*</label>
                                                    <div class="form-group">
                                                        <select name="status" class="form-control form-control-sm kt-select2">
                                                            @foreach ($master['status'] as $item)
                                                                <option value="{{$item['id']}}" {{ $item['id'] == $data['status'] ? 'selected' : '' }}> {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>IPS</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{$data['ips']}}" max="4" class="form-control" onchange="check_ipk($(this))" name="ips" placeholder="Isikan IPS">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>IPK</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{$data['ipk']}}" max="4" class="form-control" onchange="check_ipk($(this))" name="ipk" placeholder="Isikan IPK">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Jumlah SKS Semester</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{$data['sks_semester']}}" class="form-control" name="sks_semester" placeholder="Isikan SKS Semester">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Jumlah SKS Total</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{$data['sks_total']}}" class="form-control" name="sks_total" id="sks_total" placeholder="Isikan SKS Total">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                    <div class="kt-form__actions">
                                        <a href="{{url()->previous()}}" class="btn btn-label-success">
                                            <i class="la la-arrow-left"></i> Kembali
                                        </a>&nbsp;
                                        <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-danger" id="hapus_aktivitas_perkuliahan">
                                            <i class="la la-save"></i>Delete
                                        </a>
                                        <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-success" id="ubah_aktivitas_perkuliahan">
                                            <i class="la la-save"></i>Simpan
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
        <script src="{{asset('assets/js/pages/aktivitasperkuliahan/index.js')}}" type="text/javascript"></script>
    </div>

@section('js')

@stop

@endsection
