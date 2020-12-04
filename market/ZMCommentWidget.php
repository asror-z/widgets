<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * CreatedBy: Jaxongir Maxamadjonov

 */

class ZMCommentWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];

public $_config = [
    'country'=>'ru',
    'user'=>'Оксана',
    'text' => 'Some example text some example text. John Doe is an architect and engineer',
    'date' =>'1.02.2020',

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
     * Constants */
    public function asset()
    {


    }


    public $layout = [];
    public $_layout = [
        'about' => <<<HTML
          <div class="container">
             <div class="block-1" style="height: 100px;">
                <div class="float-left">
                   <h2>{user} <img style="width: 20%;" src="https://www.countryflags.io/{country}/flat/64.png" alt="img"></h2>

                    <p>{date}</p>
                  </div>
          <div class="float-right">
            <p class="reviews-rating mt-3">
                <a href="#" class="star-1 star" style="color: yellow;"><i class="fa fa-star" aria-hidden="true"></i></a>
                <a href="#" class="star-2 star style="color: yellow;"><i class="fa fa-star" aria-hidden="true"></i></a>
                <a href="#" class="star-3 star style="color: yellow;"><i class="fa fa-star" aria-hidden="true"></i></a>
                <a href="#" class="star-4 star style="color: yellow;"><i class="fa fa-star" aria-hidden="true"></i></a>
                <a href="#" class="star-5 star style="color: #cacaca;"><i class="fa fa-star" aria-hidden="true"></i></a>
            </p>
          </div>

    </div>
    <div>
        <p>{text}</p>
    </div>
</div>

HTML,
    ];


    public function codes()
    {

        $this ->htm = strtr($this ->_layout['about'],[
            '{user}'=>$this->_config['user'],
            '{country}'=>$this->_config['country'],
            '{date}'=>$this->_config['date'],
            '{text}'=>$this->_config['text'],
        ]);
    }

}
