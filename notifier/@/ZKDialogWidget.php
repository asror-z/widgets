<?php


namespace zetsoft\widgets\notifier;


use kartik\widgets\Alert;

use kartik\widgets\Dialog;
use kartik\widgets\Select2;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZKAlertWidget
 * @package widgets\dialogs
 * http://demos.krajee.com/widget-details/alert
 */
class ZKDialogWidget extends ZWidget
{

    /**
     * @var $type
     * Alert::TYPE_INFO
     * Alert::TYPE_DANGER
     * Alert::TYPE_SUCCESS
     * Alert::TYPE_WARNING
     * Alert::TYPE_PRIMARY
     * Alert::TYPE_DEFAULT
     */

    public $config = [];
    public $_config = [
        'type' => ZKDialogWidget::type['btns'],
        'body' => ZKDialogWidget::body['body']

    ];


    public const type = [
    'btns' => 'btns'


];


    public const body = [
        'body' => 'body'
    ];

       public function asset()
       {
          $this->fileCss('"https://use.fontawesome.com/releases/v5.3.1/css/all.css"');
          $this->fileJs('"https://use.fontawesome.com/releases/v5.3.1/js/ALL.js"');
       }





    public function codes()
    { //$this->htm = Alert::widget($this->options);

        $this->options = [
            'body' => $this->_config['body'],
            'type' => $this->_config['type'],
           // 'iconType' => $this->_config['iconType'],
            'icon' => $this->_config['icon'],
            'iconOptions' => [],
         //   'title' => $this->_config['title'],
            'titleOptions' => [
                'tag' => 'span',
                'class' => 'kv-alert-title'
            ],
        //    'showSeparator' => $this->_config['isShowSeparator'],
      //      'delay' => $this->_config['delay'],

      //      'options' => $this->options
        ];

    $this-> layout = [
        'btns' => <<< HTML
        <button type="button" id="btn-alert" class="btn btn-info">Alert</button>
        <button type="button" id="btn-confirm" class="btn btn-warning">Confirm</button>
        <button type="button" id="btn-prompt" class="btn btn-primary">Prompt</button>
        <button type="button" id="btn-dialog" class="btn btn-secondary">Dialog</button>
        HTML

    ];

       $this->htm=$this->layout[$this->_config['type']];
       
       $this->js = <<<HTML
          <script>
               const defaults = {
               
               
               }
        </script>

       HTML;

        $this->js = strtr($this->js, [
         //   '{enabled}' => $this->jscode($this->_config['enabled']),
        //    '{autoplay}' => $this->jscode($this->_config['autoplay']),
         //   '{controls}' => $this->jscode($this->_config['controls']),
        ]);

        $this->htm = Dialog::widget($this->options);
    }



}
