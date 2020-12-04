<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 *
 * https://vincentgarreau.com/particles.js/
 * https://github.com/VincentGarreau/particles.js/
 *
 * Created By: Jahongir Qudratov
 */

class ZParticlesWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'numberPartices' => 80,
        'moveSpeed' => 5,
        'colorDots' => '#ffffff',
        'colorShape' => '#ffffff',
        'colorLine' => '#ffffff',
        'distanceLine' => 150,
        'sizeDots' => 2,
        'animeSpeed' => 50,
        'opacityDots' => 0.5,
        'opacityLine' => 0.5,
        'shapeStrokWidth' => 1,
        'onclick' => true,
        'onhover' => true,
        'typeShape' => ZParticlesWidget::TypesShape['circle'],
        'mode' => ZParticlesWidget::Mode['push'],
        'widthParticlesdiv' => '100%',
        'heightParticlesdiv' => '100vh',
        'particlesBackground' => '#4285F4'


    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    /**
     *
     * Constants
     */

      public const TypesShape =[
        'circle' => 'circle',
        'edge' => 'edge',
        'triangle' => 'triangle',
        'polygon' => 'polygon',
        'star' => 'star',
        /*'image' => 'image'*/
      ];
      public const Mode =[
        'grab' => 'grab',
        'bubble' => 'bubble',
        'repulse' => 'repulse',
        'push' => 'push',
        'remove' => 'remove',

      ];
       public  $layout=[];
       public  $_layout=[
          'main'=><<<HTML
          <div id="particles-js"></div>
HTML,
            'js'=><<<JS
          /* ---- particles.js config ---- */

    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": {numberPartices},
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": '{colorDots}'
            },
            "shape": {
                "type": '{typeShape}',
                "stroke": {
                    "width": {shapeStrokWidth},
                    "color": '{colorShape}'
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": {opacityDots},
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": {animeSpeed},
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": {sizeDots},
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": {distanceLine},
                "color": '{colorLine}',
                "opacity": {opacityLine},
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": {moveSpeed},
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": {onhover},
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": {onclick},
                    "mode": '{mode}'
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 140,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 2
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
JS,
            'css'=> <<<CSS
    #particles-js{
        width:{widthParticlesdiv};
        height: {heightParticlesdiv};
        background-color: {particlesBackground};
        background-repeat: no-repeat;
        background-size: cover;
    }
CSS


       ];
    public function asset()
    {
       /* $this->fileCss('/publish/yarner/smartmenus/dist/css/sm-blue/sm-blue.css');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js');
    }

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm =strtr($this->_layout["main"],[]);

        $this->js =strtr($this->_layout["js"],[

            '{numberPartices}' => $this->jscode($this->_config['numberPartices']),
            '{moveSpeed}' => $this->jscode($this->_config['moveSpeed']),
            '{colorDots}' => $this->jscode($this->_config['colorDots']),
            '{colorShape}' => $this->jscode($this->_config['colorShape']),
            '{colorLine}' => $this->jscode($this->_config['colorLine']),
            '{distanceLine}' => $this->jscode($this->_config['distanceLine']),
            '{sizeDots}' => $this->jscode($this->_config['sizeDots']),
            '{animeSpeed}' => $this->jscode($this->_config['animeSpeed']),
            '{opacityDots}' => $this->jscode($this->_config['opacityDots']),
            '{opacityLine}' => $this->jscode($this->_config['opacityLine']),
            '{shapeStrokWidth}' => $this->jscode($this->_config['shapeStrokWidth']),
            '{onclick}' => $this->jscode($this->_config['onclick']),
            '{onhover}' => $this->jscode($this->_config['onhover']),
            '{typeShape}' => $this->jscode($this->_config['typeShape']),
            '{mode}' => $this->jscode($this->_config['mode']),


        ]);

       
        $this->css = strtr($this->_layout["css"],[
            '{widthParticlesdiv}'=>$this->_config['widthParticlesdiv'] ,
            '{heightParticlesdiv}'=>$this->_config['heightParticlesdiv'] ,
            '{particlesBackground}'=>$this->_config['particlesBackground'] ,


        ]);


    }

}
