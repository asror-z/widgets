<?php

namespace zetsoft\widgets\iconers;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/konpa/devicon
 * https://konpa.github.io/devicon/
 *
 * Created By: Farrux OZodkhodjaev
 *
 */

class ZKonpaIconDeviconWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
    'grapes' => true,
        ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];

    public $layout  = [];
    public $_layout  = [

       'main' => <<<HTML
        <i class="devicon-git-plain"'  ></i>
  <i class="devicon-git-plain-wordmark"></i>
  <i class="devicon-git-plain colored"></i>
  <i class="devicon-git-plain-wordmark colored"></i>
HTML,

'css' => <<<CSS
    i  {
        font-size: 50px;
    }
CSS,

];


    /**
     *
     * Constants
     */
    /*public const types = [
        'plain' => 'plain',
        'wordmark' => 'wordmark',
        'colored' => 'colored',
        'wcolored' => 'wcolored',
    ];*/


    public function asset()
    {
       /*$this->fileCss('/publish/yarner/devicon/devicon.git/devicon.css');*/
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/devicon/2.2/devicon.css');

      /* $this->fileCss('https://www.jsdelivr.com/package/npm/devicon');*/


        /*$this->fileCss('/publish/yarner/devicon/devicon.git/devicon-colors.css');*/
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/devicon/2.2/devicon-colors.css');

    }


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

     $this->htm = strtr($this->_layout['main'],[

     ]);
     $this->css = strtr($this->_layout['css'],[]);$this->htm = strtr($this->_layout['main'],[]);
        $this->css = strtr($this->_layout['css'],[]);


    }
}
