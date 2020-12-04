<?php

namespace zetsoft\widgets\themes;

use phpDocumentor\Reflection\Types\Self_;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\models\page\PageThemeType;
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
 * @author: MurodovMirbosit
 *
 */
class ZGrapesCardWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'select' => Azl . 'Выбрать',
        'view' => Azl . 'Смотреть',
        'paragraph' => '',
        'type' => self::type['main']
    ];

    public const type = [
        'main' => 'main',
        'uniCard' => 'uniCard',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div class="titleCard">{title}</div>
  <div class="row">
     <div class="col-md-12 p-5 d-flex">
           <div class="col-md-4 border grapesCard" id="{id}" style="background: url('{src}'); background-size: 100%;">
              <div class="eventBtns-{divId} d-none cardGrapes">
                   <a class="btn eventBtn select-btn text-dark d-felx">{select}</a>
                   <a class="btn eventBtn text-dark d-felx">{view}</a>
              </div>
           </div>
     </div>
  </div>
HTML,

        'uniCard' => <<<HTML
    <div class="col-md-3">
     <div class="titleCard"> 
     {title}             
  </div>
    <figure class="c4-izmir c4-border-corners-1 c4-image-zoom-out c4-gradient-bottom figureCard">
    <img src="{src}" alt="Sample Image">
    <figcaption class="c4-layout-top-left">
      <div class="c4-reveal-down">
        <p>
        {paragraph}
        </p>
      </div> 
      <div class="uniCardSrc">
        <button class="btn btn-success w-50 my-1">{select}</button>
        <button class="btn btn-dark w-50 my-1">{view}</button>
      </div> 
  </figure>
</div>
HTML,

    'css' => <<<CSS
.uniCardSrc{
  text-align: center;
  margin: auto;
}
.figureCard{
      width: 400px;
      height: 200px;
}
CSS,


        'js' => <<<JS
    $('.grapesCard').on('mouseenter', function () {
        $('.cardGrapes').removeClass('d-none');
    });
    $('.grapesCard').on('mouseleave', function () {
        $('.cardGrapes').addClass('d-none');
    });

    $('.select-btn').on('click', function () {
        alert(1);
    })
JS,


    ];

    public function asset()
    {
        $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMain.css');
       $this->fileCss('https://cdn.jsdelivr.net/npm/@ciar4n/izmir@1.0.1/izmir.min.css');
    }

    public function codes()
    {

        /** @var PageThemeType $model */

        $models = PageThemeType::find()
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->all();

        $content = '';
        foreach ($models as $model) {
            $content .= strtr($this->_layout[$this->_config['type']], [
                '{src}' => $model->image,
                '{title}' => $model->title,
                '{id}' => $model->id,
                '{divId}' => $this->id ,
                '{select}' => $this->_config['select'],
                '{view}' => $this->_config['view'],
                '{paragraph}' => $this->_config['paragraph'],
            ]);
        }

        $this->htm .= $content;

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $model->id,

        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);
    }
}
