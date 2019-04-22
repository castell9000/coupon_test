<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('login');
    }

    public function store(Request $request){ // 로그인 로직 함수, DB의 정보와 체크
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6',
        ]);

        if(! auth()->attempt($request->only('email','password'), $request->has('remember'))){
            flash('이메일 또는 비밀번호가 맞지 않습니다.');

            return back()->withInput();
        }

        flash(auth()->user()->name . '님 환영합니다.');

        return redirect()->intended('');
    }

    public function destroy(){ // 로그아웃
        auth()->logout();
        flash('또 방문해주세요.');

        return redirect('/');
    }
}
