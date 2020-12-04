<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Odilov Shukurullo
 */
namespace zetsoft\widgets\places;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZGoogleWidgetD extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $widgetId;
    public $config = [];
    public $_config = [
        'height'=>600 ,
        'width'=>0,
        'zoom' => 9,
        'multiple' => true,
        'disableDoubleClickZoom' => 9,
        'fullScreenControlPosition' => self::fullScreenControlPosition['LEFT_TOP'],
        'MapTypeControlStyle' => self::MapTypeControlStyle['DEFAULT'],
        'mapTypeControlPosition' => self::mapTypeControlPosition['TOP_CENTER'],
        'mapType' => self::mapType['roadmap'],
        'scrollwheel' => true,                   //boolean == true || false
        'zoomControl' => true,                  //boolean == true || false
        'zoomControlPosition' => self::zoomControlPosition['TOP_LEFT'],
        'grapes' =>true,                      //boolean == true || false
        'searchAutoComplete' => true,        //boolean == true || false
        'searchPlaceImageShow' => true,     //boolean == true || false
        'depend' => [
            'dependPlace' => true,
            'depend_id' => '',
        ],
        'matkerCount'               => 1,            // number min == 1, max == n
        'draggable'                 => true,       //boolean == true || false
        'limitWayPoints'            => 10,          // number min == 2, max == n(but there's a limit for google api request https://developers.google.com/maps/documentation/directions/usage-and-billing)
        'mapUseType'                => 'read',   //string == write || read
        'optimizeWaypoints'         => true,    //boolean == true || false,

        'travel_mode'   => ['DRIVING', 'WALKING', 'BICYCLING','TRANSIT'],
    ];

    public const fullScreenControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',
    ];

    public const MapTypeControlStyle = [
        'DEFAULT' => 'DEFAULT',
        'DROPDOWN_MENU' => 'DROPDOWN_MENU',
        'HORIZONTAL_BAR' => 'HORIZONTAL_BAR',
    ];

    public const mapTypeControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',

    ];

    public const mapType = [
        'roadmap' => 'roadmap',
        'satellite' => 'satellite',
        'hybrid' => 'hybrid',
        'terrain' => 'terrain',
    ];

    public const travelMode = [
        'DRIVING' => 'DRIVING',
        'BICYCLING' => 'BICYCLING',
        'TRANSIT' => 'TRANSIT',
        'WALKING' => 'WALKING',
    ];

    public const zoomControlPosition = [
        'BOTTOM_CENTER' => 'BOTTOM_CENTER',
        'TOP_RIGHT' => 'TOP_RIGHT',
        'BOTTOM_LEFT' => 'BOTTOM_LEFT',
        'BOTTOM_RIGHT' => 'BOTTOM_RIGHT',
        'LEFT_BOTTOM' => 'LEFT_BOTTOM',
        'LEFT_CENTER' => 'LEFT_CENTER',
        'LEFT_TOP' => 'LEFT_TOP',
        'RIGHT_BOTTOM' => 'RIGHT_BOTTOM',
        'RIGHT_CENTER' => 'RIGHT_CENTER',
        'RIGHT_TOP' => 'RIGHT_TOP',
        'TOP_CENTER' => 'TOP_CENTER',
        'TOP_LEFT' => 'TOP_LEFT',
    ];


    #endregion


    public $_layout = [
        'main' => <<<HTML
                <div id="locations">
                </div>             
                             
                <div class="col-md-6 sidebar pl-3 Small shadow" id="Sidebar">
                    <div class="sidebar-front">
                    <div class="search-map w-100">
                        {search}
                        <div class="seach-icon">
                        <i class="fa fa-search" ></i>
                        <div class="line"></div>
                        </div>
                        <i class="fas fa-share-square button-share"></i>
                    </div>
                    
                    <div class="specify-address  z-depth-1">
                    <div class="specify-address-box specify-address-sup d-flex align-items-center pl-3">
                        <div class="back-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="text-icon d-flex flex-column">
                            <span class="text-icon-sup">Дом</span>
                            <span class="section-home-text">Укажите адрес</span>
                        </div>
                    </div>
                     <div class="specify-address-box specify-address-sub d-flex align-items-center pl-3">
                            <div class="back-icon">
                            <i class="fa fa-briefcase"></i>
                            </div>
                        <div class="text-icon d-flex text-start flex-column">
                            <span class="text-icon-sup">Работа</span>
                            <span class="section-work-text">Укажите адрес</span>
                        </div>
                    </div>
                    </div>
                    
                    <!--address work and home sextion hidden-->
                       <div class="section-hidden-home z-depth-1">
                            <div class="section-hat d-flex mt-2 mb-3 justify-content-around align-items-center">
                                <div class="d-flex ml-3 align-items-center">
                                    <i class="fas fa-home"></i>
                                    <span class="pl-3 h5">Дом</span>
                                </div>
                                 <div class="d-flex ml-4">
                                 <button class="section-btn pl-3 h5 text-primary" id="section-btn-home-save">Сохранить</button>
                                 <button class="section-btn section-btn-close pl-3 h5 text-primary">Отмена</button>
                                </div>
                            </div>
                            <div class="text-center m-auto w-75">
                                {searchHome}
                            </div>
                       </div>
                       
                       <div class="section-hidden-work z-depth-1">
                            <div class="section-hat d-flex mt-2 mb-3 justify-content-around align-items-center">
                                <div class="d-flex ml-3 align-items-center">
                                    <i class="fa fa-briefcase"></i>
                                    <span class="pl-3 h5">Работа</span>
                                </div>
                                 <div class="d-flex ml-4">
                                 <button class="section-btn pl-3 h5 text-primary" id="section-btn-work-save">Сохранить</button>
                                 <button class="section-btn section-btn-close pl-3 h5 text-primary">Отмена</button>
                                </div>
                            </div>
                            <div class="text-center m-auto w-75">
                                {searchWork}
                            </div>
                       </div>
                    
                    <div class="move-closer next-page mt-3 z-depth-1">
                       <div class="d-flex align-items-center specify-address-box pl-3">
                        <div class="back-icon">
                            <img src="https://img.icons8.com/officel/30/000000/traffic-jam.png"/>
                        </div>
                        <div class="text-icon d-flex flex-column">
                            <span class="text-icon-sup">Рядом с вами почти нет пробок</span>
                            <span class="text-icon-sub text-left">Движение затруднено</span>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-chevron-right fa-2x mr-3"></i>
                        </div>
                    </div>
                    </div>
                    
                    <div class="opportunities d-flex justify-content-between mt-3 p-3 z-depth-1">
                    <div class="d-flex flex-column align-items-center">
                        <div class="opportunities-icon bg-success">
                            <i class="fa fa-shopping-cart opp-icon"></i>
                        </div>
                        <span>Продуктовые <br> магазины</span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="opportunities-icon bg-primary">
                            <i class="fas fa-truck opp-icon"></i>
                        </div>
                        <span>Доставка еды</span>
                     </div>
                     <div class="d-flex flex-column align-items-center">
                        <div class="opportunities-icon bg-danger">
                            <i class="fas fa-utensils opp-icon"></i>
                        </div>
                        <span>Еда навынос</span>
                     </div>
                    
                    <div class="d-flex flex-column align-items-center">
                        <div class="opportunities-icon bg-warning">
                            <i class="fas fa-bed opp-icon"></i>
                        </div>
                        <span>Гостиница</span>
                    </div>
                    
                    <div class="d-flex flex-column align-items-center">
                        <div class="opportunities-icon again-info  bg-secondary">
                            <i class="fa fa-ellipsis-h opp-icon"></i>
                        </div>
                        <span>Ещё</span>
                    </div>
                    
                    
                    </div>
                    
                    <div class="again-item z-depth-1 again-hidden">
                    <div class="opportunities-again d-flex align-items-center justify-content-between p-4">
                    <div class="opp-again-list d-flex align-items-center">  
                    <div class="opportunities-icon  bg-secondary">
                    <i class="fas fa-university opp-icon"></i>
                    </div>  <p class="pl-2 pt-3 h6">Bank</p></div>
                    
                    <div class="opp-again-list  d-flex align-items-center">  
                    <div class="opportunities-icon bg-secondary">
                    <i class="fas fas fa-gas-pump opp-icon"></i>
                    </div>  <p class="pl-2 pt-3 h6">AES</p></div>
                    <div class="opp-again-list  d-flex align-items-center">  
                    <div class="opportunities-icon bg-secondary">
                    <i class="fas fa-parking opp-icon"></i>
                    </div>  <p class="pl-2 pt-3 h6">Parking</p></div>
                    
                    
                    </div> 
                    </div>
                    </div>
                    <!--search header-->
                    <div id="right-panel"class="ctn map-sidebar-back w-100"  style="background: white; max-height: 100vh; position: absolute; z-index: 999; top: 0; left: 0;">            
                    <div class="map-saibar hidden-map-sidebar">
                    <div class="map-sidebar-header">
                <div class="map-sidebar-icons">
                <button class="map-button btn-car btn-car-active" id="DRIVING">
                 <i class="fas fa-car fa-2x btn-icon"></i>
                </button>
                <button class="map-button btn-transit btn-transit-active" id="TRANSIT">
                 <i class="fa fa-subway fa-2x btn-icon"></i>
                </button>
                <button class="map-button btn-walking btn-walking-active" id="WALKING">
                <i class="fas fa-walking fa-2x btn-icon"></i> 
                </button>
                <button class="map-button btn-biking btn-biking-active">
                <i class="fas fa-bicycle fa-2x btn-icon"></i>
                </button>
                <button class="map-button btn-plane btn-plane-active" >
                 <i class="fa fa-plane fa-2x btn-icon"></i>
                </button><i class="fas fa-biking"></i>
                </div>    
                
                <div class="button btn-close ml-auto">
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
                      <input class="form-control" id="direction_a" type="text" placeholder="Укажите пункт отправления или выберите его на карте..."> <br>
                        <input class="form-control"  id="direction_b" type="text" placeholder="Укажите пункт назначения...">
                
                </div>
                        <i class="fas fa-sync btn-sync fa-2x" id="swap"></i>
                      </div> 
                     
                </div>
                
                <!--                                <p> <i class="fab fa-plus" ></i></p>-->
                
                        
                  <div class="map-address-hidden-car">
                       <div class="map-address Small shadow p-3 d-flex flex-column">
                        <div class="d-flex mr-auto ml-3">
                            <i class="fas fa-car fa-2x"></i> 
                           <p>На автомобиле</p>
                            <i class="far fa-times-circle fa-2x"></i> 
                        </div>
                        <button class="details mr-auto">подробности</button>
                    </div>
                  
                
                  </div> 
                   <div class="map-address-hidden-bus">
                       <div class="map-address Small shadow p-3 d-flex flex-column">
                        <div class="d-flex mr-auto ml-3">
                            <i class="fa fa-subway fa-2x"></i> 
                            <p>На общественном транспорте</p>
                            <i class="far fa-times-circle fa-2x"></i> 
                        </div>
                        <button class="details mr-auto">подробности</button>
                    </div>
                  </div>
                  
                    <div class="map-address-hidden-walking">
                       <div class="map-address Small shadow p-3 d-flex flex-column">
                        <div class="d-flex mr-auto ml-3">
                            <i class="fas fa-walking fa-2x"></i> 
                            <p>Пешком</p>
                            <i class="far fa-times-circle fa-2x"></i> 
                        </div>
                        <button class="details mr-auto">подробности</button>
                    </div>
                  </div>
                  
                  <div class="map-address-hidden-biking">
                       <div class="map-address Small shadow p-3 d-flex flex-column">
                        <div class="d-flex mr-auto ml-3">
                            <i class="fas fa-bicycle fa-2x"></i> 
                            <p>На велосипеде</p>
                            <i class="far fa-times-circle fa-2x"></i> 
                        </div>
                        <button class="details mr-auto">подробности</button>
                    </div>
                  </div>
                  
                  <div class="map-address-hidden-plane">
                       <div class="map-address Small shadow p-3 d-flex flex-column">
                        <div class="d-flex mr-auto ml-3">
                            <i class="fa fa-plane fa-2x"></i> 
                            <p>На самолете</p>
                            <i class="far fa-times-circle fa-2x"></i> 
                        </div>
                        <button class="details mr-auto">подробности</button>
                    </div>
                  </div>
                             <div class="distance-map Small shadow p-3">
                         <p class="pt-2 pl-4 h5">Общее расстояние: <span id="total"></span></p> 
                             </div>
                  </div> 
                </div>   
                <i id="Openbtn" class="openbtn"><i class="fas fa-chevron-right"></i></i>  
                
                <div id="{id}" class="map-click-slider" style="width: 100% ; height: 97vh; position: relative"> 
                                                               
                </div>
                <div class="mr-5">
                        {img}   
                    </div>           
                </div>
               
                       
             
HTML,


    'css' => <<<CSS

        ::-webkit-scrollbar {
          width: 12px;
          }

        ::-webkit-scrollbar-thumb {
            background-color: forestgreen;
        }

            .content-footer {
                width: 99% !important;
                height: 100vh !important;
                position: relative !important;
                }
                .sidebar {
              height: 99.9vh !important;
              width: 450px;
              position: absolute;
              z-index: 5;
              top: 0;
              left: -460px;
              background-color: white;
              overflow-x: hidden;
              transition: all 0.3s;
              -webkit-transition: all 0.3s;
              -o-transition: all 0.3s;
            }
            #direction_a,
             #direction_b{
                width: 280px;
                height: 40px;
            }
            .topBtn,
             .bottomBtn{
                display: none !important;
            }
              .openbtn {
              cursor: pointer;
              background-color:green;
              border: none;
              width: 30px;
              height: 60px;
              transition: margin-left .3s;
              color: white;
              position: absolute;
              z-index: 5;
              top: 60px;
              left: 20px;
            }
            .map-sidebar-back {
                display: none;
            }
           .search-map {
            position: relative;
            margin: 25px 5px;
            }
            .map-search-input {
                height: 50px;
                padding-left: 30px;
                border-radius: 10px;
                border: none;
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
            .button-share {
            position: absolute;
            top: 18px;
            right: 20px;
            color: #0c850c;
            }
            .move-closer,
             .opportunities,
             .specify-address,
             .again-item{
                margin-left: 5px;
            }
            .specify-address-box {
                height: 80px;
                border-bottom: 1px solid lightgrey;
                cursor: pointer;
            }
            .specify-address-box:hover {
                background-color: #4fe084;
                color: white;
            }
            .back-icon {
                width: 50px;
                height: 50px;
                background-color: #4fe084;
                border-radius: 50%;
                display:flex;
                justify-content: center;
                align-items: center;
            }
            .map-sidebar-header {
                width: 100%;
                display:flex;
                justify-content:space-around;
                align-items: center;
                margin-bottom: 50px;
            }
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
            .menu-left,
            .rounded-circle,
            .yii-debug-toolbar_position_bottom{
                display: none!important;
            }
            .details {
                background-color: transparent;
                border: none;
                color: green;
                font-size: 20px;
                width: 50%;
            }
             .map-sidebar-icons {
                display: flex;
                justify-content:space-between;
                align-items: center;
                width: 80%;
                margin-left: 30px;
            }
            .map-button,
             .btn-burger,
             .btn-close{
                background-color: transparent;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%;
            }
            .map-button:focus {
                color: #fff;
                background-color: #0c850c;
            }
            .btn-car-active,
             .btn-transit,
             .btn-walking,
             .btn-biking,
             .btn-plane {
                border: none;
                width: 60px;
                height: 60px;
                background-color: #0c850c;
            }
            .fa-align-justify,
            .fa-times,
             .fa-circle,
             .fa-sync,
             .fa-map-marker-alt,
             .opp-icon{
                color: white;
            }
            .fa,
            .fas,
            .far,
            .next-page {
                cursor: pointer
            }
            .btn-icon {
                margin: auto;
            }
            
            .map-saibar {
                padding: 50px 10px;
                background-color: #4fe084;
            }
            .adp {
                margin: 25px;
            }
             .map-search-in {
                width: 90%;
                display:flex;
                justify-content:space-between;
                align-items: center;
                margin-left: 30px;
            }
             .map-search-location {
                display: flex;
                align-items: center;
                align-content: center;
                flex-direction: column;
            }
            .location-circle {
                display: block;
                width: 8px;
                height: 8px;
                background-color:#fff8;
                border-radius: 50% ;
                margin: 5px 0;
            }
              .text-icon {
                line-height: 22px;
                margin-left: 15px;
            }
            
            .text-icon-sup {
                font-size: 18px;
                font-weight: 700;
                text-align: start;
                padding-top: -10px;
            }
               .opportunities-icon {
                width: 50px;
                height: 50px;
                border-radius: 50% ;
                display:flex;
                justify-content:center;
                align-items: center;
                cursor: pointer;
            }
            .again-hidden {
                display:none;
            }
            .opportunities span,
            .text-icon-sub {
                line-height: 16px;
                text-align: center;
                padding-top: 10px;
                font-size: 13px;
            }
            .btn-sync {
                transform: rotateX(180deg);
            }
            .map-address-hidden-car,
            .map-address-hidden-bus,
            .map-address-hidden-walking,
            .map-address-hidden-biking,
            .map-address-hidden-plane{
                display: none;
                position: relative;
                margin-left: 10px;
            }
            .map-address p {
                font-size: 20px;
                padding-left: 25px;
            }
            .fa-times-circle {
                cursor: pointer;
                position: absolute;
                top: 10px;
                right: 10px;
            }
            .adp-directions,
             .adp-placemark,
             .adp-summary,
              .adp-agencies,
              .adp-warnbox{
                width: 95%;
                margin-left: 25px !important;
            }
            .section-hidden-home,
            .section-hidden-work {
                display: none;
                position: absolute;
                z-index: 1;
                top: 0;
                left: 0;
                width: 100%;
                height: 200px;
                background-color:#fff;
                }
            .section-btn {
                background: transparent;
                border: none;
            }
            
            
           
            
            
CSS,


        'js' => <<<JS

//#region Sidebar Start

               const buttonShare = document.querySelector('.button-share')
               const mapSidebarBack = document.querySelector('.map-sidebar-back');
               const sidebarFront = document.querySelector('.sidebar-front');
               const btnClose = document.querySelector('.btn-close');
               const nextPage = document.querySelector('.next-page ');
               const againInfo = document.querySelector('.again-info');
               const againItem = document.querySelector('.again-item');
               const sync = document.querySelector('.fa-sync');
               const btnCar = document.querySelector('.btn-car');
               const btnTransit = document.querySelector('.btn-transit');
               const btnPlane = document.querySelector('.btn-plane');
               const btnBiking = document.querySelector('.btn-biking');
               const btnWalking = document.querySelector('.btn-walking');
               const mapAddressCar = document.querySelector('.map-address-hidden-car');
               const mapAddressBus = document.querySelector('.map-address-hidden-bus');
               const mapAddressWalking = document.querySelector('.map-address-hidden-walking');
               const mapAddressBiking = document.querySelector('.map-address-hidden-biking');
               const mapAddressPlane = document.querySelector('.map-address-hidden-plane');
               const details = document.querySelectorAll('.details');
               const timesCircles = document.querySelectorAll('.fa-times-circle');
               const mapSaibar = document.querySelector('.map-saibar');
               const distanceMap = document.querySelector('.distance-map');
               const btnCarActive = document.querySelector('.btn-car-active');
               const sectionHiddenHome = document.querySelector('.section-hidden-home');
               const sectionHiddenWork = document.querySelector('.section-hidden-work');
               const specifyAddressSup = document.querySelector('.specify-address-sup');
               const specifyAddressSub = document.querySelector('.specify-address-sub');
               const sectionBtnCloses = document.querySelectorAll('.section-btn-close');  
               const sectionHomeText = document.querySelector('.section-home-text');
               const sectionWorkText = document.querySelector('.section-work-text');
               const sectionHomeInput = document.querySelector('.section-home-input');
               const sectionWorkInput = document.querySelector('.section-work-input');  
               const sectionBtnHomeSave = document.getElementById('section-btn-home-save');
               const sectionBtnWorkSave = document.getElementById('section-btn-work-save');        
              
              console.log(sectionBtnHomeSave)
               
                details.forEach((detailIn) => {
                    detailIn.addEventListener('click', eventDetail);
                   
                });
                 timesCircles.forEach((timesCircle) => {
                    timesCircle.addEventListener('click', closeInfoMap);
                });
                
                sectionBtnCloses.forEach((sectionClose) => {
                    sectionClose.addEventListener('click', closeSection)
                })
                
 
                 
                function eventDetail() {    
                        mapSaibar.style.display = 'none';
                         details.style.display = 'none';
                };
                
                function closeInfoMap() {
                    mapSaibar.style.display = 'block';
                     mapAddressCar.style.display = 'none';
                     mapAddressBus.style.display = 'none';
                     mapAddressWalking.style.display = 'none';
                     mapAddressBiking.style.display = 'none';
                };
                
                function closeSection() {
                   sectionHiddenWork.style.display = 'none';
                   sectionHiddenHome.style.display = 'none';
                }
                
                sectionBtnHomeSave.addEventListener('click', () => {
                   sectionHiddenHome.style.display = 'none';
                   
                   if (sectionHomeInput.value == '')  {
                        sectionHomeText.innerHTML = 'Вы не ввели домашний адрес';
                        sectionHomeText.style.color = 'red';
                   } else {
                      sectionHomeText.innerHTML = sectionHomeInput.value;
                      sectionHomeInput.value = '';
                      sectionHomeText.style.color = 'black';  
                   }
                });
                
                 sectionBtnWorkSave.addEventListener('click', () => {
                      sectionHiddenWork.style.display = 'none';
                    if (sectionWorkInput.value == '')  {
                        sectionWorkText.innerHTML = 'Вы не ввели рабочий адрес';
                        sectionWorkText.style.color = 'red';
                   }  else {
                        sectionWorkText.innerHTML = sectionWorkInput.value;
                        sectionWorkInput.value = '';
                        sectionWorkText.style.color = 'black';
                   }
                });
                
                
                specifyAddressSup.addEventListener('click', () => {
                    sectionHiddenHome.style.display = 'block';
                });
                 specifyAddressSub.addEventListener('click', () => {
                    sectionHiddenWork.style.display = 'block';
                });
                
                btnClose.addEventListener('click', () => {
                     mapSidebarBack.style.display = 'none';
                     sidebarFront.style.display = 'block'
                 }) ;
                 buttonShare.addEventListener('click', () => {
                     mapSidebarBack.style.display = 'block';
                     sidebarFront.style.display = 'none'
                 }) ;
                 
                  nextPage.addEventListener('click', () => {
                     mapSidebarBack.style.display = 'block';
                     sidebarFront.style.display = 'none'
                 }) ;   
                 againInfo.addEventListener('click', () => {
                     againItem.classList.toggle('again-hidden')
                 }) ;   
                 sync.addEventListener('click', () => {
                     sync.classList.toggle('btn-sync')
                 }) ;  
                  btnCar.addEventListener('click', clickBtnCar);
                  
                  function clickBtnCar() {
                      mapAddressCar.style.display = 'block';
                      mapAddressBus.style.display = 'none';
                      mapAddressWalking.style.display = 'none';
                      mapAddressBiking.style.display = 'none';
                      mapAddressPlane.style.display = 'none';
                      btnCarActive.style.background = '#0c850c';
                      btnTransit.style.background = 'none';
                      btnWalking.style.background = 'none';
                      btnBiking.style.background = 'none';
                      btnPlane.style.background = 'none';
                  }
                  

                  btnTransit.addEventListener('click', () => {
                     mapAddressBus.style.display = 'block';
                      mapAddressCar.style.display = 'none';
                      mapAddressWalking.style.display = 'none';
                      mapAddressBiking.style.display = 'none';
                      mapAddressPlane.style.display = 'none';
                      btnCarActive.style.background = 'transparent';
                      btnTransit.style.background = '#0c850c';
                       btnWalking.style.background = 'none';
                      btnBiking.style.background = 'none';
                      btnPlane.style.background = 'none';
                      
                     
                 }) ;
                  btnWalking.addEventListener('click', () => {
                      mapAddressWalking.style.display = 'block';  
                      mapAddressBus.style.display = 'none';
                      mapAddressCar.style.display = 'none';
                       mapAddressBiking.style.display = 'none';
                       mapAddressPlane.style.display = 'none';
                      btnCarActive.style.background = 'transparent'
                      btnWalking.style.background = '#0c850c';
                      btnTransit.style.background = 'none';
                       btnBiking.style.background = 'none';
                      btnPlane.style.background = 'none';
                 }) ;
                  
                   btnBiking.addEventListener('click', () => {
                       mapAddressBiking.style.display = 'block';
                       mapAddressWalking.style.display = 'none';
                       mapAddressBus.style.display = 'none';
                       mapAddressCar.style.display = 'none';
                       mapAddressPlane.style.display = 'none';
                       btnCarActive.style.background = 'transparent'
                       btnWalking.style.background = 'none';
                       btnTransit.style.background = 'none';
                       btnBiking.style.background = '#0c850c';
                       btnPlane.style.background = 'none';
                 }) ;
                 
                   btnPlane.addEventListener('click', () => {   
                      mapAddressPlane.style.display = 'block';
                      mapAddressWalking.style.display = 'none';
                      mapAddressBus.style.display = 'none';
                      mapAddressCar.style.display = 'none';
                      mapAddressBiking.style.display = 'none';
                      btnCarActive.style.background = 'transparent'
                      btnWalking.style.background = 'none';
                      btnTransit.style.background = 'none';
                      btnBiking.style.background = 'none';
                      btnPlane.style.background = '#0c850c';
                 }) ;
                   btnBiking.addEventListener('click', () => {
                      btnCarActive.style.background = 'transparent'
                 }) ;
                    btnPlane.addEventListener('click', () => {
                      btnCarActive.style.background = 'transparent'
                 }) ;

                 clickBtnCar();
                 
                var openCheck = 0;
                document.getElementById("Openbtn").onclick = function openBtn(){
                    
	                console.log("ERROR FIXING" + openCheck)
	                if(openCheck==0){
                            document.getElementById("Sidebar").style.left = "-15px";
                            document.getElementById("Openbtn").style.marginLeft = "415px";
                            document.getElementById("Openbtn").style.transform="rotate(180deg)";
                            // document.querySelector('#search_area').style.display = 'block'
                            openCheck = 1;
                        }else{
                            document.getElementById("Sidebar").style.left = "-450px";
                            document.getElementById("Openbtn").style.marginLeft= "0";
                            document.getElementById("Openbtn").style.transform="rotate(360deg)";
                            // document.querySelector('#search_area').style.display = 'none'
                            openCheck = 0;
                        }
                    };
//#endregion
//#region global vars
/*API key*/
var key = 'AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo';
/*Is show in map input search auto complete*/
var searchAutoComplete = {searchAutoComplete};

/*Is show image*/
var searchPlaceImageShow = {searchPlaceImageShow};
//#endregion

/*If loaded show map*/
$('#{id}').ready(
function () {

/*For direction Render global*/
var directionsRenderer;

console.log("{id} map creating...")

var cnt_ind = 0;

    
var map;


/*For save searched place_id*/
var searchPlaceId = "";

/*For save markers on map*/
var allMarkers = [];

/*For config max marker count*/
var count_markers = {matkerCount};

/*For direction Service*/
var directionsService;


/*For change markers*/
var cnt_edited = 0;

var mapUseType = '{mapUseType}';




//#region init
var options = {
    center:{lat:41.32, lng: 69.22},
    zoom: {zoom},
    mapTypeId: '{mapType}'
}
map = new google.maps.Map(document.getElementById('{id}'),options);

var savedData = mapValueInstalization();
console.log(savedData);
allMarkers = savedData.map(function(location, i) {
    var marker = new google.maps.Marker({
        position: {lat:parseFloat(location.lat), lng: parseFloat(location.lng)},
        label: 'Z' + i,
    });
    return marker;
});
console.log(allMarkers);

    // Add a marker clusterer to manage the markers.
var markerCluster = new MarkerClusterer(map, allMarkers,
    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

//endregion 

if (mapUseType === 'read') {
    createReadMap();
} else createWriteMap();


//region Write Map    
function createWriteMap()
{
    map.addListener('click', function(event) {
        /*If selected place id*/
        if (allMarkers.length < count_markers)
        {
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: {draggable},
                title: '' ,
                map: map
            });
            
            pushData(map, event.latLng.lat(), event.latLng.lng(), marker, allMarkers.length, 'push');
            
            allMarkers.push(marker);
            console.log('saqlandi');
            console.log(count_markers);
        }
        else if (allMarkers.length >= count_markers) {
            console.log("Oграниченный маркер!!");
            var marker = new google.maps.Marker({
                position: event.latLng,
                draggable: {draggable},
                title: '' ,
                map: map
            });
            allMarkers.forEach(function (m) {m.setMap(null);});
            
            
            var editing_index = allMarkers.length - count_markers + cnt_edited;
            allMarkers[editing_index] = marker;
            console.log(editing_index);
            console.log(allMarkers);
            for (var i = 0; i < allMarkers.length; i++) {
              allMarkers[i].setMap(map);
            }
            pushData(map,  event.latLng.lat(), event.latLng.lng(), marker, editing_index, 'edit');
            
            cnt_edited = (cnt_edited + 1) % count_markers;
        }
        else {
            alert("Пожалуйста сначала выберите место на панели поиска!")
        }
    });
    //#region Search with depend
    var Placeinput = document.getElementById('{depend_id}');
    var searchBoxPlace = new google.maps.places.SearchBox(Placeinput);

    map.addListener('bounds_changed', function () {
        searchBoxPlace.setBounds(map.getBounds());
    });

    var markers = [];

    searchBoxPlace.addListener('places_changed', function () {
        var places = searchBoxPlace.getPlaces();

        if(places.length === 0)
            return null;

        markers.forEach(function (m) {m.setMap(null);});
        markers = [];

        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (p) {
            if(!p.geometry)
                return null;

            markers.push(new google.maps.Marker({
                map:map,
                title: p.name,
                position: p.geometry.location,
                // icon: 'https://maps.google.com/maps/contrib/104742213001054094436',
            }));
            console.log('Topildi ');
            console.log(p.place_id);
            searchPlaceId = p.place_id;
             
            
            getPlaceImage(searchPlaceId);

            if(p.geometry.viewport)
                bounds.union(p.geometry.viewport);
            else bounds.union(p.geometry.location);
        })
        map.fitBounds(bounds);
        
        if (searchAutoComplete) {
            document.getElementById('search_map_{id}').value =  document.getElementById('{depend_id}').value;
        }
         
    })
    //#endregion
    
    //#region search in map
    if (searchAutoComplete)
    {
        console.log("Have search")
        /*********************************************************************************/
        var input = document.getElementById('search_map_{id}');
        var searchBox = new google.maps.places.SearchBox(input);
    
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });
         
        markers = [];
        /*For in search in map*/
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();
    
            if(places.length === 0)
                return null;
    
            markers.forEach(function (m) {m.setMap(null);});
            markers = [];
            
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (p) {
                if(!p.geometry)
                    return null;
    
                markers.push(new google.maps.Marker({
                    map:map,
                    title: p.name,
                    position: p.geometry.location,
                    // icon: 'https://maps.google.com/maps/contrib/104742213001054094436',
                }));
                console.log('User qidirdi va topildi');
                console.log(p.place_id);
                var place_id = p.place_id;
                
                getPlaceImage(p.place_id);
                 
                if(p.geometry.viewport)
                    bounds.union(p.geometry.viewport);
                else bounds.union(p.geometry.location);
            })
            
            map.fitBounds(bounds);
            document.getElementById('{depend_id}').value = document.getElementById('search_map_{id}').value;
        })
    }
    //#endregion
    
    
    /*********************************************************************************/
         /*IP address*/
    var btn_address = document.getElementById('getmyAddress');
    $(btn_address).on('click', function() {
        infoWindow = new google.maps.InfoWindow;
        var location = navigator.geolocation;
       
        if (location) {
        location.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent();
               
                markers.push(new google.maps.Marker({
                map:map,
                title: pos.name,
                position:pos,
                // icon: 'https://maps.google.com/maps/contrib/104742213001054094436',
            }));
                /*infoWindow.open(map);*/
                
                map.setCenter(pos);
                
                 var urlLink2 = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&key='+key;
                 fetch(urlLink2)
                    .then(response => response.json()) 
                     .then(data => {
                         var dataFet = data.results[0].formatted_address;
                        console.log(data);
                        var contentString = dataFet;
                        var infowindow = new google.maps.InfoWindow({
                                content: contentString
                        });
                        
                        infowindow.open(map, marker,document.contentString.insertAdjacentHTML(
                           "beforeend",                                                 
                        ));
                    })
                    .catch(err => console.warn(err.message));
            },
           function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: Служба геолокации не удалась.' :
            'Error: Ваш браузер не поддерживает геолокацию.');
        infoWindow.open(map);
    }
}
//#endregion


//#region Create Read Map

function createReadMap()
{
    //#region navigation
    directionsRenderer = new google.maps.DirectionsRenderer;
    directionsService = new google.maps.DirectionsService;
    
    directionsRenderer = new google.maps.DirectionsRenderer({
        draggable: {draggable},
        map: map,
        panel: document.getElementById('right-panel'),
    });
    
    directionsRenderer.addListener('directions_changed', function() {
        computeTotalDistance(directionsRenderer.getDirections());
    });
    
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
    
    console.log("Direction");
    
    optimalPoints();
    //#endregion
}
//#endregion
    

//#region Functions    
/*Prevent to press ENTER button in search area*/
$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
}); 
  
     
 //Get image of place with google PlacesService    
function getPlaceImage(place_id){
    if (searchPlaceImageShow){
        var request = {
            placeId: place_id,
            fields: ['name','photos']
        };
        
        service = new google.maps.places.PlacesService(map);
        service.getDetails(request, changeImage);
        
        function changeImage(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                if (place.hasOwnProperty('photos')) {
                    $('#place_image_{id}').css('display','') ;
                    document.getElementById("place_image_{id}").src = place.photos[0].getUrl();
                }
                else $('#place_image_{id}').css('display','none');
            }
        }
    }
}

//For save or edit markers
function pushData(map, lat, lng, marker, index, type)
{
    var urlLink = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ lat +','+ lng +'&key='+key;
    /************************************************************************/
    console.log("Push data type " + type)
    
    bootbox.prompt({
        title: "добавить ваше местоположение!", 
        centerVertical: true,
        callback: function(result){ 
            console.log(result);
            
            fetch(urlLink)
            .then(response => response.json()) 
            .then(data => {
                var address = data.results[0].formatted_address;
                var place_id = data.results[0].place_id;
               
               /*Fixing*/
               /* if (searchPlaceId.length === 0)
                    place_id = data.results[0].place_id;*/
                //console.log(data.results[0].place_id);
                var contentString = '<b style="text-align:center">'+result+'</b><br>'+address;
                var infowindow = new google.maps.InfoWindow({
                    content: contentString 
                });
                infowindow.open(map, marker) 
                
                /* var address_area_input = $(valueOfInput).val();*/
                
                if (type === 'push') {
                    console.log("pushing " + index);
                    $("<input hidden type='text' name = '{name}[" +index + "][place_id]' value='" + place_id + "'>").appendTo('#{id}-locations'); 
                    $("<input hidden type='text' name = '{name}["+ index + "][address]' value='" + address + "'>").appendTo('#{id}-locations');
                    $("<input hidden type='text' name = '{name}["+ index + "][user_entered_address]' value='" + result + "'>").appendTo('#{id}-locations');
                    $("<input hidden type='text' name = '{name}["+ index + "][lat]' value=" + lat + ">").appendTo('#{id}-locations');
                    $("<input hidden type='text' name = '{name}["+ index + "][lng]' value=" + lng + ">").appendTo('#{id}-locations');
                    $("<hr>").appendTo('#{id}-locations');
                }
                else if (type === 'edit') {
                    
                    $("input[name='{name}["+ index + "][address]'").val(address);
                    $("input[name='{name}["+ index + "][user_entered_address]'").val(result);
                    $("input[name='{name}["+ index + "][lat]'").val(lat);
                    $("input[name='{name}["+ index + "][lng]'").val(lng);
                }
            
            })
            .catch(err => console.warn(err.message));
              
            }
        });
} 

/*load data to showing map*/
function mapValueInstalization() {
    var data = {generateAlreadySaved};
    var index = 0;
    for(var i = 0; i < data.length; i++)
    {
        $("<input hidden type='text' name = '{name}[" + index + "][place_id]' value='" + data[i].place_id + "'>").appendTo('#{id}-locations'); 
        $("<input hidden type='text' name = '{name}[" + index + "][address]' value='" + data[i].address+ "'>").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][user_entered_address]' value='" + data[i].user_entered_address + "'>").appendTo('#{id}-locations'); 
        $("<input hidden type='text' name = '{name}[" + index + "][lat]' value=" + data[i].lat + ">").appendTo('#{id}-locations');
        $("<input hidden type='text' name = '{name}[" + index + "][lng]' value=" + data[i].lng + ">").appendTo('#{id}-locations');
        $("<hr>").appendTo('#{id}-locations');
        index++;
    }
    return data;
}


//#region For direction
/*Create Direction routes*/

function optimalPoints() {
    var limitWayPoints = {limitWayPoints};
    var coords = [];
    
    for (var i = 0; i < allMarkers.length; i++)
    {
        if (coords.length >= limitWayPoints) break;
        coords.push({
          x: allMarkers[i].position.lng(),
          y: allMarkers[i].position.lat()
        });
    }
    /*If not draw direction*/
    if (coords.length < 2) return null;
    console.log("coords")
    console.log(coords);
    
    /*Max distance will min number*/
    var mxDistance = -1000;
    var Aindex, Bindex;
    for (var i = 0; i < coords.length; i++)
    {
        for (var j = i + 1; j < coords.length; j++)
        {
            var dis = distance(coords[i].x, coords[i].y, coords[j].x, coords[j].y);
            if (mxDistance < dis)
            {
                mxDistance = dis;
                Aindex = i;
                Bindex = j;
            }
        }
    }
    Bindex = 2;
    
    console.log("Maximal distance = " + mxDistance +" of points " + Aindex + " and " + Bindex);
    
    var image = {
    url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(140, 32),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(0, 32)
    };
    var directionMarkerA = new google.maps.Marker({
        map: map,
        icon: image,
        position: allMarkers[Aindex].getPosition(),
        draggable: {draggable},
        
    });
    
    var directionMarkerB = new google.maps.Marker({
        map: map,
        icon: image,
        position: allMarkers[Bindex].getPosition(),
        draggable: {draggable},
        
    });
    
    var directionWayPoints = [];
    console.log("Get position")
    console.log(allMarkers[0].getPosition());
    for (var i = 0; i < coords.length; i++)
    {
        if (i === Aindex || i === Bindex) continue;
        
        directionWayPoints.push({
          location: {lat:coords[i].y, lng: coords[i].x},
          stopover: true
        });
    }
    createDirection(directionMarkerA,directionMarkerB,directionWayPoints);
}

function distance(x1, y1, x2, y2) {
    return (x1 - x2)*(x1 - x2) + (y1 - y2)*(y1 - y2);
}
function createDirection(directionA, directionB, wayPoints) {
    
    directionsService.route({
        origin: directionA.getPosition(),
        destination: directionB.getPosition(),
        optimizeWaypoints: {optimizeWaypoints},
        
        waypoints: wayPoints,
        
        travelMode: "DRIVING",
        /*drivingOptions: {
            departureTime: new Date(Date.now()),  // for the time N milliseconds from now.
            trafficModel: 'optimistic'
        }*/
    }, function(response, status) {
        console.log(response)
        if (status === 'OK') {
            directionsRenderer.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

/*Create Direction routes calc distance*/
function computeTotalDistance(result) {
    var total = 0;
    var totalTime = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
        totalTime += myroute.legs[i].duration.value;
    }
    total = total / 1000;
    document.getElementById('total').innerHTML = total + ' km <br>' + (totalTime/60) + ' min with ' + 'DRIVING';
}
//#endregion


//#endregion
});

JS,


    ];

    public function asset()
    {
        $url = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&libraries=places';
        $this->fileJs($url, 3);
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
        $this->fileJs('https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js', 2);
        $this->fileCss('\render\places\ZGoogleWidget\asset\main\css\style.css');
    }


  
    public function codes()
    {
        $search='' ;
        $image='' ;
        /*<input type="text" class="section-home-input w-100 pl-2">*/
        $searchHome='
                <input type="text" id="search_map_home_'.$this->getId().'" class="section-home-input w-100 pl-2"/>
            ';

        /*<input type="text" class="section-work-input w-100 pl-2">*/
        $searchWork='
                <input type="text" id="search_map_work_'.$this->getId().'" class="section-work-input w-100 pl-2"/>
            ';
        if($this->_config['searchAutoComplete'])
        {
            /*<input type="text" class=" w-100 map-search-input z-depth-1" type="text" placeholder="Поиск на Картах">*/
            $search='
                <input type="text" id="search_map_'.$this->getId().'" class="w-100 map-search-input z-depth-1" placeholder="Поиск на Картах"/>
            ' ;
        }

        if($this->_config['searchPlaceImageShow'])
        {
            $image_id = "place_image_".$this->getId();
            $image='
            <img class="manage one place_image" id='.$image_id.' style="width: 200px; height: 200px; position: absolute;  top: 15%; z-index: 1" src="https://maps.googleapis.com/maps/api/place/photo?key=AIzaSyBkxS5l87lclaC6MIWSGejdCXL13wSShRo&maxwidth=580
&photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU" />
           ' ;

        }

        if(isset($this->config['depend']['dependPlace']) && $this->config['depend']['dependPlace']){
            $this->_config['depend']['depend_id'] = $this->config['depend']['depend_id'];
        }

        $this->htm = strtr($this->_layout['main'], [
            //'{hInput}'  => $input,
            '{id}'        => $this->getId(),
            '{name}'      => $this->name,
            '{modalTitle}'=> Az::l('Adding Location'),
            '{search}'    => $search,
            '{searchHome}'  => $searchHome,
            '{searchWork}'  => $searchWork,
            '{img}'       => $image,
            '{height}'      => $this->_config['height'],
            '{width}'       => $this->_config['width'],

//            '{TRANSIT}' => $this->TRANSIT,
        ]);

        $this->css = $this->_layout['css'];


        $this->js = strtr($this->_layout['js'], [
            '{id}'                      => $this->getId(),
            '{name}'                    => $this->name,
            '{zoom}'                    => $this->_config['zoom'],
            '{mapType}'                 => $this->_config['mapType'],
            '{mapUseType}'              => $this->_config['mapUseType'],
            '{matkerCount}'             => $this->_config['matkerCount'],
            '{limitWayPoints}'          => $this->_config['limitWayPoints'],
            '{optimizeWaypoints}'       => $this->_config['optimizeWaypoints']? 'true': 'false',
            '{draggable}'               => ($this->_config['draggable'])? 'true': 'false',
            '{depend_id}'               => ($this->_config['depend']['dependPlace'] == true)?$this->_config['depend']['depend_id']: 'none',
            '{searchAutoComplete}'      => ($this->_config['searchAutoComplete'])? 'true': 'false',
            '{searchPlaceImageShow}'    => ($this->_config['searchPlaceImageShow'])? 'true': 'false',
            '{generateAlreadySaved}'    => (isset($this->value) > 0)?json_encode($this->value) :json_encode([])
        ]);

    }
}
