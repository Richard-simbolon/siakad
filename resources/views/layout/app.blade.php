<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Polbangtan Medan | SIAPDUDIK</title>
        <link href="https://polbangtanmedan.ac.id/themes/stpp/img/favicon-48.png" rel="apple-touch-icon-precomposed" sizes="48x48">
        <link href="https://polbangtanmedan.ac.id/themes/stpp/img/favicon-32.png" rel="apple-touch-icon-precomposed">
        <link href="https://polbangtanmedan.ac.id/themes/stpp/img/favicon.png" rel="shortcut icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

        <link href="{{asset('assets/plugins/custom/@fullcalendar/core/main.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/@fullcalendar/daygrid/main.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/@fullcalendar/list/main.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/@fullcalendar/timegrid/main.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/plugins/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/pages/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/jstree/dist/themes/default/style.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/jqvmap/dist/jqvmap.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/uppy/dist/uppy.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/general/plugins/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/plugins/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/plugins/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" /> 
		<link href="{{asset('assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/summernote/summernote.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->
        <link href="{{asset('assets/plugins/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/brand/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/skins/aside/light.css')}}" rel="stylesheet" type="text/css" />


        @section('css')
        @show

        <script src="{{asset('assets/plugins/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>

    </head>
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="/">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-polbangtan.png')}}" width="45%" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <!--<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>-->
                <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">



                @include('layout.sidemenu')


                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    @include('layout.header')
                    @yield('content')


                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                2019&nbsp;&copy;&nbsp;<a href="http://polbangtanmedan.ac.id" target="_blank" class="kt-link">Polbangtan Medan</a>
                            </div>
                            <div class="kt-footer__menu">
                                @if(Auth::user()->login_type == 'admin' || Auth::user()->login_type == 'jurusan')
                                    <a href="{{asset('/assets/media/panduan-akademik.pdf')}}" target="_blank" class="kt-footer__menu-link kt-link">Download Panduan Penggunaan</a>
                                @elseif (Auth::user()->login_type == 'dosen')
                                    <a href="{{asset('/assets/media/panduan-dosen.pdf')}}" target="_blank" class="kt-footer__menu-link kt-link">Download Panduan Penggunaan</a>
                                @elseif (Auth::user()->login_type == 'mahasiswa')
                                    <a href="{{asset('/assets/media/panduan-mahasiswa.pdf')}}" target="_blank" class="kt-footer__menu-link kt-link">Download Panduan Penggunaan</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>

        <!--modal : ubah kalender-->
        <div class="modal fade" id="kt_modal_kalender" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kalender Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 id="title"></h5>
                        <small id="tanggal"></small>
                        <hr/>
                        <div style="margin-top: 15px;">
                            <p id="keterangan"></p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal-->

        <!--modal : ubah password-->
        <div class="modal fade" id="kt_modal_ganti_passowrd" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Password Lama</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" autocomplete="off" name="password_lama" id="password_lama" placeholder="Isikan password lama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Password Baru</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" autocomplete="off" name="password_baru" id="password_baru" placeholder="Isikan password baru">
                            </div>
                        </div>
                        <div class="form-group form-group-last row">
                            <label class="col-lg-4 col-form-label">Konfirmasi</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" autocomplete="off" name="konfirmasi" id="password_konfirmasi" placeholder="Ketik ulang password baru">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_ubah_password_admin" class="btn btn-success">Ubah Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal-->
    </body>

		<script src="{{asset('assets/plugins/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>


        <script src="{{asset('assets/plugins/custom/@fullcalendar/core/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/@fullcalendar/daygrid/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/@fullcalendar/google-calendar/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/@fullcalendar/interaction/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/@fullcalendar/list/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/@fullcalendar/list/locales-all.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/datatables.net/js/jquery.dataTables.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/uppy/dist/uppy.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/tinymce/themes/silver/theme.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/custom/tinymce/themes/mobile/theme.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/plugins/bootstrap-timepicker.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/general.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/pages/crud/datatables/extensions/responsive.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/plugins/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/kelas/kelas.js')}}" type="text/javascript"></script>
		@yield('js')
        <script src="{{asset('assets/js/pages/master/delete.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/pages/master/matakuliah.js')}}" type="text/javascript"></script>

        <script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<script>
            $(document).ready(function(){
                var current_path  = window.location;
                $('a[href="'+current_path+'"]').parent().addClass('kt-menu__item--active');
                var i=0;
                $('.kt-menu__item a').each(function(){
                    var $this = $(this);
                    // if the current path is like this link, make it active
                    if($this.attr('href').indexOf(current_path) !== -1){
                        document.cookie = "active-menu-url=" + current_path;
                        i++;
                    }
                });

                if(i == 0){
                    $('a[href="'+getCookie("active-menu-url")+'"]').parent().addClass('kt-menu__item--active');
                }

                $(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", true);
                $("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", true);

                $(document).on('click','#editmahasiswa' , function(){
                    $(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", false);
                    //$("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", true);
                    $("#informasidasar").show();
                    $("#info_dasar").hide();
                    $("#updatemahasiswa").show();
                });

                $(document).on('click','#editdosen' , function(){
                    //$(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", false);
                    $("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", false);
                    $("#informasidasar").show();
                    $("#info_dasar").hide();
                });

                $(document).on('click','#ganti_password_admin' , function(){
                    $("#kt_modal_ganti_passowrd").modal({backdrop: 'static', keyboard: false});
                });

                changePasswordAdmin();

                getCalender();
            });

            function changePasswordAdmin(){
                $(document).on('click','#btn_ubah_password_admin' , function(){
                    Swal.fire({
                        title: 'Ubah Password',
                        text: "Apakah anda yakin ubah password ini?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0abb87',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Ubah Password!'
                    }).then((result) => {
                        if (result.value) {
                            if($("#password_lama").val()==''){
                                Swal.fire({
                                    title: 'Hapus',
                                    text: "Password Lama Harus Diisi",
                                    type: 'warning',
                                })
                            }
                            else if($("#password_baru").val()==''){
                                Swal.fire({
                                    title: 'Hapus',
                                    text: "Password Baru Harus Diisi",
                                    type: 'warning',
                                })
                            }
                            else if($("#password_konfirmasi").val()==''){
                                Swal.fire({
                                    title: 'Hapus',
                                    text: "Konfirmasi Password Harus Diisi",
                                    type: 'warning',
                                })
                            }else if($("#password_baru").val() != $("#password_konfirmasi").val()){
                                Swal.fire({
                                    title: 'Hapus',
                                    text: "Password dan Konfirmasi Password Harus Sama",
                                    type: 'warning',
                                })
                            }
                            else{
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('#csrf_').val()
                                    }
                                });
                                $.ajax({
                                    type:'POST',
                                    dataType:'json',
                                    url: "/administrator/change_password",
                                    data:{password_lama:$("#password_lama").val(),password_baru:$("#password_baru").val(),konfirmasi:$("#password_konfirmasi").val()},
                                    success:function(result) {

                                        if(result.status){
                                            Swal.fire(
                                                'Deleted!',
                                                'Password sudah diubah.',
                                                'success'
                                            )
                                        }
                                        else{
                                            alert(result.msg);
                                        }
                                    }
                                });

                            }
                        }
                    })
                });
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function getCalender(){
                $.ajax({
                    type:'GET',
                    url:'/home/getcalender',
                    success:function(result) {
                        var res = JSON.parse(result);
                        $.each(res, function( index, value ) {
                            $("#notif_calender").append(
                                '<a href="#" onclick="opendetailCalender('+value['id']+')" class="kt-notification__item">\n' +
                                '<div class="kt-notification__item-icon">\n' +
                                '<i class="flaticon-alarm-1 kt-font-success"></i>\n' +
                                '</div>\n' +
                                '<div class="kt-notification__item-details">\n' +
                                '<div class="kt-notification__item-title">\n' +
                                value['title'] +
                                '</div>\n' +
                                '<div class="kt-notification__item-time">\n' +
                                value['start'] + ' s.d ' + value['end'] +
                                '</div>\n' +
                                '</div>\n' +
                                '</a>'
                            );
                        });
                    }
                });
            }
            function opendetailCalender(id, start) {
                $.ajax({
                    type:'GET',
                    dataType:'json',
                    url:'/data/kalenderakademik/get/'+id,
                    success:function(result) {
                        if(result.status){
                            $("#title").text(result.data[0]['title']);
                            $("#tanggal").text("Tanggal publikasi : " + result.data[0]['created_at']);
                            $("#keterangan").html(result.data[0]['keterangan']);
                            $("#kt_modal_kalender").modal();
                        }
                        else{
                            alert(result.msg);
                        }
                    }
                });
            }
		</script>
        {{----}}
        <style>
            .dataTable thead tr{
                background-color:#4cad82!important;
            }
            table thead tr th{
                color:#ffffff!important;
                font-weight: 400;
            }
            .kt-aside-menu .kt-menu__nav > .kt-menu__item > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item > .kt-menu__link .kt-menu__link-text {
                color: #1a1b1aba!important;
            }
        </style>
    <input type="hidden" id="csrf_" value="{{csrf_token()}} "/>
</html>
