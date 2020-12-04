<?php
/**
 * Author:  Xolmat Ravshanov
 */
 
namespace  zetsoft\widgets\sorter;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use yii\base\InvalidConfigException;


class ZSearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public function init()
    {
        parent::init();
       
    }


    public $layout = [];
    public $_layout = [
        'search' =><<<HTML
     <div class="m-5 ">   
        <form class="form-inline md-form mr-auto mb-4" method="get">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="s">
          <button class="btn btn-rounded btn-sm my-0" type="submit">Search</button>
        </form>
      </div>  
HTML,


    ];
    public function codes(){
        $s = $this->httpGet('search');
        if(isset($s)){
         $modelName = strtolower(bname($this->_config['modal']));
          Az::$app->search->elasticsearch->index = $modelName;
          $Sresult = Az::$app->search->elasticsearch->search($s);
        }

        $result = [];
        foreach($Sresult['hits']['hits'] as $source){
            $id =  $source['_source']['id'];
            $result[$id];
            $className =  $source['_source']['className'];
        }
        if(!empty($result))
          $model  = $this->_config['modal']::findAll($result);


        $this->htm = strtr($this->_layout['search'],[

        ]);

    }
}
?>
