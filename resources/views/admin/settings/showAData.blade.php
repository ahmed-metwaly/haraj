@extends('admin.master')


@section('title')

{{ trans('admin.settingsTitle') }}

@endsection



@section('sectionName')

{{ trans('admin.sideSettingsTitle') }}

@endsection



@section('pageName')

{{ trans('admin.sideSettings') }}

@endsection



@section('content')


<div class="col-md-12">

    <!-- Advanced legend -->

    <form action="{{ route('settings-do-edit') }}" method="post">

        <div class="panel panel-flat">

            <div class="panel-heading">

                <h5 class="panel-title"> {{ trans('admin.settingsFormTitle') }} </h5>



            </div>





            <div class="panel-body">

                <fieldset>

                    <div class="collapse in" id="demo1">

                        <div class="form-group">

                            <label> {{ trans('admin.settingsSiteName') }} </label>

                            <input type="text" required name="site_name" value="{{ $data->site_name }}" class="form-control" placeholder=" {{ trans('admin.settingsSiteName') }} ">

                        </div>

                        <div class="form-group">

                            <label>{{ trans('admin.settingsSiteEmail') }}</label>

                            <input type="email" required name="site_email" value="{{ $data->site_email }}" class="form-control" placeholder="{{ trans('admin.settingsSiteEmail') }}">

                        </div>





                        <div class="form-group">

                            <label> {{ trans('admin.settingsSitePhone') }} </label>

                            <input type="tel" required name="site_phone" value="{{ $data->site_phone }}" class="form-control" placeholder=" {{ trans('admin.settingsSitePhone') }} ">

                        </div>

                        <div class="form-group">

                            <label> {{ trans('admin.settingsFb') }} </label>

                            <input type="text" required name="site_fb" value="{{ $data->site_fb }}" class="form-control" placeholder=" {{ trans('admin.settingsFb') }} ">

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsTw') }} </label>

                            <input type="text" required name="site_tw" value="{{ $data->site_tw }}" class="form-control" placeholder="{{ trans('admin.settingsTw') }}">

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsGo') }} </label>

                            <input type="text" required name="site_go" value="{{ $data->site_go }}" class="form-control" placeholder="{{ trans('admin.settingsGo') }}">

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsInst') }} </label>

                            <input type="text" required name="site_inst" value="{{ $data->site_inst }}" class="form-control" placeholder="{{ trans('admin.settingsInst') }}">

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsYout') }} </label>

                            <input type="text" required name="site_yout" value="{{ $data->site_yout }}" class="form-control" placeholder=" {{ trans('admin.settingsYout') }}  ">

                        </div>





                        <div class="form-group">

                            <label> {{ trans('admin.settingsKeyword') }} </label>

                            <textarea rows="5" required cols="5" name="site_keyword" class="form-control" placeholder="{{ trans('admin.settingsKeyword') }}">{{ $data->site_keyword }}</textarea>

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsDescription') }} </label>

                            <textarea rows="5" required cols="5" name="site_description" class="form-control" placeholder="{{ trans('admin.settingsDescription') }}">{{ $data->site_description }}</textarea>

                        </div>

                        <div class="form-group">

                            <label> عضوية مكاتب العقار والسيارات </label>

                            <textarea id="editor1" rows="5" required cols="5" name="subscribe" class="form-control ckeditor" placeholder="" value="{{$data->subscribe}}">{{ $data->subscribe }}</textarea>

                        </div>

                        <div class="form-group">

                            <label> عمولة حراج </label>

                            <textarea id="editor1" rows="5" required cols="5" name="commission" class="form-control ckeditor" placeholder="" value="{{$data->commission}}">{{ $data->commission }}</textarea>

                        </div>

                        <div class="form-group">

                            <label> حساب العمولة </label>

                            <textarea rows="5" required cols="5" name="commission_count" class="form-control" placeholder="" value="{{$data->commission_count}}">{{ $data->commission_count }}</textarea>

                        </div>

                        <div class="form-group">

                            <label> السلع والإعلانات الممنوعة </label>

                            <textarea id="editor1" rows="5" required cols="5" name="black_ads" class="form-control ckeditor" placeholder="" value="{{$data->black_ads}}">{{ $data->black_ads }}</textarea>

                        </div>


                        <div class="form-group">

                            <label> {{ trans('admin.settingsClose') }} </label>

                            <textarea rows="5" required cols="5" name="site_close_messge" class="form-control " placeholder="{{ trans('admin.settingsClose') }}">{{ $data->site_close_messge }}</textarea>

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.settingsComments') }} </label>

                            <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="site_comments_status" class="select">

                                <option value="1" {{ $data->site_comments_status == 1 ? 'selected' : '' }} > {{ trans('admin.settingsOpen') }} </option>

                                <option value="0" {{ $data->site_comments_status == 0 ? 'selected' : '' }} > {{ trans('admin.settingsClose') }} </option>

                            </select>

                        </div>



                        <div class="form-group">

                            <label> {{ trans('admin.SettingsStatus') }} </label>

                            <select required data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status" class="select">

                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }} > {{ trans('admin.SettingsStatusOpen') }} </option>

                                <option value="0" {{ $data->status == 0 ? 'selected' : '' }} > {{ trans('admin.SettingsStatusClose') }} </option>

                            </select>

                        </div>

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
@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> 
@endsection('script')