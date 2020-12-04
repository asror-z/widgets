<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;


/*
 *
 * https://www.vantajs.com/
 *  https://github.com/tengbao/vanta
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZVantaJSWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZVantaJSWidget::type['globe'],
        'colorModeForBirds' => ZVantaJSWidget::birdsColorMode['lerp'],
        'backgroundColor' => ZVantaJSWidget::color['Indigo'],
        'color' => ZVantaJSWidget::color['DarkOrchid'],
        'speed' => 4,
        'begin' => false
    ];


    /*
     * Constants
     */

    public const color = [
        'LightPink' => '#FFB6C1',
        'DeepPink' => '#FF1493',
        'Plum' => '#DDA0DD',
        'DarkOrchid' => '#FFEBCD',
        'Lavender' => '#E6E6FA',
        'Purple' => '#800080',
        'Indigo' => '#4B0082',
        'Red' => '#FF0000',
        'DarkRed' => '#8B0000',
        'LightCoral' => '#F08080',
        'Orange' => '#FFA500',
        'Yellow' => '#FFFF00',
        'Moccasin' => '#FFE4B5',
        'PaleGreen' => '#98FB98',
        'Green' => '#008000',
        'OliveDrab' => '#6B8E23',
        'LightSeaGreen' => '#20B2AA',
        'Lime' => '#00FF00',
        'Aqua' => '#00FFFF',
        'Blue' => '#0000FF',
        'Navy' => '#000080',
        'LightSkyBlue' => '#87CEFA',
        'BurlyWood' => '#DEB887',
        'Brown' => '#8B4513',
        'White' => '#FFFFFF',
        'DimGray' => '#696969',
        'LightGray' => '#D3D3D3',
        'PeachPuff' => '#FFDAB9',
    ];


    public const type = [
        'birds' => 'birds',
        'fog' => 'fog',
        'waves' => 'waves',
        'clouds' => 'clouds',
        'clouds2' => 'clouds2',
        'globe' => 'globe',
        'net' => 'net',
        'cells' => 'cells',
        'trunk' => 'trunk',
        'topology' => 'topology',
        'dots' => 'dots',
        'rings' => 'rings',
    ];

    public const birdsColorMode = [
        'lerp' => 'lerp',
        'lerpGradient' => 'lerpGradient',
        'variance' => 'variance',
        'varianceGradient' => 'varianceGradient',
    ];
    public $layout = [];
    public $_layout = [


        'birds' => <<<JS
           VANTA.BIRDS({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        backgroundAlpha: 1,
        color1: '{color}',
        color2: '#00d1ff',
        colorMode: '{colorModeForBirds}',
        birdSize: 2,
        quantity: 5,
        wingSpan: 30,
        speedLimit: 5,
        separation: 20,
        alignment: 20,
        cohesion: 20,
});
JS,
        'fog' => <<<JS
            VANTA.FOG({
        el: "#{id}",
        highlightColor: '#ffc300',
        midtoneColor: '#ff1f00',
        lowlightColor: '#2d00ff',
        baseColor: '#ffebeb',
        blurFactor: 0.6,
        zoom: 1,
        speed: {speed}
    });
JS,
        'waves' => <<<JS
            VANTA.WAVES({
        el: "#{id}",
        color: '{color}',
        shininess: 10,
        waveHeight: 35,
        waveSpeed: {speed},
        zoom: 1.2
    })
JS,
        'clouds' => <<<JS
            VANTA.CLOUDS({
        el: "#{id}",
        backgroundColor: '#ffffff',
        skyColor: '#68b8d7',
        cloudColor: '#adc1de',
        cloudShadowColor: '#183550',
        sunColor: '#ff9919',
        sunGlareColor: '#ff6633',
        sunlightColor: '#ff9933'
       })
JS,
        'clouds2' => <<<JS
            VANTA.CLOUDS2({
        el: "#{id}",
        texturePath: 'testing/animo/All/assets/JS/All Vanta animos/noise.png',
        backgroundColor: '#000000',
        skyColor: '#5ca6ca',
        cloudColor: '#334d80',
        lightColor: '#ffffff',
        speed: {speed}
       })
JS,
        'globe' => <<<JS
            VANTA.GLOBE({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        color: '{color}',
        color2: '#ffffff',
        size: 0.8
       })
JS,
        'net' => <<<JS
            VANTA.NET({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        color: '{color}',
        points: 20,
        maxDistance: 20,
        spacing: 15,
        showDots: true
       })
JS,
        'cells' => <<<JS
            VANTA.CELLS({
        el: "#{id}",
        color1: '{color}',
        color2: '#f2e735',
        size: 2.5,
        speed: {speed}
       })
JS,
        'trunk' => <<<JS
            VANTA.TRUNK({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        color: '{color}',
       })
JS,
        'topology' => <<<JS
            VANTA.TOPOLOGY({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        color: '{color}'
       })
JS,
        'dots' => <<<JS
            VANTA.DOTS({
        el: "#{id}",
        backgroundColor: '{backgroundColor}',
        color: '{color}',
        color2: '#ff8880',
        size: 3,
        spacing: 24
       })
JS,
        'rings' => <<<JS
            VANTA.RINGS({
        el: "#{id}",
        color: '{color}',
        backgroundColor: '{backgroundColor}',
        backgroundAlpha: 0.9
       })
JS


    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/vendor/p5.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/vendor/three.r95.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.birds.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.cells.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.clouds.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.clouds2.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.dots.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.fog.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.globe.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.net.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.rings.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.topology.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.trunk.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanta@0.5.10/dist/vanta.waves.min.js');
    }

    public function init()
    {
        parent::init();
        if ($this->_config['begin'])
            ob_start();
    }

    public function codes()
    {
        $obGetClean = '';
        if ($this->_config['begin'])
            $obGetClean = ob_get_clean();

            $this->htm = <<<HTML
 <div style="height: 800px" id="{$this->id}">{$obGetClean}</div>
HTML;

        $js = $this->_layout[$this->_config['type']];

        $this->js = strtr($js, [
            '{id}' => $this->id,
            '{backgroundColor}' => $this->_config['backgroundColor'],
            '{color}' => $this->_config['color'],
            '{speed}' => $this->_config['speed']
        ]);


    }
}
