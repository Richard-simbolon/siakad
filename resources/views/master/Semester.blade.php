@extends('layout.app')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            Master </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                {{$title}} </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Daftar </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url()->current()}}/create" class="btn btn-success"><i class="la la-plus"></i> Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-12 order-lg-1 order-xl-1">
                    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
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
                            </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    {{$title}}
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="m-portlet__body">
                                <table class="table table-striped table-bordered table-sm table-hover responsive no-wrap general-data-table" id="{{$tableid}}">
                                    <thead>
                                    <tr>
                                        <th style="max-width: 75px;" rowspan="2">No</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="2" style="text-align: center">Periode Berlaku</th>
                                        <th colspan="2" style="text-align: center">Masa Penilaian</th>
                                        <th rowspan="2" style="text-align: center;max-width: 130px;">Status Semester</th>
                                        <th style="max-width: 75px;" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;max-width: 85px;">Mulai</th>
                                        <th style="text-align: center;max-width: 85px;">Berakhir</th>
                                        <th style="text-align: center;max-width: 85px;">Mulai</th>
                                        <th style="text-align: center;max-width: 85px;border-right-width: 1px;">Berakhir</th>
                                    </tr>
                                    </thead>
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
        .m-content{width:100%}
        table thead tr th{
            color:#ffffff!important;
            font-weight: 400;
        }
    </style>

@section('js')
    <script>
        function setStatusSemester(id, data){
            Swal.fire({
                title: 'Simpan',
                html: "Apakah anda yakin mengaktifkan semester <br/><b>" + data+ "</b> ini ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0abb87',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aktifkan'
            }).then((result) => {
                if (result.value) {
                    var url = $(this).attr("data-url");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf_').val()
                        }
                    });
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        url:'/master/semester/activate',
                        data:{"id":id},
                        success:function(result) {

                            if(result.status == 'success'){
                                Swal.fire(
                                    'Berhasil!',
                                    'Data telah disimpan.',
                                    'success'
                                )
                                location.reload();
                            }
                            else{
                                var text = '';
                                $.each(result.message, function( index, value ) {
                                    text += '<p class="error">'+ value[0]+'</p>';
                                });
                                swal.fire({
                                    "title": "",
                                    "html": text,
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary"
                                });
                            }
                        }
                    });

                }
            })
        }
    </script>

@stop

@endsection
