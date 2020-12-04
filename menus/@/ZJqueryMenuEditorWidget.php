<?php

namespace zetsoft\widgets\menus;

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\inputes\ZKSelect2NewWidget2602;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZJqueryMenuEditorWidget
 * https://github.com/davicotico/jQuery-Menu-Editor
 *
 * https://www.jqueryscript.net/demo/Drag-Drop-Menu-Builder-For-Bootstrap/
 *
 * http://eyuf.zettest.uz/render/menus/Editors/CSSJS/jquery-menu-editor/clean_5.html
 *
 * Created By: Tursunaliyev Abdulloh
 * Refactored by: Sherzod Mangliyev
 */

class ZJqueryMenuEditorWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

      public $layout=[];
      public $_layout=[
          'main' => <<<HTML
          <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="float-left">{title}</h5>
                            
                        </div>
                        <div class="card-body">
                            <ul id="myEditor" class="sortableLists list-group">
                            </ul>
                        </div>
                    </div>
                    <p>Click the Output button to execute the function <code>getString();</code></p>
                    <div class="card">
                    <div class="card-header">JSON Output
                    <div class="float-right">
                    <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i>Output</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="form-group"><textarea type="hidden" id="out" class="form-control" cols="50" rows="10"></textarea>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="text">Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                        <div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu">
                                </div>
                                <div class="form-group">
                                    <label for="href">URL</label>
                                    <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                </div>
                                 <div class="form-group">
                                    <label for="action">action</label>
                                    <input type="text" class="form-control item-menu" id="action" name="action" placeholder="action...">
                                </div>
                                <div class="form-group">
                                    <label for="params">params</label>
                                    <input type="hidden" class="form-control item-menu" id="params" name="params" placeholder="action...">
                                    <select class="js-example-programmatic" style="width:100%;" name="params" id="vall">
                                        {options}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tooltip</label>
                                    <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
           
            
            
        </div>
   
       
    
HTML,

          'js' => <<<JS
         
            jQuery(document).ready(function () {
                var arrayjson = [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-cropLength","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];
                var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                var sortableListOptions = {
                    placeholderCss: {'background-color': "#cccccc"}
                };
                var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
                $('#btnReload').on('click', function () {
                    editor.setData(arrayjson);
                });

                $('#btnOutput').on('click', function () {
                    var str = editor.getString();
                    $("#out").text(str);
                });

                $("#btnUpdate").click(function(){
                    editor.update();
                });

                $('#btnAdd').click(function(){
                    var abl = $('#vall').val();
                    $('#params').val(abl);
                    editor.add();
                     
                });
                
                var example = $('.js-example-programmatic').select2().trigger('change');
               
                /* ====================================== */

                /** PAGE ELEMENTS **/
                $('[data-toggle="tooltip"]').tooltip();
                $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                    $('#btnStars').html(data.stargazers_count);
                    $('#btnForks').html(data.forks_count);
                });
            });
       
JS,
      ];
    /**
     *
     * Constants
     */



    public function asset()
    {
       /* $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
        $this->fileCss('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
        $this->fileJs('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/jquery-menu-editor_3.js');
        $this->fileJs('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js');
        $this->fileJs('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.js');*/

                            /* cdn.jsdelivr*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.js');
                           //  yarn
      /*  $this->fileJs('/webhtm/core/menu/assets/jQuery-Menu-Editor-master/jquery-menu-editor_3.js');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js');
    }





    public function codes()
    {

        /*$actions =

        $data =
*/




        $actions = ZArrayHelper::map(PageAction::find()->all(), 'data', 'data');
        $content = '';

       foreach ($actions as $key => $action) {
           $content = <<<HTML
            <option value="{$key}">{$action}</option>
HTML;


       }

       $this->htm .= strtr($this->_layout['main'], [
            '{title}' => '',
            '{options}' => $content,
       ]);

       $this->js .= strtr($this->_layout['js'],[]);

    }

}
