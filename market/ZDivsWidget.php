<?php

namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Zilola Ikramova

 */

class ZDivsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'height' => null,
        'size' => 'px',
        'url' => '',// path
        'id'=> null,
        'class' => '',
        'background'=>'',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     * Constants */
    public function asset()
    {

    }


     public $layout = [];
     public $_layout = [
         'main' => <<<HTML
 
            <div id="{id}" class="{class}" >
                <img src="{url}">
            </div>

HTML,
     ];


    public function codes()
    {
        if(!$this->_config['url']) {
            $this->_config['background'];
        }else {
            $this->_config['background'] = '';
        }

        if (!$this->_config['height']) {
            $this->_config['height'] = 'auto';
            $this->_config['size'] = '';
        }

        $this ->htm = strtr($this ->_layout['main'],[

            '{height}'=>$this->_config['height'],

            '{background}'=>$this->_config['background'],
            '{url}'=>$this->_config['url'],
            '{id}'=>$this->_config['id'],
            '{class}'=>$this->_config['class'],
            '{size}' => $this->_config['size']

        ]);
    }

}
