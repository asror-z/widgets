<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\blocks;


use yii\helpers\Json;
use yii\web\JqueryAsset;
use yii\widgets\PjaxAsset;
use zetsoft\service\utility\Views;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

class ZNProgressWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'test' => true,
        'ajax' => true,
        'pjax' => false,
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.js', Views::position['begin'],
            [PjaxAsset::class, JqueryAsset::class], false);

        $this->fileCss('https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.css', [
            PjaxAsset::class,
            JqueryAsset::class
        ], false);
        
    }


    /**
     * The NProgress Configuration
     * @see https://github.com/rstacruz/nprogress#configuration
     * @var null|array
     */


    public function codes()
    {
     

        $this->js = <<<JS

    var options  = {
        minimum: 0.08,
        easing: 'ease',
        positionUsing: '',
        speed: 500,
        trickle: true,
        trickleRate: 0.02,
        trickleSpeed: 800,
        showSpinner: true,
        barSelector: '[role="bar"]',
        spinnerSelector: '[role="spinner"]',
        parent: 'body',
        template: '<div class="bar" role="bar">' +
                        '<div class="peg"></div>' +
                    '</div>' +
                    '<div class="spinner" role="spinner">' +
                        '<div class="spinner-icon"></div>' +
                    '</div>',
      }; 
    
      NProgress.configure(options);

JS;

        if ($this->_config['test'])
            $this->js .= <<<JS
                 NProgress.start();
                 NProgress.done();
JS;


        if ($this->_config['pjax'])
            $this->js .= <<<JS
              jQuery(document).on('pjax:start', function() { NProgress.start(); });
              jQuery(document).on('pjax:end',   function() { NProgress.done();  });
JS;


        if ($this->_config['ajax'])
            $this->js .= <<<JS
              jQuery(document).on('ajaxStart',    function() { NProgress.start(); });
              jQuery(document).on('ajaxComplete', function() { NProgress.done();  });
JS;
    }
}
