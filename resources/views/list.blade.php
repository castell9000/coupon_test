@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>발행 쿠폰 리스트</h1>
        <hr/>
        <table class="table table-striped text-center">
            <th class="text-center">번호</th>
            <th class="text-center">쿠폰 번호</th>
            <th class="text-center">사용 유저</th>
            <th class="text-center">사용 일시</th>
            @forelse($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->coupon_code }}</td>
                <td>{{ $coupon->user['email']}}</td>
                <td>{{ $coupon->used_at }}</td>
            </tr>
            @empty
                <p>쿠폰이 없습니다.</p>
            @endforelse
        </table>
    </div>
    @if($coupons->count())
        <div class="text-center">
            {!! $coupons->render() !!}
        </div>
    @endif

@stop