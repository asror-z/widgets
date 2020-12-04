<?php

/**
 *
 *
 * Author:  jamshid Tojiboyev
 *
 */

namespace zetsoft\widgets\places\test;

use zetsoft\system\kernels\ZWidget;





/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZGoogleSideBarWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'trafficControl' => true,
        'routeButtonControl' => true,
        'zoomControl' => true,
        'searchControl' => true,
        'typeSelector' => true,
        'geolocationControl' => true,
        'fullscreenControl' => true,
        'customControl' => true,
        'rulerControl' => true,

    ];

    /**
     *
     * Constants
     */
     

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div id="Sidebar" class="sidebar text-center Small shadow">
              <div class="col-12" id="search_area">  
            {header-search}
            </div>
            {saidbar}

                        </div>
                    

            <button id="Openbtn" class="openbtn"><i class="fas fa-chevron-right"></i></button> 
            
            

HTML,

        'header-search' => <<<HTML
               
                        <div class="search-map w-100">
                         <input type="text" class=" w-100 map-search-input z-depth-1" type="text" placeholder="Поиск на Картах">
                         <div class="seach-icon">
                         <i class="fa fa-search" ></i>
                         <div class="line"></div>
                         </div>
                         <i class="fas fa-share-square button-share"></i>
                        <i class="fas fa-bars"></i>
                        </div>
                        
                        <div class="specify-address mt-3 p-3 z-depth-1">
                            <div class="d-flex align-items-center">
                                <div class="back-icon">
                                    <i class="fas fa-home fa-2x text-success"></i>
                                </div>
                                <div class="text-icon d-flex flex-column">
                                    <p>Дом</p>
                                    <span>Укажите адрес</span>
                                </div>
                            </div>
                            <hr class="w-90">
                             <div class="d-flex align-items-center">
                                <div class="back-icon rounded-circle">
                                    <i class="fas fa-briefcase fa-2x text-success"></i>
                                </div>
                                <div class="text-icon d-flex text-start flex-column">
                                    <p>Работа</p>
                                    <span>Укажите адрес</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="move-closer mt-3 p-3 z-depth-1">
                               <div class="d-flex align-items-center">
                                <div class="back-icon rounded-circle">
                                    <img src="https://img.icons8.com/officel/30/000000/traffic-jam.png"/>
                                </div>
                                <div class="text-icon d-flex flex-column">
                                    <p>Рядом с вами почти нет пробок</p>
                                    <span>Движение затруднено</span>
                                </div>
                                <div class="next-page ml-auto">
                                    <i class="fas fa-chevron-right fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="opportunities d-flex justify-content-between mt-3 p-3 z-depth-1">
                        <div class="d-flex flex-column align-items-center">
                            <div class="opportunities-icon bg-success">
                            <i class="fa fa-shopping-cart opp-icon  fa-2x"></i>
                        </div>
                        <span>Продуктовые <br> магазины</span>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                         <div class="opportunities-icon bg-primary">
                           <i class="fas fa-truck opp-icon  fa-2x"></i>
                        </div>
                        <span>Доставка еды</span>
                        </div>
                         <div class="d-flex flex-column align-items-center">
                          <div class="opportunities-icon bg-danger">
                            <i class="fas fa-utensils opp-icon  fa-2x"></i>
                        </div>
                        <span>Доставка еды</span>
                        </div>
                        
                       
                         <div class="opportunities-icon bg-warning">
                            <i class="fas fa-bed opp-icon  fa-2x"></i>
                        </div>
                         <div class="opportunities-icon again-info  bg-secondary">
                            <i class="fa fa-ellipsis-h opp-icon  fa-2x "></i>
                        </div>
                        </div>
                        
                       <div class="again-item z-depth-1 again-hidden">
                         <div class="opportunities-again d-flex align-items-center justify-content-between p-4">
                            <div class="opp-again-list d-flex align-items-center">  
                            <div class="opportunities-icon  bg-secondary">
                            <i class="fas fa-university opp-icon fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h5">Bank</p></div>
                        
                        <div class="opp-again-list  d-flex align-items-center">  
                            <div class="opportunities-icon bg-secondary">
                            <i class="fas fas fa-gas-pump opp-icon fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h5">AES</p></div>
                        <div class="opp-again-list  d-flex align-items-center">  
                            <div class="opportunities-icon bg-secondary">
                            <i class="fas fa-parking opp-icon fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h5">Parking</p></div>
                        
                        
                        </div> 
</div>
HTML,

        'saidbar' => <<<HTML
                            <div class="map-saibar success-color hidden-map-sidebar w-100">
                          <div class="map-sidebar-header">
                            <button class="btn-burger">
                        <i class="fas fa-align-justify fa-2x"></i>
                            </button>
                      <div class="map-sidebar-icons">
                    <button class="map-button btn-share">
                         <i class="fas fa-share-square fa-2x btn-icon"></i>
                    </button>
                    <button class="map-button btn-car">
                         <i class="fas fa-car fa-2x btn-icon"></i>
                    </button>
                    <button class="map-button btn-bus">
                         <i class="fas fa-bus-alt fa-2x btn-icon"></i>
                    </button>
                     <button class="map-button btn-bus">
                         <i class="fas fa-walking fa-2x btn-icon"></i>
                    </button>
                      <button class="map-button btn-bus">
                         <i class="fas fa-biking fa-2x btn-icon"></i>
                    </button>
                    <button class="map-button btn-plane">
                         <i class="fa fa-plane fa-2x btn-icon"></i>
                    </button>
</div>    
                       
                        <div class="button btn-close">
                        <i class="fa fa-times fa-2x"></i>
</div>     

                        
</div>
                        <div class="map-search-in">
                            <div class="map-search-location">
                            <i class="far fa-circle"></i>
                            <div class="circle-box">
                            <div class="location-circle"></div>
                            <div class="location-circle"></div>
                            <div class="location-circle"></div>
</div>
                            <i class="fas fa-map-marker-alt"></i>
</div>
                            <div class="map-search-from">
                              <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">
                                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Укажите пункт отправления или выберите его на карте..."
                                       aria-label="Search">
                                 <i class="fas fa-search map-search-info" aria-hidden="true"></i>
                                <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">
                                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Укажите пункт назначения..."
                                       aria-label="Search">
                                <i class="fas fa-search map-search-info"></i>
</form>
                        </form>
</div>
                                <i class="fas fa-sync fa-2x"></i>
                    </div>  
                    
                    <div class="map-sidebar-send success-color-dark">
</div>
</div>
HTML,



        'js' => <<<JS
             
            
            ymaps.ready(function () {
                
                var openCheck = 0;
                document.getElementById("Openbtn").onclick = function openBtn(){
	                if(openCheck==0){
                            document.getElementById("Sidebar").style.width = "500px";
                            document.getElementById("Openbtn").style.marginLeft = "500px";
                            document.getElementById("Openbtn").style.transform="rotate(180deg)";
                            document.querySelector('#search_area').style.display = 'block'
                            openCheck = 1;
                        }else{
                            document.getElementById("Sidebar").style.width = "0";
                            document.getElementById("Openbtn").style.marginLeft= "0";
                            document.getElementById("Openbtn").style.transform="rotate(360deg)";
                            document.querySelector('#search_area').style.display = 'none'
                            openCheck = 0;
                        }
                    }
                    
                    var get = document.querySelector('.fa-share-square');
                    var mapSidebar = document.querySelector('.hidden-map-sidebar');
                    var closeBtn = document.querySelector('.btn-close');
                    var searchArea = document.getElementById('search_area');
                    var nextPage = document.querySelector('.next-page');
                    var searchArea = document.querySelector('#search_area');
                    var againInfo = document.querySelector('.again-info');
                    var againItem = document.querySelector('.again-item');
                    
                    
                    get.addEventListener('click', () => {
                        mapSidebar.style.display = 'block';
                        searchArea.style.display = 'none';
                    });
                
                closeBtn.addEventListener('click', () => {
                    mapSidebar.style.display = 'none';
                    searchArea.style.display = 'block'; 
                });
                    nextPage.addEventListener('click', () => {
                    searchArea.style.display = 'none';   
                    mapSidebar.style.display = 'block';
                });
                   againInfo.addEventListener('click', () => {
                    againItem.classList.toggle('again-hidden')
                });
          
        });
         
JS,

        'style' => <<<CSS
         .sidebar {
              height: 100%;
              width: 0;
              position: absolute;
              z-index: 5;
              top: 0;
              left: 0;
              background-color: white;
              overflow-x: hidden;
              transition: 0.5s;
             
            }
            #search_area {
                margin-top: 60px;
            }
            
            .search-map {
            position: relative;
            
            }
            .map-search-input {
                height: 50px;
                padding-left: 50px;
                border-radius: 10px;
                border: none;
            }
            .search_area input:disabled {
                border: 1.5px solid #0c850c !important;
            }
            .seach-icon {
            display: flex;
            position: absolute;
            top: 18px;
            right: 40px;
            color: #0c850c;
            }
            .line {
                width: 30px;
                height: 1px;
                background-color: #0c850c;
                transform: rotate(90deg);
                margin-left: 10px;
                margin-top: 5px;
            }
            .form-control::placeholder {
                 margin: 0px;
                font-size: 18px;
                color: white;
            }
            .form-control {
                 margin-right: 0px;
                padding-left: 10px;
                color: white;
                font-size: 18px;
            }
            
            .button-share {
            position: absolute;
            top: 18px;
            right: 10px;
            color: #0c850c;
            }
            
            .fa-bars {
                 position: absolute;
            top: 18px;
            left: 10px;
            color: #0c850c;
            }
            
            .map-saibar {
                width: 100%;
                height: 250px;
                position: absolute;
                top: 0;
                left: 0;
            }
            .hidden-map-sidebar {
                display: none;
            }
            .map-sidebar-icons {
                display: flex;
                justify-content:space-between;
                align-items: center;
                width: 70%;
                margin: auto;
            }
            .map-button,
             .btn-burger,
             .btn-close{
                background-color: transparent;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%; 
                display:flex;
                justify-content:center;
                align-items: center;

            }
            .map-button:focus {
                outline: none;
                background-color: #0c850c;
                color: white;
            }
            .map-sidebar-header {
                width: 100%;
                display:flex;
                justify-content:space-between;
                align-items: center;
                margin-top: 50px;
            }
            
            .btn-icon {
                color: #fff9;
            }
            .fa-align-justify,
            .fa-times,
             .fa-map-marker-alt,
             .fa-circle,
             .fa-sync{
                color: white;
                cursor: pointer;
            }
            .fa,
             .fas,
             .far,
             img{
               cursor: pointer; 
            }
            .
            /*.map-button:*/
            
            .map-sidebar-send {
                width: 100%;
                height: 80px;
            }
            .map-search-in {
                width: 85%;
                display:flex;
                justify-content:space-between;
                align-items: center;
                margin: auto;
            }
            .map-search-info {
                color: white;
            }
            .map-search-location {
                display: flex;
                align-items: center;
                flex-direction: column;
            }
            .location-circle {
                display: block;
                width: 10px;
                height: 10px;
                background-color:#fff8;
                border-radius: 50% ;
                margin: 5px 0;
            }
            
            .back-icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background-color: lightgrey;
                display:flex;
                justify-content:center;
                align-items: center;
            }
            .text-icon {
                line-height: 5px;
                margin-left: 15px;
            }
            
            .text-icon p {
                font-size: 25px;
                text-align: start;
            }
            .opportunities-icon {
                width: 60px;
                height: 60px;
                border-radius: 50% ;
                display:flex;
                justify-content:center;
                align-items: center;
            }
            .opp-icon {
                color: white;
            }
            .again-hidden {
                display: none;
            }
            .opportunities-icon {
                cursor: pointer;
            }
            
          .openbtn {
              cursor: pointer;
              
              background-color:green;
              color: gray;
              width: 30px;
              height: 60px;
              transition: margin-left .5s;
              border: none;
              color: white;
            }
         html,
        body,
        #map {
            height: 70vh;
            padding: 0;
        }
         
CSS,

    ];


    public function asset()
    {
        $this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=5fb7da25-bc18-4612-b304-83ea2266c510');

    }


    public function codes()
    {

        $this->_layout['header-search'] = strtr($this->_layout['header-search'], [

        ]);
        $this->_layout['saidbar'] = strtr($this->_layout['saidbar'], [

        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{header-search}' => $this->_layout['header-search'],
            '{saidbar}' => $this->_layout['saidbar'],
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{name}' => $this->name,
            '{routeButtonControl}' => $this->_config['routeButtonControl'] ? 'routeButtonControl' : '',
            '{zoomControl}' => $this->_config['zoomControl'] ? 'zoomControl' : '',
            '{searchControl}' => $this->_config['searchControl'] ? 'searchControl' : '',
            '{typeSelector}' => $this->_config['typeSelector'] ? 'typeSelector' : '',
            '{geolocationControl}' => $this->_config['geolocationControl'] ? 'geolocationControl' : '',
            '{fullscreenControl}' => $this->_config['fullscreenControl'] ? 'fullscreenControl' : '',
            '{customControl}' => $this->_config['customControl'] ? 'customControl' : '',
            '{rulerControl}' => $this->_config['rulerControl'] ? 'rulerControl' : '',
            '{trafficControl}' => $this->_config['trafficControl'] ? 'trafficControl' : '',


        ]);

        $this->css = strtr($this->_layout['style'], []);
    }
}
