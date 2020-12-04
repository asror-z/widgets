<?php

namespace zetsoft\widgets\market;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 *
 */
class ZReytingWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => false,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */


    public function asset()
    {
    }

    public $layout =[];
    public $_layout = [

        'reyting' => <<<HTML
          
            <div class="container" '  
            {readonly}   >
             <div class="row offset-2 border rounded">
                 <div class="col-md-12 p-4   mt-2">
                     <div class="reyting mb-4">
                     <h5>Рейтинг  </h5>
                     <i class="fa fa-star " style="color: yellow"></i>
                     <i class="fa fa-star " style="color: yellow"></i>
                     <i class="fa fa-star " style="color: yellow"></i>
                     <i class="fa fa-star " style="color: yellow"></i>
                     <i class="fa fa-star " style="color: lightgray"></i>

                 </div>
                     <div class="progres"  >
                          <div class="row">
                              <div class="col-md-1">
                              <h6 style="color:limegreen;margin-top:-3px">5</h6>
                              </div>
                              <div class="col-md-10 pr-1 pl-1">
                                 <div class="progress" style="width: 100%">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                           aria-valuemin="0" aria-valuemax="100" >
                                      </div>
                                  </div>

                              </div>
                              <div class="col-md-1 pl-1">
                                  <h6 style="margin-top:-4px" >(0)</h6>
                              </div>
                          </div>
                          <div class="row">
                             <div class="col-md-1">
                                 <h6 style="color:limegreen;margin-top:-3px">4</h6>
                             </div>
                             <div class="col-md-10 pr-1 pl-1">
                                 <div class="progress" >
                                     <div class="progress-bar" role="progressbar" aria-valuenow="100"
                                          aria-valuemin="100" aria-valuemax="100"style="width:100%;background-color:limegreen">
                                     </div>
                                 </div>

                             </div>
                             <div class="col-md-1 pl-1">
                                 <h6 style="margin-top:-4px" >(4)</h6>
                             </div>
                         </div>
                          <div class="row">
                             <div class="col-md-1">
                                 <h6 style="color:limegreen;margin-top:-3px">3</h6>
                             </div>
                             <div class="col-md-10 pr-1 pl-1">
                                 <div class="progress" style="width: 100%">
                                     <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                          aria-valuemin="0" aria-valuemax="100" style="width:25%;background-color:limegreen" >
                                     </div>
                                 </div>

                             </div>
                             <div class="col-md-1 pl-1">
                                 <h6 style="margin-top:-4px" >(1)</h6>
                             </div>
                         </div>
                          <div class="row">
                             <div class="col-md-1">
                                 <h6 style="color:limegreen;margin-top:-3px">2</h6>
                             </div>
                             <div class="col-md-10 pr-1 pl-1">
                                 <div class="progress" style="width: 100%">
                                     <div class="progress-bar " style="background-color:limegreen" progressbar aria-valuenow="70"
                                          aria-valuemin="0" aria-valuemax="100" >
                                     </div>
                                 </div>

                             </div>
                             <div class="col-md-1 pl-1">
                                 <h6 style="margin-top:-4px" >(0)</h6>
                             </div>
                         </div>
                          <div class="row">
                             <div class="col-md-1">
                                 <h6 style="color:limegreen;margin-top:-3px">1</h6>
                             </div>
                             <div class="col-md-10 pr-1 pl-1">
                                 <div class="progress" style="width: 100%">
                                     <div class="progress-bar" style="background-color:limegreen" role="progressbar" aria-valuenow="70"
                                          aria-valuemin="0" aria-valuemax="100" >
                                     </div>
                                 </div>

                             </div>
                             <div class="col-md-1 pl-1">
                                 <h6 style="margin-top:-4px" >(0)</h6>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
             <div class="row offset-2 mt-3 " id="buttonclik" style="display: none">
                 <div class="col-md-12 border rounded "style="height:200px"></div>
                 <h5 style="margin-left:140px ;margin-top: 7px">Ваша оценка</h5>
                 <div class="icon"style="margin-left: 150px">
                     <i class="fa fa-star " style="color: lightgray"></i>
                     <i class="fa fa-star " style="color: lightgray"></i>
                     <i class="fa fa-star " style="color: lightgray"></i>
                     <i class="fa fa-star " style="color: lightgray"></i>
                     <i class="fa fa-star " style="color: lightgray"></i>

                 </div>

             </div>
             <div class="row"  >
                 <div class="col-md-12 offset-2">
                     <button type="button"  id="block"
                     class="btn" style="background-color: limegreen;text-align: center;padding: 5px 70px">Написать отзыв</button>
                 </div>

             

             </div>
          </div>

HTML,

    'js'=> <<<JS
       $('#block').on('click', function() {
          document.getElementById("buttonclik").style.display = "block";
       });
          
    

JS,

    ];


    public function codes()
    {
         $this ->htm = strtr($this ->_layout['reyting'],[
             
             '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
          ]);

         $this->js = strtr($this->_layout['js'],[]);
    }

}
