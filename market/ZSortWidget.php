<?php


namespace zetsoft\widgets\market;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZSignUpWidget;

class ZSortWidget extends ZWidget
{


    public $config = [];
    public $_config = [
             'name'=>' Цена',
             'head'=>'Сортировать по:',
    ];


    public $layout = [];
    public $__layout = [

          /* $data = [
                'name' => 'Imya'
           ]*/


        'main' => <<<HTML

        <nav class="nav border border-success shadow-sm rounded">
                    <span class="mt-2 mx-2">{header} </span>
                   {content}
                </nav>

HTML,
  'content' => <<<HTML

         <a id="sort{key}" role="button" class="nav-link border-right text-success" href="#" data-{key}="asc"  >
                        <div class="d-inline-flex">
                           {Name}
                            <div class="ml-1">
                                <i class="{key}-0 fas fa-sort-up d-block mb-n3 mt-2" ></i>
                                <i class="{key}-1 fas fa-sort-down d-block mb-1" ></i>
                            </div>
                        </div>
                    </a>

HTML,
    'js'=><<<JS


  $('#sort{key}').click(function(){
      function insertParam(key, value)
        {
            key = encodeURI(key); value = encodeURI(value);
    
            var kvp = document.location.search.substr(1).split('&');
    
            var i=kvp.length; var x; while(i--) 
            {
                x = kvp[i].split('=');
            
                if (x[0]==key)
                {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }
            
            if(i<0) {kvp[kvp.length] = [key,value].join('=');}
            
            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&'); 
        }
       

        switch($(this).data("{key}")){
            case 'asc':
            sortdata{key} =4;
            //$(this).data("{key}","desc")
            category{key} = "desc";
            break;
            case 'desc': 
            sortdata{key} =3;
             category{key} = "asc";
           // $(this).data("{key}","asc")
            break;
            default:sortdata{key}=0;  break;
        }
       
        $.ajax({
            url: '/core/product/sort.aspx',
            type: 'GET',
            data: {
                name: sortdata{key},
                cat: category{key},
                idd:'sort{key}',
                key:'{key}'
            },
            success: function (data) {
              insertParam('{key}', '{key}' );
               $('body').html(data);
             //   $.pjax.reload({container: '#contener', timeout: false});
            },
            error: function (res) {
                console.log(res + 'not sent')
            }
        });
      
   
  });
JS,
   'mainjs'=><<<JS
var getParams = function (url) {
	var params = {};
	var parser = document.createElement('a');
	parser.href = url;
	var query = parser.search.substring(1);

	return query;
};
var  returnurl;
var name='';
    
JS,



    ];


    public function asset()
    {

//        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');

    }

    public function codes()
    {
    $this->js=$this->_layout['mainjs'];
        $content='';
         foreach ($this->data as $key => $value){
             $content.=strtr($this->_layout['content'], [
                 '{key}' => $key,
                 '{Name}' => $value,
                 //'{id}'=>$this->id

             ]);

           $this->js.=strtr($this->_layout['js'],[
                 '{key}'=>$key
             ]);
         }

        $this->htm = strtr($this->_layout['main'], [
            '{header}' => $this->_config['head'],
            '{content}' => $content,

        ]);
       /* $this->js=strtr($this->_layout['js'],[
           '{id}'=>$this->id
        ]);*/

    }

}
