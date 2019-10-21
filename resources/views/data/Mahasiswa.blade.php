@extends('layout.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Dashboard</h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>

        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-12 order-lg-1 order-xl-1">
                    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                            {{$title}}
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="dropdown dropdown-inline">
                                            <a href="{{url()->current()}}/create" class="btn btn-label-google"><i class="la la-plus"></i> Tambah</a>
                                    </div>
                                </div>
                            </div>


                                        <div class="kt-portlet__body">
                                             <div class="m-portlet__body">
                                        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap general-data-table" id="{{$tableid}}">
                                                <thead>
                                                        <tr>
                                                            <th>
                                                                No
                                                            </th>
                                                            @foreach ($table_display as $item2)
                                                            @if (!in_array($item2 , $exclude))
                                                                <th scope="row">

                                                                    {{$Tableshow[$item2]['record']}}

                                                                </th>

                                                            @else

                                                            @endif
                                                        @endforeach
                                                        <th></th>
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
    .m-content{width:100%};
    </style>

@section('js')

@stop

@endsection
