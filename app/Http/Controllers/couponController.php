<?php

namespace App\Http\Controllers;

use App\Services\couponFunc;
use Illuminate\Http\Request;

class couponController extends Controller
{
    public function __construct() { // 로그인한 사람만 접근 가능
        $this->middleware('auth');
    }

    public function useView(){ // 쿠폰 사용 페이지 뷰 메소드
        return view('use');
    }

    public function makeView(){ // 쿠폰코드 만드는 페이지 뷰 메소드
        if(auth()->user()->check_user==1){
            return view('make');
        }else{
            flash('접근 할 수 없는 페이지입니다.');
            return redirect('/use');
        }
    }

    public function useCoupon(Request $request){
        $this->validate($request, [
            'input_coupon' => 'required|alpha_num|min:16|max:16',
        ]);

        $service = couponFunc::useCoupon($request);
        flash($service);
        return redirect('/use');

    }
    public function makeCoupon(Request $request){ // 쿠폰 만드는 로직
        $this->validate($request,[
           'prefix' => 'required|alpha_num|min:3|max:3',
        ]);

        $service = couponFunc::makeCoupon($request);

        if ($service){
            flash('쿠폰 10만개가 추가되었습니다.');
        }else{
            flash('오류가 발생하였습니다.');
        }

        return view('make');
    }

}
