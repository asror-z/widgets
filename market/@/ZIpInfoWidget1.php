<?php


namespace zetsoft\widgets\market;


use kartik\ipinfo\IpInfo;
use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\system\kernels\ZWidget;
use kartik\popover\PopoverX;
use yii\web\JsExpression;

/**
 * Class ZIpInfoWidget
 *
 * https://demos.krajee.com/ipinfo
 *
 * Created by: Muhriddin Pardabayev
 */
class ZIpInfoWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
        'showPopover' => true,
        'showFlag' => true,
    ];
    public $event = [];
    public $_event = [

    ];



    public function asset()
    {

    }
   
    public $layout = [];
    public $_layout = [
         'options' => [
             'ip' => '94.158.52.244',
             'popoverOptions' => [
                 'toggleButton' => ['class' => 'btn btn-secondary btn-lg'],
                 'placement' => PopoverX::ALIGN_BOTTOM_LEFT
             ],
             'template' => [
                 'popoverButton'=>
                     '{flag} ({city}, 
                    {region} - {zip}, 
                    {country})',
                 'inlineContent'=>
                     '{flag} {city} {countryCode}',
             ],
             
         ]
    ];

    public function codes()
    {

        $this->htm = IpInfo::widget($this->_layout['options']);
    }
}
