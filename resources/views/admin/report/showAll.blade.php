@extends('admin.master')

@section('title')
{{ trans('admin.reportDisplay') }}
@endsection

@section('sectionName')
{{ trans('admin.reports') }}
@endsection

@section('pageName')
{{ trans('admin.reportDisplay') }}
@endsection


@section('content')


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('admin.adsName') }}</th>
            <th>{{ trans('admin.reportDesc') }}</th>
            <th> {{ trans('admin.addedBy') }} </th>
            <th>{{ trans('admin.AddedDate') }}</th>
            <th>{{ trans('admin.show') }}</th>
            <th>{{ trans('admin.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($data) > 0)
            @foreach($data as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td><a target="_blank" href="{{ route('ad-view', ['id' => $value->ad_id]) }}">{{ mb_substr($value->ad_title, 0, 50) }}</a></td>
                    <td>{{ mb_substr($value->text, 0, 50) }} ...</td>
                    <td><a href="{{ route('admin-details', ['id' => $value->user_id ]) }}"> {{ $value->username }} </a> </td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ route('report-details', ['id' => $value->id]) }}"><i class="icon-tv"
                                                                                        aria-hidden="true"></i></a></td>

                    <td><a class="do-delete" href="{{ route('report-delete', ['id' => $value->id]) }}"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection