@extends('admin.master')

@section('title')
{{ trans('admin.blackListShow') }}
@endsection

@section('sectionName')
{{ trans('admin.blackList') }}
@endsection

@section('pageName')
{{ trans('admin.blackListShow') }}
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
           <!--  <th> {{ trans('admin.addedBy') }} </th> -->
            <th>{{ trans('admin.AddedDate') }}</th>
            <th>{{ trans('admin.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($data) > 0)
            @foreach($data as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td><a href="{{ route('admin-details', ['id' => $value->userId]) }}">{{ $value->username }}</a></td>
                    <td>{{ $value->user_email  }}</td>
                    <!-- <td><a href="{{ route('admin-details', ['id' => $value->created_by ]) }}"> {{ $value->created_by }} </a> </td> -->
                    <td>{{ $value->created_at }}</td>
                    <td><a class="do-delete" href="{{ route('black-delete', ['id' => $value->id]) }}"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection