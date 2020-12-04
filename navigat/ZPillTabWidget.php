<?php

/**
 *
 *
 * Author:  Daho
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;


class ZPillTabWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'pill' => [],
        'TabColor' => ZPillTabWidget::pillColor['yellow'],
        'theme' => ZPillTabWidget::themes['lightBlueTheme'],
    ];
    public const pillColor = [
        'red' => 'red',
        'pink' => 'pink',
        'purple' => 'purple',
        'deep-purple' => 'deep-purple',
        'indigo' => 'indigo',
        'blue' => 'blue',
        'light-blue' => 'light-blue',
        'cyan' => 'cyan',
        'teal' => 'teal',
        'green' => 'green',
        'light-green' => 'light-green',
        'lime' => 'lime',
        'yellow' => 'yellow',
        'amber' => 'amber',
        'orange' => 'orange',
        'deep-orange' => 'deep-orange',
        'brown' => 'brown',
        'grey' => 'grey',
        'blue-grey' => 'blue-grey',
        'white' => 'white',
        'black' => 'black',
        'lime-green' => 'lime-green',
    ];
    public const themes = [
        'bronzeTheme' => 'bronzeTheme',
        'blueTheme' => 'blueTheme',
        'whiteBlackTheme' => 'whiteBlackTheme',
        'blackWhiteTheme' => 'blackWhiteTheme',
        'lightBlueTheme' => 'lightBlueTheme',
    ];

    private function generatePill()
    {

        $idCount = 0;
        $pillTab = '';

        $pillContent = '';
        $haveSelected = true;

        foreach ($this->data as $key => $value) {
            if (is_array($value)) {

                $ddbody = '';
                foreach ($value as $k => $v) {
                    $ddbody .= strtr($this->_layout['dropdown'], [
                        '{href}' => $v,
                        '{text}' => $k
                    ]);

                }
                $pillTab .= strtr($this->_layout['dropdownfull'], [
                    '{ddtitle}' => $key,
                    '{ddbody}' => $ddbody
                ]);


            } else {

                $pillTab .= strtr($this->_layout['tabitem'], [
                    '{idCount}' => $idCount,
                    '{label}' => $key,
                    '{selected}' => $haveSelected ? 'active' : '',
                ]);
                $pillContent .= strtr($this->_layout['contentBody'], [
                    '{idCount}' => $idCount,
                    '{text}' => $value,
                    '{show}' => $haveSelected ? 'show' : '',
                ]);
                if ($haveSelected) $haveSelected = false;

            }
            $idCount++;
        }

        $pillTab = strtr($this->_layout['tab'], [
            '{content}' => $pillTab,
            '{color}' => $this->_config['TabColor']
        ]);

        $pillContent = strtr($this->_layout['content'], [
            '{body}' => $pillContent
        ]);
        return $pillTab . $pillContent;

    }

    public $layout = [];
    public $_layout = [
        'tab' => <<<HTML
<ul class="nav md-pills pills-secondary pills-{color}">
    {content}
</ul>
HTML,
        'dropdown' => <<<HTML
<a class="dropdown-item" href="{href}">{text}</a>
HTML,
        'dropdownfull' => <<<HTML
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
      aria-expanded="false">{ddtitle}</a>
    <div class="dropdown-menu">
        {ddbody}
    </div>
</li>
    
HTML,
        'tabitem' => <<<HTML
<li class="nav-item">
    <a class="nav-link {selected} qwer" id="pills-home-tab" data-toggle="pill" href="#pills{idCount}" role="tab"
      aria-controls="pills-home" aria-selected="false">{label}</a>
  </li>
HTML,

        'contentBody' => <<<HTML
<div class="tab-pane fade {show} active" id="pills{idCount}" role="tabpanel" aria-labelledby="pills-home-tab">{text}</div>
HTML,
        'content' => <<<HTML
<div class="tab-content pt-2 pl-1" id="pills-tabContent">
{body}
</div>
HTML,
        'css' => <<<CSS
        .md-pills{
            background-color:{bgcolor};
            }
            
          
            
            


CSS
    ];


    public function codes()
    {

        $this->htm = $this->generatePill();


        $this->js = <<<JS
   
    var selector =  $('.qwer')

   $(".dropdown-item").hover(function (event) { 
    $(this).css("background-color",e.type === "mouseenter"?selector:"transparent") 
})
                        
JS;


        switch ($this->_config['theme']) {

            case 'blueTheme':
            {
                $this->css = strtr($this->_layout['css'], ['{primaryColor}' => ZColor::color['oxford-blue'],
                    '{secondaryColor}' => ZColor::color['royal-blue'],
                    '{thirdColor}' => ZColor::color['payne-grey'],
                    '{activeBtn}Color' => ZColor::color['glitter'],
                    '{btnItem}Color' => ZColor::color['glitter'],
                    '{blockColor}' => ZColor::color['royal-blue'],]);
                break;
            }

            case
            'bronzeTheme':
            {
                $this->css = strtr($this->_layout['css'], [
                    '{primaryColor}' => ZColor::color['paper'],
                    '{secondaryColor}' => ZColor::color['silk'],
                    '{thirdColor}' => ZColor::color['charcoal'],
                    '{activeBtn}Color' => ZColor::color['pale-gold'],
                    '{btnItem}Color' => ZColor::color['charcoal'],
                    '{blockColor}' => ZColor::color['silk'],
                    '{bgcolor}'  =>     ZColor::color['silk'],
                    '{navcolor}' =>    ZColor::color['pale-gold'],

                ]);
                break;
            }

            case 'whiteBlackTheme':
            {
                $this->css = strtr($this->_layout['css'], [
                    '{primaryColor}' => ZColor::color['white'],
                    '{secondaryColor}' => ZColor::color['white'],
                    '{thirdColor}' => ZColor::color['white'],
                    '{activeBtnColor}' => ZColor::color['black'],
                    '{btnItemColor}' => ZColor::color['black'],
                    '{blockColor}' => ZColor::color['white'],
                    '{bgcolor}' => ZColor::color['white'],
                    '{pColor}' => ZColor:: color ['white'],
                ]);
                break;
            }

            case 'blackWhiteTheme':
            {
                $this->css = strtr($this->_layout['css'], [
                    '{primaryColor}' => ZColor::color['black'],
                    '{secondaryColor}' => ZColor::color['black'],
                    '{thirdColor}' => ZColor::color['black'],
                    '{activeBtnColor}' => ZColor::color['white'],
                    '{btnItemColor}' => ZColor::color['white'],
                    '{blockColor}' => ZColor::color['black'],
                    '{pColor}' => ZColor:: color ['black'],
                    '{bgcolor}' => ZColor::color['black'],
                ]);
                break;
            }

            case 'lightBlueTheme':
            {
                $this->css = strtr($this->_layout['css'], [
                    '{primaryColor}' => ZColor::color['white'],
                    '{secondaryColor}' => ZColor::color['light-grey'],
                    '{thirdColor}' => ZColor::color['medium-blue'],
                    '{activeBtnColor}' => ZColor::color['lighten-blue'],
                    '{btnItemColor}' => ZColor::color['royal-blue'],
                    '{blockColor}' => ZColor::color['light-grey'],
                    '{bgcolor}' => ZColor::color['lighten-blue'],

                ]);
                break;
            }

        }
    }
}
