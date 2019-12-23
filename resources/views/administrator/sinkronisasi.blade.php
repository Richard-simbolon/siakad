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
                    Admin </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Sinkronisasi </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                </div>
            </div>
        </div>
    </div>
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
                                            <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
                                        </g>
                                    </svg>
                                </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    Daftar Data
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <div>
                                <table class="dataTable table table-striped table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th style="text-align: center">Pending Data</th>
                                        <th>Waktu Sinkronisasi</th>
                                        <th style="text-align: center">Sinkronisasi Status</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?$i = 0?>
                                        @foreach ($data as $item)
                                        <? $i++ ?>
                                            <tr>
                                                <td align="center">{{$i}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->description}}</td>
                                                <td align="center">15</td>
                                                <td>{{$item->last_sync}}</td>
                                                @if($item->last_sync_status == 'sukses')
                                                    <td align="center"><span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Sukses</span></td>
                                                @else
                                                    <td align="center"><span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Gagal</span></td>
                                                @endif
                                                <td align="center"><a href="javascript:void(0)" onclick="sync('{{$item->sync_code}}')" style="font-size: 16px;" ><b><i class="la la-refresh"></i></b></a></td>
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
</div>

<style>
    .m-content{width:100%};
    </style>

@section('js')
    <script>
        function sync(code){
            Swal.fire({
                title: 'Sinkronisasi Data',
                text: "Anda Yakin Melakukan Sinkronisasi Data?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#08976d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sync Sekarang'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf_').val()
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url:'/sinkronisasi/mahasiswa',
                        data:{'jurusan':$('#jurusan-mahasiswa').val() , 'angkatan':$('#angkatan-mahasiswa').val()},
                        success:function(result) {
                            console.log(result);
                        }
                    });
                }
            });
        }
    </script>
@stop

@endsection


