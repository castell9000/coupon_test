<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Make_randnumController;

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
        $upper_fix = strtoupper($request->input('input_coupon')); // 입력받은 문자열을 대문자로
        debug($upper_fix);
        $exist_coupon = Coupon::where('coupon_code', $upper_fix);
        $check_exist=null;
        $check_used=null;
        foreach($exist_coupon->get() as $exist){
            $check_exist[] = $exist->coupon_code;
            $check_used[] = $exist->user_id;
        }
        if($check_exist == null){
            flash('존재하지 않는 쿠폰입니다.');
        }else if($check_used[0] == null){
            $exist_coupon->update(['user_id'=>auth()->user()->id]);
            $exist_coupon->update(['used_at'=>now()]);
            flash('쿠폰이 적용되었습니다.');
        }else{
            flash('이미 사용한 쿠폰입니다.');
        }

        return redirect('/use');


    }
    public function makeCoupon(Request $request){ // 쿠폰 만드는 로직
        $this->validate($request,[
           'prefix' => 'required|alpha_num|min:3|max:3',
        ]);
        $upper_fix = strtoupper($request->input('prefix')); // 입력받은 prefix문자열을 대문자로
        $grp_num = $this->couponGrp_make(); // 쿠폰 그룹을 새로 만들고 새로 만든 그룹의 id를 가져옴
        $make_rands = Make_randnumController::randnum(); // 13자리 랜덤 문자열 생성 (10만개)
        $user_ids = User::pluck('id'); // 쿠폰생성중 랜덤 유저가 사용하게 하기 위한 코드 1
        $user_ids[] = null; // 쿠폰생성중 랜덤 유저가 사용하게 하기 위한 코드 2
        $coupon = null;
        foreach ($make_rands as $make_rand){ // 데이터베이스 입력 전 배열에 정리하여 담음
            $faker = $user_ids[mt_rand(0, count($user_ids)-1)]; // 쿠폰생성중 랜덤 유저가 사용하게 하기 위한 코드 3
            if($faker == null) { // 쿠폰생성중 랜덤 유저가 사용하게 하기 위한 입력 내용 조건
                $coupon[]= [
                    'coupon_code' => $upper_fix . $make_rand,
                    'user_id' => null,
                    'coupongroup_id' => $grp_num,
                    'used_at' => null,
                ];
            }else{
                $coupon[] = [
                    'coupon_code' => $upper_fix . $make_rand,
                    'user_id' => $faker,
                    'coupongroup_id' => $grp_num,
                    'used_at' => now(),
                ];
            }
        }
        $coupon_s = array_chunk($coupon, 200); // 10만개의 배열을 200개씩 잘라 처리
        foreach ($coupon_s as $slice){
            Coupon::insert($slice);
        }
        flash('쿠폰 10만개가 추가되었습니다.');
        return view('make');
    }

    public function couponGrp_make(){ // 쿠폰 그룹을 새로 만들어 데이터베이스에 입력
        $new_grp = null; // 새로운 그룹 id를 넘겨줄 변수 초기화
        if(\App\Coupongroup::first()==null){ // 그룹이 없으면 A 그룹으로 만들고 있다면 제일 마지막 그룹이름을 유니코드로 변환해 1더해 이름을 만듦
            $coupon_grp = \App\Coupongroup::create([
               'grp_name' => 'A'
            ]);
            $new_grp = $coupon_grp->id;
        }else{
            $convert = ord(\App\Coupongroup::latest()->first()->grp_name)+1;
            $coupon_grp = \App\Coupongroup::create([
                'grp_name' => chr($convert)
            ]);
            $new_grp = $coupon_grp->id;
        }
        return $new_grp;
    }
}
