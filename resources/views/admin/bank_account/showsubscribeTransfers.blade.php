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
            <th>موافقة </th>
            <!-- <th>رقم الإعلان</th> -->
            <!-- <th>الإعلان</th> -->
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
                    <td>{{ $value->Bank()->first()->bank_name}}</td>
                    <td>{{ $value->transfered_at }}</td>
                    @if($value->byUser()->first()->is_pro ==0)
                    <td><a href="{{ route('transfer-pro', ['id' => $value->byUser()->first()->id]) }}">موافقة</a></td>
                    @else
                    <td><a href="{{ route('transfer-dispro', ['id' => $value->byUser()->first()->id]) }}">الغاء العضوية</a></td>
                    @endif
                    
                    <td>{{ $value->byUser()->first()->name }} </a> </td>
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