<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * Author:  Zoirjon Sobirov
 * https://t.me/zoirjon_sobirov
 *
 */

class ZZoirWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'options' =>[
            'ship_to'           =>['Uzbekistan', 'Russia', 'Usa'],
            'currency'          =>['UZS', 'RUB', 'USD'],
            'languageNav'       =>['UZB','RUS', 'ENG','TURK'] ,
            'languageSelect'    =>['ENG','ITL','ARB','FRN']
        ],
        'currentPlace'  =>  'UZS',
    ];
    public $event = [];
    public $_event = [

    ];



    public function asset()
    {
        $this->fileCss('\render\market\ZZoirWidget\assets\ae-header-ru.css');
         /*$this->fileCss('\render\asrorz\theme\.css');*/
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
 <div class="top-lighthouse" data-spm="" id="top-lighthouse" data-spm-max-idx="">
    <div class="top-lighthouse-wrap container">
        <div class="nav-global" id="nav-global" data-widget-cid="widget-8">
            <div class="ng-item ng-setting-proxy" data-role="privacy-setting" style="display:none;"><a
                    href="" data-spm-anchor-id="">Privacy Setting</a></div>
            <div class="ng-item ng-bp"><a href="" rel="nofollow"  data-spm-anchor-id="2">Защита Покупателя</a></div>
            <div class="ng-item ng-help ng-sub">
            <span class="ng-sub-title help">Помощь</span>
                <ul class="ng-sub-list">
                    <li>
                    <a class="ng-help-link" data-role="help-center-link"
                           href="" rel="nofollow"
                           data-spm-anchor-id="">Служба поддержки</a></li>
                    <li><a data-role="complaint-link" href="" rel="nofollow" data-spm-anchor-id="">Споры и жалобы</a></li>
                </ul>
            </div>
<!--            <div class="ng-item ng-mobile"><a href="#" rel="nofollow" data-spm-anchor-id="">Mобильное приложение!</a></div>-->
            <div class="ng-item ng-switcher" data-role="region-pannel">
                <a id="switcher-info" data-role="menu" class="switcher-info notranslate" rel="nofollow"
                   href="#" data-spm-anchor-id="">
                    <span class="ship-to">Доставка в<i class="css_flag css_uz"></i></span>
                    <span class="split">/</span>
                    <span class="currency">{currentPlace}</span>
                </a>
                <div class="dropdown_div" aria-labelledby="navbarDropdown" style="display:none">
                    <span class="label">Доставка в</span>
                    <select class="form-control form-control-sm d-block">
                        {ship_to}
                    </select>
                    <span class="label">Валюта</span>
                    <select class="form-control form-control-sm d-block">
                            {currency}                        
                    </select>
                    <div class="dropdown-divider"></div>
                    <button class="btn btn-success btn-save">Save</button>
                </div>

            </div>
            
            <div class="ng-item ng-switcher ng-switcher-language" id="lol">
                <a id="switcher-lang" data-role="menu" class="switcher-info notranslate" rel="nofollow"
                   href="#" data-spm-anchor-id="">Language</a>
                      <div  class="lang_drop_div"  style="display:none">
                          <ul style=" list-style-type:none;">
                              {languageNav}                              
                              <p >Select Language</p>
                              <select class="form-control form-control-sm d-block">
                                  {languageSelect}                       
                              </select>
                              </ul>
                          </ul>
                      </div>
            </div>
        </div>
    </div>
</div>
HTML,
        'css' => <<<CSS
     .dropdown_div ,.lang_drop_div {
     background-color: #fff;
     padding: 5px 15px!important;
     }
      
    .nav-global .ng-item a:hover {
        text-decoration: none;
        color: #10b410;
    }
    .help:hover {
        color: #10b410!important;
    }
    .nav-global .ng-item {
        position: relative;
        float: left;
        height: 30px;
        line-height: 30px;
        border-right: 1px solid #e9e9e9;
        width: 220px;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
    }
    
    .nav-global .ng-sub-title, .nav-global .ng-switcher .switcher-info{
        position: relative;
        display: block;
        font-size: 14px!important;
        padding: 0!important;
        line-height: 30px!important;
    }
    
    .nav-global .ng-sub-list {
        z-index: 99;
        width: 220px;
        
    }
    
    .top-lighthouse {
        height: 30px;
    }
    .ng-switcher .label {
        display: block;
        font-size: 14px;
        color: rgb(0, 0, 0);
        font-weight: 500;
        font-family: Arial, Helvetica, sans-serif, SimSun, 宋体;
        padding: 5px 20px 5px 0px;
        margin-left: 8px;
}

    .btn-save{
        font-size: 12px;
        font-weight: 500;
        padding: 8px 60px;
    }
        
CSS,
        'js' => <<<JS
    
    $('#switcher-info').click(function () {
        $(".dropdown_div").show();
    });
    $(document).mouseup(function (event) {
        if ($(e.target).closest(".dropdown_div").length === 0) {
            $(".dropdown_div").hide();
        }
    });


    $('#switcher-lang').click(function () {
        $(".lang_drop_div").show();
    });

    $(document).mouseup(function (event) {
        if ($(e.target).closest(".lang_drop_div").length === 0) {
            $(".lang_drop_div").hide();
        }
    });

JS,


    ];


    public function codes()
    {
        $content = '';
        foreach ($this->_config['options']['ship_to'] as  $country  ) {
            $content .= "
                       <option>$country</option> 
                        ";

        }
        $currency_content = '';
        foreach($this->_config['options']['currency'] as $currency){
            
            $currency_content .="
                    <option> $currency</option> 
            ";
        }

         $lang_nav       = '';
        foreach($this->_config['options']['languageNav'] as $langg){
             $lang_nav .="
               <a href='#'><li>$langg</li></a> 
            ";
        }


         $lang_Select    ='';
        foreach($this->_config['options']['languageSelect'] as $selectLang){
            $lang_Select .="
                    <option> $selectLang</option> 
            ";
        }
        $this->htm .= strtr($this->_layout['main'], [
                          '{ship_to}'        => $content,
                          '{currency}'       => $currency_content,
                          '{languageNav}'    => $lang_nav,
                          '{languageSelect}' => $lang_Select,
                          '{currentPlace}'   => $this->_config['currentPlace'],
        ]);
        $this->css = ($this->_layout['css']);
        $this->js = ($this->_layout['js']);
    }

}
