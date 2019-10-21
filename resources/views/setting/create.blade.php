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
                                        Create New Module
                                    </h3>
                                </div>
                            </div>
                            <!--begin::Form-->

                            <form class="kt-form kt-form--label-right" action="save">
                                    <div class="kt-portlet__body">
                                            <div class="kt-section kt-section--first">
                                                <div class="form-group m-form__group">
                                                    <label for="exampleInputEmail1">
                                                        Module Name
                                                    </label>
                                                    <input type="text" class="form-control m-input"  name="title" placeholder="Enter Menu Name">
                                                    <span class="m-form__help">
                                                        Separate with underscore to build diffrent folder.
                                                    </span>
                                                </div>

                                                <div class="form-group m-form__group">
                                                    <label for="exampleTextarea">
                                                        Example textarea
                                                    </label>
                                                    <textarea class="form-control m-input" id="exampleTextarea" name="description" rows="3"></textarea>
                                                </div>
                                                <div class="form-group m-form__group">
                                                    <label class="m-checkbox m-checkbox--state-success">
                                                        <input type="checkbox">
                                                            Is Active
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <span class="m-form__help">
                                                    Set Your Field Here
                                                </span>
                                            </div>
                                            <div class="form-group m-form__group">
                                                    <label for="exampleInputEmail1">
                                                    Table Name
                                                    </label>
                                                    <input type="text" class="form-control m-input"  name="tablename" placeholder="Enter Table Name">
                                                </div>

                                            <div class="add-field">
                                                <div class="form-group m-form__group row" id="row-append">
                                                    <div class="col-lg-3">
                                                        <input type="text" name="fieldname[]" class="form-control m-input" placeholder="Field Name">
                                                    </div>
                                                    <div class="col-lg-2" id="migrationtable">
                                                            <select class="form-control m-input m-input--square" name="type[]">
                                                                <option value="null">null</option>
                                                                @foreach (Config('migrationtable.m_table') as $item)
                                                                    <option value="{{$item}}">
                                                                        {{$item}}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div class="input-group m-input-group m-input-group--square">
                                                            <input type="text" name="length[]" class="form-control m-input" placeholder="Length">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2" id="migrationtable">
                                                            <select class="form-control m-input m-input--square migration_table" name="migrationtable[]">
                                                                <option value="null">null</option>
                                                                @foreach ($module as $item)
                                                                    <option value="{{$item['title']}}">
                                                                        {{$item['title']}}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                    </div>

                                                    <div class="col-lg-2 mtablemigrate">

                                                    </div>
                                                    <div class="col-lg-1">
                                                        <select class="form-control m-input m-input--square migration_table" name="show[]">
                                                            <option value="1">show</option>
                                                            <option value="1">hide</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="m-portlet__foot">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <button type="submit" class="btn btn-primary">
                                                                Save
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-6 m--align-right">
                                                            <button type="button" class="btn btn-danger addfield">
                                                                Add Field
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                            </form>
                <!--end::Form-->
            </div>
        </div>
    </div></div>
</div>
<style>
    .m-content{width:100%};
    </style>

@section('js')

@stop

@endsection



