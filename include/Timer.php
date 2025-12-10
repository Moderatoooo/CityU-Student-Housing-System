<?php


class Timer
{
    /**
     * 获取今天的开始结束日期
     * @return array[2] [$start,$end]
     */
    public static function getToDay($isTime = false)
    {
        if ($isTime) {
            return [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')];
        }else{
            return [date('Y-m-d'), date('Y-m-d')];
        }
    }

    /**
     * 获取昨日的开始结束日期
     * @return array[2] [$start,$end]
     */
    public static function getYesterday($isTime = false)
    {
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        if ($isTime) {
            return [$yesterday . ' 00:00:00', $yesterday . ' 23:59:59'];
        }else{
            return [$yesterday, $yesterday];
        }
    }

}