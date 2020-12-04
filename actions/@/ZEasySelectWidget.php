<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
//use zetsoft\widgets\inputes\ZSampleWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/mee4dy/easySelectable
 * https://www.jqueryscript.net/demo/DOM-Selection-jQuery-easySelectable/
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 */
class ZEasySelectWidget extends ZWidget
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
   */
  public $event = [];
  public $_event = [
      'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML
  <section>
		<ul id="easySelectable">
			<li value="{value}" name="{name}">1</li>
			<!--<li>2</li>
			<li>3</li>
			<li>4</li>
			<li>5</li>
			<li>6</li>
			<li>7</li>
			<li>8</li>
			<li>9</li>
			<li>10</li>-->
		</ul>
	</section>
HTML,

  ];


  /**
   *
   * Constants
   */

  /**
   *
   * Function  option
   * https://demos.krajee.com/widget-details/select2#settings
   */

  public function asset()
  {

    $this->fileJs('https://code.jquery.com/jquery-3.3.1.slim.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');

    $this->fileJs('https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js');

    $this->fileJs('/render/actions/ZEasySelectWidget/assets/src/js/easySelectable.js');

    $this->fileJs('/render/actions/ZEasySelectWidget/assets/index.js');

    $this->fileCss('/render/actions/ZEasySelectWidget/assets/material.css');

    $this->fileCss('/render/actions/ZEasySelectWidget/assets/src/css/easySelectable.css');

    $this->fileCss('/render/actions/ZEasySelectWidget/assets/sunburst.css');

  }


  public function codes()
  {
    $this->options = [

    ];

    $this->htm = strtr($this->_layout['main'],[

    '{value}' => $this->value,
    '{name}' => $this->name

    ]);
  }
}

