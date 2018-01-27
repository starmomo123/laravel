<?php
/**
 * Created by PhpStorm.
 * User: luoyaoxing
 * Date: 18-1-27
 * Time: 下午10:33
 */

namespace App\Services;


class TimeHandleService
{
    public function time_format($time)
    {
        $time1 = strtotime($time);
        $time2=time();
        $arrs=array_reverse(['秒','分钟','小时','天','月','年']);
        $second = $time2 - $time1;
        $minute=floor($second/60);
        $hour=floor($minute/60);
        $date=floor($hour/24);
        $month=floor($date/30);
        $year=floor($month/12);
        $times=array_values(array_reverse(compact('second','minute','hour','date','month','year')));
        $str="";
        foreach ($arrs as $key=>$arr){
            if($times[$key]>0){
                $str.=$times[$key].$arr;
                break;
            }
        }
        $str.='前';
        return $str;
    }
}