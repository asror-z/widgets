<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZGrapeParticlesWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b>',
    ];

    public $config = [];
    public $_config = [
        'grapes' => true,
        'backgroundColor' => '#fff',
        'particlesColor' => '#000',
        'shapeType' => ZGrapeParticlesWidget::shapeType['circle'],
    ];

    public const shapeType = [
      'circle' => 'circle',
      'edge' => 'edge',
      'triangle' => 'triangle',
      'polygon' => 'polygon',
      'star' => 'star',
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
           'backgroundColor',
           'particlesColor',
           'shapeType'
        ],
    ];
    
    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Опции Particles'
    ];
    
    public $event = [];
    public $_event = [
                                  
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div id="particles-js"></div>        
    
HTML,
        
        'css' => <<<CSS
         canvas {
          display: block;
          vertical-align: bottom;
         }
        
        /* ---- particles.js container ---- */
        
        #particles-js {
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: _background-color_;
          background-image: url("");
          background-repeat: no-repeat;
          background-size: cover;
          background-position: 50% 50%;
        }
        
        /* ---- stats.js ---- */
        
        .count-particles{
          background: #000022;
          position: absolute;
          top: 48px;
          left: 0;
          width: 80px;
          color: #13E8E9;
          font-size: .8em;
          text-align: left;
          text-indent: 4px;
          line-height: 14px;
          padding-bottom: 2px;
          font-family: Helvetica, Arial, sans-serif;
          font-weight: bold;
        }
        
        .js-count-particles{
          font-size: 1.1em;
        }
        
        #stats,
        .count-particles{
          -webkit-user-select: none;
        }
        
        #stats{
          border-radius: 3px 3px 0 0;
          overflow: hidden;
        }
        
        .count-particles{
          border-radius: 0 0 3px 3px;
        }
CSS,

        'js' => <<<JS
        particlesJS("particles-js", {
          "particles": {
            "number": {
              "value": 380,
              "density": {
                "enable": true,
                "value_area": 800
              }
            },
            "color": {
              "value": "{particlesColor}"
            },
            "shape": {
              "type": "{shapeType}",
              "stroke": {
                "width": 0,
                "color": "#000000"
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
              "value": 0.5,
              "random": false,
              "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
              }
            },
            "size": {
              "value": 3,
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
              "distance": 150,
              "color": "#ffffff",
              "opacity": 0.4,
              "width": 1
            },
            "move": {
              "enable": true,
              "speed": 6,
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
                "enable": true,
                "mode": "grab"
              },
              "onclick": {
                "enable": true,
                "mode": "push"
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
                "particles_nb": 4
              },
              "remove": {
                "particles_nb": 2
              }
            }
          },
          "retina_detect": true
    });


        /* ---- stats.js config ---- */

        var count_particles, stats, update;
        stats = new Stats;
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
        count_particles = document.querySelector('.js-count-particles');
        update = function() {
          stats.begin();
          stats.end();
          if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
          }
          requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js');
    }

    public function codes()
    {
        
        $this->htm = strtr($this->_layout['main'],[
           
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{particlesColor}' => $this->_config['particlesColor'],
            '{shapeType}' => $this->_config['shapeType'],
        ]);
        $this->css = strtr($this->_layout['css'], [
            '{backgroundColor}' => $this->_config['backgroundColor'],
        ]);
    }
}
