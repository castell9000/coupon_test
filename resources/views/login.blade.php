@extends('layouts.app')

@section('content')
    <div class="container" style="position:absolute; left: 25%; top: 20%">
        <div class="col-md-8">
            <div class="card-body" >
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" placeholder="example@exam.com" value="{{ old('email') }}" autofocus/>
                        {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="password">
                        {!! $errors->first('password', '<span class="form-error">:message</span>')!!}
                    </div>

                    <div class="form-group row mb-0">
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

