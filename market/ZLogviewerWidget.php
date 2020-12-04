<?php

/**
 *
 *
 * Author:  Sa'dulla Xolmatov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZLogviewerWidget extends ZWidget

{
    public $config = [];
    public $_config = [

        'title' => 'show only lines containing the phrase',

    ];

    public $event = [];
    public $_event = [

        'load' => "function(){console.log('loaded')}",
        'highlight' => "function(){console.log('highlight')}",
        'selectfilter' => "function(){console.log('selectfilter')}",
        'persist' => "function(){console.log('persist')}",
        'group' => "function(){console.log('group')}",
        'reload' => "function(){console.log('reload')}",
        'flipfilter' => "function(){console.log('flipfilter')}",
        'filter' => "function(){console.log('filter')}",
        'restart' => "function(){console.log('restart')}",
        'repaint' => "function(){console.log('repaint')}",
        'openfileif' => "function(){console.log('openfileif')}",
        'mouseup' => "function(){console.log('mouseup')}",

    ];


    public $layout = [];
    public $_layout = [

        'body' => <<<HTML
    
    <body onload="load()" >

        <div  class="content_load">

            <div id="toolbar" class="toolbar">

                <input class="search" id="search" type="text" onmousedown="selectfilter(0)">

                <div class="button2" onclick="highlight()" title="apply changes in the search box">apply</div>

                <div class="button2" onclick="persist()" title="pin this higlight filter">pin</div>

                <div class="button2" onclick="group()" title="group this filter with other pinned one">pin to...</div>

                <div class="persistents" id="persistents"></div>
                
                <div class="button_right" onclick="reload()" title="reload this file">reload</div>

                <div class="button_right" onclick="flipfilter(event)" title="disable/enable selected filters">filters on</div>

                <br/>

                <div class="button" onclick="filter()" title="{title}">filter</div>

                <div class="button" onclick="restart()" title="clear the search box">clear</div>

                <div class="hint"   onclick="repaint()" id="hint"></div>

                <div class="hint"   onclick="repaint()" id="position"></div>

                <input type="file" class="filebtn" id="file" onchange="openfileif(this);"/>

            </div>

            <div id="renderer" class="log" onmouseup="mouseup(event)"><div>nothing loaded</div></div>

        </div>

    </body>
            
HTML,

        'js' => <<<JS
              
JS,
        'event' => <<<JS
             $('#{id}')
            .on('load', {load})
            .on('highlight', {highlight})
            .on('selectfilter', {selectfilter})
            .on('group', {group})
            .on('reload', {reload})
            .on('flipfilter',{flipfilter})
            .on('filter',{filter})
            .on('restart',{restart}) 
            .on('repaint',{repaint}) 
            .on('openfileif',{openfileif}) 
            .on('mouseup',{mouseup}) 
            
JS,

      


    ];

    public function asset()
    {
        $this->fileJs('/render/market/ZLogviewerWidget/assets/custom.js');
    }

    public function codes()
    {
        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{highlight}' => $this->eventCode('highlight'),
            '{load}' => $this->eventCode('load'),
            '{selectfilter}' => $this->eventCode('selectfilter'),
            '{persist}' => $this->eventCode('persist'),
            '{group}' => $this->eventCode('group'),
            '{reload}' => $this->eventCode('reload'),
            '{flipfilter}' => $this->eventCode('flipfilter'),
            '{filter}' => $this->eventCode('filter'),
            '{restart}' => $this->eventCode('restart'),
            '{repaint}' => $this->eventCode('repaint'),
            '{openfileif}' => $this->eventCode('openfileif'),
            '{mouseup}' => $this->eventCode('mouseup'),
        ]);


        $this->htm = strtr($this->_layout['body'], [
            'title' => $this->_config['title'],
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);

        


        /*$this->htm = strtr($this->_config['class'],[
            '{class}' => $this->_config['class']
        ]);*/
    }
}
