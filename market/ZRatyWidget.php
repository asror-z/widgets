<?php

/**
 *
 *
 * @author SherzodMangliyev
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;
/**
 * Refactored by: Muhriddin Pardabayev
 * https://github.com/wbotelhos/raty
 */
class ZRatyWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'starType' => ZRatyWidget::type['starOn'],  // 'img'
        'cancel' => 'false',
        'cancelClass' => 'raty-cancel',
        'cancelHint' => 'Cancel this rating',
        'cancelOff' => '/render/market/ZRatyWidget/demo/images/cancel-off.png',
        'cancelOn' => '/render/market/ZRatyWidget/demo/images/cancel-on.png',
        'cancelPlace' => 'right',  //left
        'half' => 'true',
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
        'targetType' => 'hint'  // score
    ];

    public const type = [
        'cancelOff' => '/render/market/ZRatyWidget/demo/images/cancel-off.png',
        'cancelOn' => '/render/market/ZRatyWidget/demo/images/cancel-on.png',
        'starHalf' => '/render/market/ZRatyWidget/demo/images/star-half.png',
        'starOff' => '/render/market/ZRatyWidget/demo/images/star-off.png',
        'starOn' => '/render/market/ZRatyWidget/demo/images/star-on.png',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div id="{id}"></div>
HTML,

        'jscode' => <<<JS
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
            score:       {score},
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
         
          var input =  $("#{id}").find("input");
          $(input).attr('name', "{name}");
      
JS,
    ];
    

    public function asset()
    {
        $this->fileJs("https://cdn.jsdelivr.net/npm/raty-js@2.9.0/lib/jquery.raty.min.js");
        $this->fileCss("https://cdn.jsdelivr.net/npm/raty-js@2.9.0/lib/jquery.raty.css");
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);

        $this->js = strtr($this->_layout['jscode'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{score}' => $this->value,
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
        ]);
    }
}
