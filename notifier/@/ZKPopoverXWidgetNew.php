<?php


namespace zetsoft\widgets\notifier;


use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\system\kernels\ZWidget;
use kartik\popover\PopoverX;
use yii\web\JsExpression;

/**
 * Redfactored by Khojikabar Kodirov
 * Class ZKPopoverXWidget
 * @package widgets\dialogs
 * http://demos.krajee.com/popover-x
 */
class ZKPopoverXWidgetNew extends ZWidget
{
    public $config = [];
    public $_config = [
        'type'=>'button',
        'data-toggle'=>'popover',
        'data-placement'=>'top',
        'data-content'=> 'Loremwefwefweouhfweiufwebfyewgfweygf',
        'title'=>'Popover on top',
        'class'=>'btn btn-primary',
    ];
    public $event = [];
    public $_event = [

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZKPopoverXWidget/image/icon.png',
        'name' => Azl . 'KPopoverX',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZKPopoverXWidget/image/icon.png"/>',

    ];

    //public function init()
    //{
     //   parent::init();
     //   $this->option();
     //   ob_start();
     //   PopoverX::begin($this->options);
   // }

    public function asset()
    {
       // $this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css') ;
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
       // $this->fileJs('https://code.jquery.com/jquery-3.2.1.min.js');
       // $this->fileJs('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
    }
    /**
     * Plugin Events
     * http://plugins.krajee.com/popover-x#events
     */
    public $layout = [];
    public $_layout = [
        'main'=> <<<HTML
          <button type="{type}"  {readonly} class="{class}" data-toggle="{data-toggle}" data-placement="{data-placement}" title="{title}"
                data-content="{data-content}">"{title}"</button>
        HTML,
        'js' => <<<JS
            $(function () {
                 $('[data-toggle="{data-toggle}"]').popover()
            })
         JS
    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{class}' => $this->_config['class'],
            '{data-toggle}'=>$this->_config['data-toggle'],
            '{data-placement}'=>$this->_config['data-placement'],
            '{title}' => $this->_config['title'],
            '{data-content}'=>$this->_config['data-content'],
            
            '{readonly}'=> $this->_config['readonly']? 'readonly' : '',
        ]);

        $this->js=  strtr($this->_layout['js'],[
            '{data-toggle}'=>$this->_config['data-toggle'],
        ]) ;
    //    PopoverX::end();
    }
}
