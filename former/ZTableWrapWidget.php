<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 *
 * Created by: Javohir Abdufattokhov
 *
 * this widget has no clean.
 * It was created only for _eyuf_ project need.
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\models\place\PlaceCountry;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZTableWrapWidget extends ZWidget
{

    /**
     * Configuration
     */


    public $config = [];
    public $_config = [

    ];
    
    public $data = [
     
    ];

    public $layout = [];
    public $_layout = [

        'main' =>  <<<HTML
            <table class="program_statistic">
                <tr>
                    <th>{direction}</th>
                    <th>{study}</th>
                    <th>{passedTraining}</th>
                    <th>{total}</th>
                </tr>
                 {main}
            </table>
HTML,
        'item' =><<<HTML
            <tr>
               {item}
            </tr>
HTML,

        'text' =><<<HTML
               <td>{text}</td>
HTML,

'css' => <<<CSS
    .program_statistic table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          min-width:500px;
        }
      .program_statistic th{
               background-color: #125188;
               color: #ffffff;
               padding: 6px;
           }
      .program_statistic td, .program_statistic th {
          border: 1px solid #dddddd;
          padding: 13px;
        }
CSS,


    ];

    public function codes()
    {
        $item = '';
        foreach ( $this->data as $value ) {
            $text ='';
            foreach ($value as $val) {
                $text .= strtr($this->_layout['text'], [
                    '{text}' => $val,
                ]);
            }

            $item .= strtr($this->_layout['item'], [
                '{item}' => $text,

            ]);
        }

        $direction = Az::l('Направление');
        $study = Az::l('Учатся за рубежом');
        $passedTraining = Az::l('Прошли обучение');
        $total = Az::l('Всего');

        $this->htm = strtr($this->_layout['main'], [
            '{main}' => $item,
            '{direction}' => $direction,
            '{study}' => $study,
            '{passedTraining}' => $passedTraining,
            '{total}' => $total,
        ],
        
        );
        $this->css = strtr($this->_layout['css'], [
            
        ],

        );
        //$this->htm = strtr($this->layout['main'],$this->data);


    }

}

