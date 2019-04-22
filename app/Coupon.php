<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_code', 'user_id', 'coupongroup_id', 'used_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function coupongroup(){
        return $this->belongsTo(Coupongroup::class);
    }
}
