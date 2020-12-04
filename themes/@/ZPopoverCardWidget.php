<?php

namespace zetsoft\widgets\themes;


use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Elnur Suyunov
 *
 */
class ZPopoverCardWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'items' => [],
        'checkIcon' => FAS::_CHECK,
        'cancelIcon' => FAS::_TIMES,
        'Approve' => 'Approve',
        'Reject' => 'Reject'
    ];
    public $layout =[];
    public $_layout =[
        'main'=><<<HTML
            <div class="d-flex">
          array
</div>  
HTML,
     

    ];

    private $cardItems = [

        'cardImage' =>'',
        'cardUserName' =>'' ,
        'cardUserAdress' =>'',
        'bgColor'=> ZPopoverCardWidget::bgColor['bg-danger'],

    ];
     public const bgColor = [
        'bg-primary' => 'bg-primary',
        'bg-danger' => 'bg-danger',
        'bg-secondary' => 'bg-secondary',
        'bg-success' => 'bg-success',
        'bg-warning' => 'bg-warning',
        'bg-info' => 'bg-info',
        'bg-light' => 'bg-light',
        'bg-dark' => 'bg-dark',
        'bg-white' => 'bg-white',
     ];


    public function asset()
    {

    }

    public function codes()
    {

        $array = '';
        foreach ($this->_config['items'] as  $key => $item){
            $item = ZArrayHelper::merge($this->cardItems,$item);


            $array .=   $this->htm =<<<HTML
       
        <div class="card1 {$item['bgColor']} mr-2" >
    <div class="box1">
        <div class="img1">
            <img src="{$item['cardImage']}">
        </div>
        <h5>{$item['cardUserName']}</h5>
        <p>       
           {$item['cardUserAdress']}
        </p>

        <span>
            <div class="menu-action">
                <span class="menu-action-icon vd_green vd_bd-green" id="approve" data-toggle="tooltip" data-placement="bottom" title="Approve">
                 <i class="fas fa-{checkIcon}"></i>
                </span> 
                <span class="menu-action-icon vd_red vd_bd-red" id="reject" data-toggle="tooltip" data-placement="bottom" title="reject">
                 <i class="fas fa-{cancelIcon}"></i>
                </span>                                                                            
            </div>
        </span>
    </div>
</div>

HTML;

        }
        $this->htm = strtr($this->_layout['main'], [
            'array'=>$array,
        ]);

      $this->css=<<<CSS
.card1 {
    min-width:96px;
    width: 144px;
    min-height:240px;
    position:relative;
    
}

.card1 .box1 {
    position:absolute;
    top:50%;
    left:0;
    transform:translateY(-50%);
    text-align:center;
    box-sizing:border-box;
    width:100%;
    padding: 20px;
}
.card1 .box1 .img1 {
    margin:0 auto;
    border-radius:50%;
    overflow:hidden;
    margin-top: -30px;
    position:relative;
    
}
.card1 .box .img1 img {
    width:100%;
    height:100%;
   
}
.card1 .box h5 {
    font-size:13px;
    color:#262626;
    font-weight: bold;
    
}
.card1 .box p {
    color:#262626;
    font-size: 10px;
}
.card1 .box span {
    display:inline-flex;
}
.card1 .box ul {
    margin:0;
    padding:0;
}
.card1 .box ul li {
    list-style:none;
    float:left;
}
.card1 .box ul li a {
    display:block;
    color:#aaa;
    margin:0 10px;
    font-size:20px;
    transition:0.5s;
    text-align:center;
}
.card1 .box ul li:hover a {
    color:#e91e63;
    transform:rotateY(360deg);
}


.menu-action-icon {
    text-align: center;
    display: inline-block;
    height: 22px;
    width: 22px;
    line-height: 20px;
    margin-left: 10px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
    border: 1px solid;
    
}

 .menu-action-icon:hover {
    color: #1fae66;
    border-color: #1fae66
}
   .menu-icon {
    float: right;
    margin-right: 0;
    margin-left: 12px
}
.menu-action-icon i {
    margin: 0 auto;
    margin-top: 3px;
}

CSS;

      $this->js=<<<JS
        $('#approve').tooltip();
        $('#reject').tooltip();
JS;

        $this->htm = strtr($this->htm,[
            '{cardImage}' => $this->jscode($this->cardItems['cardImage']),
            '{bgColor}' => $this->jscode($this->cardItems['bgColor']),
            '{cardUserAdress}'=> $this->jscode($this->cardItems['cardUserAdress']),
            '{cardUserName}'=> $this->jscode($this->cardItems['cardUserName']),
            '{checkIcon}'=> $this->jscode($this->_config['checkIcon']),
            '{cancelIcon}'=> $this->jscode($this->_config['cancelIcon']),
            '{Approve}'=> $this->jscode($this->_config['Approve']),
            '{Reject}'=> $this->jscode($this->_config['Reject']),
        ]);
        /*$this->htm = strtr($this->htm, [
            '{buttonSave}' => ZButtonWidget::widget([
                'config' => [
                    'color' => ZButtonWidget::btnStyle['btn-transparent'],


                    'icon' => ZButtonWidget::icon['fa-save'],
                    'url' => '',
                    'name' => '',
                ]
            ]), '{buttonToogle}' => ZButtonWidget::widget([
                'config' => [
                    'color' => ZButtonWidget::btnStyle['btn-transparent'],

                    'icon' => ZButtonWidget::icon['fa-refresh'],
                    'name' => 'Collapse',
                    'url' => 'javascript:collapse()'
                ]
            ]),
            '{closeButton}' => ZButtonWidget::widget([
                'config' => [

                    'color' => ZButtonWidget::btnStyle['btn-transparent'],
                    'icon' => ZButtonWidget::icon['fa-times'],
                    'name' => 'Close',
                ]
            ]),

        ]);*/

    }

}
