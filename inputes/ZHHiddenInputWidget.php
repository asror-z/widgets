<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHHiddenInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#hiddenInput()-detail
 */
class ZHHiddenInputWidget extends ZWidget
{


public $config = [];
public $_config = [


];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZHHiddenInputWidget/image/icon.png',
        'name' => Azl . 'HiddenInput',
        'title' => Azl . '<b>safasfsa</b>zsdfszdfsdf',

    ];
    public function codes()
    {

     
        if (empty($this->model))
            $this->htm = ZHTML::hiddenInput(
                $this->name,
                $this->value,
            );
        else
            $this->htm = ZHTML::activeHiddenInput(
                $this->model,
                $this->attribute,
            );

    }

}
