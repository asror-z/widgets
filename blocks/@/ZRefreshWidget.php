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


use zetsoft\system\kernels\ZWidget;

class ZRefreshWidget extends ZWidget
{

    /**
     *
     * types
     */

    public $config = [];
    public $_config = [
        'type' => ZRefreshWidget::type['pjax'],
        'interval' => 2000,
        'stopBlock' => 'div.content-wrapper',
        'pjaxButton' => '#zGrid'
    ];


    public const type = [
        'pjax' => 'pjax',
        'reload' => 'reload',
    ];

    public $layout = [];
    public $_layout = [

        'js' => <<<JS
            
		if ($.AsrorZ === undefined)
            $.AsrorZ = {};

        $.AsrorZ.zDate = function () {
            return new Date($.now());
        };

        $.AsrorZ.refresh = true;
        
        jQuery(function ($) {
            
            $("{pjaxButton}").click();
            console.log('ZRefreshWidget | Process Started...');
              
        });

        jQuery(document).on('pjax:end', function () {

            console.log('Pjax End Started | ' + $.AsrorZ.zDate());

            if ($.AsrorZ.refresh)
                $.AsrorZ.zRefreshMethod();
        });


        $.AsrorZ.zRefreshMethod = function () {

        	console.log('ZCore Timer Started | {interval} ms. | ' + $.AsrorZ.zDate());
		
            $.AsrorZ.zRefresh = setTimeout(function () {
                if ($.AsrorZ.refresh) {
                    console.log('Execute Timer Action | ' + $.AsrorZ.zDate());
                    
                   $("{pjaxButton}").click();  
                }
            }, {interval});
        };


        $("{stopBlock}").hover(
            function () {

                console.log('Enter To StopBlock | ' + $.AsrorZ.zDate());
                $('body').addClass('copy');
                
                $.AsrorZ.refresh = false;
                clearTimeout($.AsrorZ.zRefresh);


            }, function () {
                console.log('Exit From StopBlock | ' + $.AsrorZ.zDate());
                $('body').removeClass('copy');
                
                $.AsrorZ.refresh = true;
                $.AsrorZ.zRefreshMethod();

            }
        );
JS,
    ];

    public function codes()
    {
        
        $this->js = strtr($this->js, [
            '{interval}' => $this->_config['interval'],
            '{pjaxButton}' => $this->_config['pjaxButton'],
            '{stopBlock}' => $this->_config['stopBlock']
        ]);

    }




}
