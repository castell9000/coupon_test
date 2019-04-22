<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Make_randnumController extends Controller
{

    static public function randnum(){
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
        return self::checkDupli($randArrs);
    }

    static function checkDupli($randArrs){
        $count_vars = array_count_values($randArrs); // 배열의 요소들의 갯수 key : value 형태 배열로 반환
        foreach ($count_vars as $count_var){
            if($count_var === '2'){
                $newRandStr = str_random(13);

                while( !array_key_exists($newRandStr, $randArrs) ){
                    $newRandStr = str_random(13);

                };
                $randArr[count(tests)-1] = $newRandStr;
            }
        }
        $coupon_Strs = $randArrs;
        return $coupon_Strs;
    }
}
