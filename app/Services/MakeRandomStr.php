<?php
/**
 * Created by PhpStorm.
 * User: prtscn
 * Date: 2019-04-23
 * Time: 18:00
 */

namespace App\Services;


class MakeRandomStr
{
    static public function makeCouponNum(){ // 랜덤 문자 배열의 중복을 검사하고 완성된 배열로 전달
        $randArrs = MakeRandomStr::makeRand();
        $count_vars = array_count_values($randArrs); // 배열의 요소들의 갯수 key : value 형태 배열로 반환
        $arrnum = 0;
        $newRandStr = null;
        foreach ($count_vars as $count_var){

            if($count_var === '2'){
                $newRandStr = self::makeRand(1)[0];

                while( !array_key_exists($newRandStr, $randArrs) ){
                    $newRandStr = self::makeRand(1)[0];

                };
                $arrnum = array_search($newRandStr, $randArrs);
            }
        }
        $randArrs[$arrnum] = $newRandStr;
        $coupon_Strs = $randArrs;
        return $coupon_Strs;
    }

    private static function makeRand($limit=100000){ // 랜덤 문자열 생성 기본 10만개
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