<?php


namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZSearchNavbarWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config =[];
    public $_config =[
             'type'=> 'search',
             'url'=> 'route'
             

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */


    public $event =[];
    public $_event=[];


    public function asset()
    {
    }

    public $layout=[];
    public $_layout=[
       'main' => <<<HTML

   
        <form action="{route}" method="get" class="">
    <div class="input-group">
        
        <input type="search"  id="searchbar" name="q" class="rounded-0 form-control search-bar" placeholder="Поиск" aria-label="Searchbar">
        
        <div class=" input-group-append  bg-transparent">
            <button type="submit" class="rounded-0 input-group-text bg-transparent"><i class="green-text fa fa-search"></i></button>
        </div>
    </div>
    </form>


HTML,


        'css' => <<<CSS

CSS,
        'js' => <<<JS
        
    var searchBar = $('#searchbar.form-control');
    var elX = searchBar.next('div').find('button');
    function setOnCss(){
        searchBar.css({'border-color': '#10b410'});
        elX.css({'border-color': '#10b410'});
    }
    function setOffCss(){
        searchBar.css({'border-color': '#ced4da'})
        elX.css({'border-color': '#ced4da'})
    }

    searchBar.on('click', function () {
        setOnCss();
    })
    searchBar.keydown(function () {
        setOnCss();
    })
    function clearOut() {
           setOffCss();
    }
    elX.on('click', clearOut);
JS,

    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        '{type}' => $this->_config['type'],


        ]);

        $this->js = strtr($this->_layout['js'], []);

        $this->css = strtr($this->_layout['css'], []);

    }
}
