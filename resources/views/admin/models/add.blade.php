@extends('admin.master')

@section('title')
    {{ trans('admin.modelAdd') }}
@endsection

@section('sectionName')
    <a href="{{ route('models') }}"> {{ trans('admin.models') }} </a>
@endsection

@section('pageName')
    {{ trans('admin.modelAdd') }}
@endsection


@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="{{ route('model-do-add') }}" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('admin.modelData') }} </h5>
                </div>


                <div class="panel-body">
                    <fieldset>
                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> {{ trans('admin.modelName') }} </label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                       placeholder=" {{ trans('admin.modelName') }} ">
                            </div>



                            <div class="form-group">
                                <label> {{ trans('admin.adminsMarks') }} </label>
                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="mark_id" class="select">

                                    @foreach($marks as $mark)

                                        <option value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADStatus') }} </label>
                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"
                                        class="select">
                                    <option value="1"> {{ trans('admin.settingsOpen') }} </option>
                                    <option value="0"> {{ trans('admin.settingsClose') }} </option>
                                </select>
                            </div>

                            <div class="col-md-2"></div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"> {{ trans('admin.save') }} <i
                                    class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /a legend -->

    </div>


@endsection



