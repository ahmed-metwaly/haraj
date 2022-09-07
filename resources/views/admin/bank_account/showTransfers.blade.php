@extends('admin.master')

@section('title')
{{ trans('admin.bankTransfers') }}
@endsection

@section('sectionName')
{{ trans('admin.bankTransfers') }}
@endsection

@section('pageName')
{{ trans('admin.bankTransfers') }}
@endsection


@section('content')


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">

    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th>اسم المحول</th>
            <th>البريد الالكترونى</th>
            <th>الجوال</th>
            <th>مبلغ التحويل</th>
            <th>اسم البنك</th>
            <th>وقت التحويل</th>
            <th>رقم الإعلان</th>
            <th>الإعلان</th>
            <th>موافقة</th>
            <th> {{ trans('admin.addedBy') }} </th>
            <!-- <th>{{ trans('admin.AddedDate') }}</th> -->
            <th>{{ trans('admin.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($TransferData) > 0)
            @foreach($TransferData as $value)

                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->transfered_by}}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->amount }}</td>
                    <td>{{ $value->bank_name}}</td>
                    <td>{{ $value->transfered_at }}</td>
                    <td>{{ $value->ad_id }}</td>
                    <td><a target="_blank"
                               href="{{ route('ad-view', ['id' => $value->ad_id]) }}">{{ $value->ads_title }}</a>
                        </td>
                        @if($value->ads_is_pro == 0)
                        <td><a href="{{ route('pro-ad', ['id' => $value->ad_id]) }}">تثبيت</a></td>
                        @else
                        <td><a href="{{ route('dis-pro-ad', ['id' => $value->ad_id]) }}">الغاء التثبيت</a></td>
                         @endif
                        
                    <td><a href="{{ route('admin-details', ['id' => $value->user_id ]) }}"> {{ $value->username }} </a> </td>
                    <!-- <td>{{ $value->created_at }}</td> -->
                    <td><a class="do-delete" href="{{ route('transfer-delete', ['id' => $value->id]) }}"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection


