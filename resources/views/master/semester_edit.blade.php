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
                            <a href="{{url()->previous()}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->previous()}}" class="kt-subheader__breadcrumbs-link">
                                {{$title}} </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Edit </a>
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
                            <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline show">
                                    <a href="{{ url('/master/semester') }}" class="btn btn-success">
                                        <i class="la la-bars"></i> Daftar &nbsp;
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <form id="form_matakuliah" class="kt-form kt-form--label-right" action="/master/{{$controller}}/update" method="POST">
                                <input type="hidden" name="row_status" value="active" />
                                <input type="hidden" name="id" value="{{$data['id']}}" >
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Nama Semester *</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control required" value="{{$data['title']}}" name="title" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Berlaku *</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control required" value="{{$data['tanggal_mulai']}}" name="tanggal_mulai" title="Tanggal Mulai Berlaku Harus Diisi" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tanggal Berakhir *</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control required" value="{{$data['tanggal_selesai']}}" name="tanggal_selesai" title="Tanggal Akhir Berlaku Harus Diisi" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Penilaian *</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" value="{{$data['tanggal_mulai_penilaian']}}" name="tanggal_mulai_penilaian">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group form-group-last">
                                                    <label>Tanggal Akhir Penilaian *</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" value="{{$data['tanggal_akhir_penilaian']}}" name="tanggal_akhir_penilaian">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                        <div class="kt-form__actions">
                                            <a href="{{url()->previous()}}" class="btn btn-label-success">
                                                <i class="la la-arrow-left"></i> Kembali
                                            </a>&nbsp;
                                            <a id="update_semester" style="color:#ffffff;" class="btn btn-success">
                                                Ubah <i class="la la-save"></i>
                                            </a>&nbsp
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script>
        $(document).on('click' , '#update_semester' , function(){
            Swal.fire({
                title: 'Simpan',
                html: "Apakah anda yakin ubah data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0abb87',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah'
            }).then((result) => {
                if (result.value) {
                    var prev_url = $(this).attr("data-prev-url");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf_').val()
                        }
                    });
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        url:'/master/semester/update',
                        data:$(this).closest('form').serialize(),
                        success:function(data) {
                            if(data.status==='success'){
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Data sudah disimpan",
                                    type: 'success',
                                    confirmButtonColor: '#0abb87',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.value){
                                        window.location = '/master/semester';
                                    }
                                });
                            }else {
                                var text = '';
                                $.each(data.msg, function( index, value ) {
                                    text += '<p class="error">'+ value[0]+'</p>';
                                });
                                Swal.fire({
                                    title: 'Gagal',
                                    html: text,
                                    type: 'error',
                                    confirmButtonColor: '#0abb87',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click' , '#delete_semester' , function(){
            Swal.fire({
                title: 'Simpan',
                html: "Apakah anda yakin hapus data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0abb87',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.value) {
                    var prev_url = $(this).attr("data-prev-url");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf_').val()
                        }
                    });
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        url:'/master/semester/delete',
                        data:$(this).closest('form').serialize(),
                        success:function(data) {
                            //var res = JSON.parse(data);
                            if(data.status==='success'){
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Data sudah dihapus",
                                    type: 'success',
                                    confirmButtonColor: '#0abb87',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.value){
                                        window.location = '/master/semester';
                                    }
                                });
                            }else {
                                Swal.fire({
                                    title: 'Gagal',
                                    html: data.msg,
                                    type: 'error',
                                    confirmButtonColor: '#0abb87',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                }
            })
        });
    </script>
@stop

@endsection


