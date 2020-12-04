<?php
/**
 *
 Made by Kodirov Khojiakbar
 *
 *
 **/

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZSelectCityWidget extends ZWidget
{
    public $config =[];
    public $_config =[
  

    ];




    public $event =[];
    public $_event=[];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/css-modal@1.5.0/build/modal.css') ;
        $this->fileCss('https://use.fontawesome.com/releases/v5.8.2/css/all.css') ;
        $this->fileJs('https://cdn.jsdelivr.net/npm/css-modal@1.5.0/modal.min.js') ;
    }

    public $layout=[];
    public $_layout=[
        'main' => <<<HTML
    <p>
    Your city: <a href="#{id}" class="cityName">______</a>
</p>


<section class="modal--show" id="{id}" tabindex="-1"
         role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-stackable="false">
    <div class="modal-inner">
        <header>
            <h2>Uzbekistan
                <a href="#!" class="close-action"
                   title="Close this modal"
                   data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
            </h2>
        </header>
        <div class="modal-content">
            <div class="container" style="margin: 0px ;">
                <input class="form-control mb-4" id="tableSearch" type="text"
                       placeholder="Search City" >

                <div class="container">
                    <div class="row">
                        <div class="card col-md-3 col-sm-3"  style="width: 10rem; font-size:1rem ; border: 0 ;">
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Margilan</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Bekabad</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Shakhrisabz</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Kokand</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Khiva</a>
                        </div>
                        <div class="card col-md-3 col-sm-3"  style="width: 10rem;  font-size:1rem ; border: 0 ;">
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Angren</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Chirchik</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Nukus</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Urgench</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Almalik</a>
                        </div>
                        <div class="card col-md-3 col-sm-3"  style="width: 10rem;  font-size:1rem ; border: 0 ;">
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Termez</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Karshi</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Bukhara</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Gulistan</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Jizakh</a>

                        </div>
                        <div class="card col-md-3 col-sm-3"  style="width: 10rem;  font-size:1rem ; border: 0 ;">
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Fergana</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Namangan</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Andijan</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Samarkand</a>
                            <a href="#!" class="close-action city" title="Close this modal" data-dismiss="modal" style='margin:3px ;'>Tashkent</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

HTML,

        'css' => <<<CSS
      .close-action{
            position: relative ;
            float:right ;
        }
CSS,
        'js' => <<<JS
      $(document).ready(function(){
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".card a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('.city').on('click',function(){
            var city = $(this).text() ;

            $('.cityName').text(city) ;
            $('#{id}').modal().hide() ;
            $('#tableSearch').val('');
        }) ;
    });
    
JS,

    ];

    public function codes()
    {


        $this->htm = ($this->_layout['main']);

        $this->js = ($this->_layout['js']);

        $this->css = ($this->_layout['css']);

    }
}
