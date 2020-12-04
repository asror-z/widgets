<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;

use kartik\form\ActiveForm;
use zetsoft\former\ALL\JqueryMenuForm;
use zetsoft\models\page\PageAction;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZRadioButtonGroup;

class ZMenuEditorWidget extends ZWidget
{

    public $formModel;
    private $actions;
    public $json;

    public function init()
    {
        parent::init();
        $this->formModel = new JqueryMenuForm();
        $this->actions = ZArrayHelper::map(PageAction::find()->all(), 'title', 'title');
    }

    public function asset()
    {
        $this->fileCss('/render/menus/ZMenuEditorWidget/assets/JqueryMenu/bootstrap.min.css');
        $this->fileCss('/render/menus/ZMenuEditorWidget/assets/JqueryMenu/bootstrap-iconpicker.min.css');

        $this->fileJs('/render/menus/ZMenuEditorWidget/assets/JqueryMenu/fontawesome5-3-1.min.js');
        $this->fileJs('/render/menus/ZMenuEditorWidget/assets/JqueryMenu/bootstrap-iconpicker.min.js');
        $this->fileJs('/render/menus/ZMenuEditorWidget/assets/JqueryMenu/menueditor.js');

                         //      cdn.jsdelivr
        /*$this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');*/

        
    }

    public function codes()
    {

        $this->rest ='[{"href":" ", "icon":"empty", "text":"Testmenu", "target": "_blank", "title":"Testmenu", "page_action_id":" "}]';
        if (!empty($this->model)) {
            if ($this->model->rest !== null) {
                $this->rest = json_encode($this->model->rest);
            }
        }

        ob_start();

        $form = ActiveForm::begin(['id' => 'menuform']);

        echo $form->field($this->model, 'json')->hiddenInput(['value' => $this->rest])->label(false);

        echo ZHTML::submitButton('Сохранить', ['class' => 'btn btn-sm btn-primary']);

        ActiveForm::end();

        echo '
<div class="row">
<div class="col-6">
    <ul id="myEditor" class="sortableLists list-group">
    </ul>
    <textarea id="model_json1" style="display: none">' . $this->rest . '</textarea>
</div>

<div class="col-6">

<div class="card border-primary mb-3">
    <div class="card-header bg-primary text-white">Edit item</div>
    <div class="card-body">';
        echo '<form id="frmEdit" class="form-horizontal">';
        echo '<div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control item-menu menu-editor-input" name="text" id="text" placeholder="Text">
                    <div class="input-group-append">
                        <button type="button" id="myEditor_icon" class="btn btn-md btn-outline-secondary"></button>
                    </div>
                </div>
                <input type="hidden" name="icon" class="item-menu">
            </div>';

        echo '<div class="row">
<div class="col-6 menu-url-type">';


        echo ZRadioButtonGroup::widget([
            'id' => 'urlType',
            'name' => 'urlType',
            'data' => [
                'absolute' => 'Absolute url',
                'action' => 'action',
            ],
            'config' => ['class' => 'form-control item-menu']
        ]);


        echo ZHRadioButtonGroupWidget::widget([
            'data' => [

            ]
        ]);

        echo '</div>';
        echo '<div class="col-6 mb-2">';
        echo ZKSelect2Widget::widget([
            'id' => 'target',
            'name' => 'target',
            'data' => [
                '_self' => 'Self',
                '_blank' => 'Blank',
                '_top' => 'Top',
            ],
            'config' => ['class' => 'form-control item-menu']
        ]);
        echo '</div>';

        echo '</div>';

        echo '<div class="row">
<div class="col-6">';
        echo '<div class="form-group">
        <input type="text" name="href" class="form-control item-menu" id="href" placeholder="URL">
    </div>';
        echo '</div>';
        echo '<div class="col-6">';
        echo '<div class="form-group">
        <input type="text" name="class" class="form-control item-menu" id="class" placeholder="CSS class">
    </div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row">
<div class="col-6">';
        echo ZKSelect2Widget::widget([
            'id' => 'page_action_id',
            'name' => 'page_action_id',
            'data' => $this->actions,
            'config' => ['class' => 'form-control item-menu']
        ]);
        echo '</div>

<div class="col-6">
    <div class="form-group">
        <input type="text" name="args" class="form-control item-menu menu-editor-input" id="args" placeholder="Args">
    </div>
</div>';
        echo '</div>';
        echo '</form></div>
    <div class="card-footer">
        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
        <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
    </div>
</div>
</div>
</div>

';

        $this->htm .= ob_get_clean();


        $this->js = <<<JS
var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
};

var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});

editor.setForm($('#frmEdit'));

editor.setUpdateButton($('#btnUpdate'));

editor.setData({$this->rest});

$("#btnUpdate").click(function(){
    editor.update();
    $("#coremenu-json").val(editor.getString());
});

$('#btnAdd').click(function(){
    editor.add();
    $("#coremenu-json").val(editor.getString());
});

$('#menuform').submit(function() {
    $("#coremenu-json").val(editor.getString());
    return true;
});

$('.menu-url-type').find('input').addClass('item-menu')

JS;

        $this->css = <<<CSS
.menu-editor-input {
	padding: 22px 15px;
}
CSS;


    }

}
