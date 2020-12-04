<?php

namespace zetsoft\widgets\notifier;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 */

/**@View */
class ZVendroidPopoverWidget extends ZWidget
{

	/**
	 * Configuration
	 */
	public $config = [];
	public $_config = [
		'content' => '',
		'badge' => '10',
		'title' => 'Vend Popover',
		'viewButtonTitle' => 'read all'
	];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <!--<div class="my-div2">
    <div class="d-inline-blok my-div">-->

       
     <li class="one-icon mega-li">
    <button id="myDropdown" class="btn mega-link dropdown-toggle" data-toggle="dropdown">
                    <span class="mega-icon vend-icon-color"><i class="{icon}"></i></span>
                    <span class="badge vd_bg-red">{badge}</span>
                </button>
    
    
    <!--<a href="#" class="btn-floating btn-info btn-sm" data-action="click-trigger">
        <i class="{icon} vend-icon-color"></i>

    </a>-->
        <!--<span class="badge counter">{badge}</span>-->

    <div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm dropdown-menu" aria-labelledby="myDropdown">
        <div class="child-menu">
            <div class="title my-title">
                <span class="title-popover">{title}</span>
                <div class="vd_panel-menu mt-1">
                    <span class="menu">
                       {viewButton}
                                 </span> 
                    <span class="menu">
                       {refreshButton}
                    </span>
                    
                </div>
            </div>
            
            {content}
            
        </div> <!-- child-menu -->
    </div>   <!-- vd_mega-menu-content -->
   
   
    </li>
    <!--</div>
     </div>-->
HTML,
        'js' => <<<JS
                
            	 
            	 $('#scroll').slimscroll({
            	     width: '320px',
                 railVisible: true,
                 allowPageScroll: true,
                 touchScrollStep: 1000,
            	    height:'400px',
            	});
         /*   $('{icon}').click(function() {
              Cookies.set('clicked', false, {path: '/'});
            }) */
JS,

        'css' => <<<CSS
        
        .vend-icon-color{
            color: #0d47a1 !important;
        }
        /*.my-div{
            position: relative;
            max-width: 100%;
            max-height: 100%;

        }
        .my-div2{
            display: inline-block;
            max-width: 90px;
            max-height: 70px;
        }*/
        .my-title{
            bacground: #1fae66 !important;
        }
        
        .noHover:hover{
            background: transparent!important;
        }
        .title-popover{
            font-size: 16px;
           /* margin-left: 40px;*/
        }
        
CSS,
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


	public function asset()
	{

		$this->fileCss('/render/ALL/vendroid/assets/theme/vendroid/css/theme.min.css');
		$this->fileCss('/render/ALL/vendroid/assets/theme/vendroid/css/theme-responsive.min.css');
	//	$this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
	                // cdn.jsdelivr
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
	}


	public function codes()
	{

                                                                    
		$this->_layout;

		$refreshButton = ZButtonWidget::widget([
			'config' => [
				'hasIcon' => true,
				'btnType' => ZButtonWidget::btnType['link'],
				'btnStyle' => ZButtonWidget::btnStyle['none'],
				'btnRounded' => false,
				'text' => '',
				'method' => ZButtonWidget::method['post'],
				'pjax' => true,
				'title' => 'Обновление',
				'ttSize' => ZButtonWidget::ttSize['small'],
				'ttSide' => ZButtonWidget::ttSide['bottom'],
				'btn' => false,
				'class' => 'h-100 p-0 noHover',
				'iconColor' => '#0d47a1',
				'icon' => 'fa fa-' . FA::_SYNC,
			],
			'id' => 'messagePjax'
		]);

		$viewButton = ZButtonWidget::widget([
			'config' => [
				'hasIcon' => true,
				'btnType' => ZButtonWidget::btnType['link'],
				'btnStyle' => ZButtonWidget::btnStyle['none'],
				'btnRounded' => false,
				'text' => '',
				'method' => ZButtonWidget::method['post'],
				'pjax' => true,
                'class' => 'h-100 p-0 noHover',
                'title' => $this->_config['viewButtonTitle'],
				'ttSize' => ZButtonWidget::ttSize['small'],
				'ttSide' => ZButtonWidget::ttSide['bottom'],
				'btn' => false,
				'iconColor' => '#0d47a1',
				'icon' => 'fa fa-' . FA::_EYE,

			],

		]);

		$this->htm = strtr($this->_layout['main'], [
			'{content}' => $this->_config['content'],
			'{badge}' => $this->_config['badge'],
			'{refreshButton}' => $refreshButton,
			'{viewButton}' => $viewButton,
			'{icon}' => $this->_config['icon'],
			'{title}' => $this->_config['title']
		]);

		/*$this->js = strtr($this->layout['js'], [
			'{icon}' => $this->_config['icon'],
		]);*/

		$this->css = strtr($this->_layout['css'], [

		]);


	}

}
