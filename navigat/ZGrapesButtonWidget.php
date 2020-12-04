<?php

/**
 *
 *
 * Created By: Shakxzod Namazbaev
 * Created_at: 03.12.2019
 * Refactored By: Xakimjon Ergashov
 * Refactored_at 05.05.2020
 *
 */

namespace zetsoft\widgets\navigat;

use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use function Amp\Parallel\Worker\factory;

class ZGrapesButtonWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
       'theme' => ZGrapesButtonWidget::themes['firstBtn']
    ];

    public const themes = [
        'firstBtn' => 'firstBtn',
        'secondBtn' => 'secondBtn'
    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
    
    ];

  

    public $layout = [];
    public $_layout = [
            'firstBtn' => <<<HTML
        
HTML,

            'secondBtn' => <<<HTML

HTML,

            'css' => <<<CSS

CSS,

          'js' => <<<JS

JS,



    ];

    public function codes()
    {
        if ($this->_config['theme'] === 'firstBtn')
            $this->htm = $this->_layout['firstBtn'];


        if ($this->_config['theme'] === 'secondBtn')
            $this->htm = $this->_layout['secondBtn'];

        $this->css = $this->_layout['css'];

        $this->js = $this->_layout['js'];


    }
}
