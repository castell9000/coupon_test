@extends('layouts.app')

@section('content')
    <div class="container" style="position:absolute; left: 25%; top: 20%">
        <div class="col-md-8">
            <div class="card-body" >
                <p>Coupon 번호 16자리를 입력해주세요.</p>
                <p>숫자와 영어 대문자를 정확히 입력해주세요.</p>
                <hr/>
                <form action="{{ route('coupon.use') }}" method="post">
                    @csrf
                    <div class="form-group row {{ $errors->all() ? 'has-error' : '' }}">
                    <label for="input_coupon" class="col-md-4 col-form-label text-md-right">Coupon Number</label>
                        <div class="col-md-6">
                            <input type="text" name="input_coupon" class="form-control" value="{{ old('name') }}"><br/>
                            {!! $errors->first('alpha_num', '<span class="form-error>Only use alphabet or number</span>') !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Use Coupon
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

