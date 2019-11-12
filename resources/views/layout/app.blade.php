<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIAKAD</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		<!-- Fonts<link href="public/assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />

		<link href="public/assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
        <link href="public/assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" /> -->
       <!--end:: Vendor Plugins -->


		<!--begin:: Vendor Plugins for custom pages
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/skins/header/base/light.css')}}assets/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
<!--
        <link href="{{asset('assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
-->
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
                <a href="index.html">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-polbangtan.png')}}" width="60%" />
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
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                                <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
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

		<!--<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>

		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/quill/dist/quill.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/raphael/raphael.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/general/dompurify/dist/purify.js" type="text/javascript"></script>-->

		<!--end:: Vendor Plugins -->


		<!--begin:: Vendor Plugins for custom pages
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript"></script>
<script src="{{asset('assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="text/javascript"></script>



        <script src="{{asset('assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/datatables.net-select/js/dataTables.select.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/jstree/dist/jstree.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/plugins/custom/jqvmap/dist/jquery.vmap.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script>
		<script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="{{asset('assets/js/pages/dashboard.js')}}assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script>-->

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
        <script src="{{asset('assets/js/pages/custom/wizard/wizard-3.js')}}" type="text/javascript"></script>
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
			$(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", true);
			$("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", true);
			
			$(document).on('click','#editmahasiswa' , function(){
				$(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", false);
				//$("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", true);
				$("#informasidasar").show();
				$("#info_dasar").hide();
			});

			$(document).on('click','#editdosen' , function(){
				//$(".form-mahasiswa input , .form-mahasiswa select , .form-mahasiswa textarea , .form-mahasiswa option").prop("disabled", false);
				$("#form-update-dosen input , #form-update-dosen select , #form-update-dosen textarea , #form-update-dosen option").prop("disabled", false);
				$("#informasidasar").show();
				$("#info_dasar").hide();
			});
		})
		</script>
        <script src="{{asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
        <style>
            table thead tr{
                background-color:#4cad82!important;
            }
            table thead tr th{
                color:#ffffff!important;
                font-weight: 400;
            }
            .kt-aside-menu .kt-menu__nav > .kt-menu__item > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item > .kt-menu__link .kt-menu__link-text {
                color: #1a1b1a!important;
            }
        </style>
    <input type="hidden" id="csrf_" value="{{csrf_token()}} "/>
</html>
