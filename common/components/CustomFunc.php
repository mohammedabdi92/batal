<?php

namespace common\components;

class CustomFunc
{
    public static function getRandomString($length = 4 , $numberOnly = false) {
        $str = "";
        $characters = ( $numberOnly ) ? range('0','9') : array_merge(range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
    public static function arrayList($models,$from="id",$to="name"){
        if($models)
            return \yii\helpers\ArrayHelper::map($models, $from, $to);

    }
    public static function getFullDate($date){

        return $date? date('Y-m-d H:i:s', $date):'';

    }
}