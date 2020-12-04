<?php

namespace zetsoft\widgets\animo;


use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZHoversCsshakeWidget
 * https://elrumordelaluz.github.io/csshake/
 *
 * Created By: Musoxon Abdulhamidov
 * Refactored: Musoxon Abdulhamidov
 */

class ZCsshakeWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'types' =>ZHoversCsshakeWidget::type['shake-hard'],
        'text' => 'shake',
    ];

    public const type = [
        'shake-hard' => 'shake-hard',
        'shake-slowww' => 'shake-slow',
        'shake-little' => 'shake-little',
        'shake-horizontal' => 'shake-horizontal',
        'shake-vertical' => 'shake-vertical',
        'shake-rotate' => 'shake-rotate',
        'shake-opacity' => 'shake-opacity',
        'shake-crazy' => 'shake-crazy',
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/csshake@1.5.3/dist/csshake.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/csshake@1.5.3/dist/csshake-slow.css');
    }


    public function codes()
    {

            $this->htm = <<<HTML
        <div class="{$this->_config['types']}"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png" alt="shake">{$this->_config['text']}</div>
        <div class="{$this->_config['types']}"><img src="/render/animo/ZCsshakeWidget/asset/images/num5.jpg" alt="shake-hard">{$this->_config['text']}</div>
        <div class="{$this->_config['types']}"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png" alt="Shake-slow">{$this->_config['text']}</div>


    <div class="row">
    <div class="col-4">
        <div class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png" alt="shake">shake</div>
        <div class="shake shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num5.jpg" alt="shake-hard">shake-hard</div>
        <div class="shake shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png" alt="Shake-slow">Shake-slow</div>
    </div>
    <div class="col-4">
        <div class="shake shake-little"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png" alt="shake">shake-little</div>
        <div class="shake shake-horizontal"><img src="/render/animo/ZCsshakeWidget/asset/images/num5.jpg">shake-horiznotal</div>
        <div class="shake shake-vertical"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png">shake-vertical</div>
    </div>
    <div class="col-4">
        <div class="shake shake-rotate"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png">shake-rotate</div>
        <div class="shake shake-opacity"><img src="/render/animo/ZCsshakeWidget/asset/images/num5.jpg">shake-opacity</div>
        <div class="shake shake-crazy"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png">shake-crazy</div>
    </div>
</div>

    <div class="row" id="footer">
    <div class="col-4">
        <div class="shake shake-freeze"><img src="/render/animo/ZCsshakeWidget/asset/images/num1.png" alt="shake">when :hover</div>
    </div>
    <div class="col-4">
        <div class="shake shake-constant"><img src="/render/animo/ZCsshakeWidget/asset/images/num5.jpg">instead on :hover</div>
    </div>
    <div class="col-4">
        <div class="shake shake-constant shake-constant--hover"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png">stop when :hover</div>
    </div>
</div>              /render/animo/ZCsshakeWidget/asset/images/num66.png

    <div class="row" id="footer2">
    <ul class="shake-trigger"> 
            <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div>

            <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div>

            <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div>      
            
            <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div>
                
           <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div>
            
            <div class="col-2">
                <li class="shake-slow"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake-hard"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
                <li class="shake"><img src="/render/animo/ZCsshakeWidget/asset/images/num66.png"></li>
            </div> 
            </ul>
    </div>

HTML;

        $this->css = <<<CSS
    * { box-sizing: border-box; }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        
        [class*="col-"] {
            float: left;
            padding: 10px;
            border: 1px solid #7544ff;
        }

        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}

        #footer {
            margin-top: 5rem;
        }
        
        #footer2 {
        margin-top: 5rem;
        margin-right: 2rem;
        }
CSS;


    }

}
