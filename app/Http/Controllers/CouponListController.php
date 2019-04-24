<?php

namespace App\Http\Controllers;

use App\Coupongroup;
use App\Services\CouponFunc;
use Illuminate\Http\Request;

class CouponListController extends Controller
{
    public function listView(Request $request){
        if(auth()->user()->check_user==1){
            $coupons = CouponFunc::couponPaging(substr($request->path(),-1));
            $groups = Coupongroup::pluck('grp_name');
            debug($groups);
            return view('list',compact(['coupons', 'groups']));
        }else{
            flash("접근 할 수 없는 페이지입니다.");
            return redirect('/use');
        }
    }
    public function statics(){
        if(auth()->user()->check_user==1){
            $coupons = CouponFunc::staticCoupons();
            return view('statics',compact('coupons'));
        }else{
            flash("접근 할 수 없는 페이지입니다.");
            return redirect('/use');
        }
    }

}
