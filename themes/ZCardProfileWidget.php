<?php

namespace zetsoft\widgets\themes;

use phpDocumentor\Reflection\Types\Self_;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZIcon;
use zetsoft\widgets\navigat\ZBreadCrumbWidget as ZBreadCrumbWidgetAlias;
use zetsoft\widgets\navigat\ZButtonWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Daho
 *
 */
class ZCardProfileWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'title' => 'ZetSoft Eneterprise LLC',
        'content' => null,
        'coverImage' => null,
        'color' => ZColor::color['primary-color'],
        'url' => '',
        'ProfileRightButton' => '',
        'grapes' => true,
    ];

    public $layout = [];
    public $_layout = [
        'profileCard' => <<<HTML

<!-- Card -->

<div class="card testimonial-card mb-3 pb-3"  {readonly}>
  <div class="card-up {color} coverCardImg d-flex flex-row-reverse">    
    <div class="col-2">
        <div class="d-flex flex-row-reverse mt-3">
        {ProfileRightButton}
        </div>
    </div>
    
</div>
  <!-- Avatar -->
  <div class="avatar mx-auto white ">
    <img src="{url}" class="userPhoto"
      alt="avatar">
  </div>

  <!-- Content -->
 
  <div class="card-body">
    <!-- Name -->
    <h4 class="card-title">{title}</h4>
    <hr>
    <!-- Quotation -->
    {content}
  </div>

</div>
<!-- Card -->
HTML,
    ];


    public function init()
    {
        parent::init();
        ob_start();
    }


    public function codes()
    {

        $content = ob_get_clean() . $this->_config['content'];

        $this->htm .= strtr($this->_layout['profileCard'], [
            '{content}' => $content,
            '{title}' => $this->_config['title'],
            '{color}' => $this->_config['color'],
            '{url}' => $this->_config['url'],
            '{ProfileRightButton}' => $this->_config['ProfileRightButton'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

        ]);

        $this->css = <<<CSS
        .coverCardImg{
            background-image: url("{$this->_config['coverImage']}");
        }
        
        .card-footer{
            padding-bottom: 0!important;
        }
        
        .kv-panel-after{
            padding-bottom: 0!important;
        }
     
        .userPhoto {
            max-width: 117px!important;
            width: 100px!important;
            height: 100px!important;
            }
            
        .avatar.mx-auto.white {
            max-width: 117px!important;
            width: 108px!important;
            height: 108px!important;            
        }
            
        .modal-content{
            padding: 20px;
        }         
CSS;


    }

}
