<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


/**
 *
 * Refactored: Zoxidjon001
 */
class ZChechBoxesWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'title'=>ZChechBoxesWidget::titles['title1'],
        'btnType'=>ZChechBoxesWidget::btnTypes['btn-primary'],
        'labelType'=>ZChechBoxesWidget::labelTypes['btn-success'],
    ];
    public const titles =[
        'title1'=>' Default Checkbox',
        'title2'=>' Primary Checkbox',
        'title3'=>' Success Checkbox',
        'title4'=>' Info Checkbox',
        'title5'=>' Warning Checkbox',
        'title6'=>' Danger Checkbox',
    ];
    public const btnTypes = [
       'btn-default'=>'btn-default',
        'btn-primary'=>'btn-primary',
        'btn-success'=>'btn-success',
        'btn-info'=>'btn-info',
        'btn-warning'=>'btn-warning',
        'btn-danger'=>'btn-danger',
    ];
    public const labelTypes = [
        'btn-default'=>'btn-default',
        'btn-primary'=>'btn-primary',
        'btn-success'=>'btn-success',
        'btn-info'=>'btn-info',
        'btn-warning'=>'btn-warning',
        'btn-danger'=>'btn-danger',
    ];


    public $layout = [];
    public $_layout = [
      'main'=><<<HTML
     
<div class="container">
    <div class="col-xs-12 col-sm-6">
        <h3>Standard Checkboxes</h3><hr />
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-default" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-default" class="btn {labelType}">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-default" class="btn {btnType} active ">
                   {title}
                </label>
            </div>
        </div>
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-primary" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-primary" class="btn {labelType}">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-primary" class="btn {btnType} active ]">
                    {title}
                </label>
            </div>
        </div>
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-success" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-success" class="btn {labelType}">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-success" class="btn {btnType} active">
                    {title}
                </label>
            </div>
        </div>
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-info" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-info" class="btn {labelType}">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-info" class="btn {btnType} active">
                     {title}
                </label>
            </div>
        </div>
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-warning" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-warning" class="btn {labelType}">
                    <span class="glyphicon glyphicon-ok "></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-warning" class="btn {btnType} active ]">
                    {title}
                </label>
            </div>
        </div>
        <div class="[ form-group ]">
            <input type="checkbox" name="{name}" value="{value}" id="fancy-checkbox-danger" autocomplete="off" />
            <div class="[ btn-group ]">
                <label for="fancy-checkbox-danger" class="btn {labelType}">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label for="fancy-checkbox-danger" class="btn {btnType} active ]">
                   {title}
                </label>
            </div>
        </div>
    </div>
</div>
HTML,

    ];



    public function asset()
    {
        $this->fileCss('//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css');
        $this->fileJs('//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js');
    }

    public function codes()
    {


        if (empty($this->model)) {
            $this->htm = ZHTML::activeCheckbox(
                $this->name,
                false,
                $this->options
            );
        } else {
            $this->htm = ZHTML::activeCheckbox(
                $this->model,
                $this->attribute,
                $this->options
            );
        }

        $this->htm = strtr($this->_layout['main'], [
            '{title}'=>$this->_config['title'],
            '{btnType}'=>$this->_config['btnType'],
            '{labelType}'=>$this->_config['labelType'],
        ]);

        $this->css =<<<CSS
    .form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: none;
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: inline-block;   
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
    display: inline-block;
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
    display: none;   
}
CSS;



    }


}
