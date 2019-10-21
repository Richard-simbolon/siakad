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
                <div class="col-lg-12">
                    <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{$title}}
                                    </h3>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <form class="kt-form kt-form--label-right" action="save">
                                    <?php if($column == '1'){ ?>
                                    <div class="kt-portlet__body">
                                            <div class="kt-section kt-section--first">
                                            @foreach ($table as $item)

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            {{$Tableshow[$item]['record']}}
                                                        </label>
                                                        @if ($html[$item]['type'] == 'text')
                                                            <input type="email" name="{{$item}}" class="form-control m-input m-input--square" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter {{$Tableshow[$item]['record']}}">
                                                        @elseif($html[$item]['type'] == 'radio')
                                                                <div class="kt-radio-inline">
                                                                    <?php $radio = explode("," , $html[$item]['value']);
                                                                        foreach($radio as $radioitem){
                                                                            echo '

                                                                                <label class="kt-radio">
                                                                                    <input type="radio" name="'.$item.'" value="'.$radioitem.'">
                                                                                    '.$radioitem.'
                                                                                    <span></span>
                                                                                </label>
                                                                            ';
                                                                        }
                                                                    ?>
                                                                </div>
                                                        @elseif($html[$item]['type'] == 'number')
                                                            <input class="form-control m-input" type="number" value="0" id="example-number-input">
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
                                                                <input type="email" name="{{$val}}" class="form-control m-input m-input--square" id="{{$val}}" aria-describedby="emailHelp" placeholder="Enter {{$Tableshow[$val]['record']}}">
                                                            @elseif($html[$val]['type'] == 'radio')
                                                                <div class="kt-radio-inline">
                                                                    <?php $radio = explode("," , $html[$val]['value']);
                                                                        foreach($radio as $radioitem){
                                                                            echo '<label class="kt-radio">
                                                                                    <input type="radio" name="'.$val.'" value="'.$radioitem.'">
                                                                                    '.$radioitem.'
                                                                                    <span></span>
                                                                                </label>';
                                                                        }
                                                                    ?>
                                                                </div>


                                                            @elseif($html[$val]['type'] == 'number')
                                                                <input class="form-control m-input" type="number" value="0" id="example-number-input">
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                    </div>
                                    <?php }?>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a  class="btn btn-metal generalsave">
                                                        Submit
                                                    </a>
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
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
    .m-content{width:100%};
    </style>

@section('js')

@stop

@endsection


