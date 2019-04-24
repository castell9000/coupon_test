<?php
/**
 * Created by PhpStorm.
 * User: prtscn
 * Date: 2019-04-23
 * Time: 19:34
 */

namespace App\Services;

use App\Coupon;
use App\Coupongroup;
use App\User;
use Illuminate\Http\Request;

class CouponFunc
{
    static public function makeCoupon(Request $request){

        $upper_fix = strtoupper($request->input('prefix')); // 입력받은 prefix문자열을 대문자로
        $grp_num = CouponFunc::makeCouponGrp(); // 쿠폰 그룹을 새로 만들고 새로 만든 그룹의 id를 가져옴
        $make_rands = MakeRandomStr::makeCouponNum(); // 13자리 랜덤 문자열 생성 (10만개)
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
        return true;
    }

    static public function useCoupon(Request $request){
        $message = null;
        $upper_fix = strtoupper($request->input('input_coupon')); // 입력받은 문자열을 대문자로
        $exist_coupon = Coupon::where('coupon_code', $upper_fix);
        $check_exist=null;
        $check_used=null;
        foreach($exist_coupon->get() as $exist){
            $check_exist[] = $exist->coupon_code;
            $check_used[] = $exist->user_id;
        }
        if($check_exist == null){
            $message = '존재하지 않는 쿠폰입니다.';
        }else if($check_used[0] == null){
            $exist_coupon->update(['user_id'=>auth()->user()->id]);
            $exist_coupon->update(['used_at'=>now()]);
            $message = '쿠폰이 적용되었습니다.';
        }else{
            $message = '이미 사용한 쿠폰입니다.';
        }

        return $message;
    }

    private function makeCouponGrp(){
        $new_grp = null; // 새로운 그룹 id를 넘겨줄 변수 초기화
        if(Coupongroup::first()==null){ // 그룹이 없으면 A 그룹으로 만들고 있다면 제일 마지막 그룹이름을 유니코드로 변환해 1더해 이름을 만듦
            $coupon_grp = Coupongroup::create([
                'grp_name' => 'A'
            ]);
            $new_grp = $coupon_grp->id;
        }else{
            $convert = ord(Coupongroup::latest()->first()->grp_name)+1;
            $coupon_grp = Coupongroup::create([
                'grp_name' => chr($convert)
            ]);
            $new_grp = $coupon_grp->id;
        }
        return $new_grp;
    }

    static public function couponPaging(){
        $coupons = null;
//        if($grpName == null){
            $coupons = Coupon::latest()->paginate(50);
//        }else{
//            $grp_id = Coupongroup::where('grp_name',$grpName)->first()->id;
//            $coupons = Coupon::where('coupongroup_id',$grp_id)->latest()->paginate(50);
//        }

        return $coupons;
    }

    static public function staticCoupons(){
        $grp_num = Coupongroup::count();
        $static_arr = null;
        $i=0;
        while ($i<$grp_num){
            $convert = ord(Coupongroup::first()->grp_name);
            $check = chr($convert+$i);

            $total = Coupongroup::where('grp_name',$check)->with('coupons')->first()->coupons->count();
            $used = $total - Coupongroup::where('grp_name',$check)->with('coupons')->first()->coupons->where('user_id',null)->count();
            $rate = $used/$total;
            $i++;
            $static_arr[] = [$check, $total, $used, $rate];
        }

        return $static_arr;
    }
}