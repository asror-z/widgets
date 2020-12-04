<?php

/*
 *
 * class ZJqueryConfirmWidget
 *
 * http://craftpip.github.io/jquery-confirm/#quickfeatures
 *
 * Created By: Nigoraxon G'aniyeva
 * Refactored:
 */


namespace zetsoft\widgets\notifier;


use zetsoft\system\kernels\ZWidget;

class ZJspanelModalWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' =>  '<form class="p-2"><div class="form-group"><label for="exampleInputEmail1">Email address</label><input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"><small id="emailHelp" class="form-text text-muted">Well never share your email with anyone else.</small></div><div class="form-group"><label for="exampleInputPassword1">Password</label><input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div><button type="submit" class="btn btn-primary">Submit</button></form>',
        'headt' => 'This Title',
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/modal/jspanel.modal.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/tooltip/jspanel.tooltip.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/hint/jspanel.hint.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/layout/jspanel.layout.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/contextmenu/jspanel.contextmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/dock/jspanel.dock.js');

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <button class="btn btn-primary createmodal">Create Modal</button>
HTML,


       'js' => <<<JS
        
/*
    METHODS

    .addControl({
            html: '<span class="fa fa-cog"></span>',
            name: 'settings',
            handler: function(panel, control){
                panel.content.innerHTML = 'You clicked the "settings" control';
            }
        })

        var tbar = '<span id="btn-bus"><i class="fa fa-bus"></i></span>'+
    '<span id="btn-train"><i class="fa fa-train"></i></span>'+
    '<span id="btn-car"><i class="fa fa-car"></i></span>';


     .addToolbar('header', tbar, function (panel) {
            var tb = this.headertoolbar;
            tb.querySelector('#btn-bus').addEventListener('click', function () {
                panel.content.innerHTML = 'you clicked the bus icon.';
            }, false);
            tb.querySelector('#btn-train').addEventListener('click', function () {
                panel.content.innerHTML = 'you clicked the train icon.';
            }, false);
            tb.querySelector('#btn-car').addEventListener('click', function () {
                panel.content.innerHTML = 'you clicked the car icon.';
            }, false);
            Array.prototype.slice.call(tb.querySelectorAll('span')).forEach(function (item) {
                item.style.cursor = 'pointer';
                item.style.margin = '3px 8px 1px 0';
            });
        });



            panel.close();
            panel.closeChildpanels();

           panel.contentRemove(function () {
            this.setTheme('darkgray');
        });


            panel.dragit('enable');

          panel.front(function () {
            this.setTheme('purple filledlight');
          });


         .maximize();
         .minimize();
        .normalize();

        panel.overlaps("#testcontainer", "paddingbox", event);

         panel.reposition('left-top 50 50');

         panel
            .resize({
                width:  window.innerWidth/2,
                height: 300
            })

        .resizeit();

        .setBorder('dashed orange');

        .setBorderRadius('0.5rem');

        .setControlStatus('minimize', 'disable');

        .setHeaderLogo('<i class="fa fa-spinner fa-spin"></i>'

        .create().setHeaderTitle('a new title ...');

        .setTheme({
        bgPanel: 'linear-gradient(120deg,#155799,#159957)',
        bgContent: 'transparent',
        colorHeader: '#fff',
        colorContent: '#fff',
        border: '4px solid #157B75'
    });

        .smallify();
        .unsmallify()
    
* */
/*

   options

    addCloseControl: 1,

    animateIn: 'jsPanelFadeIn',
    animateOut: 'jsPanelFadeOut'

    autoclose: 3000,
     autoclose: {
    time: '6s',
    background: 'linear-gradient(90deg, rgba(255,0,0,1) 0%, rgba(0,255,17,1) 100%)'
  }

    border: "thick dashed orange",
    borderRadius: '1rem',

    boxShadow: 2,                 // type: integer range: 0 - 5

    callback: function () {
    this.content.innerHTML = '<p>Added via option.callback.</p>';
  }

    closeOnEscape: true,

    config: hintConfig,     // type object

    container: '#testcontainer',    // type: string (selector), node object, jQuery object

    content: '<p>Appended with <i>Element.innerHTML</i></p>',        // type: string, element, function


     contentAjax: {
    url: '../docs/sample-content/sampleContent.html',   // url type: string, default: undefined
    done: function (panel) {
      panel.content.innerHTML = this.responseText;
    },
    evalscripttags: true
  },                                            //  type: string, object


    contentFetch: {
    resource: '../docs/sample-content/delayedContent.php',
    beforeSend: function() {
      this.headerlogo.innerHTML = "<span class='fa fa-spinner fa-spin' style='margin-left:8px'></span>"
    },
    fetchInit: {
      method: 'POST'
    },
    done: function (panel, response) {
      this.content.innerHTML = response;
      this.headerlogo.innerHTML = "<span class='fa fa-check' style='margin-left:8px'></span>";
      this.resize('auto 300').reposition();
    }
  }                                              // type: string, object


    contentOverflow: 'scroll',            // type: string

    contentSize: '600 300',            // type: object, string
    contentSize: {
    width: function() {
        return window.innerWidth/4
    },
    height: 'auto'
  }

     data: 'foobar',                // type: string, number, array, plain object

     dragit: {
        axis: 'x',
        cursor: 'move'
        //.....
  }                                  // type: object or boolean false (turns off dragit completely)


    footerToolbar: '<span style="flex:1 1 auto">Some text content</span>'      //type: string, array, node object or function

    header: false,        // type: boolean or string     string 'auto-show-hide'


    headerControls: {
    add: {
      html: '<span class="fal fa-undo"></span>',
      name: 'reset',
      handler: function(panel, control){
        panel.content.innerHTML = 'You clicked the "reset" control';
      }
    },
    minimize: 'remove',
    reset: 'enable'
  }                                   // type: object or string


    headerRemove: true

    headerTitle: 'just another title'           // type: string, function or element

     headerToolbar: '<span id="bus"><i class="fad fa-bus fa-fw"></i></span>'         // type: string, array, node object or function


     iconfont: 'material-icons',               // type: string or array

     id: 'mypanel-1',                         // type: string, function

     maximizedMargin: [61, 5, 5, 5]             // type: number, array

     onbeforeclose: function (panel, status, closedByUser) {
        console.log(panel, status, closedByUser);
     return confirm('Close panel?');
  }

    panelSize: '600 300',                          // type: object or string


    position: {
    my: 'right-top',
    at: 'right-top',
    of: 'body .main-content',
    offsetX: '-0.5rem',
    offsetY: '5px',
    autoposition 'down'
}                                                   // type: object, string or boolean false


    resizeit: {
    handles: 'e, se'
  }                                               // type: object or boolean false (turns off resizeit completely)


    theme: 'primary',                           // type: string object

    */
       
    
    $('.createmodal').on('click', function () {
        
            
    
     jsPanel.modal.create({
        contentSize: ({
            width: function () {
                return window.innerWidth / 2
            },
            height: function () {
                return window.innerHeight / 2
            }, 
         
        }),
        position: 'center 50 50',
        closeOnBackdrop: false,
        headerTitle: '{headt}',
       
        content: '{content}',
        //animateIn: 'jsPanelFadeIn',
        //animateOut: 'jsPanelFadeOut',
       
        footerToolbar: '<i class="fa fa-clock"></i><span class="clock">loading ...</span>',
        callback: function (panel) {

            function clock() {
                var time = new Date(),
                    hours = time.getHours(),
                    minutes = time.getMinutes(),
                    seconds = time.getSeconds();
                panel.footer.querySelectorAll('.clock') [0].innerHTML = harold(hours) + ':' + harold(minutes) + ':' + harold(seconds);
                function harold(standIn) {
                    if (standIn < 3) {
                        standIn = '0' + standIn
                    }
                    return standIn;
                }
            }
            setInterval(clock, 1000);
        }
    })
         
        .setBorderRadius('0.3rem')
        .setTheme({
            bgPanel: 'linear-gradient(120deg,#1BE7FF,#fdf000)',
            colorHeader: '#ffffff',
            colorContent: 'black',
            border: '2px solid #dffff1'
        })
        
    
    
    }); 
 

JS,


    ];

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], []);
        $this->js .= strtr($this->_layout['js'], [
            '{content}' => $this->_config['content'],
            '{headt}' => $this->_config['headt'],
        ]);

    }
}
