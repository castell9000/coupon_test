<?php

namespace App\Http\Controllers;

use App\Services\CouponFunc;
use Illuminate\Http\Request;

class CouponController extends Controller
{
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

        $service = CouponFunc::useCoupon($request);
        flash($service);
        return redirect('/use');

    }
    public function makeCoupon(Request $request){ // 쿠폰 만드는 로직
        $this->validate($request,[
           'prefix' => 'required|alpha_num|min:3|max:3',
        ]);

        $service = CouponFunc::makeCoupon($request);

        if ($service){
            flash('쿠폰 10만개가 추가되었습니다.');
        }else{
            flash('오류가 발생하였습니다.');
        }

        return view('make');
    }

}
