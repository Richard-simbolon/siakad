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
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url()->previous()}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                            <span class="kt-menu__link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
                                        <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
                                    </g>
                                </svg>
                            </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    Ubah Pengaturan Laporan
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" action="/master/{{$controller}}/update" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$data['id']}}" />
                            <div class="col-lg-6">
                                <?php if($column == '1'){ ?>
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        @foreach ($table as $item)
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    {{$Tableshow[$item]['record']}}
                                                </label>
                                                @if ($html[$item]['type'] == 'text')
                                                    <input type="text" name="{{$item}}" value="{{$data[$item]}}" class="form-control m-input m-input--square" placeholder="Enter {{$Tableshow[$item]['record']}}">
                                                @elseif($html[$item]['type'] == 'radio')
                                                    <div class="kt-radio-inline">
                                                        <?php $radio = explode("," , $html[$item]['value']);
                                                        foreach($radio as $radioitem){
                                                            if($radioitem != 'deleted'){
                                                                $checked = $data["row_status"]==$radioitem? "checked" : "";
                                                                echo '

                                                                <label class="kt-radio">
                                                                    <input type="radio" name="'.$item.'" value="'.$radioitem.'"'. $checked .'>
                                                                    '.$radioitem.'
                                                                    <span></span>
                                                                </label>
                                                            ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                @elseif($html[$item]['type'] == 'number')
                                                    <input class="form-control m-input" type="number" value="0" id="example-number-input" value="{{$data['t']}}}">
                                                @elseif($html[$item]['type'] == 'date')
                                                    <input type="date" name="{{$item}}" class="form-control" style="max-width: 200px" placeholder="Isikan {{$Tableshow[$item]['record']}}">
                                                @endif

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <?php }else{?>
                                <div class="kt-portlet__body">
                                    <?php
                                    $m = array_chunk($table , 2);
                                    ?>
                                    @foreach ($m as $item)
                                        <div class="form-group row">
                                            @foreach($item as $val)
                                                <div class="col-lg-6">
                                                    <label for="{{$val}}">
                                                        {{$Tableshow[$val]['record']}}
                                                    </label>
                                                    @if ($html[$val]['type'] == 'text')
                                                        <input type="text" name="{{$val}}" value="{{$data[$val]}}}" class="form-control m-input m-input--square" id="{{$val}}" placeholder="Enter {{$Tableshow[$val]['record']}}">
                                                    @elseif($html[$val]['type'] == 'radio')
                                                        <div class="kt-radio-inline">
                                                            <?php $radio = explode("," , $html[$val]['value']);
                                                            foreach($radio as $radioitem){
                                                                if($radioitem != 'deleted'){
                                                                    $checked = $data["row_status"]==$radioitem? "checked" : "";
                                                                    echo '<label class="kt-radio">
                                                                        <input type="radio" name="'.$val.'" value="'.$radioitem.'"'. $checked .'>
                                                                        '.$radioitem.'
                                                                        <span></span>
                                                                    </label>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    @elseif($html[$val]['type'] == 'number')
                                                        <input class="form-control m-input" type="number" value="0" id="example-number-input">
                                                    @elseif($html[$item]['type'] == 'date')
                                                        <input type="date" name="{{$item}}" class="form-control" style="max-width: 200px" placeholder="Isikan {{$Tableshow[$item]['record']}}">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <?php }?>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="{{url()->previous()}}" class="btn btn-label-success">
                                                <i class="la la-arrow-left"></i> Kembali
                                            </a>&nbsp;
                                            <button type="submit" class="btn btn-success"><i class="la la-save"></i>Ubah</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .m-content{width:100%}
    </style>

@section('js')

@stop

@endsection


