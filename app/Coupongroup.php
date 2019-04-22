<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupongroup extends Model
{
    protected $fillable = ['grp_name'];

    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
}
