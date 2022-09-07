@extends('admin.master')

@section('title')
{{ trans('admin.citiesDisplay') }}
@endsection

@section('sectionName')
{{ trans('admin.citiesTitle') }}
@endsection

@section('pageName')
{{ trans('admin.citiesDisplay') }}
@endsection


@section('content')


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('admin.cityName') }}</th>
            <th>{{ trans('admin.adminsADCount') }}</th>
            <th> {{ trans('admin.addedBy') }} </th>
            <th>{{ trans('admin.AddedDate') }}</th>
            <th>{{ trans('admin.show') }}</th>
            <th>{{ trans('admin.edit') }}</th>
            <th>{{ trans('admin.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($data) > 0)
            @foreach($data as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td><a href="{{ route('city-details', ['id' => $value->id]) }}">{{ $value->name }}</a></td>
                    <td><a href="{{ route('country-details', ['id' => $value->country_id]) }}">{{ $value->country_name }}</a></td>
                    <td><a href="{{ route('admin-details', ['id' => $value->user_id ]) }}"> {{ $value->username }} </a> </td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ route('city-details', ['id' => $value->id]) }}"><i class="icon-tv"
                                                                                        aria-hidden="true"></i></a></td>
                    <td><a href="{{ route('city-edit', ['id' => $value->id]) }}"><i class="icon-pencil"
                                                                                     aria-hidden="true"></i></a></td>
                    <td><a class="do-delete" href="{{ route('city-delete', ['id' => $value->id]) }}"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection