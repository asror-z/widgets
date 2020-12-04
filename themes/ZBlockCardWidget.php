<?php

namespace zetsoft\widgets\themes;

use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonT_OLDWidget;


/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Daho
 * Refactored: Jahongir Qudratov
 */



class ZBlockCardWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'isCardHeader' => false,
        'horizontal_OR_vertical' => 'vertical',
        'title' => '75',
        'url' => '/core/core/register.aspx',
        'cardWidth' => '100%',

        'cardTitleBool' => true,
        'text' => 'New Orders',
        'counter' => 29,
        'type' => ZBlockCardWidget::type['linkCard'],
        'color' => ZBlockCardWidget::color['cyan accent-4'],
        'cardfooterColor' => ZBlockCardWidget::color['cyan darken-3'],
        'badgeType' => ZBlockCardWidget::color['cyan darken-4'],

        'footerText' => 'More info',
        'icon' => 'fas fa-envelope',
        'grapes'=>true,
    ];

    public const type = [
        'textLeft' => 'textLeft',
        'textRight' => 'textRight',
        'todoList' => 'todoList',
        'linkCard' => 'linkCard'
    ];

    public const color = [
        'danger-color' => 'danger-color',
        'warning-color' => 'warning-color',
        'success-color' => 'success-color',
        'info-color' => 'info-color',
        'danger-color-dark' => 'danger-color-dark',
        'info-color-dark' => 'info-color-dark',
        'success-color-dark' => 'success-color-dark',
        'warning-color-dar' => 'warning-color-dar',
        'default-color' => 'default-color',
        'primary-color' => 'primary-color',
        'secondary-color' => 'secondary-color',
        'default-color-dark' => 'default-color-dark',
        'primary-color-dark' => 'primary-color-dark',
        'secondary-color-dark' => 'secondary-color-dark',
        'elegant-color' => 'elegant-color',
        'stylish-color' => 'stylish-color',
        'unique-color' => 'unique-color',
        'special-color' => 'special-color',
        'elegant-color-dark' => 'stylish-color-dark',
        'unique-color-dark' => 'unique-color-dark',
        'special-color-dark' => 'special-color-dark',
        'red lighten-5' => 'red lighten-5',
        'red lighten-4' => 'red lighten-4',
        'red lighten-3' => 'red lighten-3',
        'red lighten-2' => 'red lighten-2',
        'red lighten-1' => 'red lighten-1',
        'red' => 'red',
        'red darken-4' => 'red darken-4',
        'red darken-3' => 'red darken-3',
        'red darken-2' => 'red darken-2',
        'red darken-1' => 'red darken-1',
        'red accent-1' => 'red accent-1',
        'red accent-2' => 'red accent-2',
        'red accent-3' => 'red accent-3',
        'red accent-4' => 'red accent-4',
        'pink lighten-5' => 'pink lighten-5',
        'pink lighten-4' => 'pink lighten-4',
        'pink lighten-3' => 'pink lighten-3',
        'pink lighten-2' => 'pink lighten-2',
        'pink lighten-1' => 'pink lighten-1',
        'pink' => 'pink',
        'pink darken-4' => 'pink darken-4',
        'pink darken-3' => 'pink darken-3',
        'pink darken-2' => 'pink darken-2',
        'pink darken-1' => 'pink darken-1',
        'pink accent-1' => 'pink accent-1',
        'pink accent-2' => 'pink accent-2',
        'pink accent-3' => 'pink accent-3',
        'pink accent-4' => 'pink accent-4',
        'purple lighten-5' => 'purple lighten-5',
        'purple lighten-4' => 'purple lighten-4',
        'purple lighten-3' => 'purple lighten-3',
        'purple lighten-2' => 'purple lighten-2',
        'purple lighten-1' => 'purple lighten-1',
        'purple' => 'purple',
        'purple darken-4' => 'purple darken-4',
        'purple darken-3' => 'purple darken-3',
        'purple darken-2' => 'purple darken-2',
        'purple darken-1' => 'purple darken-1',
        'purple accent-1' => 'purple accent-1',
        'purple accent-2' => 'purple accent-2',
        'purple accent-3' => 'purple accent-3',
        'purple accent-4' => 'purple accent-4',
        'deep-purple lighten-5' => 'deep-purple lighten-5',
        'deep-purple lighten-4' => 'deep-purple lighten-4',
        'deep-purple lighten-3' => 'deep-purple lighten-3',
        'deep-purple lighten-2' => 'deep-purple lighten-2',
        'deep-purple lighten-1' => 'deep-purple lighten-1',
        'deep-purple' => 'deep-purple',
        'deep-purple darken-4' => 'deep-purple darken-4',
        'deep-purple darken-3' => 'deep-purple darken-3',
        'deep-purple darken-2' => 'deep-purple darken-2',
        'deep-purple darken-1' => 'deep-purple darken-1',
        'deep-purple accent-1' => 'deep-purple accent-1',
        'deep-purple accent-2' => 'deep-purple accent-2',
        'deep-purple accent-3' => 'deep-purple accent-3',
        'deep-purple accent-4' => 'deep-purple accent-4',
        'indigo lighten-5' => 'indigo lighten-5',
        'indigo lighten-4' => 'indigo lighten-4',
        'indigo lighten-3' => 'indigo lighten-3',
        'indigo lighten-2' => 'indigo lighten-2',
        'indigo lighten-1' => 'indigo lighten-1',
        'indigo' => 'indigo',
        'indigo darken-4' => 'indigo darken-4',
        'indigo darken-3' => 'indigo darken-3',
        'indigo darken-2' => 'indigo darken-2',
        'indigo darken-1' => 'indigo darken-1',
        'indigo accent-1' => 'indigo accent-1',
        'indigo accent-2' => 'indigo accent-2',
        'indigo accent-3' => 'indigo accent-3',
        'indigo accent-4' => 'indigo accent-4',
        'blue lighten-5' => 'blue lighten-5',
        'blue lighten-4' => 'blue lighten-4',
        'blue lighten-3' => 'blue lighten-3',
        'blue lighten-2' => 'blue lighten-2',
        'blue lighten-1' => 'blue lighten-1',
        'blue' => 'blue',
        'blue darken-4' => 'blue darken-4',
        'blue darken-3' => 'blue darken-3',
        'blue darken-2' => 'blue darken-2',
        'blue darken-1' => 'blue darken-1',
        'blue accent-1' => 'blue accent-1',
        'blue accent-2' => 'blue accent-2',
        'blue accent-3' => 'blue accent-3',
        'blue accent-4' => 'blue accent-4',
        'light-blue lighten-5' => 'light-blue lighten-5',
        'light-blue lighten-4' => 'light-blue lighten-4',
        'light-blue lighten-3' => 'light-blue lighten-3',
        'light-blue lighten-2' => 'light-blue lighten-2',
        'light-blue lighten-1' => 'light-blue lighten-1',
        'light-blue' => 'light-blue',
        'light-blue darken-4' => 'light-blue darken-4',
        'light-blue darken-3' => 'light-blue darken-3',
        'light-blue darken-2' => 'light-blue darken-2',
        'light-blue darken-1' => 'light-blue darken-1',
        'light-blue accent-1' => 'light-blue accent-1',
        'light-blue accent-2' => 'light-blue accent-2',
        'light-blue accent-3' => 'light-blue accent-3',
        'light-blue accent-4' => 'light-blue accent-4',
        'cyan lighten-5' => 'cyan lighten-5',
        'cyan lighten-4' => 'cyan lighten-4',
        'cyan lighten-3' => 'cyan lighten-3',
        'cyan lighten-2' => 'cyan lighten-2',
        'cyan lighten-1' => 'cyan lighten-1',
        'cyan' => 'cyan',
        'cyan darken-4' => 'cyan darken-4',
        'cyan darken-3' => 'cyan darken-3',
        'cyan darken-2' => 'cyan darken-2',
        'cyan darken-1' => 'cyan darken-1',
        'cyan accent-1' => 'cyan accent-1',
        'cyan accent-2' => 'cyan accent-2',
        'cyan accent-3' => 'cyan accent-3',
        'cyan accent-4' => 'cyan accent-4',
        'teal lighten-5' => 'teal lighten-5',
        'teal lighten-4' => 'teal lighten-4',
        'teal lighten-3' => 'teal lighten-3',
        'teal lighten-2' => 'teal lighten-2',
        'teal lighten-1' => 'teal lighten-1',
        'teal' => 'teal',
        'teal darken-4' => 'teal darken-4',
        'teal darken-3' => 'teal darken-3',
        'teal darken-2' => 'teal darken-2',
        'teal darken-1' => 'teal darken-1',
        'teal accent-1' => 'teal accent-1',
        'teal accent-2' => 'teal accent-2',
        'teal accent-3' => 'teal accent-3',
        'teal accent-4' => 'teal accent-4',
        'green lighten-5' => 'green lighten-5',
        'green lighten-4' => 'green lighten-4',
        'green lighten-3' => 'green lighten-3',
        'green lighten-2' => 'green lighten-2',
        'green lighten-1' => 'green lighten-1',
        'green' => 'green',
        'green darken-4' => 'green darken-4',
        'green darken-3' => 'green darken-3',
        'green darken-2' => 'green darken-2',
        'green darken-1' => 'green darken-1',
        'green accent-1' => 'green accent-1',
        'green accent-2' => 'green accent-2',
        'green accent-3' => 'green accent-3',
        'green accent-4' => 'green accent-4',
        'light-green lighten-5' => 'light-green lighten-5',
        'light-green lighten-4' => 'light-green lighten-4',
        'light-green lighten-3' => 'light-green lighten-3',
        'light-green lighten-2' => 'light-green lighten-2',
        'light-green lighten-1' => 'light-green lighten-1',
        'light-green' => 'light-green',
        'light-green darken-4' => 'light-green darken-4',
        'light-green darken-3' => 'light-green darken-3',
        'light-green darken-2' => 'light-green darken-2',
        'light-green darken-1' => 'light-green darken-1',
        'light-green accent-1' => 'light-green accent-1',
        'light-green accent-2' => 'light-green accent-2',
        'light-green accent-3' => 'light-green accent-3',
        'light-green accent-4' => 'light-green accent-4',
        'lime lighten-5' => 'lime lighten-5',
        'lime lighten-4' => 'lime lighten-4',
        'lime lighten-3' => 'lime lighten-3',
        'lime lighten-2' => 'lime lighten-2',
        'lime lighten-1' => 'lime lighten-1',
        'lime' => 'lime',
        'lime darken-4' => 'lime darken-4',
        'lime darken-3' => 'lime darken-3',
        'lime darken-2' => 'lime darken-2',
        'lime darken-1' => 'lime darken-1',
        'lime accent-1' => 'lime accent-1',
        'lime accent-2' => 'lime accent-2',
        'lime accent-3' => 'lime accent-3',
        'lime accent-4' => 'lime accent-4',
        'yellow lighten-5' => 'yellow lighten-5',
        'yellow lighten-4' => 'yellow lighten-4',
        'yellow lighten-3' => 'yellow lighten-3',
        'yellow lighten-2' => 'yellow lighten-2',
        'yellow lighten-1' => 'yellow lighten-1',
        'yellow' => 'yellow',
        'yellow darken-4' => 'yellow darken-4',
        'yellow darken-3' => 'yellow darken-3',
        'yellow darken-2' => 'yellow darken-2',
        'yellow darken-1' => 'yellow darken-1',
        'yellow accent-1' => 'yellow accent-1',
        'yellow accent-2' => 'yellow accent-2',
        'yellow accent-3' => 'yellow accent-3',
        'yellow accent-4' => 'yellow accent-4',
        'amber lighten-5' => 'amber lighten-5',
        'amber lighten-4' => 'amber lighten-4',
        'amber lighten-3' => 'amber lighten-3',
        'amber lighten-2' => 'amber lighten-2',
        'amber lighten-1' => 'amber lighten-1',
        'amber' => 'amber',
        'amber darken-4' => 'amber darken-4',
        'amber darken-3' => 'amber darken-3',
        'amber darken-2' => 'amber darken-2',
        'amber darken-1' => 'amber darken-1',
        'amber accent-1' => 'amber accent-1',
        'amber accent-2' => 'amber accent-2',
        'amber accent-3' => 'amber accent-3',
        'amber accent-4' => 'amber accent-4',
        'orange lighten-5' => 'orange lighten-5',
        'orange lighten-4' => 'orange lighten-4',
        'orange lighten-3' => 'orange lighten-3',
        'orange lighten-2' => 'orange lighten-2',
        'orange lighten-1' => 'orange lighten-1',
        'orange' => 'orange',
        'orange darken-4' => 'orange darken-4',
        'orange darken-3' => 'orange darken-3',
        'orange darken-2' => 'orange darken-2',
        'orange darken-1' => 'orange darken-1',
        'orange accent-1' => 'orange accent-1',
        'orange accent-2' => 'orange accent-2',
        'orange accent-3' => 'orange accent-3',
        'orange accent-4' => 'orange accent-4',
        'deep-orange lighten-5' => 'deep-orange lighten-5',
        'deep-orange lighten-4' => 'deep-orange lighten-4',
        'deep-orange lighten-3' => 'deep-orange lighten-3',
        'deep-orange lighten-2' => 'deep-orange lighten-2',
        'deep-orange lighten-1' => 'deep-orange lighten-1',
        'deep-orange' => 'deep-orange',
        'deep-orange darken-4' => 'deep-orange darken-4',
        'deep-orange darken-3' => 'deep-orange darken-3',
        'deep-orange darken-2' => 'deep-orange darken-2',
        'deep-orange darken-1' => 'deep-orange darken-1',
        'deep-orange accent-1' => 'deep-orange accent-1',
        'deep-orange accent-2' => 'deep-orange accent-2',
        'deep-orange accent-3' => 'deep-orange accent-3',
        'deep-orange accent-4' => 'deep-orange accent-4',
        'brown lighten-5' => 'brown lighten-5',
        'brown lighten-4' => 'brown lighten-4',
        'brown lighten-3' => 'brown lighten-3',
        'brown lighten-2' => 'brown lighten-2',
        'brown lighten-1' => 'brown lighten-1',
        'brown' => 'brown',
        'brown darken-4' => 'brown darken-4',
        'brown darken-3' => 'brown darken-3',
        'brown darken-2' => 'brown darken-2',
        'brown darken-1' => 'brown darken-1',
        'grey lighten-5' => 'grey lighten-5',
        'grey lighten-4' => 'grey lighten-4',
        'grey lighten-3' => 'grey lighten-3',
        'grey lighten-2' => 'grey lighten-2',
        'grey lighten-1' => 'grey lighten-1',
        'grey' => 'grey',
        'grey darken-4' => 'grey darken-4',
        'grey darken-3' => 'grey darken-3',
        'grey darken-2' => 'grey darken-2',
        'grey darken-1' => 'grey darken-1',
        'blue-grey lighten-5' => 'blue-grey lighten-5',
        'blue-grey lighten-4' => 'blue-grey lighten-4',
        'blue-grey lighten-3' => 'blue-grey lighten-3',
        'blue-grey lighten-2' => 'blue-grey lighten-2',
        'blue-grey lighten-1' => 'blue-grey lighten-1',
        'blue-grey' => 'blue-grey',
        'blue-grey darken-4' => 'blue-grey darken-4',
        'blue-grey darken-3' => 'blue-grey darken-3',
        'blue-grey darken-2' => 'blue-grey darken-2',
        'blue-grey darken-1' => 'blue-grey darken-1',
        'mdb-color lighten-5' => 'mdb-color lighten-5',
        'mdb-color lighten-4' => 'mdb-color lighten-4',
        'mdb-color lighten-3' => 'mdb-color lighten-3',
        'mdb-color lighten-2' => 'mdb-color lighten-2',
        'mdb-color lighten-1' => 'mdb-color lighten-1',
        'mdb-color' => 'mdb-color',
        'mdb-color darken-4' => 'mdb-color darken-4',
        'mdb-color darken-3' => 'mdb-color darken-3',
        'mdb-color darken-2' => 'mdb-color darken-2',
        'mdb-color darken-1' => 'mdb-color darken-1',
        'black' => 'black',
        'white' => 'white',
        'transparent' => 'transparent',
        'rgba-blue-light' => 'rgba-blue-light',
        'rgba-red-light' => 'rgba-red-light',
        'rgba-pink-light' => 'rgba-pink-light',
        'rgba-purple-light' => 'rgba-purple-light',
        'rgba-indigo-light' => 'rgba-indigo-light',
        'rgba-cyan-light' => 'rgba-cyan-light',
        'rgba-teal-light' => 'rgba-teal-light',
        'rgba-green-light' => 'rgba-green-light',
        'rgba-lime-light' => 'rgba-lime-light',
        'rgba-yellow-light' => 'rgba-yellow-light',
        'rgba-orange-light' => 'rgba-orange-light',
        'rgba-brown-light' => 'rgba-brown-light',
        'rgba-grey-light' => 'rgba-grey-light',
        'rgba-blue-grey-light' => 'rgba-blue-grey-light',
        'rgba-black-light' => 'rgba-black-light',
        'rgba-stylish-light' => 'rgba-stylish-light',
        'rgba-white-light' => 'rgba-white-light',
        'rgba-blue-strong' => 'rgba-blue-strong',
        'rgba-red-strong' => 'rgba-red-strong',
        'rgba-pink-strong' => 'rgba-pink-strong',
        'rgba-purple-strong' => 'rgba-purple-strong',
        'rgba-indigo-strong' => 'rgba-indigo-strong',
        'rgba-cyan-strong' => 'rgba-cyan-strong',
        'rgba-teal-strong' => 'rgba-teal-strong',
        'rgba-green-strong' => 'rgba-green-strong',
        'rgba-lime-strong' => 'rgba-lime-strong',
        'rgba-yellow-strong' => 'rgba-yellow-strong',
        'rgba-orange-strong' => 'rgba-orange-strong',
        'rgba-brown-strong' => 'rgba-brown-strong',
        'rgba-grey-strong' => 'rgba-grey-strong',
        'rgba-blue-grey-strong' => 'rgba-blue-grey-strong',
        'rgba-black-strong' => 'rgba-black-strong',
        'rgba-stylish-strong' => 'rgba-stylish-strong',
        'rgba-white-strong' => 'rgba-white-strong',
        'rgba-blue-slight' => 'rgba-blue-slight',
        'rgba-red-slight' => 'rgba-red-slight',
        'rgba-pink-slight' => 'rgba-pink-slight',
        'rgba-purple-slight' => 'rgba-purple-slight',
        'rgba-indigo-slight' => 'rgba-indigo-slight',
        'rgba-cyan-slight' => 'rgba-cyan-slight',
        'rgba-teal-slight' => 'rgba-teal-slight',
        'rgba-green-slight' => 'rgba-green-slight',
        'rgba-lime-slight' => 'rgba-lime-slight',
        'rgba-yellow-slight' => 'rgba-yellow-slight',
        'rgba-orange-slight' => 'rgba-orange-slight',
        'rgba-brown-slight' => 'rgba-brown-slight',
        'rgba-grey-slight' => 'rgba-grey-slight',
        'rgba-blue-grey-slight' => 'rgba-blue-grey-slight',
        'rgba-black-slight' => 'rgba-black-slight',
        'rgba-stylish-slight' => 'rgba-stylish-slight',
        'rgba-white-slight' => 'rgba-white-slight',
        'aqua-gradient' => 'aqua-gradient',
        'purple-gradient' => 'purple-gradient',
        'peach-gradient' => 'peach-gradient',
        'blue-gradient' => 'blue-gradient'
    ];


    public function asset()
    {

    }


    public function codes()
    {
        $isCardHeader = !($this->_config['isCardHeader']) ? $this->jscode('d-none') : $this->jscode('d-block');
        $isHorOrVer = $this->_config['horizontal_OR_vertical'] === 'horizontal' ? $this->jscode('d-block') : $this->jscode('d-flex');


        $this-> layout = [
            'textLeft' => <<<HTML
            <div id="{$this->id}">
        <div class="card" >
            <div class="{$isCardHeader}">
                <h3>My title</h3>
            </div>
            <div class="card-body  " style="padding: 0!important;">
                 
                <div class=" {$isHorOrVer} {$this->_config['color']}">
                    <div class="card-content w-75 {$this->_config['color']}">
                         <div>
                            <h1 class="titleText">{$this->_config['title']}</h1>
                            <p class="card-text myClass">{$this->_config['text']}</p> 
                        </div>
                    </div>
                    <div class="card-icon  element-text">
                            <i class="icon {$this->_config['icon']}"></i>
                            
                    </div>
                </div>
                    <div class="card-text card-footer {$this->_config['cardfooterColor']} elementcenter footerOfCard"><a class="card-text" href="">{$this->_config['footerText']}</a>
                        <sup class="badge {$this->_config['badge']}">{$this->_config['counter']}</sup>
                    </div>
                
            </div>
        
        </div>
        </div>

HTML,
            'textRight' => <<<HTML
        <div id="{$this->id}">
        <div class="card" >
            <div class="{$isCardHeader}">
                <h3>My title</h3>
            </div>
            <div class="card-body  " style="padding: 0!important;">
                 
                <div class=" {$isHorOrVer} {$this->_config['color']}">
                
                    <div class="card-icon element-text">
                            <i class="icon {$this->_config['icon']}"></i>
                            
                    </div>
                    <div class="card-content w-75 {$this->_config['color']}">
                         <div class="text-right">
                            <h1 class="titleText">{$this->_config['title']}</h1>
                            <p class="card-text myClass">{$this->_config['text']}</p> 
                        </div>
                    </div>
                    
                </div>
                    <div class="card-text card-footer {$this->_config['cardfooterColor']} elementcenter footerOfCard"><a class="card-text" href="">{$this->_config['footerText']}</a>
                        <sup class="badge {$this->_config['badge']}">{$this->_config['counter']}</sup>
                    </div>
                
            </div>
        
        </div>
        </div>
HTML,
            'todoList' => <<<HTML
            <div class="panel widget panel-bd-top vd_todo-widget light-widget">
  <div class="panel-heading no-title ">
    <div class="vd_panel-menu">
  <div data-action="refresh" class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Refresh"> <i class="icon-cycle"></i> </div>
  <div class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Config">
    <div data-action="click-trigger" class="menu-trigger"><i class="icon-cog"></i> </div>
    <div class="vd_mega-menu-content  width-xs-2  left-xs" data-action="click-target">
      <div class="child-menu">
        <div class="content-list content-menu">
          <ul class="list-wrapper pd-lr-10">
            <li> <a href="#"> <div class="menu-icon"><i class="fa fa-user"></i></div> <div class="menu-text">Panel Menu</div> </a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="menu entypo-icon" data-placement="bottom" data-toggle="tooltip" data-original-title="Close" data-action="close"> <i class="icon-cross"></i> </div>
</div>
<!-- vd_panel-menu --> 
 
  </div>
  <div class="panel-body">
    <h2 class="mgbt-xs-20"> <span class="append-icon"> <i class="fa fa-check-circle-o vd_green"></i> </span> Todo List</h2>
    <div class="input-group mgbt-xs-15">
      <input type="text">
      <div class="input-group-btn">
        <button data-toggle="dropdown" class="btn dropdown-toggle vd_bg-green vd_white" type="button"><i class="fa fa-plus fa-fw"></i></button>
      </div>
      <!-- /btn-group --> 
    </div>
    <div class="controls">
      <div class="vd_checkbox checkbox-done">
        <input type="checkbox" id="checkbox-1" value="1">
        <label for="checkbox-1"> Basketball time </label>
      </div>
      <div class="vd_checkbox  checkbox-done">
        <input type="checkbox" id="checkbox-2" value="1">
        <label for="checkbox-2"> Design Logo for customer</label>
      </div>
      <div class="vd_checkbox  checkbox-done">
        <input type="checkbox" id="checkbox-3" value="1">
        <label for="checkbox-3"> Cooking delicious meal</label>
      </div>
      <div class="vd_checkbox  checkbox-done">
        <input type="checkbox" id="checkbox-4" value="1">
        <label for="checkbox-4"> Sleeping with my pillow</label>
      </div>
      <div class="row mgtp-15 mgbt-xs-0">
        <div class="col-xs-6"> <a role="button" href="#" class="btn vd_btn vd_bg-green">Save</a> </div>
        <div class="col-xs-6 text-right"> <a role="button" href="#" class="btn vd_btn vd_bg-grey"><i class="icon-trash"></i></a> </div>
      </div>
    </div>
  </div>
</div>
HTML,
             'linkCard' => <<<HTML
            <a href="{$this->_config['url']}" class="click_btn">
            <div id="{$this->id}">
           
            <div class="card" >
                <div class="{$isCardHeader}">
                    <h3>My title</h3>
                </div>
                <div class="card-body  " style="padding: 0!important;">
                     
                    <div class=" {$isHorOrVer} {$this->_config['color']}">
                       <div class="card-icon element-text">
                            <i class="icon {$this->_config['icon']}"></i>
                            
                         </div>
                        <div class="card-content {$this->_config['color']}">
                                
                                <p class="card-text myClass">{$this->_config['text'] }</p>                  
                        </div>
                        
                        
                    </div>
                    
                    
                    
                </div>
            
            </div>

            </div>  
          </a>
HTML,

        ];


        $this->css = <<<CSS
            
            
            .elementcenter{
                text-align: center;
            }
            
            .icon-element{
                    font-size: 24px;
                    color:{$this->_config['color']};            
            }
            
            .icon{
                font-size: 90px;
            }
            
            .element-text{
            color: white!important;
            padding: 10px;
            font-size: 20px!important;
            font-weight: bold;
            }
            
            .card-text{
               color: white!important;
            }
            
            
            
            .card-content{
                color: white!important;
                    text-align: center;
                    width: 100%;
                    padding: 35px 15px 30px 15px;
                    min-height: 158px;
            }
            
            .card-icon{
                margin: auto;
                padding-right: 15px;
                padding-left: 15px;
            }
            
            .footerOfCard a{
                font-size: 20px!important;
                
            }
            
            .myClass{
                font-size: 20px!important;
            }
            
            .titleText{
                font-size: 75px;
                font-weight: bold;
            }
            
            
            
            
            
            '#{$this->id}'{
                width: {$this->_config['cardWidth']};
                
            }
             
            
    CSS;
        if($this->_config['visible'])
            $this->htm = $this->layout[$this->_config['type']];


    }



}
