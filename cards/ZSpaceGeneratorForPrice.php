<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\cards;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZSpaceGeneratorForPrice extends Zwidget
{
    public $config = [];
    public $_config = [


    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];

    /*
     * Constants
     * */


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'vertical' => <<<HTML
                 
                
HTML,
    'js' => <<<JS

JS,


    ];

    public function asset()
    {

    }

    public function codes()
    {
        $this->htm = $this->_layout['vertical'];
    }
}

