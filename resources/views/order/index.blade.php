@extends('layouts.main')
@section('content')
    <table class="table table-stripped">
        <thead>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Tổng giá trị</th>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->customer_name}}</td>
                    <td>{{$item->customer_phone_number}}</td>
                    <td>{{$item->total_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection