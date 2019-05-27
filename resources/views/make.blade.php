@extends('layouts.app')

@section('content')
    <div class="container" style="position:absolute; left: 25%; top: 20%">
        <div class="col-md-8">
            <div class="card-body" >
                <p>Prefix를 3자 입력해주세요.</p>
                <p>Prefix에 사용되는 문자는 숫자와 영어 알파벳만 허용됩니다.</p>
                <p>쿠폰번호는 한번에 10만개가 만들어집니다.</p>
                <hr/>
                <form action="{{ route('coupon.make') }}" method="post">
                    @csrf
                    <div class="form-group row {{ $errors->all() ? 'has-error' : '' }}">
                        <label for="prefix" class="col-md-4 col-form-label text-md-right">Prefix</label>
                        <div class="col-md-6">
                            <input type="text" name="prefix" class="form-control" value="{{ old('name') }}"><br/>
                            {!! $errors->first('prefix', '<span class="form-error">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="form-group col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Make Coupon
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

