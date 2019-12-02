@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
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
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Kurikulum </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Daftar </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ url('/data/kurikulum/create') }}" class="btn btn-success">
                        <i class="flaticon2-plus"></i> Tambah Kurikulum &nbsp;
                    </a>
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
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000" />
                                    <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            &nbsp; Daftar Kurikulum
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-xl-4">
                            <label class="select2-label">Tahun Ajaran</label>
                            <div class="form-group">
                                <select id="tahun_berlaku" class="form-control kt-select2 kurikulum_filter" id="kt_select2_1">
                                    <option value="">-- Pilih Pencarian --</option>
                                    <option value="1">2019/2010</option>
                                    <option value="2"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <label class="select2-label">Jurusan</label>
                            <div class="form-group">
                                <select id="jurusan" class="form-control kurikulum_filter">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="1">Penyuluhan Perkebunan Presisi</option>
                                    <option value="2">Penyuluhan Pertanian Berkelanjutan</option>
                                    <option value="3">Teknologi Produksi Tanaman Perkebunan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <div class="kt-form__actions">
                                    <button type="reset" class="btn btn-success"><i class="flaticon-search"></i>Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table class="dataTable table table-striped table-bordered table-hover table-checkable responsive no-wrap" >
                            <thead>
                            <tr>
                                <th style="vertical-align: middle" rowspan="2">NO</th>
                                <th style="vertical-align: middle" rowspan="2">Nama Kurikulum</th>
                                <th style="vertical-align: middle" rowspan="2">Program Studi</th>
                                <th style="vertical-align: middle" rowspan="2">Mulai Berlaku</th>
                                <th style="text-align: center" colspan="3">Aturan Jumlah SKS</th>
                                <th style="text-align: center" colspan="3">Jumlah SKS Matakuliah	</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Lulus</th>
                                <th style="text-align: center">Wajib</th>
                                <th style="text-align: center">Pilihan</th>
                                <th style="text-align: center">Wajib</th>
                                <th style="text-align: center">Pilihan</th>
                                <th style="text-align: center"></th>
                            </tr>
                            </thead>
                            <tbody class="kurikulum_table">
                                <?php $i=0;?>
                                @foreach ($data as $item)
                                <?php $i++;?>
                                    <tr>
                                        <td align="center">{{$i}}</td>
                                        <td>{{$item['nama_kurikulum']}}</td>
                                        <td>{{$item['title']}}</td>
                                        <td>{{$item['mulai_berlaku']}}</td>
                                        <td align="center">{{$item['jumlah_sks']}}</td>
                                        <td align="center">{{$item['jumlah_bobot_mata_kuliah_wajib']}}</td>
                                        <td align="center">{{$item['jumlah_bobot_mata_kuliah_pilihan']}}</td>
                                        <td align="center">{{$item['total_matakuliah']}}</td>
                                        <td align="center">{{$item['total_wajib']}}</td>
                                        <td><span class="dropdown">
                                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                                  <i class="la la la-edit"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-203px, 24px, 0px);">
                                                    <a class="dropdown-item" href="{{url('/data/kurikulum/view/'.$item['id'])}}"><i class="la la-eye"></i> View</a>
                                                    <a class="dropdown-item" href="{{url('/data/kurikulum/edit/'.$item['id'])}}"><i class="la la-edit"></i> Edit</a>
                                                </div>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
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

<style>
    .m-content{width:100%};
    </style>

@section('js')

@stop

@endsection
