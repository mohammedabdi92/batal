<?php

namespace common\models;

use common\models\User;
use common\models\Admin;

class BaseModel extends \yii\db\ActiveRecord
{


    public function getDate($att)
    {
        return date('Y-m-d H:i:s', $this->$att);
    }
    public function getUserName($att)
    {
        $user =  User::findOne($this->$att);
        return $user->username??'';
    }
    public function getAdminname($att)
    {
        $user =  Admin::findOne($this->$att);
        return $user->full_name??'';
    }


}