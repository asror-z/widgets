<?php

namespace zetsoft\widgets\inputes;

use zetsoft\former\shop\shopSizeForm;
use zetsoft\models\auto\ChatMail;
use zetsoft\models\menu\Menu;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;


class ZNewMultipleWidget extends ZWidget
{


    /**
     * Configuration
     */
    //public $formClass = shopSizeForm::class;

    public $config = [];
    public $_config = [
        'placeholderLeft' => '',
        'placeholderRight' => '',
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
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',

    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
    ];

    public function asset()
    {
        //$this->fileJs('http://code.jquery.com/jquery-latest.min.js');
        $this->fileJs('/render/inputes/ZNewMultipleWidget/demo/jscripts/duplicateFields.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

    <div id="additional-field-model">
    
        <div>
                {content}
                
                <div class="col-md-4 col-xs-7 text-right">
                    <label class="col-xs-12 control-label" for="field-c"><br></label>
                    <a href="javascript:void(0);" class="btn btn-warning remove-this-field" style="display: none;">
                        <i class="fa fa-remove"></i>
                        <span class="hidden-xs"> Delete </span>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-success create-new-field"
                       style="display: inline-block;">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> Duplicate </span>
                    </a>
                </div>
        </div>
    </div>

HTML,

        'content' => <<<HTML

HTML,

        'js' => <<<JS

        $(function () {
            $('#additional-field-model').duplicateElement({
                "class_remove": ".remove-this-field",
                "class_create": ".create-new-field"
            });
        });
       
JS,

    ];


    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => ZFormWidget::widget([
                'model' => new Menu(),
                'attribute' => 'name'
            ])
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,

        ]);

    }

}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
