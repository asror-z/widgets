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


/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Created By Jahongir Qudratov
 *
 */

namespace zetsoft\widgets\images;


use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHImgWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#img()-detail
 *
 *
 */
class ZHImgWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'class' => 'img-fluid  rounded-circle',
        'width' => 200,
        'style' => '',
        'height' => 200,
        'alt' => 'alt',
        'align' => '',
        'grapes' => true,
        'url' => '/render/images/assets/image/user/male.png'

    ];


    public function codes()
    {
        $defImg = $this->_config['url'];

        $this->options = [
            'class' => $this->_config['class'],
            'width' => $this->_config['width'],
            'height' => $this->_config['height'],
            'style' => $this->_config['style'],
            'alt' => $this->_config['alt'],
        ];

        if ($this->modelCheck()) {
            $this->htm = ZHTML::img(
                $this->value,
                $this->options
            );
        } else {

            $this->htm = ZHTML::img(
                $this->value = $defImg,
                $this->options,
            );
        }


    }
}





/* $photos = $this->value;
 if ($this->modelCheck())

     foreach ($photos as $key => $photo) {
         $path = "/upload/User/photo/$photo";


         $this->htm = ZHTML::img(
             $this->options,
             $return[] = $path
         );
     }
 else {

     $this->htm = ZHTML::img(

         $this->options,
         $return[] = '/publish/image/user/male.png'
     );


 }

 return $return;*/
