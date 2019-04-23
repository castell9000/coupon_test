<?php
/**
 * Created by PhpStorm.
 * User: prtscn
 * Date: 2019-04-23
 * Time: 18:36
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class MakeRandomStr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MakeRandomStr';
    }
}