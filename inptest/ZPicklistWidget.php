<?php

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/Gabrielr47/pickList
 * https://www.jqueryscript.net/demo/Simple-Side-by-side-Combo-Box-Plugin-With-jQuery-pickList/
 *
 * Created By: Aziz Rozmetov
 * Refactored:
 *
 * clean
 * testing/Inptest/ZPicklistWidget/clean1.html
 */
class ZPicklistWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'btnColor' => ZPicklistWidget::btnColor['btn-info'],
        'btnType' => ZPicklistWidget::btnType['btn-sm']/*,
        'btntextColor' => ZPicklistWidget::btntextColor['text-white']*/
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
       <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> </h3>
                </div>
                <div class="panel-body">
                    <div id="pickList"></div>
                       
                    </div>
                </div>   
        </div>

HTML,
    ];

    public const btnColor = [
        'btn-primary' => 'btn-primary',
        'btn-secondary' => 'btn-secondary',
        'btn-success' => 'btn-success',
        'btn-danger' => 'btn-danger',
        'btn-warning' => 'btn-warning',
        'btn-info' => 'btn-info',
        'btn-light' => 'btn-light',
        'btn-dark' => 'btn-dark',
        'btn-white' => 'btn-white'
    ];

    public const btnType = [
        'btn-sm' => 'btn-sm',
        'btn-lg' => 'btn-lg',
        'btn-md' => 'btn-md',
    ] ;

    
    public function codes()
    {
        if (empty(!$this->model)) {
            $this->htm = ZHTML::checkboxButtonGroup(
                $this->name,
                null,
                $this->data,
                $this->options
            );
        } else {
            $this->htm = ZHTML::activeCheckboxButtonGroup(
                $this->model,
                $this->attribute,
                $this->data,
                $this->options
            );
        }


        $this->htm .= strtr($this->_layout['main'], [

            '{id}' => $this->id,
            '{name}' => $this->name,
             //'{value}'  => $this->value,
         /*   '{btnColor}' => $this->jscode($this->_config['btnTypes']),
             '{btnType}' => $this->jscode($this->_config['btnType']),*/

        ]);

        $this->js = <<<JS

   console.log($('.pickListSelect option').val());

            (function ($) {

        $.fn.pickList = function (options) {

            var opts = $.extend({}, $.fn.pickList.defaults, options);

            this.fill = function () {
                var option = '';

                $.each(opts.data, function (key, val) {
                    option += '<option data-id=' + val.id + '>' + val.text + '</option>';
                });
                this.find('.pickData').append(option);
            };
            this.controll = function () {
                var pickThis = this;

                pickThis.find(".pAdd").on('click', function () {
                    var p = pickThis.find(".pickData option:selected");
                    p.clone().appendTo(pickThis.find(".pickListResult"));
                    p.remove();
                });

                pickThis.find(".pAddAll").on('click', function () {
                    var p = pickThis.find(".pickData option");
                    p.clone().appendTo(pickThis.find(".pickListResult"));
                    p.remove();
                });

                pickThis.find(".pRemove").on('click', function () {
                    var p = pickThis.find(".pickListResult option:selected");
                    p.clone().appendTo(pickThis.find(".pickData"));
                    p.remove();
                });

                pickThis.find(".pRemoveAll").on('click', function () {
                    var p = pickThis.find(".pickListResult option");
                    p.clone().appendTo(pickThis.find(".pickData"));
                    p.remove();
                });
            };

            this.getValues = function () {
                var objResult = [];
                this.find(".pickListResult option").each(function () {
                    objResult.push({
                        id: $(this).data('id'),
                        text: this.text
                    });
                });             
                return objResult;
                
            };

            this.init = function () {
                var pickListHtml =
                    "<div class='row'>" +
                    "  <div class='col-sm-5'>" +
                    "	 <select class='form-control pickListSelect pickData' multiple></select>" +
                    " </div>" +
                    " <div class='col-sm-2 pickListButtons'>" +
                    "	<button  class='pAdd btn {btnColor} {btnType}'>" + opts.add + "</button>" +
                    "      <button  class='pAddAll btn {btnColor} {btnType}'>" + opts.addAll + "</button>" +
                    "	<button  class='pRemove btn {btnColor} {btnType}'>" + opts.remove + "</button>" +
                    "	<button  class='pRemoveAll btn {btnColor} {btnType}'>" + opts.removeAll + "</button>" +
                    " </div>" +
                    " <div class='col-sm-5'>" +
                    "    <select class='form-control pickListSelect pickListResult' multiple></select>" +
                    " </div>" +
                    "</div>";

                this.append(pickListHtml);

                this.fill();
                this.controll();
            };

            this.init();
            return this;
        };

        $.fn.pickList.defaults = {
            add: 'Add',
            addAll: 'Add All',
            remove: 'Remove',
            removeAll: 'Remove All'
        };


    }(jQuery));

    var val = {
        1: {id: 1, text: 'Isis'},
        2: {id: 2, text: 'Sophia'},
        3: {id: 3, text: 'Alice'},
        4: {id: 4, text: 'Isabella'},
        5: {id: 5, text: 'Manuela'},
        6: {id: 6, text: 'Laura'},
        7: {id: 7, text: 'Luiza'},
    };

    var pick = $("#pickList").pickList({data: val});

    $("#getSelected").click(function () {
        console.log(pick.getValues());
    });



JS;


        $this->css = <<<CSS

     .pickListButtons {
            padding: 10px;
            text-align: center;
        }

        .pickListButtons button {
            margin-bottom: 5px;
        }

        .pickListSelect {
            height: 200px !important;
        }
CSS;


        $this->htm = strtr($this->htm, [
            '{btnColor}' => $this->jscode($this->_config['btnColor']),
            '{btnType}' => $this->jscode($this->_config['btnType']),
        ]);

    }

}
