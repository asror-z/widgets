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

namespace zetsoft\widgets\themes;


use zetsoft\system\kernels\ZWidget;

class ZDynCardWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'title' => 'Список Типы Документов',
        'grapes'=>true,
       
    ];

    public $layout = [];
    public $_layout = [
        'dynCard' => <<<HTML
       <div class="card border-primary"  '>
          <div class="view overlay">   
            <div class="card-header text-white bg-primary" {readonly}>
                  <!--<div class="float-right"><div class="summary"> 
                         Показаны <b>{current}</b> из <b>{allRecord}</b> 
                         записи.</div>
                  </div>-->   <!-- <= NEED -->
          
                   <h5 class="m-0">
                       <i class="fa-1x fa fa-chart-pie"></i> &nbsp;&nbsp;<b>{title}</b>
                   </h5>            
           </div>
</div>
      <div class="card-body">        
      </div>
</div>
HTML,
    ];



    public function codes()
    {
        $this->htm = strtr($this->_layout['dynCard'], [
            '{title}' => $this->_config['title'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
    }
    
}
