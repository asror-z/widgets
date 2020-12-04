<?php


namespace zetsoft\widgets\navigat;
/**
 *
 *
 * Author:  Qudratov Jahongir
 * Refactored: Toirov Azimjon
 */

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
class ZLanguagePickerWidget_02 extends ZWidget
{

    public $config = [];
    public $_config = [
        'grapes' => true,
        
    ];


    public $data = [
        'ru' => 'Russian',
        'en' => 'English',
        'uz' => 'Uzbek',
        'tr' => 'Turkish',
        'zh' => 'Chinese',
        'ja' => 'Japan',
        'ar' => 'Arabic',
        'fr' => 'French',
        'de' => 'German',
        'it' => 'Italian',
        'es' => 'Spanish',
        'ko' => 'Korean',
    ];



    public function codes()
    {
        $current_lang = \Yii::$app->language;
        $this->htm = <<<HTML
  <div class="vd_mega-menu-wrapper"  '  {readonly}>
            <div class="vd_mega-menu pull-right">
                <ul class="mega-ul">
                    <li id="lang-picker" class="profile mega-li">
                        <a id="lang-pickerr" class="mega-link" data-action="click-trigger">
                           <span class="mega-image">
                                <img src="/render/navigat/ZLanguagePickerWidget/assets/LanguagePicker/{$current_lang}.svg" alt="">
                            </span>
                            <span class="mega-name">
                                {$this->data[$current_lang]} <i class="fa fa-caret-down fa-fw"></i>
                            </span>
                        </a>
                        <div class="vd_mega-menu-content  width-xs-2  left-xs left-sm lang-content" data-action="click-target">
                            <div class="child-menu">
                                <div class="content-list content-menu">
                                    <ul class="list-wrapper pd-lr-10">
HTML;


        foreach ($this->data as $key => $data) {

            $selected_lang = '/' . $key . '/';

            $url = $selected_lang . Az::$app->request->pathInfo;

            if (!empty(Az::$app->request->queryString))
                $url .= '?' . Az::$app->request->queryString;


            $this->htm .= <<<HTML
<li id="lang-picker">
    <a href="{$url}">
          <span class="lang-img mega-image">
              <img id="langIcon" src="/render/navigat/ZLanguagePickerWidget/assets/LanguagePicker/{$key}.svg" alt="example image">
          </span>
            <div class="menu-text lang-text">{$data}</div>
    </a>
</li>
HTML;
        }
        $this->htm .= <<<HTML
 
                           </ul>
                         </div>
                       </div>
                     </div>
                   </li>
                </ul>
            </div>
        </div>
HTML;




        $this->css = <<<CSS
            
    
          #langIcon{
              width: 18px;
              margin-right: 5px;
              vertical-align: middle;
          }
          .lang-content{
              max-height: 300px;
              overflow-y: scroll !important;
              
          }
          .lang-text{
             height: 36px;
             padding-top: 5px;
             margin-left: 0!important;
          }
          .vd_mega-menu-content{
            display: none;
          }
          .vd_mega-menu{
          float:right;!important;
          }
          
           
CSS;
        $this->htm = strtr($this->htm, [
            '{widget}' => $this->dataWidget,
            '{config}' => json_encode($this->_config, JSON_UNESCAPED_UNICODE),
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
}
}
