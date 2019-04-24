@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>발행 쿠폰 리스트</h1>
        <hr/>
        <table class="table table-striped text-center">
            <th class="text-center">그룹</th>
            <th class="text-center">쿠폰의 총 갯수</th>
            <th class="text-center">쿠폰 사용수</th>
            <th class="text-center">쿠폰 사용률</th>
            @forelse($coupons as $coupon)
            <tr>
                <td>{{ $coupon[0] }}</td>
                <td>{{ $coupon[1] }}</td>
                <td>{{ $coupon[2] }}</td>
                <td>{{ $coupon[3] }}</td>
            </tr>
            @empty
                <p>쿠폰이 없습니다.</p>
            @endforelse
        </table>
    </div>

@stop