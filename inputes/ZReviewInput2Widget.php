<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 * modifyed by: Javohir
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\models\user\UserCompany;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;


class ZReviewInput2Widget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'formClass' => null,

    ];

    public $data = [
        '1option'=>5,
        '2option'=>4,
        '3option'=>2,
    ];
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="row">
     {content}
     </div>
   
HTML,

      'content'=><<<HTML
    <input type="hidden" id="stars{id}"  name="{class-name}[]" value="{value}"/>
    <div class="col-md-12">
    {name}
     {star}
</div> 
     
HTML,


      'js' => <<<JS
       $('#wopt{id}').on('change',function() {
       //  console.log(this.value);
         $("#stars{id}").val(this.value);
       //    console.log($("#stars{id}").val());    
       }); 
JS,


    ];

    public function asset()
    {
       // $this->fileCss('/render/market/ZReviewWidget/assets/style.css');
    }

    public function codes()
    {


        $form = Az::$app->forms->modelz->formObject($this->_config, $this->model);
         $id=[];
        $reviews = '';
        $i=0;
        if (!empty($this->data))
            if (is_array($this->data)) {


            foreach ($this->data as $value=>$key) {
                $i++;
            $id[$i]= random_int(1,1000);

                $reviews .= strtr($this->_layout['content'], [
                '{class-name}'=>$this->name,
                     '{name}'=> $value,
                     '{value}'=> $key,
                     '{id}'=> $id[$i],
                     '{star}'=>ZKStarRatingWidget::widget([
                         'name' =>$value,
                         'value' =>$key,
                         'id'=>'wopt'.$id[$i]

                     ]),

                ]);

                $this->js .= strtr($this->_layout['js'],[
                    '{id}'=>$id[$i]

                ]);
            } }



            $this->htm = strtr($this->_layout['main'], [
              '{content}'=>$reviews
            ]);






       }

      
    


}
