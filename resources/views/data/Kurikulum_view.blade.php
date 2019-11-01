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
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"></path>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                            <h3 class="kt-portlet__head-title">
                                &nbsp;Kurikulum
                            </h3>
                        </div>

                        <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-more-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                        <!--begin::Nav-->
                                        <ul class="kt-nav">
                                            <li class="kt-nav__head">
                                                Pilihan Aksi
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                    </g>
                                                </svg>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__item">
                                                <a href="{{url('data/kurikulum/edit/'.$kurikulum['id'].'')}}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-edit"></i>
                                                    <span class="kt-nav__link-text">Ubah</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link"  data-toggle="modal" data-target="#kt_modal_hapus_data">
                                                    <i class="kt-nav__link-icon flaticon-delete"></i>
                                                    <span class="kt-nav__link-text">Hapus</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <div class="kt-form__actions">
                                    <a href="http://127.0.0.1:8000/data/kurikulum" style="align:right" type="button" class="btn btn-metal btn-outlane-metal"><i class="la la-arrow-left"></i>Kembali</a>
                                </div>
                            </div>
                    </div>
                    <!--begin::Form-->
                    <div class="kt-portlet__body">
                        <form class="kt-form">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Nama Kurikulum * </label>
                                        <input type="text" class="form-control" value="{{$kurikulum['nama_kurikulum']}}" name="nama_kurikulum" placeholder="Isikan Nama Kurikulum">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label class="select2-label">Jurusan *</label>
                                    <div class="form-group">
                                        <select name="program_studi_id" class="form-control update_list_matakuliah" >
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach ($master['jurusan'] as $item)
                                                <option attr="{{$item['id'].'-'.$kurikulum['program_studi_id']}}" value="{{$item['id']}}" {{ $item['id'] == $kurikulum['program_studi_id'] ? 'selected' : '' }}>{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <label class="select2-label">Mulai berlaku *</label>
                                    <div class="form-group">
                                        <select name="mulai_berlaku" class="form-control">
                                            <option value="">-- Pilih Jurusan --</option>
                                            <option value="1">2018/2019 Ganjil</option>
                                            <option value="2">2019/2020 Genap</option>
                                            <option value="3">2020/2021 Ganjil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Jumlah Bobot Matakuliah Wajib *</label>
                                        <input type="text" class="form-control" name="jumlah_bobot_mk_wajib" value="{{$kurikulum['jumlah_bobot_mata_kuliah_wajib']}}" placeholder="Isikan Jumlah Bobot Matakuliah Wajib">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Jumlah Bobot Matakuliah Pilihan *</label>
                                        <input type="text" class="form-control" name="jumlah_bobot_mk_pilihan" value="{{$kurikulum['jumlah_bobot_mata_kuliah_pilihan']}}" placeholder="Isikan Jumlah Bobot Matakuliah Pilihan">
                                    </div>
                                </div>
                                <!--<div class="col-xl-6">-->
                                <!--<div class="form-group">-->
                                <!--<label>Jumlah SKS</label>-->
                                <!--<input type="text" class="form-control" name="jumlah_sks" placeholder="Isikan Jumlah SKS">-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>                      
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered table-hover responsive" id="kurikulum_matakuliah">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Kode Matakuliah</th>
                                            <th rowspan="2">Nama Matakuliah</th>
                                            <th colspan="5" style="text-align: center">Bobot Matakuliah (SKS)</th>
                                            <th rowspan="2" style="text-align: center">Semester</th>
                                            <th rowspan="2" style="text-align: center">Wajib?</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">Matakuliah</th>
                                            <th style="text-align: center">Tatap Muka</th>
                                            <th style="text-align: center">Praktikum</th>
                                            <th style="text-align: center">Praktek Lapangan</th>
                                            <th style="text-align: center">Simulasi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0;
                                                $bobot_mata_kuliah = 0;
                                                $bobot_tatap_muka = 0;
                                                $bobot_praktikum = 0;
                                                $bobot_praktek_lapangan = 0;
                                                $bobot_simulasi = 0;
                                            ?>
                                            @foreach ($matakuliah as $item)

                                                <?php 
                                                $i++;
                                                $bobot_mata_kuliah += $item->bobot_mata_kuliah;
                                                $bobot_tatap_muka = $item->bobot_tatap_muka;
                                                $bobot_praktikum = $item->bobot_praktikum;
                                                $bobot_praktek_lapangan = $item->bobot_praktek_lapangan;
                                                $bobot_simulasi = $item->bobot_simulasi;
                                                ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$item->kode_mata_kuliah}}</td>
                                                    <td>{{$item->nama_mata_kuliah}}</td>
                                                    <td align="center">{{$item->bobot_mata_kuliah}}</td>
                                                    <td align="center">{{$item->bobot_tatap_muka}}</td>
                                                    <td align="center">{{$item->bobot_praktikum}}</td>
                                                    <td align="center">{{$item->bobot_praktek_lapangan}}</td>
                                                    <td align="center">{{$item->bobot_simulasi}}</td>
                                                    <td align="center">{{$item->semester}}</td>
                                                    <td align="center"><?php if($item->is_wajib == '1'){echo '<i class="la la-check"></i>';} ?></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td  align="right"colspan="3">
                                                    <b>TOTAL SKS</b>
                                                </td>
                                                <td align="center"><b>{{$bobot_mata_kuliah}}</b></td>
                                                <td align="center"><b>{{$bobot_tatap_muka}}</b></td>
                                                <td align="center"><b>{{$bobot_praktikum}} </b></td>
                                                <td align="center"><b>{{$bobot_praktek_lapangan}}</b></td>
                                                <td align="center"><b>{{$bobot_simulasi}}</b></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .m-content{width:100%};
    </style>

<script>
    var url = '/data/dosen';
    var form = 'dosen-form';
</script>

@section('js')



@stop

@endsection
