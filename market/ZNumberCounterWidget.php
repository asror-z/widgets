<?php
/**
 *
 * Made by Kodirov Khojiakbar
 *
 *
 **/

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZNumberCounterWidget extends ZWidget
{
    public $config = [];
    public $_config = [


    ];


    public $event = [];
    public $_event = [];


    public function asset()
    {
        $this->fileJs('/render\market\ZNumberCounterWidget\demo\assets\js\main.js');
        /*$this->fileCss('/render\market\ZNumberCounterWidget\demo\assets\css\style.css');*/


    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

                    <div class="form-group">
                        <label class="control-label">Before:</label>
                        <input class="form-control" type="number" value="1" min="1" max="10" 
                            name="{name}"
                        />
                    </div>
                    <div class="form-group">
                        <label class="control-label">After:</label>
                        <input id="after{id}" class="form-control" type="number" value="1" min="1" max="10" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Colorful:</label>
                        <input id="colorful{id}" class="form-control" type="number" value="1" min="1" max="10" />
                    </div>
               
HTML,
        
        'js' => <<<JS
      $('#after{id}').bootstrapNumber();
        $('#colorful{id}').bootstrapNumber({
            upClass: 'success',
            downClass: 'danger'
        });
    
JS,

    ];

    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);



    }
}
