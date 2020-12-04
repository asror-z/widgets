<?php

namespace zetsoft\widgets\inptest;

//use PhpOffice\PhpWord\Reader\HTML;
use phpoffice\phpword\src\PhpWord\Reader\HTML;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Dilmurod Axmadov
 * Refactored: Asror Zakirov
 */
class ZMultiselectWidget extends ZWidget
{
  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'isMultiple' => ZMultiselectWidget::type['multiple'],
      'csvDispCount' => 3,
      'placeholder' => '',
      'captionFormat' => '{0} Selected',
      'captionFormatAllSelected' => '{0} all selected!',
      'floatWidth' => 400,
      'forceCustomRendering' => false,
      'nativeOnDevice' => [
          'Android',
          'BlackBerry',
          'iPhone',
          'iPad',
          'iPod',
          'Opera Mini',
          'IEMobile',
          'Silk'
      ], //array
      'outputAsCSV' => true,
      'csvSepChar' => ',',
      'okCancelInMulti' => true,
      'isClickAwayOk' => true,
      'triggerChangeCombined' => true,
      'selectAll' => true,
      'search' => true,
      'searchText' => 'Search...',
      'noMatch' => 'No matches for "{0}"',
      'prefix' => '',
      'locale' => [
          'OK',
          'Cancel',
          'Select All'],
      'up' => true,
      'showTitle' => true,
      'hasIcon' => true,

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

  public const type = [
      'multiple' => 'multiple',
      'nomultiple' => 'nomultiple'
  ];


  public function asset()
  {
//        $this->fileCss('/publish/yarner/sumoselect/sumoselect.css');
//        $this->fileJs('/publish/yarner/sumoselect/jquery.sumoselect.js');

    $this->fileCss('https://cdn.jsdelivr.net/npm/sumoselect@3.0.5/sumoselect.css');
    $this->fileJs('https://cdn.jsdelivr.net/npm/sumoselect@3.0.5/jquery.sumoselect.js');
  }


  public function codes()
  {

    $this->layout = [
        'multiple' => <<<HTML
             <span>{getIcon}</span>    &ensp;
             <div class="SumoSelect"  tabindex="0" role="button" aria-expanded="false">
                             <select multiple="{isMultiple}" id="{id}" placeholder="{placeholder}" class="SumoUnder" value="{value}"  name="{modelClass}[{attribute}][]">
                 {itemsSelect}
                </select>
                <p>{value}</p>
            </div>
            
HTML,
        'nomultiple' => <<<HTML
             <span>{getIcon}</span> &ensp;&ensp;
            <div class="SumoSelect"  tabindex="0" role="button" aria-expanded="false">
                <select placeholder="{placeholder}" class="SumoUnder" 
                name="{modelClass}[{attribute}]" id="{id}" >
                    {itemsSelect}
                </select>
            </div>

HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon} fa-2x mt-6"></i>
HTML,
        'jsCode' => <<<JS
            $(document).ready(function () {
                $('#{$this->id}').SumoSelect({
                    placeholder: '{placeholder}',
                    csvDispCount: {csvDispCount},
                    captionFormat: '{captionFormat}',
                    captionFormatAllSelected: '{captionFormatAllSelected}',
                    floatWidth: {floatWidth},
                    forceCustomRendering: {forceCustomRendering},
                    nativeOnDevice: {nativeOnDevice},
                    outputAsCSV: {outputAsCSV},
                    csvSepChar: '{csvSepChar}',
                    okCancelInMulti: {okCancelInMulti},
                    isClickAwayOk: {isClickAwayOk},
                    triggerChangeCombined: {triggerChangeCombined},
                    selectAll: {selectAll},
                    search: {search},
                    searchText: '{searchText}',
                    noMatch: '{noMatch}',
                    prefix: '{prefix}',
                    locale: {locale},
                    up: {up},
                    showTitle: {showTitle}
                });
                
           $('.opt').click(function() {
               $('#hiddenMulti').val($('.SumoUnder').val());
           });      
    });
JS,
        'blog' => <<<HTML
            <option value="{key}">{item}</option>
HTML,

    ];

    if ($this->_config['hasIcon'] == true) {
      $getIcon = $this->htm .= strtr($this->layout['icon'], [

          '{icon}' => $this->_config['icon'],

      ]);
    } else {
      $getIcon = '';
    }

    $itemsSelect = '';
    $values = $this->value;

    foreach ($this->data as $key => $item) {
      $isSelected = '';
      if ($values > 0) {
        foreach ($values as $item1) {
          if ($key == $item1) {
            $isSelected = 'selected';
          }
        }
      }

      $itemsSelect .= $this->htm = strtr($this->_layout['blog'], [
          '{key}' => $key,
          '{item}' => $item,
      ]);//
    }//


    $this->htm = strtr($this->layout[$this->_config['isMultiple']], [
        '{id}' => $this->id,
        '{modelClass}' => $this->modelClass,
        '{attribute}' => $this->attribute,
        '{value}' => $this->jscode($this->value),
        '{placeholder}' => $this->_config['placeholder'],
        '{itemsSelect}' => $itemsSelect,
        '{isMultiple}' => $this->_config['isMultiple'],
        '{getIcon}' => $getIcon


    ]);

    $this->js = strtr($this->layout['jsCode'], [
        '{placeholder}' => $this->jscode($this->_config['placeholder']),
        '{csvDispCount}' => $this->jscode($this->_config['csvDispCount']),
        '{captionFormat}' => $this->jscode($this->_config['captionFormat']),
        '{captionFormatAllSelected}' => $this->jscode($this->_config['captionFormatAllSelected']),
        '{floatWidth}' => $this->jscode($this->_config['floatWidth']),
        '{forceCustomRendering}' => $this->jscode($this->_config['forceCustomRendering']),
        '{csvSepChar}' => $this->jscode($this->_config['csvSepChar']),
        '{nativeOnDevice}' => $this->jscode($this->_config['nativeOnDevice']),
        '{outputAsCSV}' => $this->jscode($this->_config['outputAsCSV']),
        '{okCancelInMulti}' => $this->jscode($this->_config['okCancelInMulti']),
        '{isClickAwayOk}' => $this->jscode($this->_config['isClickAwayOk']),
        '{triggerChangeCombined}' => $this->jscode($this->_config['triggerChangeCombined']),
        '{selectAll}' => $this->jscode($this->_config['selectAll']),
        '{search}' => $this->jscode($this->_config['search']),
        '{searchText}' => $this->jscode($this->_config['searchText']),
        '{noMatch}' => $this->jscode($this->_config['noMatch']),
        '{prefix}' => $this->jscode($this->_config['prefix']),
        '{locale}' => $this->jscode($this->_config['locale']),
        '{up}' => $this->jscode($this->_config['up']),
        '{showTitle}' => $this->jscode($this->_config['showTitle']),
        '{id}' => $this->jscode($this->id),
    ]);
  }
}
