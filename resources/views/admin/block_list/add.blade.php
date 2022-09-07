@extends('admin.master')

@section('title')
{{ trans('admin.blackListAdd') }}
@endsection

@section('sectionName')
    <a href="{{ route('black-lists') }}"> {{ trans('admin.blackList')  }} </a>
@endsection

@section('pageName')
{{ trans('admin.blackListAdd') }}
@endsection


@section('content')


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('admin.userName') }}</th>
            <th>{{ trans('admin.userEmail') }}</th>
            <th>{{ trans('admin.adminsADCount') }}</th>
            <th>{{ trans('admin.AddedDate') }}</th>
            <th>{{ trans('admin.add') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($data) > 0)
            @foreach($data as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td><a href="{{ route('admin-details', ['id' => $value->id]) }}">{{ $value->name }}</a></td>
                    <td>{{ $value->email  }}</td>
                    <td>{{$value->country_name }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td><a class="" href="{{ route('black-do-add', ['id' => $value->id]) }}"><i
                                    class="icon-user-plus"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection