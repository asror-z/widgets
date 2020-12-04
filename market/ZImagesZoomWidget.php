<?php


namespace zetsoft\widgets\market;


use zetsoft\dbitem\market\MyOrder;
use zetsoft\models\App\eyuf\Order;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZImagesZoomWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'ImgSrc' => 'https://avatars.mds.yandex.net/get-pdb/216365/917608de-21cb-45dd-8acc-cd754a24540b/s1200',  
        'images' => ['here should be images'],
        'orders' => [],
        'grapes' => true,
    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
        'onload' => 'console.log("self | $eventOnLoad")',
        'onclick' => 'console.log("self | $eventOnClick")',
    ];
    /*   */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            
    <section class="shopping-cart">
         <div class="show" href="/render/market/ZimageszoomWidget/demo/images/p4.png">
                <img src="/render/market/ZimageszoomWidget/demo/images/p5.jpg" id="show-img">
            </div>
            <div class="small-img">
                <img src="/render/market/ZimageszoomWidget/demo/images/online_icon_right@2x.png" class="icon-left" alt="" id="prev-img">
            <div class="small-container">
            <div id="small-img-roll">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p4.png" class="show-small-img" alt="">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p3.jpg" class="show-small-img" alt="">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p6.jpg" class="show-small-img" alt="">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p5.jpg" class="show-small-img" alt="">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p2.jpg" class="show-small-img" alt="">
                   <img src="/render/market/ZimageszoomWidget/demo/images/p1.jpg" class="show-small-img" alt="">
             <img src="/render/market/ZimageszoomWidget/demo/images/p2.jpg" class="show-small-img" alt="">
                <!--{images}-->
            </div>
            </div>
                <img src="/render/market/ZimageszoomWidget/demo/images/online_icon_right@2x.png" class="icon-right" alt="" id="next-img">
        </div>          
    </section>
      <!--<script src=""></script> -->   
  <script src="https://ghcdn.rawgit.org/MonsterDuang/images-zoom/master/scripts/zoom-image.js"></script>
<script src="https://ghcdn.rawgit.org/MonsterDuang/images-zoom/master/scripts/main.js"></script>        
HTML,
        'js' => <<<JS
                                     
     
            
JS,
        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick}); 

JS,
        'css' => <<<CSS
                    *{
             margin: 0;
             padding: 0;
             box-sizing: border-box
}
        .show{
            width: 400px;
            height: 400px;
}
        .small-img{
            width: 350px;
            height: 70px;
            margin-top: 10px;
            position: relative;
            left: 25px;
}
        .small-img .icon-left, .small-img .icon-right{
            width: 12px;
            height: 24px;
            cursor: pointer;
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto 0;
}
        .small-img .icon-left{
            transform: rotate(180deg)
}
        .small-img .icon-right{
            right: 0;
}
        .small-img .icon-left:hover, .small-img .icon-right:hover{
            opacity: .5;
}
        .small-container{
             width: 310px;
             height: 70px;
             overflow: hidden;
             position: absolute;
             left: 0;
             right: 0;
             margin: 0 auto;
}
        .small-container div{
            width: 800%;
            position: relative;
}

        .small-container .show-small-img{
             width: 70px;
            height: 70px;
            margin-right: 6px;
            cursor: pointer;
            float: left;
}
        .small-container .show-small-img:last-of-type{
            margin-right: 0;
}
CSS,


    ];


    /*private function generateData(){
        $code = '';
        foreach ($this->data as $value){
            $code .= strtr($this->_layout['item'],[
                '{src}' => $value
            ]);
        }

        return $code;
    }*/
    public function asset()
    {
        {
            /*  $this->fileJs('https://ghcdn.rawgit.org/MonsterDuang/images-zoom/master/scripts/jquery.min.js');
             $this->fileJs('https://ghcdn.rawgit.org/MonsterDuang/images-zoom/master/scripts/zoom-image.js');
              $this->fileJs('https://ghcdn.rawgit.org/MonsterDuang/images-zoom/master/scripts/main.js'); */

        }

    }

    public function codes()
    {

             $this->htm = strtr($this->_layout['main'], [
                /*'{imgSRC}' => $this->_config['ImgSrc'],*/
            ]);

            $this->js = strtr($this->_layout['js'],[]);



        $this->css = strtr($this->_layout['css'], []);
    }

}

