<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\notifier;


use kartik\growl\Growl;
use yii\helpers\ArrayHelper;
use zetsoft\models\chat\ChatNotify;
use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZSessionGrowlWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public const icon = [
        'error' => 'fa fa-debug',
        'success' => 'fa fa-check-circle',
        'warning' => 'fa fa-exclamation-circle',
        'info' => 'fa fa-info-circle',
    ];


    public function codes()
    {

        $notifies = ChatNotify::find()
            ->where(['or',
                ['user_id' => $this->userIdentity()->id],
                ['user_id' => -1]
            ])
            ->andWhere([
                'check' => false
            ])
            ->all();


        foreach ($notifies as $notify) {

            $this->htm .= ZKGrowlWidget::widget([
                'config' => [
                    'title' => $notify->title,
                    'body' => $notify->text,
                    'delay' => 500,
                    'type' => $notify->type,
                ]
            ]);

            $notify->check = true;
            $notify->save();
        }


    }


}




/*
$this->notifyInfo('asfasf', '');
$this->notifySuccess('afsdfgdsaf', '');*/
