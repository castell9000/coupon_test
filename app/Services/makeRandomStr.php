<?php
/**
 * Created by PhpStorm.
 * User: prtscn
 * Date: 2019-04-23
 * Time: 18:00
 */

namespace App\Services;


class makeRandomStr
{
    static public function makeCouponNum(){
        $randArrs = makeRandomStr::makeRand();
        $count_vars = array_count_values($randArrs); // 배열의 요소들의 갯수 key : value 형태 배열로 반환
        foreach ($count_vars as $count_var){
            $arrnum = 0;
            if($count_var === '2'){
                $newRandStr = str_random(13);

                while( !array_key_exists($newRandStr, $randArrs) ){
                    $newRandStr = str_random(13);

                };
                $randArr[$arrnum] = $newRandStr;
            }
            $arrnum++;
        }
        $coupon_Strs = $randArrs;
        return $coupon_Strs;
    }

    private static function makeRand(){
        $limit = 100000; // 쿠폰 랜덤 문자열 생성 갯수 제한 10만개
        $check = 0;      // 쿠폰 랜덤 문자열 반복문 조건 변수 초기화
        $randArrs = null; // 쿠폰 랜덤 문자열 담을 변수 초기화
        $char_arc = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // 쿠폰 번호로 사용될 문자 조건, 숫자와 영어 대문자

        while($check++<$limit){ // 랜덤 문자열 10만개 생성 및 배열에 저장
            $make_randStr = '';
            for($i=0; $i<13; $i++) {
                $make_randStr .= $char_arc[mt_rand(0, strlen($char_arc)-1)];
            }
            $randArrs[] = $make_randStr;

        }
        return $randArrs;
    }

}