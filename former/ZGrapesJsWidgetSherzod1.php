<?php


namespace zetsoft\widgets\former;

use yii\helpers\Html;
use zetsoft\dbitem\grap\GrapeBtnItem;
use zetsoft\dbitem\grap\GrapeToolbarItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZGrapesJsWidgetSherzod1 extends ZWidget
{

    public $service;

    public $config = [];
    public $_config = [
        'webSocket' => false,
        'wsUrl' => 'ws://localhost:1997',
        'autoAdd' => '1',
        'dropzone' => '0',
        'links' => [],
        'scripts' => [],
        'widgets' => [],
        'css' => '',
        'buttons' => null,
        'buttonsEx' => null,
        'tbButtons' => null,
        'templates' => [],
        'categories' => [
            'inputes',
            'former',
        ],
        'saveFile' => '',
        'theme' => ZGrapesJsWidget::themes['lightBlueTheme'],
        'lang' => ZGrapesJsWidget::langs['ru'],
        'tooltipTheme' => ZGrapesJsWidgetSherzod1::tooltipTheme['tooltipster-light'],
    ];

    public const tooltipTheme = [
        'tooltipster-borderless' => 'tooltipster-borderless',
        'tooltipster-light' => 'tooltipster-light',
        'tooltipster-noir' => 'tooltipster-noir',
        'tooltipster-punk' => 'tooltipster-punk',
        'tooltipster-shadow' => 'tooltipster-shadow',

    ];

    public $active = [];
    public $_active = [
        'ready' => true,
        'component:add' => true,
        'component:mount' => false,
        'component:clone' => true,
        'component:update' => false,
        'property:compUpdate' => false,
        'component:styleUpdate' => true,
        'component:selected' => true,
        'component:toggled' => false,
        'component:remove' => true,

        'block:add' => false,
        'block:remove' => false,
        'block:dragStart' => true,
        'block:drag' => false,
        'block:dragStop' => false,

        'assets:add' => false,
        'assets:remove' => false,
        'assets:start' => false,
        'assets:end' => false,
        'assets:response' => false,
        'assets:error' => false,

        'keymap:add' => false,
        'keymap:remove' => false,
        'keymap:emit' => false,

        'emit:(id, alt + u, e)' => false,
        'styleManager:update:target' => true,
        'styleManager:change' => true,
        'styleManager:change:{propertyName}' => false,

        'storage:start' => false,
        'storage:start:store' => false,
        'storage:start:load' => false,
        'storage:load' => false,
        'storage:store' => false,
        'storage:end' => false,
        'storage:end:store' => false,
        'storage:end:load' => false,
        'storage:error' => false,
        'storage:error:store' => false,
        'storage:error:load' => false,

        'canvas:dragenter' => false,
        'canvas:dragover' => false,
        'canvas:drop' => false,
        'canvas:dragend' => false,
        'canvas:dragdata' => false,

        'selector:add' => true,
        'rte:enable' => false,
        'rte:disable' => false,
        'modal:open' => false,
        'modal:close' => false,

        'run:{commandName}' => false,
        'stop:{commandName}' => false,
        'run:{commandName}:before' => false,
        'stop:{commandName}:before' => false,
        'abort:{commandName}' => false,
        'run' => false,
        'run:tlb-move' => false,
        'stop' => false,
        'canvasScroll' => false,
        'obdev' => true,
        'update' => true,
        'undo' => true,
        'redo' => true,
        'load' => true,

        'property:styleUpdate' => false,
    ];

    public $event = [];
    public $_event = [];

    public $layout = [];
    public $_layout = [
        'html' => <<<HTML
        <div id="gjs" actions="{actionItem}" class="btn-style">
            {content} 
        </div>
        
        
        <div class="tooltip_templates" style="display: none;">
            {tooltip}        
        </div>
HTML,

        'tooltip' => <<<HTML
      
        <div id="{tooltipId}-tooltip" class="tooltip-div">
           
            <h4 class="tooltip-title">{title}</h4>
            <p class="tooltip-text">
                <i class="{icon}"></i>
                {content}
            </p>
           
        </div>
        
HTML,
        'main' => <<<JS

    {mainCodeForInit}
        
    const body = editor.Canvas.getDocument().body;
    body.insertAdjacentHTML('beforeend', `<style id="grape_style">{css}</style>`);
    
    const commands = editor.Commands;
    const blockManager = editor.BlockManager;
    
    commands.add('set-device-desktop', {
        run: function(ed) { ed.setDevice('Desktop') },
        stop: function() {},
    });
    
    commands.add('set-device-tablet', {
        run: function(ed) { ed.setDevice('Tablet') },
        stop: function() {},
    });
    
    commands.add('set-device-mobile', {
        run: function(ed) { ed.setDevice('Mobile portrait') },
        stop: function() {},
    });
    
    var panelManager = editor.Panels;
    
    var excludeCategories = [
        'Extra',
        'Basic',
        'Forms',
      
    ]
      
    const blocks = blockManager.getAll();
    const toRemove = blocks.filter(block =>  {
      
        var category = block.get('category')
        category.set('open', false)
        
        if (excludeCategories.includes(category.get('id')))
            return block
        
    });
    
    toRemove.forEach(block => blockManager.remove(block.get('id')))
      
    var visibilityBtn = panelManager.getButton('options', 'sw-visibility');
    visibilityBtn.set({
        className: 'fa fa-square',
    });
    
    panelManager.removeButton('options', 'export-template');
    panelManager.removeButton('options', 'gjs-open-import-webpage');
    panelManager.getButton('options', 'sw-visibility').set('active', 1);
    panelManager.getButton('views', 'open-sm').set({
        className: 'grape-tooltip fa fa-paint-brush'
    });
    panelManager.getButton('views', 'open-tm').set({
        className: 'grape-tooltip fa fa-cog',
    });
    panelManager.getButton('views', 'open-layers').set({
        className: 'grape-tooltip fa fa-bars'
    });
    panelManager.getButton('views', 'open-blocks').set({
        className: 'grape-tooltip fa fa-th-large',
    });
    
    {buttons}
    {columns}
    {blocks}
    {templates}
    
    {eventFunctions}
    
    editor.on('load', function(model) {
         loadEditor(model);
    }).on('component:add', function(model) {
         componentAdd(model);
    }).on('component:selected', function(model) {
         componentSelected(model);
    }).on('component:drag:end', function(model) {
         componentDragEnd(model);
    }).on('component:remove', function(model) {
        componentRemove(model);  
    }).on('component:drag', function(model) {
        componentDrag(model);
    }).on('component:styleUpdate', function(model) {
        componentStyleUpdate(model);
    }).on('component:deselected', function(model) {
         componentDeselected(model);
    })
          
    {saveFunc}
          
JS,
        'blocks' => <<<JS
    
        blockManager.add('{blockId}', {
            category: {
                label: '{category}',
                open: false,
            },
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{label}</div>
            </div>`,
            attributes: {
                class:'widgets grape-tooltip',
                'data-tooltip-content': '#{title}-tooltip',
            },
            content: {
                type: '{type}',                        
                name: '{name}',
                widgetName: '{widgetName}',
                removable: {removable},
                draggable:{draggable},
                droppable:{droppable},
                badgable:{badgable},
                highlightable:{highlightable},
                copyable: {copyable},
                resizable: false,
                layerable: {layerable},
                selectable: {selectable},
                hoverable: {hoverable},
                editable: false,
                content: `{content}`,
                style: {},
                void: {void},
                toolbar: {toolbar},
                script:function() {
                  {script}
                }
            },                  
           
        });

JS,
        'templates' => <<<JS
        blockManager.add('{blockId}', {
            category: {
                label: '{category}',
                open: false
            },
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{title}</div>
            </div>`,
            attributes: {
                title: 'Insert h1 block',
                class: 'templates'
            },
            content: {
                type: '{type}',                        
                name: '{name}',
                widgetName: '{widgetName}',
                removable: {removable},
                draggable:{draggable},
                droppable:{droppable},
                badgable:{badgable},
                highlightable:{highlightable},
                copyable: {copyable},
                resizable: false,
                layerable: {layerable},
                selectable: {selectable},
                hoverable: {hoverable},
                editable: false,
                content: `{content}`,
                style: {},
                void: {void},
                toolbar: {toolbar},
                script:function() {
                  {script}
                }
            },                  
           
        });
JS,
        'columns' => <<<JS
        blockManager.add('{blockId}', {
            category: {
                label: '{category}',
                open: false
            },
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{title}</div>
            </div>`,
            attributes: {
                title: 'Insert h1 block'
            },
            content: `{content}`,
        });
JS,
        'button' => <<<JS
           
            panelManager.removeButton('{panelId}', '{id}');
            panelManager.addButton('{panelId}', {
                id: '{id}',  
                className: 'fa {icon}',
                command: '{command}',
                tagName:'{tagName}', 
                attributes: {attributes},
                label: '{label}',
                active:'{active}',  
                dragDrop:'{dragDrop}',
                togglable:'{togglable}',
                disable:'{disable}',
            });
            
JS,
        'css' => <<<CSS
      .gjs-pn-buttons {
         justify-content: space-around;
      }
      
      .gjs-pn-options {
         width: 600px;
      }
      
      #gjs-sm-input-holder select {
         display: block !important;
      }
CSS,

        'saveFile' => <<<JS

    {webSocket}

        function saveContentPhp(type = 'ajax') {

        $('.gjs-pn-btn.fa-eye').before('<span class="spinner-border text-primary" role="status" style="position: absolute; right: -17px;"><span class="sr-only">Loading...</span></span>');
        
        let wrapper = $(editor.Canvas.getDocument().body).find('#wrapper');
        let content = $(wrapper).clone();
        let divs = content.find('div');

        content.find('.widgetsWrap').unwrap('.parent-div');
    
        var components = editor.DomComponents.getWrapper()
        components = components.find('.parent-div')
    
        let css = '';
        components.forEach(function(component) {
        
            var selector = $(component.getEl()).attr('data-id')
            var cssText = component.get('cssText')
            
            if (selector !== '' && selector !== undefined && cssText !== undefined) {
                css += '.' + selector + '{' + cssText + '}'
            }
        })
        
        divs.each(function (key, v) {
            v.getAttributeNames().forEach(function (attr) {
                if (attr !== 'class')
                    $(v).removeAttr(attr);
            });
        });
    
        if (type === "ajax") {
            $.ajax({
                method: 'post',
                url: '/core/grape/save.aspx',
                data: {
                    file: '{saveFile}',
                    content: content.html(),
                    actions: $('#gjs').attr('actions'),
                    css: css,
                },
                success: function () {
                
                    $('.spinner-border').remove()
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Сохранено в файл',
                        text: '{saveFile}',
                        timer: 1000,
                        showConfirmButton: false,
                    })
                },
                error: function (e) {
                    $('.spinner-border').remove()
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Ошибка при сохранении!',
                        text: e.statusText,
                        timer: 3000,
                        showConfirmButton: false,
                    })
                }
            });
        } else {
        
            var save_content = JSON.stringify({
                content: content.html(), 
                actionId: "{actionId}", 
                config: "{saveFile}"
            });
            
            conn.send(save_content);
            
        }
    }       

JS,
        'webSocket' => <<<JS

        var conn = new WebSocket('{host}');
        
        conn.onmessage = function (data) {
        
            $('#saveFile').show()
            $('.spinner-border').remove()
           
        };
    
        setInterval(function() {
            if (conn.readyState === WebSocket.OPEN)
            saveContentPhp() 
        }, 3000);

        conn.onclose = function (event) {
        
            console.log('Socket is closed. Reconnect will be attempted in 1 second.', e.reason);
            setTimeout(function() {
            
              var conn = new WebSocket('ws://localhost:1997');
              
            }, 1000);
            
        };
JS,
    ];

    public function asset()
    {
        #region Css
        $tooltipTheme = $this->_config['tooltipTheme'];
        $this->fileCss("/render/former/ZGrapesJsWidget/demo/Grapes/css/tooltip/$tooltipTheme.css");
        $this->fileCss('/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css');
        $this->fileCss('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/grapesjs@0.16.2/dist/css/grapes.min.css');
        $this->fileCss('/render/former/ZGrapesJsWidget/asset/tooltips/tooltipster.bundle.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/simple-hint/3.0.0/simple-hint.min.css');
        $this->fileCss('/render/former/ZGrapesJsWidget/demo/Grapes/css/newClean1.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/jspanel.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css');
        $this->fileCss('https://cdn.statically.io/gh/kristofferandreasen/wickedCSS/11397fa7/dist/wickedcss.min.css');

        #endregion
        #region Js
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs@0.16.2/dist/grapes.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('/render/former/ZGrapesJsWidget/demo/Grapes/js/grapesjs-custom-code.min.js');
        $this->fileJs('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js');
        $this->fileJs('/render/former/ZGrapesJsWidget/demo/Grapes/js/grapesjs-typed.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
        $this->fileJs('https://raw.githack.com/omarmd1986/grapesjs-blocks-avance/master/dist/grapesjs-blocks-avance.min.js');
        $this->fileJs('/render/former/ZGrapesJsWidget/asset/tooltips/tooltipster.bundle.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/analytics.js@2.9.1/analytics.min.js');
        $this->fileJs('/render/former/ZGrapesJsWidget/demo/Grapes/js/toastr.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-preset-webpage@0.1.11/dist/grapesjs-preset-webpage.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-plugin-social@0.0.11/dist/grapesjs-plugin-social.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-lory-slider@0.1.5/dist/grapesjs-lory-slider.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-tabs@0.2.2/dist/grapesjs-tabs.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-touch@0.1.1/dist/grapesjs-touch.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-parser-postcss@0.1.1/dist/grapesjs-parser-postcss.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/jspanel.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/modal/jspanel.modal.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/tooltip/jspanel.tooltip.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/hint/jspanel.hint.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/layout/jspanel.layout.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/contextmenu/jspanel.contextmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/dock/jspanel.dock.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/velocity-animate@2.0.6/velocity.min.js');

        #endregion
    }

    public function init()
    {
        parent::init();
        ob_start();

    }

    public function codes()
    {

        $service = Az::$app->App->eyuf->grapes;
        $tooltips = $service->tooltip();

        $this->htm = strtr($this->_layout['html'], [
            '{content}' => ob_get_clean(),
            '{actionItem}' => $this->getPregActions(),
            '{tooltip}' => $this->getTooltipReplace($tooltips),
        ]);

        $href = $this->httpGet('path') . '.aspx';

        $toolbar = $this->getToolbar();
        $topButtons = $this->getTopButtons($href);
        $blocks = $service->getBlocksReplace($tooltips, $this, $toolbar);
        $buttons = $this->getButtonsReplace($topButtons);
        $columns = $service->getColumnsReplace($this->_layout['columns']);
        $templates = $this->getTemplatesReplace();

        $webSocket = $this->getWebSocket();
        $saveFunc = strtr($this->_layout['saveFile'], [
            '{webSocket}' => $webSocket,
            '{saveFile}' => str_replace('\\', '/', $this->_config['saveFile']),
            '{css}' => $this->jscode($this->_config['css']),
        ]);

        $root = Root . '\render\former\ZGrapesJsWidget\assets\\';
        $mainCode = file_get_contents($root . 'mainJsMaladoy.js');
        $events = file_get_contents($root . 'eventCleanSherzod1.js');

        $this->js = strtr($this->_layout['main'], [
            '{mainCodeForInit}' => strtr($mainCode, [
                '{autoAdd}' => $this->jscode($this->_config['autoAdd']),
                '{dropzone}' => $this->jscode($this->_config['dropzone']),
                '{scripts}' => $this->jscode($this->_config['scripts']),
                '{links}' => $this->jscode($this->_config['links']),
                '{toolbar}' => $this->jscode($toolbar),
            ]),
            '{tooltipTheme}' => $this->_config['tooltipTheme'],
            '{eventFunctions}' => strtr($this->jscode($events), [
                '{toolbar}' => $this->jscode($toolbar),
                '{href}' => $href,
                '{css}' => $this->getPregCss(),
            ]),
            '{css}' => $this->getPregCss(),
            '{saveFunc}' => $saveFunc,
            '{buttons}' => $this->jscode($buttons),
            '{blocks}' => $this->jscode($blocks),
            '{columns}' => $this->jscode($columns),
            '{templates}' => $this->jscode($templates),
        ]);

        $this->css = strtr($this->_layout['css'], []);

    }


    public function getTemplatesReplace()
    {


        $getTemplates = Az::$app->App->eyuf->grapes->getTemplates();

        $templates = '';
        foreach ($getTemplates as $grapItem) {
            $templates .= strtr($this->_layout['templates'], [
                '{blockId}' => $this->jscode($grapItem->blockId),
                '{img}' => $this->jscode($grapItem->img),
                '{name}' => $this->jscode(bname($grapItem->blockName)),
                '{widgetName}' => $this->jscode($grapItem->ajaxName),
                '{content}' => $this->jscode($grapItem->content),
                '{category}' => $this->jscode($grapItem->category),
                '{script}' => $this->jscode($grapItem->script),
                '{style}' => $this->jscode($grapItem->style),
                '{title}' => $this->jscode($grapItem->title),
                '{src}' => $this->jscode($grapItem->src),
                '{type}' => $this->jscode($grapItem->type),
                '{removable}' => $this->jscode($grapItem->removable),
                '{draggable}' => $this->jscode($grapItem->draggable),
                '{droppable}' => $this->jscode($grapItem->droppable),
                '{badgable}' => $this->jscode($grapItem->badgable),
                '{stylable}' => $this->jscode($grapItem->stylable),
                '{highlightable}' => $this->jscode($grapItem->highlightable),
                '{copyable}' => $this->jscode($grapItem->copyable),
                '{resizable}' => 0,
                '{editable}' => $this->jscode($grapItem->editable),
                '{layerable}' => $this->jscode($grapItem->layerable),
                '{selectable}' => $this->jscode($grapItem->selectable),
                '{ajaxName}' => $this->jscode($grapItem->ajaxName),
                '{hoverable}' => $this->jscode($grapItem->hoverable),
                '{void}' => $this->jscode($grapItem->void),
                '{icon}' => $this->jscode($grapItem->icon),
                '{components}' => $this->jscode($grapItem->components),
                '{toolbar}' => $this->jscode($this->getToolbar()),
                '{class}' => $this->jscode($grapItem->class),
                '{propagate}' => $this->jscode([$grapItem->propagate]),
                '{unstylable}' => $this->jscode([$grapItem->unstylable]),
            ]);
        }

        return $templates;
    }

    private function getToolbar()
    {
        $toolbars = [

            [
                'command' => 'tlb-move',
                'attributes' => [
                    'class' => 'fa fa-arrows paramsIcon',
                    'title' => Az::l('Переместить'),
                ]
            ],

            [
                'command' => 'grapes-clone',
                'attributes' => [
                    'class' => 'fa fa-clone paramsIcon',
                    'title' => Az::l('Клонировать'),
                ]
            ],

            [
                'command' => 'tlb-delete',
                'attributes' => [
                    'class' => 'fa fa-trash paramsIcon',
                    'title' => Az::l('Удалить'),
                ]
            ],

            [
                'command' => 'tlb-params',
                'attributes' => [
                    'class' => 'fal fa-cog paramsIcon',
                    'title' => Az::l('Параметры'),
                ]
            ],

        ];

        return json_encode($toolbars);
    }


    private function getWebSocket()
    {
        $webSocket = '';
        if ($this->_config['webSocket']) {
            $webSocket = strtr($this->_layout['webSocket'], [
                '{host}' => $this->_config['wsUrl']
            ]);
        }

        return $webSocket;
    }


    public function getButtonsReplace($btns)
    {

        $buttons = '';
        foreach ($btns as $btnItem) {

            $buttons .= strtr($this->_layout['button'], [
                '{panelId}' => $btnItem->panelId,
                '{id}' => $btnItem->id,
                '{className}' => $btnItem->className,
                '{tagName}' => $btnItem->tagName,
                '{icon}' => $btnItem->icon,
                '{title}' => $btnItem->title,
                '{attributes}' => json_encode($btnItem->attributes),
                '{href}' => $btnItem->href,
                '{target}' => $btnItem->target,
                '{label}' => $btnItem->title,
                '{command}' => $btnItem->command,
                '{active}' => $btnItem->active,
                '{disable}' => $btnItem->disable,
                '{dragDrop}' => $btnItem->dragDrop
            ]);

        }

        return $buttons;

    }


    public function getPregActions()
    {
        $content = file_get_contents($this->_config['saveFile']);
        preg_match('/\$action = new WebItem\(\);.*\$action\);/s', $content, $pregActionItem);
        return ZArrayHelper::getValue($pregActionItem, 0);
    }


    public function getPregCss()
    {
        $content = file_get_contents($this->_config['saveFile']);
        preg_match('/<style>(.*?)<\/style>/s', $content, $pregCss);
        return ZArrayHelper::getValue($pregCss, 1);
    }


    public function getTooltipReplace($tooltips)
    {

        $tooltip = '';
        foreach ($tooltips as $key => $value) {
            $tooltip .= strtr($this->_layout['tooltip'], [
                '{tooltipId}' => $key,
                '{src}' => $value->src,
                '{icon}' => $value->icon,
                '{title}' => $value->title,
                '{content}' => $value->content,
            ]);
        }

        return $tooltip;

    }


    public function getTopButtons($href)
    {

        $topButtons = [];

        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'preview';
        $btn->attributes = [
            'title' => Az::l('Предпросмотр'),
            'class' => 'WhiteClass grape-tooltip',
        ];
        $btn->tagName = 'span';
        $btn->icon = 'fas fa-eye';
        $btn->label = '';
        $btn->command = 'preview';
        $topButtons['preview'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'fullscreen';
        $btn->attributes = [
            'title' => Az::l('Полный экран'),
            'class' => 'WhiteClass grape-tooltip'
        ];
        $btn->tagName = 'span';
        $btn->icon = 'fas fa-arrows-alt';
        $btn->label = '';
        $btn->command = 'core:fullscreen';
        $topButtons['fullscreen'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'undo';
        $btn->attributes = [
            'title' => Az::l('Назад'),
            'class' => 'WhiteClass grape-tooltip'
        ];
        $btn->tagName = 'span';
        $btn->icon = 'fas fa-undo';
        $btn->label = '';
        $btn->command = 'core:undo';
        $topButtons['undo'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'redo';
        $btn->attributes = [
            'title' => Az::l('Вперёд'),
            'class' => 'WhiteClass grape-tooltip'
        ];
        $btn->tagName = 'span';
        $btn->icon = 'fas fa-redo';
        $btn->label = '';
        $btn->command = 'core:redo';
        $topButtons['redo'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'canvas-clear';
        $btn->attributes = [
            'title' => Az::l('Очистить Canvas'),
            'class' => 'WhiteClass grape-tooltip'
        ];
        $btn->tagName = 'span';
        $btn->icon = 'fas fa-trash';
        $btn->label = '';
        $btn->command = 'grapes-clean';
        $topButtons['clear'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'saveFile';
        $btn->tagName = 'span';
        $btn->icon = 'gjs-pn-btn saveFile fas fa-save';
        $btn->label = '';
        $btn->attributes = [
            'id' => 'saveFile',
            'title' => Az::l('Сохранить файл'),
            'class' => 'WhiteClass grape-tooltip',
        ];
        $btn->command = 'save-file';
        $topButtons['saveFile'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'gotoPage';
        $btn->tagName = 'a';
        $btn->icon = 'fas fa-location-arrow gotoPage';
        $btn->label = '';
        $btn->attributes = [
            'href' => $href,
            'target' => '_blank',
            'title' => Az::l('Перейти на страницу'),
            'class' => 'WhiteClass grape-tooltip'
        ];
        $btn->command = 'go-to-page';
        $topButtons['gotoPage'] = $btn;

        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'widget';
        $btn->tagName = 'span';
        $btn->label = 'Виджеты';
        $btn->active = true;
        $btn->attributes = [
            'href' => $href,
            'target' => '_blank',
            'class' => 'widget-switch tabItem grape-tooltip'
        ];
        $btn->command = 'wav';
        $topButtons['widget'] = $btn;


        $btn = new GrapeBtnItem();
        $btn->panelId = 'options';
        $btn->id = 'template';
        $btn->tagName = 'span';
        $btn->label = 'Блоки';
        $btn->attributes = [
            'href' => $href,
            'target' => '_blank',
            'class' => 'template-switch tabItem grape-tooltip'
        ];
        $btn->command = 'wav';
        $topButtons['template'] = $btn;

        $topButtons = $this->topButtonsFix($topButtons);

        return $topButtons;
    }


    private function topButtonsFix($topButtons)
    {

        $return = [];

        if (empty($this->_config['buttonsEx']))
            return $topButtons;

        foreach ($topButtons as $name => $topButton) {

            if (!ZArrayHelper::isIn($name, $this->_config['buttonsEx']))
                $return[$name] = $topButton;

        }

        return $return;

    }

}

