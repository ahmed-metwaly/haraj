@extends('admin.master')

@section('title')
{{ trans('admin.adminMessageShow') }}
@endsection

@section('sectionName')
{{ trans('admin.adminMessages') }}
@endsection

@section('pageName')
{{ trans('admin.adminMessageShow') }}
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
            <th>{{ trans('admin.titleMessage') }}</th>
            <!-- <th>{{ trans('admin.ip') }}</th> -->
            <th>{{ trans('admin.message') }}</th>
            <th>{{ trans('admin.AddedDate') }}</th>
            <th>{{ trans('admin.show') }}</th>
            <th>{{ trans('admin.replay') }}</th>
            <th>{{ trans('admin.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($data) > 0)
            @foreach($data as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td> {{ $value->name }} </td>
                    <td> {{ $value->email }} </td>
                    <td> {{ $value->title }} </td>
                    <!-- <td> {{ $value->ip }} </td> -->
                    <td> {{ mb_substr($value->message, 0, 50) }} </td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ route('admin-message-details', ['id' => $value->id]) }}"><i class="icon-tv"
                                                                                          aria-hidden="true"></i></a></td>
                    <td><a href="mailto:{{ $value->email }}"><i class="icon-reply"
                                                                                     aria-hidden="true"></i></a></td>
                    <td><a class="do-delete" href="{{ route('admin-message-delete', ['id' => $value->id]) }}"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection