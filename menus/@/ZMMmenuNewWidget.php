<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;

/*use zetsoft\system\helpers\ZJsonHelper;*/


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMMmenuNewWidget extends  ZWidget
{
    public $config = [];
    public $_config = [
        'name' => '',
        'isName' => true,
        'isAll' => true,
        'isApp' => true,
        'menu_ids' => [],
        'cssTheme' => ZMMmenuNewWidget::cssTheme['light'],
        'theme'    => ZMMmenuNewWidget::theme['theme-dark'],
        'pagedim'  => ZMMmenuNewWidget::pagedim['pagedim-black'],
        'dividers.add' => false,
        'dropdowns.drop' => false,
        'counters.add' => true,
        'counters.count' => true,
        'pageScroll.scroll' => true,
        'content.img.width' => 300,
        'menu-effect-slide' => true,
        'iconbar.use' => false,
        'iconbar.top' => [

        ],
        'iconbar.bottom' => [
        ],

        'all.border' => ZMMmenuNewWidget::border['border-none'],
        'position'   => ZMMmenuNewWidget::position['position-back'],
        'shadows'    => ZMMmenuNewWidget::shadows['shadow-page'],
        'fx-slides'  => ZMMmenuNewWidget::fx_slide['fx-panels-slide-0'],

        "tileview" => false,
        "listview-justify" => false,
        "multiline" => false,
        'fullscreen' => false,


        'p-left' => 'left',
        'p-right' => 'right',
        'p-top' => 'top',
        'p-bottom' => 'bottom'

    ];

    public const cssTheme = [
        'light' => 'light',
        'dark' => 'dark',
        'eyuf' => 'eyuf',
    ];

    public const theme = [
        'theme-white' => 'theme-white',
        'theme-dark' => 'theme-dark',
        'theme-light' => 'theme-light',
        'theme-black' => 'theme-black',
        'theme-eyuf' => 'theme-eyuf',
    ];

    public const border = [
        'border-full' => 'border-full',
        'border-none' => 'border-none',
    ];

    public const pagedim = [
        'pagedim-black' => 'pagedim-black',
        'pagedim-white' => 'pagedim-white',
        'pagedim' => 'pagedim'
    ];

    public const position = [
        'position-back' => 'position-back',
        'position-top' => 'position-top',
        'position-right' => 'position-right',
        'position-front' => 'position-front',
        'position-bottom' => 'position-bottom'
    ];

    public const shadows = [
        'shadow-page' => 'shadow-page',
        'shadow-panels' => 'shadow-panels',
        'shadow-menu' => 'shadow-menu'
    ];

    public const fx_slide = [
        'fx-panels-slide-100' => 'fx-panels-slide-100',
        'fx-panels-slide-0' => 'fx-panels-slide-0',
        'fx-panels-none' => 'fx-panels-none'
    ];

    public $event = [];

    public $_event = [
        'openPanel:start' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:start: " + panel.id) }',
        'openPanel:finish' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:finish: " + panel.id) }',
        'closeAllPanels:before' => 'function (event) { console.log("ZALLMmenuWidget | closeAllPanels:before: " + panel.id) }',
        'closeAllPanels:after' => 'function (event) { console.log("ZALLMmenuWidget | closeAllPanels:after: " + panel.id) }',
        'closePanel:before' => 'function (event) { console.log("ZALLMmenuWidget | closePanel:before: " + panel.id) }',
        'closePanel:after' => 'function (event) { console.log("ZALLMmenuWidget | closePanel:after: " + panel.id) }',
        'openPanel:before' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:before: " + panel.id) }',
        'openPanel:after' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:after: " + panel.id) }',
        'setSelected:before' => 'function (event) { console.log("ZALLMmenuWidget | setSelected:before: " + panel.id) }',
        'setSelected:after' => 'function (event) { console.log("ZALLMmenuWidget | setSelected:after: " + panel.id) }',
    ];


    public function asset()
    {
    

        $this->fileCss('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/fix-modal.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css');

        $theme = $this->_config['theme'];
        $this->fileCss("/render/menus/ZMMmenuWidget/assets/mmenu-theme/$theme.css");

        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.13/dist/mmenu.polyfills.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.8/dist/mmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.js');

        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/fix-modal.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu-theme/theme_eyuf.css');
 


    }

 

    /**
     * Recursively renders the menu items (without the container tag).
     * @param $items
     * @return string the rendering result
     */
    public function all($items)
    {
        $lines = [];



        foreach ($items as $item) {
        
            if ($item->visible === false)
                continue;

                $menu = $this->item($item);

            if (!empty($item->items)) {
                $menu .= strtr($this->layout['subMenuTemplate'], [
                    '{items}' => $this->all($item->items),
                ]);
            }

                  
            $lines[] = ZHTML::tag('li', $menu, []);
        }

        return implode("\n", $lines);
    }

    public function item($item)
    {
        $data_id = uniqid('', true);

        if (!empty($item->items))
            $linkTemplate = $this->layout['linkTemplateItem'];
        else {
            if ($item->target === '_blank')
                $linkTemplate = $this->layout['linkTemplateBlank'];
            else
                $linkTemplate = $this->layout['linkTemplate'];
        }

        if ($item->icon === 'empty' || empty($item->icon))
            $item->icon = Az::$app->utility->mains->icon(true);

        $icon = strtr($this->layout['defaultIcon'], [
            '{icon}' => $item->icon
        ]);

        $class = str_replace(',', ' ', $item->class);

        $replace = [
            '{data-id}' => 'data-id="' . $data_id . '"',
            '{class}' => $class,
            '{url}' => (!empty($item->url)) ? $item->url : '#',
            '{label}' => $item->title,
            '{icon}' => $icon
        ];

        return strtr($linkTemplate, $replace);

    }

    /**
     * @inheritdoc
     */

    public function codes()
    {

        if($this->_config['isAll'] ) {
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );
        }



        $role = $this->userRole();
        $url = Az::$app->App->eyuf->user->getMainUrl();
        //    $url = ZUrl::to($url);
        $url = ZUrl::to([$url]);

        $this->layout = [

            'main' => <<<HTML
 <nav id="menu"  style="">
    <ul class="listview-icons">
        <li>
            <a href="{$url}"></i>{home}</a>
        </li>
        {content}
	</ul>
</nav>
HTML,

            'linkTemplate' => <<<HTML
                <a href="{url}" class="{class}">{icon}&nbsp;&nbsp; {label}</a>
HTML,
            'linkTemplateBlank' => <<<HTML
                  <a href="{url}" class="{class}" target="_blank">{icon}&nbsp;&nbsp; {label}</a>
HTML,
            'linkTemplateItem' => <<<HTML
                  <a {data-id} class="{class}" href="{url}">{icon}&nbsp;&nbsp; {label} </a>
HTML,
            'subMenuTemplate' => <<<HTML
       <ul class="treeview-menu">{items}</ul> 
HTML,

            'defaultIcon' => <<<HTML
                 <i class="{icon}"></i>
HTML,

        ];

        $this->js = strtr($this->js, [

            '{dividers.add}' => $this->jscode($this->_config['dividers.add']),
            '{dropdowns.drop}' => $this->jscode($this->_config['dropdowns.drop']),
            '{counters.add}' => $this->jscode($this->_config['counters.add']),
            '{counters.count}' => $this->jscode($this->_config['counters.count']),
            '{pageScroll.scroll}' => $this->jscode($this->_config['pageScroll.scroll']),
            '{navbar.title}' => $this->jscode(Az::l('Главное меню')),
            '{content.img.width}' => $this->jscode($this->_config['content.img.width']),

            '{all.theme}' => $this->jscode($this->_config['theme']),
            '{pagedim}' => $this->jscode($this->_config['pagedim']),

            '{iconbar.use}' => $this->jscode($this->_config['iconbar.use']),
            '{iconbar.top}' => $this->jscode($this->_config['iconbar.top']),
            '{iconbar.bottom}' => $this->jscode($this->_config['iconbar.bottom']),

            '{all.border}' => $this->jscode($this->_config['all.border']),
            '{position}' => $this->jscode($this->_config['position']),
            '{shadows}' => $this->jscode($this->_config['shadows']),
            '{fx-slides}' => $this->jscode($this->_config['fx-slides']),

            '{tileview}' => ($this->_config['tileview']) ? ($this->jscode('tileview')) : '',
            '{menu-effect-slide}' => ($this->_config['menu-effect-slide']) ? ($this->jscode('fx-menu-slide')) : '',
            '{listview-justify}' => ($this->_config['listview-justify']) ? ($this->jscode('listview-justify')) : '',
            '{multiline}' => ($this->_config['multiline']) ? ($this->jscode('multiline')) : '',
            '{fullscreen}' => ($this->_config['fullscreen']) ? ($this->jscode('fullscreen')) : '',

            '{p-right}' => $this->jscode($this->_config['p-right']),
            '{p-left}' => $this->jscode($this->_config['p-left']),
            '{p-top}' => $this->jscode($this->_config['p-top']),
            '{p-bottom}' => $this->jscode($this->_config['p-bottom']),

            /**
             *
             * Events
             */
            //  '{openPanel:start}' => $this->eventCode('openPanel:start'),
            '{openPanel:start}' => $this->eventCode('openPanel:start'),


        ]);

        $this->js .= <<<JS
 
 
/*
$(function () {
    var e, t, n = $(window), i = ($("html"),
        $("body")), a = $("body, html");
    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1)
    },

        function () {
          
        }()
});
*/


$(document).ready(function() {

                  var options = {
                "extensions": {
                    all: [
                        "{all.theme}", //  theme-dark | theme-black | theme-light  / theme-eyuf
                        "{pagedim}", // pagedim-black | pagedim-white | pagedim
                        
                        /*
                        * https://mmenujs.com/docs/extensions/border-style.html
                        */
                       
                        "{all.border}", // border-none | border-full

                        "{position}", // position-back / "position-right"  | position-top | position-bottom | position-front 
                        "{shadows}",  // shadow-page | shadow-menu | shadow-panels

                        /* TO USE EFFECTS ENABLE "menu-effect-slide" (P.S the same with  the 'fx-menu-slide' */
                        "{menu-effect-slide}",
                        "{fx-slides}",// "fx-panels-none",// fx-panels-slide-0 | fx-panels-slide-100 / fx-menu-slide,
                        
                        //  "{istileview}", / tileview : true
                        // "{fullscreen}", / fullscreen
                       
                        //  "{multiline}" // "multiline",
                        //  "{islistview-justify}" //   "listview-justify" : true,


                    ],
                },
                hooks: {
                    "openPanel:start": {openPanel:start},
                    "openPanel:finish": (panel) => {
                        console.log("Finished opening panel: " + panel.id);
                    },
                    "closeAllPanels:before": (panel) => {
                        console.log("Before closing all panel: " + panel.id);
                    },
                    "closeAllPanels:after": (panel) => {
                        console.log("After closing all panel: " + panel.id);
                    },
                    "closePanel:before": (panel) => {
                        console.log("Before closing panel: " + panel.id);
                    },
                    "closePanel:after": (panel) => {
                        console.log("After closing panel: " + panel.id);
                    },
                    "openPanel:before": (panel) => {
                        console.log("Before opening panel xx: " + panel.id);
                    },
  
                    "openPanel:after": (panel) => {
                        console.log("After opening panel: " + panel.id);
                    },
                    "setSelected:before": (panel) => {
                        console.log("Before set selected: " + panel.id);
                    },
                    "setSelected:after": (panel) => {
                        console.log("After set selected: " + panel.id);
                    },

                },
                /*
                * https://mmenujs.com/docs/addons/dividers.html
                */
                "dividers": {
                    add: {dividers.add},
                    addTo: "panels"
                },
                /*
                * https://mmenujs.com/docs/addons/drag.html
                */
                drag: {
                    open: false,
                    node: null
                },
                /*"sectionIndexer": false,*/
                /*
                * https://mmenujs.com/docs/addons/dropdown.html
                */
                
                "dropdown": {
                    drop: {dropdowns.drop},
                    event: "click", // hover | click hover | hover click      e
                    fitViewport: true,
                    position: {
                        of: null,
                        x: "left",
                        y: "bottom"  // bottom
                    },
                    tip: false,
                    offset: {
                        button: {
                            x: 100,
                            y: 100
                        }
                    },
                    viewport: {
                        x: 20,
                        y: 20
                    },

                },
                /*
                * https://mmenujs.com/docs/addons/fixed-elements.html
                */
                fixedElements: {
                    insertMethod: "append", // "prepend"
                    insertSelector: "body"
                },


                /*
                * https://mmenujs.com/docs/addons/iconbar.html
                */
               /* iconbar: {
                    use: {iconbar.use},
                    position: "{p-left}", // right , left
                    top: {iconbar.top},
                    bottom: {iconbar.bottom},
                    type: null // "tabs"
                },*/

                rag: {
                    open: false
                },
                // https://mmenujs.com/docs/addons/back-button.html
                backButton: {
                    close: true
                },
                // https://mmenujs.com/docs/addons/columns.html
                columns: {
                    add: false,
                    visible: {
                        max: 3,
                        min: 1
                    }
                },
                /*
                * https://mmenujs.com/docs/addons/auto-height.html
                */
                autoHeight: {
                    height: "default" // auto | highest
                },

                pageScroll: {
                    scroll: {pageScroll.scroll},
                    update: false
                },
                
                /*
                * https://mmenujs.com/docs/addons/counters.html
                */

                counters: {
                    add: {counters.add},
                    addTo: "panels",
                    count: {counters.count}
                },
                /*
                * https://mmenujs.com/docs/addons/keyboard-navigation.html
                */
                keyboardNavigation: {
                    enable: false,
                    enhance: false
                },

                /*
                * https://mmenujs.com/docs/addons/icon-panels.html
                */
                iconPanels: {
                    add:false,
                    hideDivider: true,
                    hideNavbar: false,
                    visible: "first" // max 3
                },
                /*"navbar": false,*/

                navbar: {
                    title: "{navbar.title}",
                    add: true,
                    sticky: true,
                    titleLink: "parent", // anchor | none
                },

                onClick: {
                    close: false,
                    preventDefault: null, // true | false
                    setSelected: true,
                },
                slidingSubmenus: true,
                wrappers: [],
                
                /*
                * https://mmenujs.com/docs/addons/navbars.html
                */
                navbars: [
                    {
                        content: [
                            '<div class="zlogo"><img src="/zetimg/<?=App?>/logo.jpg" width="{content.img.width}"></div>'
                        ],
                        position: "{p-top}"
                    },
                    {
                        use: true,
                        content: [
                            'searchfield', // breadcrumbs | close | next | prev | searchfield | title 
                        ],
                        position: "{p-top}", // bottom
                        type: null // tabs
                        // {...} objects
                    },
                    {
                        content: [
                            'breadcrumbs', 'prev'/*, 'next'*/
                        ]
                    }
                    
                ],
                /*
                * https://mmenujs.com/docs/addons/lazy-submenus.html
                */
                lazySubmenus: {
                    load: false
                },

                /**
                 *
                 * https://mmenujs.com/docs/addons/searchfield.html
                 */
                searchfield: {
                    add: true,
                    addTo: "panels",// panel
                    cansel: true,
                    noResults: "No results found.", //false
                    placeholder: "Найти", // something
                    search: true,
                    showSubPanels: true,
                    showTextItems: true,
                    panel: {
                        add: false,
                        dividers: true,
                        fx: "none",
                        id: null,
                        splash: null,
                        title: "search",
                    },
                },
                /*
                * https://mmenujs.com/docs/addons/set-selected.html
                */
                setSelected: {
                    current: true,
                    hover: !0,
                    parent: !0
                },
                /*
                * https://mmenujs.com/docs/addons/sidebar.html
                */
                sidebar: {
                    collapsed: {
                        use: 768, // true , false , usable meausure (example: 768 ) 
                        blockMenu: true,  // false
                        hideNavbar: true, // false
                        hideDivider: false // true
                    },
                    /* expanded:{
                         use: false,
                         initial: "open" // remember
                     },
 */
                    expanded: {
                        use: 1440, // false, //true  usable meausure (example: 1440 )
                        initial: "remember" // open
                    }
                },

                /*
                * https://mmenujs.com/docs/core/options.html
                */
            };

            var configs = {
                offCanvas: {
                    page: {
                        selector: "#page"
                    }
                },
                /**
                 * https://mmenujs.com/docs/addons/searchfield.html
                 */
                "searchfield": {
                    "clear": true,
                      form: null, // false
                     input: null,
                     submit: true  
                },
                autoHeight: {
                    // auto height options
                },
                navbars: {
                    breadcrumbs: {
                        separator: "/",
                        removeFirst: false
                    }
                },
                /*height: {
                    // max: 40     iconPanels
                }, */
                width: {
                    // max: 40
                },
                /*
                * https://mmenujs.com/docs/addons/page-scroll.html
                */
                pageScroll: {
                    scrollOffset: 0,
                    updateOffset: 50
                }

            };

            var menu = new Mmenu("#menu", options, configs);
            var api = menu.API;
            var t = $("#hamburger").children(".mburger");
            api.bind("close:finish", function () {
                setTimeout(function () {
                    t.attr("href", "#menu");
                }, 100)
            }),
                api.bind("open:finish", function () {
                    setTimeout(function () {
                        t.attr("href", "#page");
                    }, 100)
                });


            $(function () {
                $('.mm-listitem').each(function () {
                    var firstchild = $(this).children('.mm-listitem__text');
                    var secondchild = $(this).children('.mm-btn');
                    var myhref = secondchild.attr("href");

                    firstchild.attr("href", myhref);
                    firstchild.addClass("mm-listitem__btn");

                });
            });
});

JS;

        $content = '';

        /** @var array $item */
        if (!empty($this->data))
            $content .= $this->all($this->data);

        $this->htm = strtr($this->layout['main'], [
            '{home}' => Az::l('Главная страница'),
            '{content}' => $content
        ]);


        $this->css = <<<CSS


.home-mmenu{
    margin-right: 12px !important;
}

CSS;


    }

}
