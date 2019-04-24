<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponListController extends Controller
{
    public function listView(){
        if(auth()->user()->check_user==1){
            $coupons = \App\Coupon::latest()->paginate(50);
            return view('list',compact('coupons'));
        }else{
            flash("접근 할 수 없는 페이지입니다.");
            return redirect('/use');
        }
    }


}
