<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\navigat;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZZoomWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'position' => self::position['right']
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];
    public const position = [
        'fullscreen' => 'fullscreen',
        'lens' => 'lens',
        'inside' => 'inside',
        'bottom' => 'bottom',
        'right' => 'right',
        'left' => 'left',
        'top' => 'top',
        'id' => '#id',
    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'test' => <<<HTML
<!-- Primary carousel image -->

     <div class="show" href="1.jpg">
       <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" id="show-img">
     </div>

     <!-- Secondary carousel image thumbnail gallery -->

     <div class="small-img">
      <img src="images/next-icon.png" class="icon-left" alt="" id="prev-img">
       <div class="small-container">
        <div id="small-img-roll">
          <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="show-small-img" alt="">
          <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="show-small-img" alt="">
          <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="show-small-img" alt="">
          <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="show-small-img" alt="">
        </div>
       </div>
      <img src="https://image.freepik.com/free-photo/image-human-brain_99433-298.jpg" class="icon-right" alt="" id="next-img">
     </div>
HTML,


        'main' => <<<HTML
        <div class="xzoom-container row">
          <img class="xzoom" src="{src}" xoriginal="{src}" style="width: 387px;">
          <div class="xzoom-thumbs">
            {items}
          </div>
        </div>
HTML,
        'item' => <<<HTML
        <a 
            href="{src}"><img 
            class="xzoom-gallery xactive" 
            width="50" 
            src="{src}" 
            title="The title goes here"
            xpreview="{src}"
        ></a>
HTML,

        'css' => <<<CSS
  .show {
  width: 400px;
  height: 400px;
}

.small-img {
  width: 350px;
  height: 70px;
  margin-top: 10px;
  position: relative;
  left: 25px;
}

.small-img .icon-left, .small-img .icon-right {
  width: 12px;
  height: 24px;
  cursor: pointer;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto 0;
}

.small-img .icon-left { transform: rotate(180deg) }

.small-img .icon-right { right: 0; }

.small-img .icon-left:hover, .small-img .icon-right:hover { opacity: .5; }

.small-container {
  width: 310px;
  height: 70px;
  overflow: hidden;
  position: absolute;
  left: 0;
  right: 0;
  margin: 0 auto;
}

.small-container div {
  width: 800%;
  position: relative;
}

.small-container .show-small-img {
  width: 70px;
  height: 70px;
  margin-right: 6px;
  cursor: pointer;
  float: left;
}

.small-container .show-small-img:last-of-type { margin-right: 0; }
CSS,

        'js' => <<<JS
      //Initialize product gallery

$('.show').zoomImage();

$('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
$('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
$('.show-small-img').click(function () {
  $('#show-img').attr('src', $(this).attr('src'))
  $('#big-img').attr('src', $(this).attr('src'))
  $(this).attr('alt', 'now').siblings().removeAttr('alt')
  $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  if ($('#small-img-roll').children().length > 4) {
    if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
    } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})

//Enable the next button

$('#next-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})

//Enable the previous button

$('#prev-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})


//////////////////


/**
 * by MonsterDuang
 */
;(function($) {
    /**
     * 1, 缩略图大小和父容器大小一致
     * 2, 父容器 href 属性为高清图片路径
     */
    $.fn.zoomImage = function(paras) {
        /**
         * 默认参数
         */
        var defaultParas = {
            layerW: 100, // 遮罩宽度
            layerH: 100, // 遮罩高度
            layerOpacity: 0.2, // 遮罩透明度
            layerBgc: '#000', // 遮罩背景颜色
            showPanelW: 500, // 显示放大区域宽
            showPanelH: 500, // 显示放大区域高
            marginL: 5, // 放大区域离缩略图右侧距离
            marginT: 0 // 放大区域离缩略图上侧距离
        };

        paras = $.extend({}, defaultParas, paras);

        $(this).each(function() {
            var self = $(this).css({position: 'relative'});
            var selfOffset = self.offset();
            var imageW = self.width(); // 图片高度
            var imageH = self.height();

            self.find('img').css({
                width: '100%',
                height: '100%'
            });

            // 宽放大倍数
            var wTimes = paras.showPanelW / paras.layerW;
            // 高放大倍数
            var hTimes = paras.showPanelH / paras.layerH;

            // 放大图片
            var img = $('<img>').attr('src', self.attr("href")).css({
                position: 'absolute',
                left: '0',
                top: '0',
                width: imageW * wTimes,
                height: imageH * hTimes
            }).attr('id', 'big-img');

            // 遮罩
            var layer = $('<div>').css({
                display: 'none',
                position: 'absolute',
                left: '0',
                top: '0',
                backgroundColor: paras.layerBgc,
                width: paras.layerW,
                height: paras.layerH,
                opacity: paras.layerOpacity,
                border: '1px solid #ccc',
                cursor: 'crosshair'
            });

            // 放大区域
            var showPanel = $('<div>').css({
                display: 'none',
                position: 'absolute',
                overflow: 'hidden',
                left: imageW + paras.marginL,
                top: paras.marginT,
                width: paras.showPanelW,
                height: paras.showPanelH
            }).append(img);

            self.append(layer).append(showPanel);

            self.on('mousemove', function (event) {
                // 鼠标相对于缩略图容器的坐标
                var x = e.pageX - selfOffset.left;
                var y = e.pageY - selfOffset.top;

                if(x <= paras.layerW / 2) {
                    x = 0;
                }else if(x >= imageW - paras.layerW / 2) {
                    x = imageW - paras.layerW;
                }else {
                    x = x - paras.layerW / 2;
                }

                if(y < paras.layerH / 2) {
                    y = 0;
                } else if(y >= imageH - paras.layerH / 2) {
                    y = imageH - paras.layerH;
                } else {
                    y = y - paras.layerH / 2;
                }

                layer.css({
                    left: x,
                    top: y
                });

                img.css({
                    left: -x * wTimes,
                    top: -y * hTimes
                });
            }).on('mouseenter', function() {
                layer.show();
                showPanel.show();
            }).on('mouseleave', function() {
                layer.hide();
                showPanel.hide();
            });
        });
    }
})(jQuery);


JS,


    ];

    private function generateData(){
        $code = '';
        foreach ($this->data as $value){
            $code .= strtr($this->_layout['item'],[
                '{src}' => $value
            ]);
        }

        return $code;
    }

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.css');
        $this->fileJs('https://raw.githubusercontent.com/payalord/xZoom/master/example/js/setup.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js');
    }

    public function codes(){

        $code = '';
        foreach ($this->data as $value){
            $code .= strtr($this->_layout['item'],[
                '{src}' => $value
            ]);
        }

        $this->htm = strtr($this->_layout['test'],[
            /*'{items}' => $code,
            '{src}' => ZArrayHelper::getValue($this->data, 0)*/
        ]);

        $this->css = $this->_layout['css'];
    }
}
