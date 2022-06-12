<?php

namespace api\components;

class JwtValidationData extends \sizeg\jwt\JwtValidationData
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->validationData->setIssuer('http://batalapi.mohammedabadi.com');
        $this->validationData->setAudience('http://batalapi.mohammedabadi.com');
        $this->validationData->setId('4f1g23a12aa');

        parent::init();
    }
}