<?php


namespace zetsoft\widgets\former;

use zetsoft\dbitem\grap\GrapeBtnItem;
use zetsoft\dbitem\grap\GrapeItem;
use zetsoft\dbitem\grap\GrapeToolbarItem;
use zetsoft\dbitem\grap\GrapeTooltipItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;

class  ZGrapesJsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'autoAdd' => '1',
        'dropzone' => '0',
        'styles' => [],
        'scripts' => [],
        'widgets' => [],
        'css' => '',
        'buttons' => null,
        'tbButtons' => null,
        'templates' => [],
        'categories' => [],
        'saveFile' => '',
        'theme' => ZGrapesJsWidget::themes['lightBlueTheme'],
        'lang' => ZGrapesJsWidget::langs['ru'],
        'tooltipTheme' => 'tooltipster-noir', //tooltipster-borderless, tooltipster-light, tooltipster-noir, tooltipster-punk, tooltipster-shadow,
        'labelColor' => '#081F62',
        'borderInputColor' => '#cccccc',
        'inputColor' => '#004b7f',
        'zinputColor' => '#004b7f',


    ];

    public const langs = [
        'bs' => 'bs',
        'de' => 'de',
        'en' => 'en',
        'es' => 'es',
        'fa' => 'fa',
        'fr' => 'fr',
        'it' => 'it',
        'nl' => 'nl',
        'pt' => 'pt',
        'ru' => 'ru',
        'tr' => 'tr',
        'uz' => 'uz',
    ];

    public const style_label = Azl . 'Это титле';

    public const themes = [
        'bronzeTheme' => 'bronzeTheme',
        'blueTheme' => 'blueTheme',
        'whiteBlackTheme' => 'whiteBlackTheme',
        'blackWhiteTheme' => 'blackWhiteTheme',
        'lightBlueTheme' => 'lightBlueTheme',
    ];


    public $active = [];
    public $_active = [
        'ready' => true,  //
        'component:add' => true,  //
        'component:mount' => false,  //
        'component:clone' => true,
        'component:update' => false,
        'property:compUpdate' => false,
        'component:styleUpdate' => true,
        'component:selected' => true, //
        'component:toggled' => false,
        'component:remove' => true,

        'block:add' => false,    //
        'block:remove' => false, //
        'block:dragStart' => true,  //
        'block:drag' => false,   //
        'block:dragStop' => false,   //

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
        'storage:load' => false,    //
        'storage:store' => false,   //
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
    public $_event = [
        'component:clone' => <<<JS
    function(model) {
        
    }
JS,
        'component:styleUpdate' => <<<JS
           function(model) {
                let parentEl = $(model.getEl());    
                let parentId = parentEl.attr('data-id');
                let styles = model.getStyle();    
                let css=null;
                let newCss = '';
                //let elements = importCss.split('{').join('').split('}');
                
                let elements = importCss.split('}');
                let isContain = false;
                let info=null;
                
                console.log(elements)
                
                elements.map((key,k)=>
                    key.includes(parentId)?equalize(true,k):''
                )                              
               
                function equalize(bool,int) {
                    info=int;
                    isContain = bool;
                }
                
                
                if (styles !== '' && parentEl.hasClass('parent-div')){
                    /*if (isContain){
                        let el = elements[info];
                        elements[info]+=JSON.stringify(styles).split('{').join('').split('}').join('').split(',')[0]+';}';
                    }
                    else{*/
                        if (parentId!==undefined)
                            newCss = '.' + parentId + JSON.stringify(styles);
                        else{
                            if (parentEl[0].id)
                                newCss = '#'+parentEl[0].id+JSON.stringify(styles);
                            else
                                newCss = '.'+parentId.id+JSON.stringify(styles);
                        }
                    //}
                
                /*if (newCss!==''){
                    console.log(newCss); 
                    elements.push(newCss);
                    //importCss = importCss.join(newCss);
                    console.log(elements);
                    elements.map((key,k)=>
                        css+=key
                    )    
                    importCss=css;
                    console.log(importCss);
                }
                else
                    console.log(elements[info])*/
                
                if (parentEl.hasClass('parent-div'))
                    parentEl.attr('data-css', newCss);  
                }             
}
JS,

        'property:styleUpdate' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
   console.log(e);
}",
        'component:mount' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
   console.log(e);
}",
        'component:drag:start' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
   console.log(e);
}",
        'component:drag' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
   console.log(e);
}",
        'obdev' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
   console.log(e);
}",
        'component:toggled' => "function (e) {
            console.log('{className} | {event}');
            console.log(e);
        }",
        'component:update' => "function (e) {
    console.log('{className} | {event}');
      console.log(e);
}",
        'property:compUpdate' => "function (e) {
    console.log('{className} | {event}:{propertyName}');
    //     console.log(e);
}",

//assets

        'assets:add' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'assets:remove' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'assets:start' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'assets:end' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'assets:response' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'assets:error' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        //Keymap
        'keymap:add' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'keymap:remove' => "function (event) {
      console.log('{className} | {event}');
    console.log(e);
}",
        'keymap:emit' => "function (event) {
    console.log('{className} |{event}');
    console.log(e);
}",
        'emit:(id, alt + u, e)' => "function (event) {
    console.log('{className} | emit:(id, alt + u, e)');
    console.log(e);
}",

//Style Manager

        'styleManager:update:target' => <<<JS
        function(model) {
          console.log('styleManager:update:target');
          console.log(model);
          console.log('styleManager:update:target');
        }
JS,

        'styleManager:change' => <<<JS
    function(model) {
      
        console.log('styleManager:change');
        console.log(model);
        console.log('styleManager:change');
    
    }

JS,

//Storages
        'storage:start' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:start:store' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:start:load' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:load' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:store' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:end' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:end:store' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:end:load' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:error' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:error:store' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",
        'storage:error:load' => "function (event) {
    console.log('{className} | {event}');
    console.log(e);
}",

//Canvas
        'canvas:dragenter' => "function (event) {
    console.log('{className} | {event}');
        console.log(e);
    }",
        'canvas:dragover' => "function (event) {
    console.log('{className} | {event}');
        console.log(e);
    }",
        'canvas:drop' => "function (event) {
    console.log('{className} | {event}');
        console.log(e);
    }",
        'canvas:dragend' => "function (event) {
    console.log('{className} | {event}');
        console.log(e);
    }",
        'canvas:dragdata' => "function (event) {
    console.log('{className} | {event}');
        console.log(e);
    }",
        //Selectors
        'selector:add' => <<<JS
    function (event) {
        console.log('{className} | {event}');
        console.log(e);
        console.log('{className} | {event}');
    }
JS,

        //RTE
        'rte:enable' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'rte:disable' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        //Modal
        'modal:open' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'modal:close' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        //Commands
        'run:{commandName}' => "function (event) {
        console.log('{className} | run:{commandName}');
        console.log(e);
    }",
        'stop:{commandName}' => "function (event) {
        console.log('{className} | stop:{commandName}');
        console.log(e);
    }",
        'run:{commandName}:before' => "function (event) {
        console.log('{className} | run:{commandName}:before');
        console.log(e);
    }",
        'stop:{commandName}:before' => "function (event) {
        console.log('{className} | stop:{commandName}:before');
        console.log(e);
    }",
        'abort:{commandName}' => "function (event) {
        console.log('{className} | abort:{commandName}');
        console.log(e);
    }",
        'run' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'stop' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'canvasScroll' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'update' => <<<JS
    function(model) {
      console.log('update');
      console.log(editor.getCss());
      console.log('update');
    }
JS,
        'undo' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'redo' => "function (event) {
        console.log('{className} | {event}');
        console.log(e);
    }",


        'block:add' => /** @lang JavaScript */
            "function (e) {
        console.log('{className} | {event}');
        console.log(e);
    }",
        'block:remove' => /** @lang JavaScript */
            "function (e) {
        console.log('{className} | {event}');
        //console.log(e);
    }",

        'block:drag' => 'function (e) {
       
        //console.log(e);
    }',
        'block:dragStop' => 'function (e) {
        console.log(\'{className} | {event}\');
        //console.log(e);
    }',


        'load' => <<<JS
      $('.fa-desktop').attr('data-original-title', 'Desktop');
    $('.fa-tablet').attr('data-original-title', 'Tablet');
    $('.fa-mobile').attr('data-original-title', 'Mobile');

    const body = editor.Canvas.getDocument().body;
    let child = $(body)[0].children[1]
    $(child).hide();

    let wrapper1 = $(editor.Canvas.getDocument().body).find('#wrapper')
    wrapper1.addClass('parent-div');

//Loader options start

    setTimeout(function () {
        $('.preloader').hide();
        $('#gjs').removeClass('d-none');
    }, 3000);

//Loader options end


    editor.CssComposer.getAll().reset();
    const swv = buttonManager.getButton('options', 'sw-visibility');

    $('#search_grape').attr('type', 'search');

    $('#search_grape').on('keyup', function () {
        $(this).value;
    });

    $('.gjs-pn-options .gjs-pn-btn').on('click', function () {
        if (!$(this).hasClass('fa-square-o')) {
            if (!$('fa-square-o').hasClass('gjs-pn-active')
            ) {
                swv.set('active', 1);
            } else {
                swv.set('active', 0);
            }
        }
    });

    const wrapper = editor.DomComponents.getWrapper();

    const componentsParent = wrapper.find('.zwidget');
    componentsParent.forEach(function (zwidget) {

        var widget = zwidget.getEl();
        var parent = $(widget).closest('.template-block');

        zwidget.attributes.content = $(widget).html();

        if (parent.hasClass('template-block'))
            $(widget).removeClass('parent-div');

    });

    const components = wrapper.find('[data-gjs-type]');
    components.forEach(function (component) {

        const componentEl = component.getEl();
        component.set({
            'editable': false,
            'copyable': false,
            'droppable': false,
            'draggable': false,
            'hoverable': false,
            'selectable': false,
            'stylable': false,
            'highlightable': false,
            'badgable': false,
            'layerable': false,
            'ajaxable': true,
        });


        if ($(componentEl).hasClass('parent-div')
            || $(componentEl).hasClass('col'))
            component.set({
                'copyable': true,
                'ajaxable': true,
                'droppable': false,
                'stylable': true,
                'draggable': '.col',
                'hoverable': true,
                'selectable': true,
                'highlightable': true,
                'layerable': true,
            });

        if ($(componentEl).hasClass('col'))
            component.set({
                'droppable': true,
            });


        if (component.get('type') === 'text')
            component.set({
                'editable': true
            });

    });


    blockManager.remove('column1');
    blockManager.remove('column2');
    blockManager.remove('column3');
    blockManager.remove('column3-7');


//template and Widget block filter part

    let blocks = blockManager.getAll().models;
    let widgets = [];
    let templates = [];
    let container = $('.gjs-pn-views-container');
    let container_div2 = $('.gjs-pn-options .gjs-pn-buttons')

    let template_btn1 = document.createElement('span');
    let widget_btn = document.createElement('span');
    let widget_icon = document.createElement('i');
    let template_icon = document.createElement('i');
    const openBlock = editor.Panels.getButton('views', 'open-blocks');
    let content_tmpl = document.createElement('div');

    container_div2.addClass('extras');

    widget_btn.setAttribute('data-original-title', 'Widgets');
    template_btn1.setAttribute('data-original-title', 'Templates');


    content_tmpl.setAttribute('class', 'content-switch');
    widget_icon.setAttribute('class', 'fas fa-palette');
    template_icon.setAttribute('class', 'fas fa-layer-group');
    widget_icon.setAttribute('style', 'font-size:1.4rem');
    template_icon.setAttribute('style', 'font-size:1.4rem');

    template_btn1.setAttribute('class', 'btn-widget d-inline-block btn btn-sm btn-outline-primary template-switch ');
    widget_btn.setAttribute('class', 'btn-template d-inline-block btn btn-sm btn-outline-primary widget-switch ');

    content_tmpl.append(widget_btn);
    content_tmpl.append(template_btn1);
    if (window.matchMedia("(max-width: 768px)").matches) {
        $('.gjs-pn-options .gjs-pn-buttons .fa-arrows-alt').remove();
        $('#search_grape').after(content_tmpl);
    } else {
        container_div2.prepend(content_tmpl);
    }

    let btn_widget = $('.widget-switch');
    let btn_template = $('.template-switch');

    btn_widget.append(widget_icon);
    btn_template.append(template_icon);

    let block_categories = $('.gjs-block-categories');
    let block_category = $('.gjs-block-category');

    block_categories.append()
    for (let i = 0; i < block_category.length; i++) {
        let counter_wdg = 0;
        let counter_tmp = 0;
        let item = block_category[i];
        let item_children = item.children[1].children;
        for (let j = 0; j < item_children.length; j++) {
            let item_after = item_children[j];
            if (item_after.classList.contains('widgets')) {
                counter_wdg++;
            }
            if (item_after.classList.contains('templates')) {
                counter_tmp++;
            }
        }
        if (counter_wdg > 0) {
            widgets.push(item);
        }
        if (counter_tmp > 0) {
            templates.push(item);
            item.style.display = 'none';
        }
        if (counter_tmp === 0 && counter_wdg === 0) {
            widgets.push(item);
        }
    }
    btn_widget.removeClass('btn-outline-primary');
    btn_widget.addClass('btn-primary');
    btn_template.on('click', function () {
        $('#search_grape').show();
        openBlock.set('active', 1);
        widgets.map(widget =>
            widget.style.display = 'none'
        )
        templates.map(template =>
            template.style.display = 'block'
        )
        btn_widget.removeClass('btn-primary');
        btn_widget.addClass('btn-outline-primary');
        btn_template.removeClass('btn-outline-primary');
        btn_template.addClass('btn-primary');
    })

    btn_widget.on('click', function () {
        openBlock.set('active', 1);
        $('#search_grape').show();
        widgets.map(widget =>
            widget.style.display = 'block'
        )
        templates.map(template =>
            template.style.display = 'none'
        )
        btn_template.removeClass('btn-primary');
        btn_template.addClass('btn-outline-primary');
        btn_widget.removeClass('btn-outline-primary');
        btn_widget.addClass('btn-primary');
    })


//end template and widget filter part


    let content_right = document.createElement('div');
    let btn_eye = $('.fa-eye')[0];
    let btn_arrow = $('.gotoPage')[0];


//btn_eye.classList.add('eye-add');

    content_right.setAttribute('class', 'content-right');
    content_tmpl.setAttribute('class', 'content-switch');
    content_right.append(btn_eye);
    content_right.append(btn_arrow);
    container_div2.append(content_right)


    $('.gjs-pn-btn.fa.fa-desktop').addClass('gjs-pn-active');


    $('#yii-debug-toolbar').remove();
    let col = $(".gjs-pn-views .gjs-pn-buttons");
    let cols = $('.gjs-pn-panel:nth-child(3)');
    let categories = $(".gjs-pn-views-container");
    let btnDiv = document.createElement("SPAN");
    let canvas = $(".gjs-cv-canvas");
    let count = 0;

    const categoriess = editor.BlockManager.getCategories();
    categoriess.each(category => {
        category.set('open', false)
    })

    let btns = $(".gjs-pn-views span");
    $(".gjs-pn-buttons .fa-paint-brush,.gjs-pn-buttons .fa-cog,.gjs-pn-buttons .fa-th-large,.gjs-pn-buttons .fa-bars").on("click", function () {
        if (!$(this).hasClass('gjs-pn-active')) {
            canvas.css({"left": "3%", "width": "97%", "transition": "0.3s all ease-in"});
            $('.gjs-pn-views-container').hide("swing");
        } else {
            canvas.css({"left": "22.5%", "width": "77.4%"});
            $('.gjs-pn-views-container').show("swing");
        }
    })
//category list fa

    let categories1 = $(".gjs-block-category");
    let bar_icon = document.createElement("I");
    let close_icon = document.createElement("I");
    close_icon.setAttribute("class", "fa fa-times float-right d-none close");
    bar_icon.setAttribute("class", "fa fa-bars float-right bar gjs-caret-icon");
    categories1.each((i, category) =>
        category.children[0].children[0].remove('.fa-caret-right')
    )
    $(".gjs-block-category .gjs-title").append(bar_icon);
    $(".gjs-block-category .gjs-title").append(close_icon);

//end

    $(".gjs-block").attr("data-toggle", "popover");
    $(".gjs-block").attr("tabindex", "0");
    $(".gjs-block").attr("data-placement", "top");
    $(".gjs-block").attr("data-trigger", "hover");
    $(".popover-body").css("padding", "0");

    $(function () {
        $('.gjs-block').popover();
    });
//zoom in/out

//Review options

    $('.gjs-pn-options .gjs-pn-buttons .fa-eye').on("click", function () {
        $('.gjs-off-prv').removeClass('fa-eye-slash');
        $('.gjs-off-prv').addClass('fa-times-circle');
        $('.gjs-off-prv').css({'font-size': '1.7rem'});
    })

//Review options end

    let zoomsize = 100;

    function zoomOutt() {
        zoomsize--;
        zoomsize--;
        editor.Canvas.setZoom(zoomsize);

    }

    function zoomInn() {
        zoomsize++;
        zoomsize++;
        editor.Canvas.setZoom(zoomsize);
    }

// + , -
    $(document).keydown(function (event) {
        if (e.keyCode === 189) {
            //editor.Canvas.setZoom(20);
            zoomOutt();
        } else if (e.keyCode === 187) {
            //editor.Canvas.setZoom(120);
            zoomInn();
        }
    });


    $('.grapes-tooltip').tooltipster({
        theme: 'tooltipster-borderless',
        animation: 'fade',
        delay: 100,
        anchor: 'right',/*top-left, top-center, top-right, left-center, left-right, bottom-left, bottom-center, bottom-right*/
        minWidth: 140,
        maxWidth: 180,

    });

    $(document).ready(function () {

        $(".fa-save, .fa-arrows-alt, .fa-trash, .fa-square-o, .fa-undo, .fa-redo, .fa-eye, .fa-desktop," +
            ".fa-tablet, .fa-mobile, .fa-palette, .fa-layer-group, .fa-location-arrow").tooltip({
            placement: 'bottom'
        });

    });


    let undoBtn = document.querySelector('.fa-undo');
    let redoBtn = document.querySelector('.fa-repeat');
    undoBtn.className = 'gjs-pn-btn fa fa-undo btn btn-outline-primary';
    redoBtn.className = 'gjs-pn-btn fa fa-redo btn btn-outline-primary';
    undoBtn.onclick = function () {
        this.className = 'gjs-pn-btn fa fa-undo btn btn-outline-primary';
    };
    redoBtn.onclick = function () {
        redoBtn.className = 'gjs-pn-btn fa fa-redo btn btn-outline-primary';
    };
 
JS,


        'block:dragStart' => <<<JS
    function(model) {
    
    }
JS,

        'component:add' => <<<JS
    function(model) {
        const visibility = buttonManager.getButton('options','sw-visibility');
        visibility.set('active',1);
        
    
        let parentDiv = $(model.getEl());
        let className = model.get('name');
        
        if (className) {
            
            let file = 'getWidget';
            let htmlClass = 'zwidget';
            
            if (className.includes('zetsoft/blocks')) {
                file = 'getBlocks';
                htmlClass = 'template-block';
            }
            
            if (className.includes('zetsoft')) {
                
                $.ajax({      
                   method: "GET",
                   url: '/core/grapes/getAssets.aspx?param=' + className,
                   success: function(response) {
                      getAssets(model, response);
                   },
                });
        
                $.ajax({      
                   method: "GET",
                   url: '/core/grapes/' + file + '.aspx?param=' + className,
                   success: function(response) {
                      getAssets(model, response);
                      
                      setTimeout(function() { 
                          parentDiv.html(response);
                            
                          var parentId = parentDiv.find('[parent-id]').attr('parent-id');
                          parentDiv.addClass('parent-div ' + parentId + ' ' + htmlClass);
                          parentDiv.attr('data-id', parentId);
                          parentDiv.attr('data-css', '');
                          
                      }, 1500);
                   },
                });
                
            }
                
            
        }
    } 
    
JS,

        'component:selected' => <<<JS
        function(model) {
        $('.gjs-traits-label').html('');
        
           
        
       var settingsBtn = panelManager.getButton('views', 'open-tm');
       settingsBtn.set('active', 1); 
       
        /*const visibility=buttonManager.getButton('options','sw-visibility');
        visibility.set('active',1);*/
       $('#search_grape').hide();
       let selected = editor.getSelected();
       let selectedEl = $(selected.getEl());
       let parentDiv = selectedEl;
       
       let isAll = false;
       let blockName = '';
       let configs = {};
       let file = 'getOptions';
       
       if (!selectedEl.hasClass('parent-div'))
           parentDiv = selectedEl.closest('.parent-div');
       
       
       if (parentDiv.hasClass('zwidget')) {
           blockName = parentDiv.find('[widget]').attr('widget');
           configs = parentDiv.find('[config]').attr('config');
       } else {
           blockName = parentDiv.find('[widget]').attr('widget');
           configs = {};
           file = 'selected';
       }
       
       
       if (blockName)
           if (blockName.includes('zetsoft')) {
              
               if (blockName.match(/zetsoft\/blocks\/.*\/ALL/g))
                   isAll = true;
              
               $.ajax({
                   url: '/core/grapes/' + file + '.aspx?param=' + blockName + '&configs=' + configs + '&isAll=' + isAll,
                   type: 'GET',
                   async: false, 
                   success :  function(response) {
                      $('.gjs-traits-label').html(response);
                      $('.gjs-trt-traits').empty();
                   },
               });
              
               let blockId = parentDiv.attr('data-id');
               $('#sendOptions').click(function() {
                   $.ajax({      
                        method: "GET",
                        url: '/core/grapes/getWidget.aspx?' + $('#activeForm').serialize()
                                                              + '&param=' + blockName
                                                              + '&blockId=' + blockId,
                        success: function(response) {
                            parentDiv.html(response);
                            model.attributes.content = response;
                        },
                   });
               });
              
          }
       
   }
JS,

        'ready' => "",

        'component:remove' => <<<JS
            function(){
                const openBl=buttonManager.getButton('views','open-blocks');
                openBl.set('active',1)
            }
JS,

        'component:drag:end' => <<<JS
    function(model) {
        
        var target = model.target;
        let className = target.get('name');
        var parentEl = $(target.getEl());
        var configs = parentEl.find('[config]').attr('config');
       
        if (className === '')
            className = parentEl.find('[widget]').attr('widget');
        
        if (className) {
            
            let file = 'getWidget';
            let htmlClass = 'zwidget';
            
            if (className.includes('zetsoft/blocks')) {
                file = 'getBlocks';
                htmlClass = 'template-block';
            }
            
            var ajaxable = parentEl.attr('ajaxable');
            var content = target.get('content');
            
            if (ajaxable === 'true')
                $.ajax({      
                   method: "GET",
                   url: '/core/grapes/' + file + '.aspx?param=' + className + '&configs=' + configs,
                   success: function(response) {
                       parentEl.html(response);
                       target.attributes.content = response;
                   },
                });
            else 
                parentEl.html(content);
        
            if (!parentEl.hasClass(htmlClass))
                 parentEl.addClass(htmlClass + ' parent-div');
            
        }
        
        
    }
JS,

    ];

    public $layout = [];
    public $_layout = [

        'html' => <<<HTML
         <div class="preloader">
            <div class="lds-facebook">
                <div>
            
                </div>
                <div>
                
                </div>
                <div>
                
                </div>
            </div>
         </div>
        <div id="gjs" class="btn-style">
            {content} 
        </div>
HTML,

        'tooltip' => <<<HTML
      
        <div id="{tooltipId}-tooltip" class="tooltip-div">
           
           <!--TITLE-->
           
           <h4 class="tooltip-title">{title}</h4>
                       <!--CONTENT-->    
                <p class="tooltip-text">
               <!-- <img class="tooltip-img" src="{src}">-->
                <i class="{icon}"></i>
               
                    {content}
                </p>
           
        </div>
        
HTML,

        'tooltipTheme' => <<<JS
    $('.tooltip-div').tooltipster({
        theme: '{tooltipTheme}'
    });
JS,

        'main' => <<<JS
    /** @lang JavaScript */

    var editor = grapesjs.init({
        allowScripts: 1,
        height: '100%',
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        fromElement: true,
        showToolbar: 1,
        showDevices: 1,
        devicePreviewMode: 0,
        mediaCondition: 'max-width',
        tagVarStart: '{[ ',
        tagVarEnd: ' ]}',
        keepEmptyTextNodes: 0,
        jsInHtml: true,
        nativeDnD: 1,
        multipleSelection: 1,
        exportWrapper: 0,
        wrapperIsBody: 1,
        avoidInlineStyle: 1,
        avoidDefaults: 1,
        clearStyles: 0,
        dragMode: 0,
        el: '',
        undoManager: {},
        commands: {
            defaults: [
                {
                    id: 'grapes-clone',
                    run() {

                    const domComponents = editor.DomComponents;
                    let model = editor.getSelected();
                    let parentEl = $(model.getEl());
                    let className = model.get('name');
                    
                    if (className === '')
                        className = parentEl.find('[widget]').attr('widget');

                    let file = 'getWidget';
                    let htmlClass = 'zwidget';

                    if (className.includes('zetsoft/blocks')) {
                        file = 'getBlocks';
                        htmlClass = 'template-block';
                    }

                    var configs = parentEl.find('[config]').attr('config');
                    
                    $.ajax({
                        method: "GET",
                        url: '/core/grapes/' + file + '.aspx?param=' + className + '&configs=' + configs,
                        success: function(response) {
                           
                            var newComp = domComponents.addComponent({
                                removable: true,
                                draggable: true,
                                highlightable: true,
                                copyable: true,
                                content: response,
                            });
                            
                            var newEl = $(newComp.getEl());            
                            newEl.addClass(htmlClass + ' parent-div');
                            newEl.html(response);
                            
                            parentEl.after(newComp);
                            model.attributes.content = response;

                        },
                        
                    });
                    
                    },
                },
                {id: 'clear'}
            ]
        },
        assetManager: {
            assets: [
                
            ],
            noAssets: '',
            stylePrefix: 'am-',
            upload: 0,
            uploadName: 'files',
            headers: {},
            params: {},
            credentials: 'include',
            multiUpload: true,
            //  ]
            // }
            autoAdd: {autoAdd}, //1

            // Text on upload input
            uploadText: 'Drop files here or click to upload',

            // Label for the add button
            addBtnText: 'Add image',

            // To upload your assets, the module uses Fetch API, with this option you
            // overwrite it with something else.
            // It should return a Promise
            // @example
            // customFetch: (url, options) => axios(url, { data: options.body }),
            customFetch: '',

            // Custom uploadFile function.
            // Differently from the `customFetch` option, this gives a total control
            // over the uploading process, but you also have to emit all `asset:upload:*` events
            // by yourself (if you need to use them somewhere)
            // @example
            // uploadFile: (e) => {
            //   var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
            //   // ...send somewhere
            // }
            uploadFile: '',

            // In the absence of 'uploadFile' or 'upload' assets will be embedded as Base64
            embedAsBase64: 1,

            // Handle the image url submit from the built-in 'Add image' form
            // @example
            // handleAdd: (textFromInput) => {
            //   // some check...
            //   editor.AssetManager.add(textFromInput);
            // }
            handleAdd: '',

            // Enable an upload dropzone on the entire editor (not document) when dragging
            // files over it
            // If active the dropzone disable/hide the upload dropzone in asset modal,
            // otherwise you will get double drops (#507)
            dropzone:{dropzone}, //0

            // Open the asset manager once files are been dropped via the dropzone
            openAssetsOnDrop: 1,

            // Any dropzone content to append inside dropzone element
            dropzoneContent: '',

            // Default title for the asset manager modal
            modalTitle: 'Select Image',

            //Default placeholder for input
            inputPlaceholder:'http://path/to/the/image.jpg',

            //method called before upload, on return false upload is canceled.
            // @example
            // beforeUpload: (files) => {
            //   // logic...
            //   var stopUpload = true;
            //   if(stopUpload) return false;
            // }
            beforeUpload: null
        },
        canvas: {
            stylePrefix: 'cv-',

            /*
             * Append external scripts to the `<head>` of the iframe.
             * Be aware that these scripts will not be printed in the export code
             * @example
             * scripts: [ 'https://...1.js', 'https://...2.js' ]
             */
            /*
             * Append external styles to the `<head>` of the iframe
             * Be aware that these styles will not be printed in the export code
             * @example
             * styles: [ 'https://...1.css', 'https://...2.css' ]
             */
             
            styles: [
                'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css',
                '/render/asrorz/mdb/css/mdb.min.css',
                //'/render/former/ZGrapesJsWidget/assets/grapesjs/grapes-grid.css',
                'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
                //'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css',
                //Tooltip theme
                '/render/former/ZGrapesJsWidget/asset/tooltips/assets/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css',
                '/render/former/ZGrapesJsWidget/asset/tooltips/assets/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css',
                '/render/former/ZGrapesJsWidget/asset/tooltips/assets/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css',
                '/render/former/ZGrapesJsWidget/asset/tooltips/assets/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css',
                '/render/former/ZGrapesJsWidget/asset/tooltips/assets/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css',
                /*'/render/former/ZGrapesJsWidget/asset/main/material.css',
                '/render/former/ZGrapesJsWidget/asset/main/mainCss.css'*/
             ].concat({styles}),


            scripts: [
                'https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js',
                'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js',
                'https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js',
                'https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js',
                'https://cdn.jsdelivr.net/npm/cookiejs@1.0.26/dist/cookie.min.js',
                '/render/asrorz/ven/js/theme.js',
                'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js',
            ].concat({scripts}),

            /**
             * Add custom badge naming strategy
             * @example
             * customBadgeLabel: function(component) {
             *  return component.getName();
             * }
             */
            customBadgeLabel: '',
            /**
             * Indicate when to start the auto scroll of the canvas on component/block dragging (value in px )
             */
            autoscrollLimit: 50,
            notTextable: ['button', 'a', 'input[type=checkbox]', 'input[type=radio]']
        },
        layers: {},
        richTextEditor: {
            stylePrefix: 'rte-',

            // If true, moves the toolbar below the element when the top canvas
            // edge is reached
            adjustToolbar: 1,

            // Default RTE actions
            actions: ['bold', 'italic', 'underline', 'strikethrough', 'link']

        },
        domComponents: {
            stylePrefix: 'comp-',

            wrapperId: 'wrapper',

            wrapperName: 'Body',

            // Default wrapper configuration
            wrapper: {
                removable: false,
                copyable: false,
                draggable: true,
                components: [],
                traits: [],
                stylable: [
                    'background',
                    'background-color',
                    'background-image',
                    'background-repeat',
                    'background-attachment',
                    'background-position',
                    'background-size'
                ]
            },

            // Could be used for default components
            components: [],

            // If the component is draggable you can drag the component itself (not only from the toolbar)
            draggableComponents: 1,

            // Generally, if you don't edit the wrapper in the editor, like
            // custom attributes, you don't need the wrapper stored in your JSON
            // structure, but in case you need it you can use this option.
            // If you have `config.avoidInlineStyle` disabled the wrapper will be stored
            // as we need to store inlined style.
            storeWrapper: 0,

            processor: 0,

            // List of void elements
            voidElements: [
                'area',
                'base',
                'br',
                'col',
                'embed',
                'hr',
                'img',
                'input',
                'keygen',
                'link',
                'menuitem',
                'meta',
                'param',
                'source',
                'track',
                'wbr'
            ]
        },

        //Configurations for Modal Dialog
        modal: {},

        //Configurations for Code Manager
        codeManager: {},

        panels: {
            stylePrefix: 'pn-',
            
            // Default panels fa-sliders for features
            defaults: [
                {
                   
                  id: 'myNewPanel',
                  visible  : true,
               
                },
             
            ],

            // Editor model
            em: null,

            // Delay before show children buttons (in milliseconds)
            delayBtnsShow: 300,
            
            buttons: [
               
            ]   
            
        },
        cssComposer: {
            // Style prefix
            stylePrefix: 'css-',

            // Custom CSS string to render on top
            staticRules: '',

            // Default CSS style
            rules: []
        },
        storageManager: {
            // Prefix identifier that will be used inside storing and loading
            id: 'gjs-',

            // Enable/Disable autosaving
            autosave: 0,

            // Indicates if load data inside editor after init
            autoload: 0,

            // Indicates which storage to use. Available: local | remote
            type: 'local',

            // If autosave enabled, indicates how many steps (general changes to structure)
            // need to be done before save. Useful with remoteStorage to reduce remote calls
            stepsBeforeSave: 0,

            //Enable/Disable components model (JSON format)
            storeComponents: 0,

            //Enable/Disable 
            // 
            // model (JSON format)
            storeStyles: 0,

            //Enable/Disable saving HTML template
            storeHtml: 0,

            //Enable/Disable saving CSS template
            storeCss: 0,

            // ONLY FOR LOCAL STORAGE
            // If enabled, checks if browser supports Local Storage
            checkLocal: 0,

            // ONLY FOR REMOTE STORAGE
            // Custom parameters to pass with the remote storage request, eg. csrf token
            params: {},

            // Custom headers for the remote storage request
            headers: {},

            // Endpoint where to save all stuff
            urlStore: '',

            // Endpoint where to fetch data
            urlLoad: '',

            //Callback before request
            beforeSend(jqXHR, settings) {
            },

            //Callback after request
            onComplete(jqXHR, status) {
            },

            // set contentType paramater of $.ajax
            // true: application/json; charset=utf-8'
            // false: 'x-www-form-urlencoded'
            contentTypeJson: true,

            credentials: 'include',

            // Pass custom options to fetch API (remote storage)
            // You can pass a simple object: { someOption: 'someValue' }
            // or a function wich returns and object to add:
            // currentOpts => {
            //  return currentOpts.method === 'post' ?  { method: 'patch' } : {};
            // }
            fetchOptions: ''
        },
        selectorManager: {
            // Style prefix
            stylePrefix: 'clm-',

            // Specify the element to use as a container, string (query) or HTMLElement
            // With the empty value, nothing will be rendered
            appendTo: '',

            // Default selectors
            selectors: [],

            // Label for selectors
            label: 'Classes',

            // Label for states
            statesLabel: '- State -',

            selectedLabel: 'Selected',

            // States
            states: [
                {name: 'hover', label: 'Hover'},
                {name: 'active', label: 'Click'},
                {name: 'nth-of-type(2n)', label: 'Even/Odd'}
            ],

            // Custom selector name escaping strategy, eg.
            // name => name.replace(' ', '_')
            escapeName: 0
        },
        deviceManager: {
            devices: [
                {
                    id: 'desktop',
                    name: 'Desktop',
                    width: ''
                },
                {
                    id: 'tablet',
                    name: 'Tablet',
                    width: '768px',
                    widthMedia: '992px'
                },
                {
                    id: 'mobileLandscape',
                    name: 'Mobile landscape',
                    width: '568px',
                    widthMedia: '768px'
                },
                {
                    id: 'mobilePortrait',
                    name: 'Mobile portrait',
                    width: '320px',
                    widthMedia: '480px'
                }
            ],
            deviceLabel: 'Device'
        },
        layerManager: { },
        styleManager: {
            clearProperites:true,
            sectors: [
             
                {
                    name: 'Flex',
                    open: false,
                    buildProps: [
                        'flex-direction',
                        'flex-wrap',
                        'justify-content',
                        'align-items',
                        'align-content',
                        'order',
                        'flex-basis',
                        'flex-grow',
                        'flex-shrink',
                        'align-self'
                    ]
                },
                {
                    name: 'Dimension',
                    open: false,
                    buildProps: [
                        'width',
                        'height',
                        'max-width',
                        'min-height',
                        'margin',
                        'padding'
                    ]
                }
            ]
        },
        traitManager: {
            stylePrefix: 'trt-',

            // Specify the element to use as a container, string (query) or HTMLElement
            // With the empty value, nothing will be rendered
            appendTo: '',
            
            // label: 'Выбранный элемент',
            // Placeholder label for text input types
            labelPlhText: 'eg. Text here',

            // Placeholder label for href input
            labelPlhHref: 'eg. https://google.com',

            // Default options for the target input
            optionsTarget: [
                {value: '', name: 'This window'},
                {value: '_blank', name: 'New window'}
            ],

            // Text to show in case no element selected
            textNoElement: 'Select an element before using Trait Manager'
        },
        textViewCode: 'Code',
        // Keep unused styles within the editor
        keepUnusedStyles: 0,
        // TODO
        multiFrames: 0,
        i18n: {
            locale: 'en', // default locale
            detectLocale: true, // by default, the editor will detect the language
            localeFallback: 'en', // default fallback
            messages: {
                en: {langGrapes}
            },
        },
        blockManager: {
            // Specify the element to use as a container, string (query) or HTMLElement
            // With the empty value, nothing will be rendered
            appendTo: '',
            
            // Append blocks to canvas on click
            appendOnClick: 0,

            blocks: []
        },

        plugins: [
            'gjs-preset-webpage',
            'grapesjs-tabs',
            'grapesjs-custom-code',
            'grapesjs-touch',
            'grapesjs-tooltip',
            'grapesjs-tui-image-editor',
            'grapesjs-typed',
            'gjs-plugin-ckeditor',
            'grapesjs-blocks-avance',
            'grapesjs-tabs',
            'grapesjs-lory-slider',
            'grapesjs-plugin-social',
            // 'grapesjs-plugin-forms',
            // 'grapesjs-plugin-header',
            // 'grapesjs-blocks-bootstrap4',
            // 'grapesjs-blocks-flexbox-fork',
            // 'grapesjs-custom-blocks',
            // 'grapesjs-style-filter',
            // 'grapesjs-style-gradient',
        ],
        pluginsOpts: {
            'grapesjs-blocks-avance': {
             blocks: ['grid-items', 'list-items', 'header', 'section', 'footer', 'iframe', 'link-block', 'quote', 'text-basic', 'button', 'progress-bar'],
                
                //prefixName: 'blocks-advanced',

                //gridsCategory: `Marketing`,

                //containerCategory: `Containers`,

                //avanceCategory: `Avance`,
                
                },
                
                'grapesjs-lory-slider' : {

  
    // Pass a falsy value to avoid adding the block
    sliderBlock: {category:'Extra'},

    // Object to extend the default slider properties, eg. `{ name: 'My Slider', draggable: false, ... }`
    sliderProps: {},

    // Object to extend the default slider frame properties
    frameProps: {},

    // Object to extend the default slides properties
    slidesProps: {},

    // Object to extend the default slide properties
    slideProps: {},

    // Object to extend the default previous nav properties
    prevProps: {},

    // Object to extend the default next nav properties
    nextProps: {},

   // Default slides
   slideEls: `
     <div class="gjs-lory-slide"></div>
     <div class="gjs-lory-slide"></div>
     <div class="gjs-lory-slide"></div>
   `,
//
   // Previous nav element string, as for example, an HTML string
   prevEl: `<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 501.5 501.5">
       <g><path fill="#2E435A" d="M302.67 90.877l55.77 55.508L254.575 250.75 358.44 355.116l-55.77 55.506L143.56 250.75z"/></g>
     </svg>`,
//
    // Next nav element string, as for example, an HTML string
    nextEl: `<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 501.5 501.5">
        <g><path fill="#2E435A" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"/></g>
      </svg>`,
//
   // Class name for the slider frame
   classFrame: 'gjs-lory-frame',
//
   // Class name for slides container
   classSlides: 'gjs-lory-slides',

   // Class name for slides container
   classSlide: 'gjs-lory-slide',

   // Class name for slider previous control
   classPrev: 'gjs-lory-prev',
//
   // Class name for slider next control
   classNext: 'gjs-lory-next',

   // Script to load dynamically in case no lory instance was found
   script: 'https://cdnjs.cloudflare.com/ajax/libs/lory.js/2.3.4/lory.min.js',

  },
                
            'gjs-plugin-ckeditor': {
                position: 'top',
                options: {
                    language: 'ru',
                    toolbar: [
                        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
                        '/',
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                        '/',
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                        { name: 'others', items: [ '-' ] },
                        { name: 'about', items: [ 'About' ] }
                    ],
                }
            },
            'gjs-preset-webpage': {
                blocks: ['link-block', 'quote', 'text-basic'],
                modalImportTitle: 'Import',
                modalImportButton: 'Import',
                modalImportLabel: '',
                modalImportContent: '',
                importViewerOptions: {},
                textCleanCanvas: 'Are you sure to clean the canvas?',
                showStylesOnChange: true,
                textGeneral: 'General',
                textLayout: 'Layout',
                textTypography: 'Typography',
                textDecorations: 'Decorations',
                textExtra: 'Extra',
                customStyleManager: [],
                blocksBasicOpts: {},
                navbarOpts: {},
                countdownOpts: {},
                formsOpts: {},
                exportOpts: {},
                aviaryOpts: false,
                filestackOpts: false,
            },
            'grapesjs-tooltip': {
                id: 'tooltip',

                // Label of the tooltip. Used for the block and component name
                labelTooltip: 'Tooltip',

                // Object to extend the default tooltip block, eg. { label: 'Tooltip', category: 'Extra', ... }.
                // Pass a falsy value to avoid adding the block
                blockTooltip: {},

                // Object to extend the default tooltip properties, eg. `{ name: 'Tooltip', droppable: false, ... }`
                propsTooltip: {},

                // A function which allows to extend default traits by receiving the original array and returning a new one
                extendTraits: traits => traits,

                // Tooltip attribute prefix
                attrTooltip: 'data-tooltip',

                // Tooltip class prefix
                classTooltip: 'tooltip-component', 

                // Custom CSS styles, this will replace the default one
                style: 'style-tooltip',

                // Additional CSS styles
                styleAdditional: '',

                // Make all tooltip relative classes private
                privateClasses: 0,

                // Indicate if the tooltip can be styled. You can also pass an array
                // of which proprties can be styled. Eg. `['color', 'background-color']`
                stylableTooltip: [
                    'background-color',
                    'padding',
                    'padding-top',
                    'padding-right',
                    'padding-bottom',
                    'padding-left',
                    'font-family',
                    'font-size',
                    'font-weight',
                    'letter-spacing',
                    'color',
                    'line-height',
                    'text-align',
                    'border-radius',
                    'border-top-left-radius',
                    'border-top-right-radius',
                    'border-bottom-left-radius',
                    'border-bottom-right-radius',
                    'border',
                    'border-width',
                    'border-style',
                    'border-color',
                ],

                // If true, force the tooltip to be shown
                showTooltipOnStyle: 1,
            },
            'grapesjs-tui-image-editor': {
                config: {},

                // Pass the editor constructor. By default, the `tui.ImageEditor` will be called
                constructor: '',

                // Label for the image editor (used in the modal)
                labelImageEditor: 'Image Editor',

                // Label used on the apply button
                labelApply: 'Apply',

                // Default editor height
                height: '650px',

                // Default editor width
                width: '100%',

                // Id to use to create the image editor command
                commandId: 'tui-image-editor',

                // icon used in the component toolbar
                // Hide the default editor header
                hideHeader: 1,

                // By default, GrapesJS takes the modified image, adds it to the Asset Manager and update the target.
                // If you need some custom logic you can use this custom 'onApply' function
                // eg.
                // onApply: (imageEditor, imageModel) => {
                //   const dataUrl = imageEditor.toDataURL();
                //   editor.AssetManager.add({ src: dataUrl }); // Add it to Assets
                //   imageModel.set('src', dataUrl); // Update the image component
                // }
                onApply: 0,

                // If no custom `onApply` is passed and this option is `true`, the result image will be added to assets
                addToAssets: 1,

                // If no custom `onApply` is passed, on confirm, the edited image, will be passed to the AssetManager's
                // uploader and the result (eg. instead of having the dataURL you'll have the URL) will be
                // passed to the default `onApply` process (update target, etc.)
                upload: 0,

                // The apply button (HTMLElement) will be passed as an argument to this function, once created.
                // This will allow you a higher customization.
                onApplyButton: () => {
                },

            },
            'grapesjs-typed': {
                block: {},

                props: i => i,
            },
            'grapesjs-plugin-forms': {
                blocks: ['form', 'input', 'textarea', 'select',
                    'button', 'label', 'checkbox', 'radio'],
                labelTraitMethod: 'Method',
                labelTraitAction: paramAction,
                labelTraitState: 'State',
                labelTraitId: 'ID',
                labelTraitFor: 'For',
                labelInputName: 'Input',
                labelTextareaName: 'Textarea',
                labelSelectName: 'Select',
                labelCheckboxName: 'Checkbox',
                labelRadioName: 'Radio',
                labelButtonName: 'Button',
                labelTraitName: 'Name',
                labelTraitPlaceholder: 'Placeholder',
                labelTraitValue: 'Value',
                labelTraitRequired: 'Required',
                labelTraitType: 'Type',
                labelTraitOptions: 'Options',
                labelTraitChecked: 'Checked',
                labelTypeText: 'Text',
                labelTypeEmail: 'Email',
                labelTypePassword: 'Password',
                labelTypeNumber: 'Number',
                labelTypeSubmit: 'Submit',
                labelTypeReset: 'Reset',
                labelTypeButton: 'Button',
                labelNameLabel: 'Label',
                labelForm: 'Form',
                labelSelectOption: '- Select option -',
                labelOption: 'Option',
                labelStateNormal: 'Normal',
                labelStateSuccess: 'Success',
                labelStateError: 'Error',
                category: 'Forms',
            },
            'grapesjs-blocks-bootstrap4': {
                default: true,
                text: true,
                link: true,
                image: true,
                // LAYOUT
                container: true,
                row: true,
                column: true,
                column_break: true,
                media_object: true,
                // COMPONENTS
                alert: true,
                tabs: true,
                badge: true,
                button: true,
                button_group: true,
                button_toolbar: true,
                card: true,
                card_container: true,
                collapse: true,
                dropdown: true,
                // TYPOGRAPHY
                header: true,
                paragraph: true,
                // BASIC
                list: true,
                // FORMS
                form: true,
                input: true,
                form_group_input: true,
                input_group: true,
                textarea: true,
                select: true,
                label: true,
                checkbox: true,
                radio: true,
                // COMPONENTS
                tab: 'Tab',
                tabPane: 'Tab Pane',
                dropdown_menu: 'Dropdown Menu',
                dropdown_item: 'Dropdown Item',
                // FORMS
                file_input: 'File',
                select_option: '- Select option -',
                option: 'Option',
                trait_method: 'Method',
                trait_enctype: 'Encoding Type',
                trait_multiple: 'Multiple',
                trait_action: paramAction,
                trait_state: 'State',
                trait_id: 'ID',
                trait_for: 'For',
                trait_name: 'Name',
                trait_placeholder: 'Placeholder',
                trait_value: 'Value',
                trait_required: 'Required',
                trait_type: 'Type',
                trait_options: 'Options',
                trait_checked: 'Checked',
                type_text: 'Text',
                type_email: 'Email',
                type_password: 'Password',
                type_number: 'Number',
                type_date: 'Date',
                type_hidden: 'Hidden',
                type_submit: 'Submit',
                type_reset: 'Reset',
                type_button: 'Button',
                'layout': true,
                'components': true,
                'typography': true,
                'basic': true,
                'forms': true,
            },
            'grapesjs-blocks-flexbox-fork': {
                flexboxBlock: {},

                // Classes prefix
                stylePrefix: '',

                // Row label
                labelRow: 'Row',

                // Column label
                labelColumn: 'Column',
            },
            'grapesjs-style-filter': {
                inputFilterType: {},

                // Extend the default filter strength input, eg. `{ name: 'Blur', defaults: 50, ... }`
                inputFilterStrength: {},

                // Customize the filter strength input when it should be updated. The option
                // is a function, which receive the current object type and returns a new one
                filterStrengthChange: type => type,
            },
            'grapesjs-style-gradient': {
                grapickOpts: {},

                // Custom color picker, check Grapick's repo to get more about it
                // If you leave it empty the native color picker will be used.
                // You can use 'default' string to get the one used by Grapesjs (which
                // is spectrum at the moment of writing)
                colorPicker: '',

                // Show gradient direction input under picker, you can pass an object
                // as a model
                inputDirection: 1,

                // Show gradient type input under picker, you can pass an object as
                // a model
                inputType: 1,
            },
            
            'grapesjs-tabs': {
                tabsBlock: {category:'Extra'},
                tabsProps: {},

                // Object to extend the default tab properties
                tabProps: {},

                // Object to extend the default tab content properties
                tabContentProps: {},

                // Object to extend the default tab container properties
                tabContainerProps: {},

                // Default class to use on tab
    classTab: 'tab',

    // Class used on tabs when active
    classTabActive: 'tab-active',

    // Default class to use on tab content
    classTabContent: 'tab-content',

    // Default class to use on tab container
    classTabContainer: 'tab-container',

    // The attribute used inside tabs as a selector for tab contents
    selectorTab: 'href',
    
     templateTabContent: `<div>New Tab Content</div>`,
     
     style: `
      .tab {
        text-decoration: none;
        color: inherit;
        padding: 7px 14px;
        transition: opacity 0.3s;
        display: inline-block;
        border-radius: 3px;
        margin-right: 10px;
      }
      .tab.tab-active {
        background-color: #0d94e6;
        color: white;
      }
      .tab-content {
        padding: 6px 12px;
        min-height: 100px;
        animation: fadeEffect 1s;
      }
      @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
      }
    `
                
            },
            

        },
    });
    
    
        // FUNCTIONS FOR COMPONENT:ADD EVENTS
    
        function setOptions() {
                      
            const wrapper = editor.DomComponents.getWrapper();
            const components = wrapper.find('[data-gjs-type]');
            components.forEach(function(component) {
            
            const componentEl = component.getEl();
            component.set({
                'editable': false,
                'copyable': false,
                'droppable': false,
                'draggable': false,
                'hoverable': false,
                'selectable': false,
                'stylable': false,
                'highlightable': false,
                'badgable': false,
                'layerable': false,
                'ajaxable': true,
            });
            
            
             if ($(componentEl).hasClass('parent-div')
             || $(componentEl).hasClass('col'))
                component.set({
                    'copyable': true,
                    'ajaxable': true,
                    'droppable': false,
                    'stylable': true,
                    'draggable': '.col',
                    'hoverable': true,
                    'selectable': true,
                    'highlightable': true,
                    'layerable': true,
                });
            
             if ($(componentEl).hasClass('col'))
                component.set({
                    'droppable': true,
                });
            
            
             if (component.get('type') === 'text') 
                 component.set({
                    'editable': true
                 });
             
            });
                        
        }
        
        var arrayAssets = [];            

        function getAssets(model, response) {
            
            model.attributes.content = response; 
                       
            const responseDom = $.parseHTML(response, document, true);
            const canvasHead = editor.Canvas.getDocument().head;
            
            $(responseDom).each(function(i , el) {
                
                const src = $(el).attr("src");
                const href = $(el).attr("href");
                if (src && !arrayAssets.includes(src)) {
                    const script = document.createElement("script");
                    script.src = src;
                    script.type = "text/javascript";
                    canvasHead.append(script);
                    arrayAssets.push(src);
                }
                
                if (href && !arrayAssets.includes(href)) {
                    const link = document.createElement("link");
                    link.href = href;
                    link.rel = "stylesheet";
                    canvasHead.append(link);
                    arrayAssets.push(href);
                }
                
            });
            
            
        }
        
        
        
        editor.on('load', {load})
              .on('component:add',{component:add})
              .on('component:drag', {component:drag})
              .on('component:drag:start', {component:drag:start})
              .on('component:drag:end', {component:drag:end})
              .on('component:selected', {component:selected})
              .on('component:remove', {component:remove}) 
              .on('component:clone', {component:clone})
              .on('component:mount',{component:mount}) 
              .on('component:update', {component:update})
              .on('component:update:{propertyName}', {property:compUpdate})
              .on('component:styleUpdate', {component:styleUpdate})
              .on('component:styleUpdate:{propertyName}', {property:styleUpdate}) 
              .on('component:toggled',{component:toggled})
              .on('storage:load', {storage:load})
              .on('storage:store', {storage:store} )
              .on('block:add',{block:add}) 
              .on('block:remove',{block:remove})
              .on('block:drag:start', {block:dragStart})
              .on('block:drag',{block:drag})
              .on('block:drag:stop',{block:dragStop})
              .on('assets:add', {assets:add})
              .on('assets:remove', {assets:remove})
              .on('assets:start', {assets:start})
              .on('assets:end', {assets:end})
              .on('assets:response', {assets:response})
              .on('assets:error', {assets:error})
              .on('keymap:add', {keymap:add})
              .on('keymap:remove', {keymap:remove})
              .on('keymap:emit', {keymap:emit})
              .on('emit:(id, alt + u, e)', {emit:(id, alt + u, e)})
              .on('styleManager:update:target', {styleManager:update:target})
              .on('styleManager:change', {styleManager:change})
              .on('styleManager:change:{propertyName}', {styleManagerProp:change})
              .on('storage:start', {storage:start})
              .on('storage:start:store', {storage:start:store})
              .on('storage:start:load', {storage:start:load})
              .on('storage:load', {storage:load})
              .on('storage:store', {storage:store})
              .on('storage:end', {storage:end})
              .on('storage:end:store', {storage:end:store})
              .on('storage:end:load', {storage:end:load})
              .on('storage:error', {storage:error})
              .on('storage:error:store', {storage:error:store})
              .on('storage:error:load', {storage:error:load})
              .on('canvas:dragenter', {canvas:dragenter})
              .on('canvas:dragover', {canvas:dragover})
              .on('canvas:drop', {canvas:drop})
              .on('canvas:dragend', {canvas:dragend})
              .on('canvas:dragdata', {canvas:dragdata})
              .on('selector:add', {selector:add})
              .on('rte:enable', {rte:enable})
              .on('rte:disable', {rte:disable})
              .on('modal:open', {modal:open})
              .on('modal:close', {modal:close})
              .on('run:{commandName}', {run:commandName})
              .on('stop:{commandName}', {stop:commandName})
              .on('run:{commandName}:before', {run:commandName:before})
              .on('stop:{commandName}:before', {stop:commandName:before})
              .on('abort:{commandName}', {abort:commandName})
              .on('run:tlb-move', {run:tlb-move})
              .on('run', {run})
              .on('stop', {stop})
              .on('canvasScroll', {canvasScroll})
              .on('update', {update})
              .on('undo', {undo})
              .on('redo', {redo})
        
                 
        const body = editor.Canvas.getDocument().body;
        body.insertAdjacentHTML('beforeend', `<style id="grape_style">{css}</style>`);
        
              
        const commands = editor.Commands;
        const blockManager = editor.BlockManager;
        let buttonManager = editor.Panels;
        
        // Make private already inserted selectors
        editor.SelectorManager.getAll().each(selector => selector.set('private', 1));

        // All new selectors will be private
        editor.on('selector:add', selector => selector.set('private', 1));

        
        const cols = [
            blockManager.get('column1'),
            blockManager.get('column2'),
            blockManager.get('column3'),
            blockManager.get('column3-7'),
        ];
        
        cols.map((i,col)=>
            i.set({
                category:'columns'
            })
        )  ;
        
        
        const layerManager = editor.LayerManager;
        const cssManager = editor.CssComposer;
        
        cssManager.getAll();
       
        let rule = cssManager.setRule(".gjs-selected", {border:"2px dashed red"}); 
        rule.toCSS();
        let importCss = `{css}`;
    
    {blocks}
    {buttons}
    {columns}
    {templates}
  
    
JS,

        'button' => <<<JS
            if (buttonManager.getButton('{panelId}','{id}')){
                buttonManager.removeButton('{panelId}', '{id}');
                buttonManager.addButton('{panelId}',
                {
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
            } 
            else{
                buttonManager.addButton('{panelId}',
                {
                   id: '{id}',  
                    className: 'fa {icon}',
                    command: {command},
                    tagName:'{tagName}', 
                    attributes: {attributes},
                    label: '{label}',
                    active:'{active}',  
                    dragDrop:'{dragDrop}',
                    togglable:'{togglable}',
                    disable:'{disable}',
                });
            }
JS,

        'tbButton' => /** @lang JavaScript */
            <<<JS
{  
    command: {command},
    attributes: {
        class: '{class}', 
        id: '{id}', 
        title: '{title}', 
        name: '{name}', 
        draggable: '{draggable}'
    }
},
JS,

        'blocks' => <<<JS
        blockManager.add('{blockId}', {
            category: '{category}',
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{label}</div>
            </div>`,
            attributes: {
                class:'widgets grapes-tooltip',
                'data-tooltip-content': '#{title}-tooltip'
            },
            content: {
                type: '{type}',                        
                name: '{ajaxName}', //'zetsoft/widgets/inptest/ZKSelect2AjaxWidget'
                removable: {removable},         //true
                draggable: {draggable},      // true
                droppable: {droppable},      // true
                badgable: {badgable},        // true
                stylable: {stylable},        // true
                isAll:{isAll},        // true
                'stylable-require': [],
                unstylable:{unstylable},    //[]  ,
                'style-signatur': [],
                highlightable:{highlightable},      // true
                copyable:{copyable},        // true
                resizable:{resizable},      // false //https://github.com/artf/grapesjs/blob/master/src/utils/Resizer.js
                layerable: {layerable},         //true
                selectable: {selectable},       //true
                hoverable: {hoverable},         //true
                editable:{editable},        //false
                content: `{content}`,
                style: {},
                void: {void},       //true
                toolbar: [{tbItem}],
                icon:'{icon}', //'fas fa-car'
                script:function() {
                 {script}
                }
            },                  
      
        });
JS,

        'templates' => <<<JS
        blockManager.add('{blockId}', {
            category: '{category}',
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{title}</div>
            </div>`,
            attributes: {
                title: 'Insert h1 block',
                class:'templates'
            },
            content: {
                type: '{type}',                        
                name: '{ajaxName}', //'zetsoft/widgets/inptest/ZKSelect2AjaxWidget'
                removable: {removable},         //true
                draggable:{draggable},      // true
                droppable:{droppable},      // true
                badgable:{badgable},        // true
                stylable:{stylable},        // true
                'stylable-require': [],
                unstylable:{unstylable},    //[]  ,
                'style-signatur': [],
                highlightable:{highlightable},      // true
                copyable:{copyable},        // true
                resizable:{resizable},      // false //https://github.com/artf/grapesjs/blob/master/src/utils/Resizer.js
                layerable: {layerable},         //true
                selectable: {selectable},       //true
                hoverable: {hoverable},         //true
                editable:{editable},        //false
                content: `{content}`,
                style: {},
                void: {void},       //true
                icon:'{icon}', //'fas fa-car'
                script:function() {
                 {script}
                }
            },                  
           
        });
JS,

        'columns' => <<<JS
        blockManager.add('{blockId}', {
            category: '{category}',
            label: `<div><i class="fa-2x {icon}"></i> 
              <div class="gjs-block-label">{title}</div>
            </div>`,
            attributes: {
                title: 'Insert h1 block'
            },
            content: `{content}`,
        });
JS,

        'mainCss' => <<<CSS
           .gjs-pn-options .gjs-pn-buttons .fa-eye{
border: 1px solid {thirdColor};

}

#search_grape{
    
border: 1px solid {thirdColor};

}

.gjs-pn-views{
   
background-color: {secondaryColor};
}

.gjs-title:hover{
color: {thirdColor}!important;
}


#review_div{
  
border: 0.5px solid {secondaryColor};

}

.gjs-one-bg{
background-color:{primaryColor};
}

.gjs-editor{
background-color:{secondaryColor}!important;
}

.gjs-block:hover{
background-color: {activeBtnColor};
color:{thirdColor}
}


#gjs-clm-states{
background-color:{secondaryColor};
}

.gjs-clm-tags #gjs-clm-tags-field{
background-color: {secondaryColor};
}

.gjs-radio-item{
background-color: {secondaryColor};
}
.gjs-field-integer input{
background-color: {secondaryColor};
}

.gjs-input-holder input{
color:{btnItemColor}!important;
}
.gjs-fields{
background-color: {secondaryColor};
}

.gjs-block-category .gjs-title, .gjs-category-title, .gjs-clm-tags .gjs-sm-title, .gjs-layer-title, .gjs-sm-sector .gjs-sm-title{
background-color: {blockColor};

border-top: 0.5px solid {thirdColor}d6;

}
.gjs-block-category .gjs-title:hover, .gjs-category-title:hover, .gjs-clm-tags .gjs-sm-title:hover, .gjs-layer-title:hover, .gjs-sm-sector .gjs-sm-title:hover{
background-color: {activeBtnColor};
}
.gjs-blocks-c{

background-color:{secondaryColor};
}

.gjs-two-color{
color:{btnItemColor};

}
.gjs-three-bg{
background-color:{activeBtnColor};
}

.select2-container--bootstrap4 .select2-selection__clear{
 
color: {thirdColor};

}

#gjs-clm-new{
color:{btnItemColor}!important;
}

#search-grape:active #scope_div span{
background-color: {primaryColor};
}

.gjs-block{
border: 0.7px solid {thirdColor};

}

.gjs-clm-tags .gjs-sm-stack #gjs-sm-add, .gjs-color-main, .gjs-off-prv, .gjs-sm-sector .gjs-sm-stack #gjs-sm-add{
color:{thirdColor};
fill: {thirdColor};
}
.gjs-bg-main, .gjs-clm-tags .gjs-sm-colorp-c, .gjs-off-prv, .gjs-sm-sector .gjs-sm-colorp-c{
background-color: {secondaryColor};
}


.gjs-pn-btn.gjs-pn-active{
background-color: {activeBtnColor};
color:{thirdColor};
}

.gjs-pn-btn:hover{
background-color: {activeBtnColor};
color:{thirdColor}
}

.submit_button {
   
color: {primaryColor};

}
CSS,

        'css' => <<<CSS
        .addedBtn {
            color: {btnItemColor};
        }

CSS,

        'saveJs' => <<<JS
        panelManager.addButton('options', {
        id: 'saveFile',
        tagName: 'span',
        attributes: {
            title: 'Save to file',
            id: 'saveFile',
        },
        className: 'saveFile fas fa-save btn btn-outline-success',
        command: function() {
            saveContentPhp("ajax");
        }
    });
    

// Connect to socket
var conn = new WebSocket('ws://localhost:1997');
conn.onmessage = function (data) {
    $('#saveFile').show()
    $('.spinner-border').remove()
    if (data){
    }else{
    }
};
// save content
setInterval(function(){
    if (conn.readyState === WebSocket.OPEN)
    saveContentPhp() 
    }, 
3000);

//Retry connection
conn.onclose = function (event) {
    console.log('Socket is closed. Reconnect will be attempted in 1 second.', e.reason);
    setTimeout(function() {
      var conn = new WebSocket('ws://localhost:1997');
    }, 1000);
  };
//Retry connection
function saveContentPhp(type) {
    $('.gjs-pn-btn.fa-eye').before('<span class="spinner-border text-primary" role="status" style="position: absolute; right: -17px;"><span class="sr-only">Loading...</span></span>');
            let wrapper = $(editor.Canvas.getDocument().body).find('#wrapper');
            let content = $(wrapper).clone();
            let styles = content.find('.parent-div');
            let divs = content.find('div');
            
            content.find('.widgetsWrap').unwrap('.parent-div');
            
            let css = `{css}`;
           
            let splitedCss = css.split('}'); 
            const canvas = editor.DomComponents.getWrapper();
            const componentsParent = canvas.find('.parent-div');
            componentsParent.forEach(function(parent) {
                
                 var element = $(parent.getEl());
                 
                  let kla='';
                 if (JSON.stringify(parent.getStyle())!=='{}') {
                    if (!css.includes(element.data('id'))){
                        for (let object in parent.getStyle()){
                  kla=kla+object+":"+parent.getStyle()[object]+";";
                        }
                        css += '.' + element.data('id') + "{"+kla+"}";
                      }
                    else{
                        let others='';
                        let important='';
                        let class1='';
                        let index=css.indexOf(element.data('id'));
                        let pos=element.data('id').length+1;
                        /*css=[css.slice(0,index+pos), class1.substring(1,class1.length-1), css.slice(index+pos)].join('');*/
                       
                        let aaa=css.substring(index);
                        let interval=aaa.substring(0,aaa.indexOf('}')+1);
                        if (index===0) {
                            important=aaa.substring(aaa.indexOf('}')+1);
                            
                        }
                        else {
                            others=css.substring(0,index-1)+css.substring(index+interval.length) ;
                        
                        };
                        
                        interval=interval.slice(interval.indexOf('{')+1,interval.lastIndexOf('}'));
                        
                        let array=interval.split(';');
                        let counter=[];
                        let count=0;
                         
                         
                        for(let object in parent.getStyle()){

                             array= array.filter(item => !item.includes(object))

                        }
                        
                         for(let object in parent.getStyle()){
                             array.push(object+":"+parent.getStyle()[object])     
                        }
                       
                        
                        let final="."+element.data('id')+"{";
                        array.forEach(function(item) {


                                    final=final+item+";"
                                      
                              })
                          final=final+"}";
                          
                          others=others+final;
                          css = others;
                       
                         }
                         }
            });
            
            
            css = '<style>' + css + '</style>';
            divs.each(function(key, v) {
               v.getAttributeNames().forEach(function(attr) {
                 if (attr !== 'class')
                    $(v).removeAttr(attr);
               });
            });              
             
            if(type === "ajax") {
                $.ajax({
                    method: 'post',
                    url: '/core/grapes/save.aspx',
                    data: {
                        'file': '{saveFile}',
                        'content':  content.html(),
                        'actionId': '{actionId}',
                        'css': css,
                    },
                    success: function() {
                        $('.spinner-border').remove()
                    },
                    error: function (event) {
                        alert("error --- " + e.status + "  statusText:" + e.statusText)
                        $('.spinner-border').remove()
                    }
                });
            }
               else{
                    var save_content = JSON.stringify({content : content.html(), actionId:  "{actionId}", config:  "{saveFile}"});
                    conn.send(save_content);
               }
}
// end save content
// end connection to socket
JS

    ];


    public const type = [
        'stepper-vertical' => 'stepper-vertical',
        'stepper-horizontal' => 'stepper-horizontal',
        'linear' => 'linear',
        'parallel' => 'parellel',
        'horizontal' => 'horizontal',
    ];

    public function asset()
    {
        $this->fileCss('/render/former/ZGrapesJsWidget/asset/main/grapes.min.css');
        
        $this->fileCss('/render/former/ZGrapesJsWidget/asset/tooltips/tooltipster.bundle.min.css');
        $this->fileJs('/render/former/ZGrapesJsWidget/asset/tooltips/tooltipster.bundle.min.js');
        

        $this->fileJs('/render/former/ZGrapesJsWidget/asset/main/grapes-search.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-preset-webpage@0.1.11/dist/grapesjs-preset-webpage.min.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-plugin-ckeditor@0.0.9/dist/grapesjs-plugin-ckeditor.min.js');
        $this->fileCss('/render/former/ZGrapesJsWidget/asset/icon/Css/styleButtons.css');
        $this->fileCss('/render/former/ZGrapesJsWidget/assets/grapesjs/material.css');

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/simple-hint/3.0.0/simple-hint.min.css');
        $this->fileJs('https://raw.githack.com/omarmd1986/grapesjs-blocks-avance/master/dist/grapesjs-blocks-avance.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-tabs@0.2.2/dist/grapesjs-tabs.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-lory-slider@0.1.5/dist/grapesjs-lory-slider.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-plugin-social@0.0.11/dist/grapesjs-plugin-social.min.js');
        $this->fileCss('/render/former/ZGrapesJsWidget/asset/main/mainCss.css');
    }

   /* public function init()
    {
        parent::init();
        ob_start();

        Az::$app->params['grape'] = true;

    }*/

    public function codes()
    {



        $get = $this->httpGet('path');
        $basename = bname($get);
        $currentFileName = str_replace('.php', '', $basename);
        $folderName = bname(str_replace($basename, '', $get));
        $renderPath = str_replace($currentFileName, 'content', $get);

        if ($folderName === 'ALL') {
            $renderPath = str_replace($currentFileName, 'content_' . $currentFileName, $get);
        }

        $getPath = Root . '\\' . $renderPath . '.php';

        if (empty($this->_config['saveFile'])) {
            $this->_config['saveFile'] = str_replace('\\', '/', $getPath);
        }

        $actionId = $this->httpGet('key');
        $PageAction = PageAction::findOne($actionId);

        switch (true) {
            case  $renderPath:
                $href = '/core/tester/asror/main.aspx?path=' . $renderPath;
                break;
            case  $PageAction:
                $href = '/' . $PageAction->data . '.aspx';
                break;
            default :
                $href = '/core/widget/class.aspx';
        }

        $this->htm = strtr($this->_layout['html'], [
            '{content}' => ob_get_clean(),
        ]);


        #region toolbar buttons starts

        if ($this->_config['tbButtons'] !== null)
            $tbButtons = $this->_config['tbButtons'];
        else {
            $tbButtons = [];
            //edit
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = '';
            $tbButton->class = 'fa fa-cog';
            $tbButton->title = Az::l('Редактировать');
            $tbButton->name = '';
            $tbButton->draggable = false;
            $tbButton->command = /** @lang JavaScript */

                <<<JS
                    function (e) {
    const buttonManager=editor.Panels;
    const openSm=buttonManager.getButton('views','open-tm');
    openSm.set('active',1)
                    } 
JS;
            $tbButtons[] = $tbButton;
            //edit
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = '';
            $tbButton->class = 'fa fa-paint-brush';
            $tbButton->title = Az::l('Редактировать');
            $tbButton->name = '';
            $tbButton->draggable = false;
            $tbButton->command = /** @lang JavaScript */
                <<<JS
                 function (event) {
                    const buttonManager=editor.Panels;
                    const openTm = buttonManager.getButton('views','open-sm');
                    openTm.set('active',1) ;
                   
                } 
JS;
            $tbButtons[] = $tbButton;


            //drag
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = 'tbdrag';
            $tbButton->class = 'fa fa-arrows';
            $tbButton->title = Az::l('Выдвинуть');
            $tbButton->name = '';
            $tbButton->draggable = true;
            $tbButton->command = "'tlb-move'";
            $tbButtons[] = $tbButton;
            //up
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = 'arrowUp';
            $tbButton->class = 'fa fa-arrow-up';
            $tbButton->title = Az::l('Выдвинуть на верх');
            $tbButton->name = '';
            $tbButton->draggable = false;
            $tbButton->command = /** @lang JavaScript */
                <<<JS
function command(ed) {
    return ed.runCommand('core:component-exit', {
        force: 1
    });
}
JS;
            $tbButtons[] = $tbButton;
            //clone
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = 'tbclone';
            $tbButton->class = 'fa fa-clone';
            $tbButton->title = Az::l('Клонировать');
            $tbButton->name = '';
            $tbButton->draggable = false;
            $tbButton->command = "'tlb-clone'";
            $tbButtons[] = $tbButton;
            //delete
            $tbButton = new GrapeToolbarItem();
            $tbButton->id = 'tbdelete';
            $tbButton->class = 'fa fa-trash-o';
            $tbButton->title = Az::l('Удалить');
            $tbButton->name = '';
            $tbButton->draggable = false;
            $tbButton->command = "'tlb-delete'";
            $tbButtons[] = $tbButton;
        }

        #toolbar buttons end


        #buttons add/edit start

        if ($this->_config['buttons'] !== null)
            $btns = $this->_config['buttons'];
        else {
            $btns = [];

            $btn = new GrapeBtnItem();
            $btn->panelId = 'options';
            $btn->id = 'fullscreen';
            $btn->attributes = [
                'title' => 'FullScreen'
            ];
            $btn->tagName = 'span';
            $btn->icon = 'fas fa-arrows-alt btn btn-outline-primary';
            $btn->label = '';
            $btn->command = 'fullscreen';
            $btns['fullscreen'] = $btn;

            $btn = new GrapeBtnItem();
            $btn->panelId = 'options';
            $btn->id = 'canvas-clear';
            $btn->attributes = [
                'title' => 'Clear'
            ];
            $btn->tagName = 'span';
            $btn->icon = 'fas fa-trash btn btn-outline-danger';
            $btn->label = '';
            $btn->command = 'clear';
            $btns['clear'] = $btn;

            $btn = new GrapeBtnItem();
            $btn->panelId = 'options';
            $btn->id = 'sw-visibility';
            $btn->attributes = [
                'title' => 'View'
            ];
            $btn->tagName = 'span';
            $btn->icon = 'fas fa-square-o btn btn-outline-primary';
            $btn->label = '';
            $btn->command = 'sw-visibility';
            $btns['view'] = $btn;

            $btn = new GrapeBtnItem();
            $btn->panelId = 'options';
            $btn->id = 'gotoPage';
            $btn->tagName = 'a';
            $btn->icon = 'fas fa-location-arrow btn btn-outline-primary gotoPage';
            $btn->label = '';
            $btn->attributes = [
                'href' => $href,
                'target' => '_blank',
                'title' => 'Go to Page'
            ];
            $btn->command = 'function(){console.log("gotoPage")}';
            $btns['gotoPage'] = $btn;
        }

        #endregion

        $service = Az::$app->App->eyuf->grapes;

        $data = $service->grapesCategories($this->_config['categories']);

        if (!empty($this->_config['widgets']))
            $data = $service->grapesWidgets($this->_config['widgets']);

        $toolbarButtons = '';
        /** @var GrapeToolbarItem $tbItem */
        foreach ($tbButtons as $tbItem) {
            $toolbarButtons .= strtr($this->_layout['tbButton'], [
                '{id}' => $tbItem->id,
                '{class}' => $tbItem->class,
                '{title}' => $tbItem->title,
                '{name}' => $tbItem->name,
                '{draggable}' => $tbItem->draggable,
                '{command}' => $tbItem->command,
            ]);
        }

        $tooltips = $service->tooltip();
        /** @var GrapeTooltipItem $value */
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

        $this->js = strtr($this->_layout['tooltipTheme'], [
            '{tooltipTheme}' => $this->_config['tooltipTheme'],
        ]);
        $blocks = '';

        /** @var GrapeItem $grapItem */
        foreach ($data as $grapItem) {

            $icon = $tooltips[$grapItem->title]->icon;

            if (empty($icon))
                $icon = Az::$app->utility->mains->icon(true);

            $blocks .= strtr($this->_layout['blocks'], [
                '{blockId}' => $this->jscode($grapItem->blockId),
                '{img}' => $this->jscode($grapItem->img),
                '{blockName}' => $this->jscode($grapItem->blockName),
                '{content}' => $this->jscode($grapItem->content),
                '{category}' => $this->jscode($grapItem->category),
                '{script}' => $this->jscode($grapItem->script),
                '{style}' => $this->jscode($grapItem->style),
                '{label}' => $this->jscode($grapItem->blockName),
                '{title}' => $this->jscode($grapItem->title),
                '{src}' => $this->jscode($grapItem->src),
                '{type}' => $this->jscode($grapItem->type),
                '{removable}' => $this->jscode($grapItem->removable),
                '{draggable}' => $this->jscode($grapItem->draggable),
                '{droppable}' => $this->jscode($grapItem->droppable),
                '{isAll}' => $this->jscode($grapItem->isAll),
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
                '{icon}' => $this->jscode($icon),
                '{components}' => $this->jscode($grapItem->components),
                '{class}' => $this->jscode($grapItem->class),
                '{propagate}' => $this->jscode([$grapItem->propagate]),
                '{unstylable}' => $this->jscode([$grapItem->unstylable]),
                '{tbItem}' => $this->jscode($toolbarButtons),
            ]);
        }

        $buttons = '';
        /** @var GrapeBtnItem $btnItem */
        foreach ($btns as $btnItem) {
            switch ($btnItem->type) {

                default:
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
        }

        $getTemplates = $service->getTemplates();

        $templates = '';

        foreach ($getTemplates as $grapItem) {

            $templates .= strtr($this->_layout['templates'], [
                '{blockId}' => $grapItem->blockId,
                '{img}' => $grapItem->img,
                '{blockName}' => $grapItem->blockName,
                '{content}' => $grapItem->content,
                '{category}' => $grapItem->category,
                '{script}' => $grapItem->script,
                '{style}' => $grapItem->style,
                '{title}' => $grapItem->title,
                '{src}' => $grapItem->src,
                '{type}' => $grapItem->type,
                '{removable}' => $grapItem->removable,
                '{draggable}' => $grapItem->draggable,
                '{droppable}' => $grapItem->droppable,
                '{badgable}' => $grapItem->badgable,
                '{stylable}' => $grapItem->stylable,
                '{highlightable}' => $grapItem->highlightable,
                '{copyable}' => $grapItem->copyable,
                '{resizable}' => 0,
                '{editable}' => $grapItem->editable,
                '{layerable}' => $grapItem->layerable,
                '{selectable}' => $grapItem->selectable,
                '{ajaxName}' => $grapItem->ajaxName,
                '{hoverable}' => $grapItem->hoverable,
                '{void}' => $grapItem->void,
                '{icon}' => $grapItem->icon,
                '{components}' => $grapItem->components,
                '{toolbar}' => $grapItem->toolbar,
                '{class}' => $grapItem->class,
                '{propagate}' => $this->jscode([$grapItem->propagate]),
                '{unstylable}' => $this->jscode([$grapItem->unstylable]),
            ]);
        }

        $getColumns = $service->getColumns();

        $columns = '';

        foreach ($getColumns as $grapItem) {
            $columns .= strtr($this->_layout['columns'], [
                '{blockId}' => $grapItem->blockId,
                '{blockName}' => $grapItem->blockName,
                '{content}' => $grapItem->content,
                '{category}' => $grapItem->category,
                '{title}' => $grapItem->title,
                '{icon}' => $grapItem->icon,
            ]);
        }

        $this->htm .= <<<HTML

<div class="tooltip_templates">
    {$tooltip}        
</div>
HTML;

        $lang = file_get_contents(Root . '\render\former\ZGrapesJsWidget\asset\main\langs\\' . $this->_config['lang'] . '.js');

        $this->js .= strtr($this->_layout['main'], [
            '{blocks}' => $blocks,
            '{columns}' => $columns,
            '{buttons}' => $buttons,
            '{style_label}' => ZGrapesJsWidget::style_label,
            '{css}' => $this->jscode($this->_config['css']),
            '{templates}' => $templates,
            '{autoAdd}' => $this->jscode($this->_config['autoAdd']),
            '{dropzone}' => $this->jscode($this->_config['dropzone']),
            '{styles}' => $this->jscode($this->_config['styles']),
            '{scripts}' => $this->jscode($this->_config['scripts']),
            '{langGrapes}' => $this->jscode($lang),

            '{component:add}' => $this->eventCode('component:add'),
            '{ready}' => $this->eventCode('ready'),
            '{component:mount}' => $this->eventCode('component:mount'),
            '{storage:load}' => $this->eventCode('storage:load'),
            '{storage:store}' => $this->eventCode('storage:store'),
            '{component:clone}' => $this->eventCode('component:clone'),
            '{component:drag:start}' => $this->eventCode('component:drag:start'),
            '{component:drag:end}' => $this->eventCode('component:drag:end'),
            '{component:drag}' => $this->eventCode('component:drag'),
            '{component:update}' => $this->eventCode('component:update'),
            '{property:compUpdate}' => $this->eventCode('property:compUpdate'),
            '{component:remove}' => $this->eventCode('component:remove'),

            '{component:styleUpdate}' => $this->eventCode('component:styleUpdate'),
            '{property:styleUpdate}' => $this->eventCode('property:styleUpdate'),

            '{component:selected}' => $this->eventCode('component:selected'),
            '{component:toggled}' => $this->eventCode('component:toggled'),
            '{block:add}' => $this->eventCode('block:add'),
            '{block:remove}' => $this->eventCode('block:remove'),
            '{block:dragStart}' => $this->eventCode('block:dragStart'),
            '{block:drag}' => $this->eventCode('block:drag'),
            '{block:dragStop}' => $this->eventCode('block:dragStop'),

            '{assets:add}' => $this->eventCode('assets:add'),
            '{assets:remove}' => $this->eventCode('assets:remove'),
            '{assets:start}' => $this->eventCode('assets:start'),
            '{assets:end}' => $this->eventCode('assets:end'),
            '{assets:response}' => $this->eventCode('assets:response'),
            '{assets:error}' => $this->eventCode('assets:error'),

            '{keymap:add}' => $this->eventCode('keymap:add'),
            '{keymap:remove}' => $this->eventCode('keymap:remove'),
            '{keymap:emit}' => $this->eventCode('keymap:emit'),
            '{emit:(id, alt + u, e)}' => $this->eventCode('emit:(id, alt + u, e)'),

            '{styleManager:update:target}' => $this->eventCode('styleManager:update:target'),
            '{styleManager:change}' => $this->eventCode('styleManager:change'),
            '{styleManagerProp:change}' => $this->eventCode('styleManager:change:{propertyName}'),

            '{storage:start}' => $this->eventCode('storage:start'),
            '{storage:start:store}' => $this->eventCode('storage:start:store'),
            '{storage:start:load}' => $this->eventCode('storage:start:load'),

            '{storage:end}' => $this->eventCode('storage:end'),
            '{storage:end:store}' => $this->eventCode('storage:end:store'),
            '{storage:end:load}' => $this->eventCode('storage:end:load'),
            '{storage:error}' => $this->eventCode('storage:error'),
            '{storage:error:store}' => $this->eventCode('storage:error:store'),
            '{storage:error:load}' => $this->eventCode('storage:error:load'),

            '{canvas:dragenter}' => $this->eventCode('canvas:dragenter'),
            '{canvas:dragover}' => $this->eventCode('canvas:dragover'),
            '{canvas:drop}' => $this->eventCode('canvas:drop'),
            '{canvas:dragend}' => $this->eventCode('canvas:dragend'),
            '{canvas:dragdata}' => $this->eventCode('canvas:dragdata'),

            '{selector:add}' => $this->eventCode('selector:add'),

            '{rte:enable}' => $this->eventCode('rte:enable'),
            '{rte:disable}' => $this->eventCode('rte:disable'),

            '{modal:open}' => $this->eventCode('modal:open'),
            '{modal:close}' => $this->eventCode('modal:close'),

            '{run:commandName}' => $this->eventCode('run:{commandName}'),
            '{stop:commandName}' => $this->eventCode('stop:{commandName}'),
            '{run:commandName:before}' => $this->eventCode('run:{commandName}:before'),
            '{stop:commandName:before}' => $this->eventCode('stop:{commandName}:before'),
            '{abort:commandName}' => $this->eventCode('abort:{commandName}'),
            '{run:tlb-move}' => $this->eventCode('run:tlb-move'),
            '{run}' => $this->eventCode('run'),
            '{stop}' => $this->eventCode('stop'),
            '{canvasScroll}' => $this->eventCode('canvasScroll'),
            '{update}' => $this->eventCode('update'),
            '{undo}' => $this->eventCode('undo'),
            '{obdev}' => $this->eventCode('obdev'),
            '{redo}' => $this->eventCode('redo'),


            '{load}' => $this->jscode(file_get_contents(Root.'/render/former/ZGrapesJsWidget/asset/main/load_grapes.js')),
        ]);

        switch ($this->_config['theme']) {

            case 'blueTheme':
            {
                $this->css = strtr($this->_layout['mainCss'], [
                    '{primaryColor}' => ZColor::color['oxford-blue'],
                    '{secondaryColor}' => ZColor::color['royal-blue'],
                    '{thirdColor}' => ZColor::color['payne-grey'],
                    '{activeBtn}Color' => ZColor::color['glitter'],
                    '{btnItem}Color' => ZColor::color['glitter'],
                    '{blockColor}' => ZColor::color['royal-blue'],
                ]);
                break;
            }

            case 'bronzeTheme':
            {
                $this->css = strtr($this->_layout['mainCss'], [
                    '{primaryColor}' => ZColor::color['paper'],
                    '{secondaryColor}' => ZColor::color['silk'],
                    '{thirdColor}' => ZColor::color['charcoal'],
                    '{activeBtn}Color' => ZColor::color['pale-gold'],
                    '{btnItem}Color' => ZColor::color['charcoal'],
                    '{blockColor}' => ZColor::color['silk'],
                ]);
                break;
            }

            case 'whiteBlackTheme':
            {
                $this->css = strtr($this->_layout['mainCss'], [
                    '{primaryColor}' => ZColor::color['white'],
                    '{secondaryColor}' => ZColor::color['white'],
                    '{thirdColor}' => ZColor::color['white'],
                    '{activeBtnColor}' => ZColor::color['black'],
                    '{btnItemColor}' => ZColor::color['black'],
                    '{blockColor}' => ZColor::color['white'],
                ]);
                break;
            }

            case 'blackWhiteTheme':
            {
                $this->css = strtr($this->_layout['mainCss'], [
                    '{primaryColor}' => ZColor::color['black'],
                    '{secondaryColor}' => ZColor::color['black'],
                    '{thirdColor}' => ZColor::color['black'],
                    '{activeBtnColor}' => ZColor::color['white'],
                    '{btnItemColor}' => ZColor::color['white'],
                    '{blockColor}' => ZColor::color['black'],
                ]);
                break;
            }

            case 'lightBlueTheme':
            {
                $this->css = strtr($this->_layout['mainCss'], [
                    '{primaryColor}' => ZColor::color['white'],
                    '{secondaryColor}' => ZColor::color['light-grey'],
                    '{thirdColor}' => ZColor::color['medium-blue'],
                    '{activeBtnColor}' => ZColor::color['lighten-blue'],
                    '{btnItemColor}' => ZColor::color['royal-blue'],
                    '{blockColor}' => ZColor::color['light-grey'],
                ]);
                break;
            }

        }

        $href = '/core/tester/asror/main.aspx?path=' . $renderPath;

        if ($PageAction)
            $href = '/' . $PageAction->data . '.aspx';

        $myJS = file_get_contents(Root . '/render/former/ZGrapesJsWidget/asset/main/myJS.js');

        $load_grapes = file_get_contents(Root . '/render/former/ZGrapesJsWidget/asset/main/load_grapes.js');

        //$this->js .= $load_grapes;

        $this->js .= strtr($myJS, [
            '{href}' => $href,
            '{actionId}' => $href,
        ]);

        $this->js .= strtr($this->_layout['saveJs'], [
            '{saveFile}' => $this->_config['saveFile'],
            '{actionId}' => $actionId,
            '{css}' => $this->jscode($this->_config['css']),
        ]);


        /*$this->js.=strtr($this->js,[
            '{css}'=>$this->jscode($this->_config['css'])
        ]); */
    }
}

