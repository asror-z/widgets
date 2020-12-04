<?php



/**
 *
 * https://github.com/ConnorAtherton/loaders.css
 * http://connoratherton.com/loaders
 *
 * Created By: Zulpanov Ibrohim
 * Refactored: Zulpanov Ibrohim
 */

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;


class  ZLoadersLoadersCssWidget extends ZWidget
{
    public $config = [];
    public const type = [
        'ball-pulse' => 'ball-pulse',
        'ball-grid-pulse' => 'ball-grid-pulse',
        'ball-clip-rotate' => 'ball-clip-rotate',
        'ball-clip-rotate-pulse' => 'ball-clip-rotate-pulse',
        'square-spin' => 'square-spin',
        'ball-clip-rotate-multiple' => 'ball-clip-rotate-multiple',
        'ball-pulse-rise' => 'ball-pulse-rise',
        'ball-rotate' => 'ball-rotate',
        'cube-transition' => 'cube-transition',
        'ball-zig-zag' => 'ball-zig-zag',
        'ball-zig-zag-deflect' => 'ball-zig-zag-deflect',
        'ball-triangle-path' => 'ball-triangle-path',
        'ball-scale' => 'ball-scale',
        'line-scale' => 'line-scale',
        'line-scale-party' => 'line-scale-party',
        'ball-scale-multiple' => 'ball-scale-multiple',
        'ball-pulse-sync' => 'ball-pulse-sync',
        'ball-beat' => 'ball-beat',
        'line-scale-pulse-out' => 'line-scale-pulse-out',
        'line-scale-pulse-out-rapid' => 'line-scale-pulse-out-rapid',
        'ball-scale-ripple' => 'ball-scale-ripple',
        'ball-scale-ripple-multiple' => 'ball-scale-ripple-multiple',
        'ball-spin-fade-loader' => 'ball-spin-fade-loader',
        'line-spin-fade-loader' => 'line-spin-fade-loader',
        'triangle-skew-spin' => 'triangle-skew-spin',
        'pacman' => 'pacman',
        'ball-grid-beat' => 'ball-grid-beat',
        'semi-circle-spin' => 'semi-circle-spin',
    ];
    public $_config = [
        'type' => ZLoadersLoadersCssWidget::type['pacman']
    ];

     public  $layout=[];
     public  $_layout=[

         'ball-pulse' => <<<HTML
        <div class="ball-pulse loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
   HTML,

         'ball-grid-pulse' => <<<HTML
       <div class="ball-grid-pulse loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML,

         'ball-clip-rotate' => <<<HTML
      <div class="ball-clip-rotate loader">
                    <div></div>
                </div>
HTML,


         'ball-clip-rotate-pulse' => <<<HTML
          <div class="ball-clip-rotate-pulse loader">
                    <div></div>
                    <div></div>
                </div>
HTML,
         'square-spin' => <<<HTML
          <div class="square-spin loader">
                    <div></div>
                </div>
HTML,
         'ball-clip-rotate-multiple loader'  => <<<HTML
           <div class="ball-clip-rotate-multiple">
                    <div></div>
                    <div></div>
                </div>
HTML,  'ball-rotate' => <<<HTML
            <div class="ball-rotate loader">
                    <div></div>
                </div>
HTML,
         'cube-transition' => <<<HTML
          <div class="cube-transition loader">
                    <div></div>
                    <div></div>
                </div>
HTML,
         'ball-zig-zag' => <<<HTML
         <div class="ball-zig-zag loader">
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'ball-zig-zag-deflect' => <<<HTML
         <div class="ball-zig-zag-deflect loader">
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'ball-triangle-path' => <<<HTML
         <div class="ball-triangle-path loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'ball-scale' => <<<HTML
          <div class="ball-scale loader">
                    <div></div>
                </div>
HTML
         ,  'line-scale' => <<<HTML
           <div class="line-scale loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'line-scale-party' => <<<HTML
           <div class="line-scale-party loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'ball-scale-multiple' => <<<HTML
          <div class="ball-scale-multiple loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML
         ,  'ball-pulse-sync' => <<<HTML
          <div class="ball-pulse-sync loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'ball-beat' => <<<HTML
           <div class="ball-beat loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'line-scale-pulse-out' => <<<HTML
          <div class="line-scale-pulse-out loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'line-scale-pulse-out-rapid' => <<<HTML
          <div class="line-scale-pulse-out-rapid loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'ball-scale-ripple' => <<<HTML
         <div class="ball-scale-ripple loader">
                    <div></div>
                </div>
HTML, 'ball-scale-ripple-multiple' => <<<HTML
        <div class="ball-scale-ripple-multiple loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'ball-spin-fade-loader' => <<<HTML
          <div class="ball-spin-fade-loader loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'line-spin-fade-loader' => <<<HTML
           <div class="line-spin-fade-loader loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'triangle-skew-spin' => <<<HTML
        <div class="triangle-skew-spin loader">
                    <div></div>
                </div>
HTML, 'pacman' => <<<HTML
         <div class="pacman loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'ball-grid-beat' => <<<HTML
          <div class="ball-grid-beat loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
HTML, 'semi-circle-spin' => <<<HTML
           <div class="semi-circle-spin loader">
                    <div></div>
                </div>
HTML,







     ];

 public function asset()
{


    /*
     *
     *
     *  <link rel="stylesheet" href="\publish\yarner\loaders.css\loaders.min.css">
     */
    $this->fileCss('https://cdn.jsdelivr.net/npm/loaders.css@0.1.2/loaders.min.css');
}
  public function codes()
{
    $this->css = <<<CSS
               .loader > div {
                background-color: orange;
            } 
    CSS;


    $this->htm = $this->_layout[$this->_config['type']];

}


}?>

