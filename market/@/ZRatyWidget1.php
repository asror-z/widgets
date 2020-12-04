<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;
/**
 * Created by: Muhriddin Pardabayev
 * https://github.com/wbotelhos/raty
 */
class ZRatyWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
       /* 'starType' => 'img',  // 'img'
        'cancel' => 'true',
        'cancelClass' => 'raty-cancel',
        'cancelHint' => 'Cancel this rating',
        'cancelOff' => '/render/market/ZRatyWidget/demo/images/cancel-off.png',
        'cancelOn' => '/render/market/ZRatyWidget/demo/images/cancel-on.png',
        'cancelPlace' => 'right',  //left
        'half' => 'false',
        'halfShow' => 'true',
        'hints' => '[\'bad\', \'poor\', \'regular\', \'good\', \'gorgeous\']',// any words
        'noRatedMsg' => 'Not rated yet!',
        'number' => 5,   // 1-numberMax
        'numberMax' => 20,  // any number
        'precision' => 'false',
        'readOnly' => 'false',
        'scoreName' => 'score',
        'single' => 'false',
        'space' => 'true',
        'starHalf' => '/render/market/ZRatyWidget/demo/images/star-half.png',
        'starOff' => '/render/market/ZRatyWidget/demo/images/star-off.png',
        'starOn' => '/render/market/ZRatyWidget/demo/images/star-on.png',
        'targetForma' => '{score}',
        'targetKeep' => 'false',
        'targetText' => '',
        'targetType' => 'hint'*/

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div id="{id}">
                <div class="stars">
                    <input class="star active" type="hidden" id="{id}" name="{name}" value="{va lue}" placeholder="{placeholder}">
                </div>
           </div>
HTML,

       /* 'jscode' => <<<JS
         
            $('#{id}').raty({
            
            starType: '{starType}',  
            cancel:      {cancel},
            cancelClass: '{cancelClass}',
            cancelHint:  '{cancelHint}',
            cancelOff:   '{cancelOff}',
            cancelOn:    '{cancelOn}',
            cancelPlace: '{cancelPlace}', 
            click:       undefined,
            half:        {half},
            halfShow:    {halfShow},
            hints:       {hints},  
            iconRange:   undefined,
            mouseout:    undefined,
            mouseover:   undefined,
            noRatedMsg:  '{noRatedMsg}',
            number:      {number},  
            numberMax:   {numberMax}, 
            path:        undefined,
            precision:   {precision},
            readOnly:    {readOnly},
            score:       undefined,
            scoreName: '{id}',
            single:      {single},
            space:       {space},
            starHalf:    '{starHalf}',
            starOff:     '{starOff}',
            starOn:      '{starOn}',
            target:      undefined,
            targetForma: '{targetForma}',
            targetKeep:  {targetKeep},
            targetScore: undefined,
            targetText:  '{targetText}',
            targetType:  '{targetType}',
            
                       
         });
         $('#{id}').raty('click', number); 
         
         
JS,*/

         'js' => <<<JS
          
                var cStars = function(nowPos) {
              // У всех убираем active
              $('#id').removeClass('active');
              for (var i = 0; nowPos + 1 > i; i++) {
                $('.stars .star').eq(i).toggleClass('active');
              }
            }
            
            //переменная содержит количество активных звезд
            var starsCount = $('.star.active').length;
            
            // При наведении
            $('#id').hover(function() {
              cStars($(this).index());
            });
            
            // При клике
            $('#id').click(function() {
              cStars($(this).index());
              //меняем количество по клику
              starsCount = $('#id').length;
            });
            
            $('#id').on('mouseleave', function() {
              cStars(+starsCount - 1);
            });

JS,

    ];

    public function asset()
    {
        $this->fileJs("https://cdn.jsdelivr.net/npm/raty-js@2.9.0/lib/jquery.raty.min.js");
        $this->fileJs("https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js");
        $this->fileCss("https://cdn.jsdelivr.net/npm/raty-js@2.9.0/lib/jquery.raty.css");
    }

    public function codes()
    {

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{name}' => $this->name,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
        ]);

        /*$this->js .= strtr($this->_layout['jscode'], [
            '{id}' => $this->id,
            '{starType}' => $this->_config['starType'],
            '{cancel}' => $this->_config['cancel'],
            '{cancelClass}' => $this->_config['cancelClass'],
            '{cancelHint}' => $this->_config['cancelHint'],
            '{cancelOff}' => $this->_config['cancelOff'],
            '{cancelOn}' => $this->_config['cancelOn'],
            '{cancelPlace}' => $this->_config['cancelPlace'],
            '{half}' => $this->_config['half'],
            '{halfShow}' => $this->_config['halfShow'],
            '{hints}' => $this->_config['hints'],
            '{noRatedMsg}' => $this->_config['noRatedMsg'],
            '{number}' => $this->_config['number'],
            '{numberMax}' => $this->_config['numberMax'],
            '{precision}' => $this->_config['precision'],
            '{readOnly}' => $this->_config['readOnly'],
            '{scoreName}' => $this->_config['scoreName'],
            '{single}' => $this->_config['single'],
            '{space}' => $this->_config['space'],
            '{starHalf}' => $this->_config['starHalf'],
            '{starOff}' => $this->_config['starOff'],
            '{starOn}' => $this->_config['starOn'],
            '{targetForma}' => $this->_config['targetForma'],
            '{targetKeep}' => $this->_config['targetKeep'],
            '{targetText}' => $this->_config['targetText'],
            '{targetType}' => $this->_config['targetType'],
        ]);*/
        $this->js .= strtr($this->_layout['js'], [
        
        ]);
    }
}
