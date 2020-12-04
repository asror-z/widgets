<?php
/**
 *
 * Class ZGoogleWidget
 * Created By: Daho
 * Refactored by: Davlatmurod Jumaboyev,Khojiakbar Kodirov, Zoirjon Sobirov, Anvar Jabborov
 */

namespace zetsoft\widgets\places\test;

use kartik\builder\Form;
use kartik\widgets\Typeahead;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\former\ZFormWidget;

class ZYandexDbWidgetZ extends ZWidget
{
    #region Congif
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'zoom' => self::zoom['zoom'],
        'controls' => self::controls['routePanelControl'],
        'type' => self::type['auto'],
        'types' => self::types['typse'],
        'fromEnabled' => self::fromEnabled['true'],
        'from' => self::from['from'],
        'toEnabled' => self::toEnabled['true'],
        'allowSwitch' => self::allowSwitch['false'],
        'reverseGeocoding' => self::reverseGeocoding['true'],
        'data' => self::data['data'],
        'options' => self::options['options'],

    ];
    public const zoom = [
        'zoom' => 9,
    ];
    public const controls = [
        'routePanelControl' => 'routePanelControl',
        'routeButtonControl' => 'routeButtonControl',
    ];
    public const type = [
        'masstransit' => 'masstransit',
        'pedestrian' => 'pedestrian',
        'taxi' => 'taxi',
        'auto' => 'auto',
        'bicycle' => 'bicycle',
    ];
    public const types = [
        'typse' => '{masstransit: true, pedestrian: true, taxi: true, auto: true, bicycle: true,}',
    ];
    public const fromEnabled = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const from = [
        'from' => 'Москва, метро Молодежная',
    ];
    public const toEnabled = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const allowSwitch = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const reverseGeocoding = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const data = [
        'data' => '{content: "Поменять местами", title: "Поменять точки местами"}',
    ];
    public const options = [
        'options' => '{selectOnClick: false, maxWidth: 160}',
    ];


    public $_layout = [
        'main' => <<<HTML
             <div id="locations"></div>
        <div id="map"> 
                       <div class="search-map">
                         <input type="text" class="w-100 map-search-input z-depth-1" type="text" placeholder="Поиск мест и адресов">
<!--                             {search}-->
                         <div class="seach-icon">
                         <i class="fa fa-search" ></i>
                         <div class="line"></div>
                         </div>
                         <i class="fas fa-share-square button-share"></i>
                         <i class="fa fa-times close-btn-back"></i>
                         <i class="fa fa-map-marker fa-2x"></i>
                        </div>
                    <div class="sidebar Small shadow" id="Sidebar">
                         <div class="sidebar-front">
                        
                    
                        
<!--address work and home sextion hidden-->
                              
                <div class = "yandex-sidebar-front">
                        <div class="opportunities d-flex justify-content-around">
                             <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon warning-color">
                                    <i class="fas fa-truck opp-icon fa-2x"></i>
                                </div>
                                <span>Restaurant <br> delivery</span>
                             </div> 
                            
                            <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon light-green accent-4">
                                    <i class="fas fa-pills opp-icon fa-2x"></i>
                                </div>
                                <span>Pharmacies</span>
                             </div>
                            
                            <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon light-blue lighten-1">
                                <i class="fas fa-shopping-basket fa-2x"></i>
                                </div>
                                <span>Groceries</span>
                            </div>
                            
                              <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon light-blue lighten-1">
                                <i class="fal fa-shopping-bag fa-2x"></i>
                                </div>
                                <span>Grocery <br> delivery</span>
                             </div> 


                        </div>
                        
                                                  <div class="opportunities-sub d-flex justify-content-around mt-2">
                             <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon indigo lighten-1">
                                    <i class="fas fas fa-gas-pump opp-icon fa-2x"></i>
                                </div>
                                <span>Gas sataions</span>
                             </div> 
                            
                            <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon  red accent-1">
                                    <i class="fas fa-hospital opp-icon fa-2x"></i>
                                </div>
                                <span>Hospitals</span>
                             </div>
                            
                            <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon indigo lighten-1">
                                    <i class="fas fa-money-check-alt opp-icon fa-2x"></i>
                                </div>
                                <span>ATMs</span>
                            </div>
                            
                           <div class="d-flex flex-column align-items-center">
                                <div class="opportunities-icon again-info  bg-secondary">
                                    <i class="fa fa-ellipsis-h opp-icon"></i>
                                </div>
                                <span>All places</span>
                                
</div>
    </div>
      <div class="again-item z-depth-1 again-hidden">
                         <div class="opportunities-again d-flex align-items-center justify-content-between p-4">
                            <div class="opp-again-list d-flex align-items-center">  
                            <div class="opportunities-icon  red accent-1">
                            <i class="fal fa-dumbbell fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h6">Fitness</p></div>
                        
                        <div class="opp-again-list  d-flex align-items-center">  
                            <div class="opportunities-icon indigo lighten-1">
                            <i class="fas fa-bed fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h6">Hotels</p></div>
                        <div class="opp-again-list  d-flex align-items-center">  
                            <div class="opportunities-icon bg-secondary">
                            <i class="fas fa-tv fa-2x"></i>
                        </div>  <p class="pl-2 pt-3 h6">Cinemas</p></div>
                        
                        
                        </div> 
                    </div>
                       </div>
                </div>   
                               
               
                        
                        
<!--search header-->
                      <div id="right-panel" class="yandex-sidebar-back w-100"> 
                            <div class="map-sidebar-header">
                      <div class="map-sidebar-icons w-100">
                    <button class="map-button btn-car" id="DRIVING">
                         <i class="fas fa-car fa-2x btn-icon"></i>
                    </button>
                    <button class="map-button btn-transit" id="TRANSIT">
                         <i class="fa fa-subway fa-2x btn-icon"></i>
                    </button>
                     <button class="map-button btn-walking" id="WALKING">
                        <i class="fas fa-walking fa-2x btn-icon"></i> 
                    </button>
                      <button class="map-button btn-biking">
                       <i class="fas fa-bicycle fa-2x btn-icon"></i>
                    </button>
                    <button class="map-button btn-plane" >
                         <i class="fas fa-taxi fa-2x btn-icon"></i>
                    </button>
</div>    
                        
                          </div>
                           <div class="map-search-in">
                            <div class="map-search-from">
                              <div class="d-flex align-items-center">
                                  <i class="fas fa-dot-circle"></i>
                                    <input type="text" class="form-control ml-2"  id="direction_a" type="text" placeholder="Откуда">
                            </div> <br>
                            <div class="d-flex align-items-center">
                                  <i class="fas fa-dot-circle circle-sub"></i>
                                    <input class="form-control ml-2"  id="direction_b" type="text" placeholder="Куда">
                            </div>
                                

</div>                             <i class="fas fa-exchange-alt" id="swap"></i>
                              </div> 
                                  <div class="add-inputs">

</div>
                              <div class="d-flex justify-content-between add-box-search">
                              <span id="add-input" class="text-add" >Добавить точку</span>
                              <span id="remove-inputs" class="text-remove" >Сбросить</span>
</div>


                             
</div>

<!--                                <p> <i class="fab fa-plus" ></i></p>-->
           
                 
                          </div> 
                        
                        <div id="OpenSidebar" class="open-sidebar">
                            <i class="fas fa-caret-right"></i>
                        </div> 
        
        </div>                 
                     
HTML,

        'css' => <<<CSS
          
            .menu-left,
            .rounded-circle,
            .yii-debug-toolbar_position_bottom{
                display: none!important;
            }
        .ymaps-2-1-76-controls__control_toolbar {
            display: none!important;
        } 
            .topBtn,
             .bottomBtn{
                display: none !important;
            }
       html, body, #map {
            width: 100%;
            height: 100vh;
            padding: 0;
            margin: 0;
        }
        #map {
            position: relative;
        }
        
         ::-webkit-scrollbar {
          width: 12px;
          }

        ::-webkit-scrollbar-thumb {
            background-color: darkslategrey;
        }

            .content-footer {
                width: 99% !important;
                height: 100vh !important;
                position: relative !important;
                }
                .sidebar {
              height: 99.9vh !important;
              width: 430px;
              position: absolute;
              z-index: 5;
              top: 0;
              left: -430px;
              background-color: white;
              overflow-x: hidden;
              transition: all 0.3s;
              -webkit-transition: all 0.3s;
              -o-transition: all 0.3s;
            }
            #direction_a,
             #direction_b{
                width: 330px;
                height: 40px;
            }
            
              .open-sidebar {
              cursor: pointer;
              background-color: darkslategrey;
              border-radius: 5px;
              border: none;
              width: 30px;
              height: 35px;
              color: #fafafa;
              position: absolute;
              z-index: 999;
              top: 20px;
              left: 450px;
              display:flex;
              justify-content:center;
              align-items:center;
            }
            .yande-sidebar-back {
                display: none;
                margin-top: 100px;
            }
            
           .search-map {
            position: absolute;
            width: 410px;
            top: 10px;
            left: 10px;
            z-index: 999;
            }
            .map-search-input {
                padding-left: 45px;
                border: none;
                height: 50px;
                border-radius: 2.5px;
            }
             .map-search-input::placeholder {
                font-size: 20px;
                font-weight: 100;
             }
              .map-search-input:focus {
                outline: none !important;
              }
            .seach-icon {
            display: flex;
            position: absolute;
            top: 18px;
            right: 40px;
            color: grey;
            }
              .line {
                width: 30px;
                height: 1px;
                background-color: grey;
                transform: rotate(90deg);
                margin-left: 10px;
                margin-top: 5px;
            }
            .fa-map-marker {
            position: absolute;
            top: 10px;
            left: 10px;
            color: red;
            }
            .fa-dot-circle {
               color: red; 
            }
            .circle-sub {
                color: black;
            }
            .button-share,
            .fa-times {
            position: absolute;
            top: 18px;
            right: 20px;
            color: grey;
            }
            
            .close-btn-back {
                display: none;
            }
            .map-sidebar-header {
                width: 100%;
                display:flex;
                justify-content:space-around;
                align-items: center;
                margin-bottom: 50px;
            }
             .map-sidebar-icons {
                display: flex;
                justify-content:space-around;
                align-items: center;
            }
            .map-button{
                background-color: transparent;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%;
            }
            .map-button:focus {
                color: #fff;
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
             .map-search-in {
                width: 100%;
                display:flex;
                justify-content:space-around;
                align-items: center;
            }
             .opportunities-icon {
                width: 60px;
                height: 60px;
                border-radius: 50% ;
                display:flex;
                justify-content:center;
                align-items: center;
                cursor: pointer;
                color: white;
            }
            .opportunities span {
                line-height: 16px;
                text-align: center;
                padding-top: 10px;
            }
            .btn-sync {
                transform: rotateX(180deg);
            }
            .text-remove,
            .text-add {
                color: grey;
                cursor: pointer;
            }
            .text-remove:hover,
            .text-add:hover {
                color: red;
            }
            .yandex-sidebar-back {
                display:none;
            }
            .yandex-sidebar-front {
                margin-top: 100px;
            }
            
            .form-control {
                background-color: #fafafa;
            }
            .add-box-search {
               display:flex;
               justify-content: space-between;
               width: 90%;
               margin: 30px auto;
            }
            .add-inputs {
                display:flex;
                justify-content:center;
                flex-direction: column;
                margin-left: 17px;
                 
            }
            .added-input {
               display:flex;
               align-items: center;
               width: 85%;
               margin-top: 15px;
            }
            .fa-exchange-alt {
              transform: rotate(95deg);
            }
        
        
        
CSS,
        'js' => <<<JS
 
 const openSidebarBack = document.querySelector('.button-share');
 const yandeSidebarBack = document.querySelector('.yandex-sidebar-back');
 const yandexSidebarFront = document.querySelector('.yandex-sidebar-front');
 const closeBtnBack = document.querySelector('.close-btn-back');
 const addInput = document.getElementById('add-input');
 const removeInput = document.getElementById('remove-inputs');
 const addBoxSearch = document.querySelector('.add-inputs');
        console.log(addBoxSearch)
 
 
 openSidebarBack.addEventListener('click', () => {
     yandexSidebarFront.style.display = 'none'
     yandeSidebarBack.style.display = 'block';
     closeBtnBack.style.display = 'block';
     openSidebarBack.style.display = 'none';
     document.getElementById("Sidebar").style.left = "0";
     document.getElementById("OpenSidebar").style.transform="rotate(180deg)";
 });
 
 closeBtnBack.addEventListener('click', () => {
     yandexSidebarFront.style.display = 'block'
     yandeSidebarBack.style.display = 'none';
     closeBtnBack.style.display = 'none';
     openSidebarBack.style.display = 'block';
 
 });
 
 addInput.addEventListener('click', () => {
  let input =  document.createElement('div');
  input.classList.add('added-input');
  input.innerHTML = `<i class="fas fa-dot-circle circle-sub"></i>
                                    <input id="direction" class="form-control ml-2" type="text" placeholder="Куда">`
  
  console.log(input)
  addBoxSearch.prepend(input)

 });
   document.getElementById("swap").onclick =
  function (event) {
    e.preventDefault();
    var inputdirection_a = document.getElementById("direction_a");
    var fromVal = inputdirection_a.value;

    var inputdirection_b = document.getElementById("direction_b");
    var toVal = inputdirection_b.value;

    inputdirection_a.value = toVal;
    inputdirection_b.value = fromVal;
  };
 removeInput.addEventListener('click', () => {
   addBoxSearch.remove();
 })
 
                         var openCheck = 0;
                document.getElementById("OpenSidebar").onclick = function openSidebar(){
	                if(openCheck==0){
                            document.getElementById("Sidebar").style.left = "0";
                            document.getElementById("OpenSidebar").style.transform="rotate(180deg)";
                            openCheck = 1;
                        }else{
                            document.getElementById("Sidebar").style.left = "-430px";
                            document.getElementById("OpenSidebar").style.transform="rotate(360deg)";
                            openCheck = 0;
                        }
                    };
         
 
 
 
 ymaps.ready(function () {
 
    var myMap = new ymaps.Map('map', {
        center: [41.327069, 69.281797],
        zoom: {zoom},
        // Добавим панель маршрутизации.
        controls: ['{routePanelControl}']
    });

    var control = myMap.controls.get('{routePanelControl}');
///////////////////
                  
  // Получение объекта, описывающего построенные маршруты.
  var multiRoutePromise = control.routePanel.getRouteAsync();
  multiRoutePromise.then(function(multiRoute) {
    //  Подписка на событие получения данных маршрута от сервера.
    multiRoute.model.events.add('requestsuccess', function() {
    var wayPoints = multiRoute.getWayPoints();
    //var pointe=[];
   wayPoints.each(function (point) {   
            point.options.set({
                preset: "islands#redStretchyIcon",
                iconContentLayout: ymaps.templateLayoutFactory.createClass('{{ properties.request|raw }}')
            }); 
            //pointe = point.properties._data.address; 
            console.log('addr: ',point.properties._data.address);
            console.log('hhh: ',point.properties._data);
            console.log('kkk: ',point.properties);
            console.log('yyy: ',point);
            console.log('cor: ', point.properties._data.coordinates);
            console.log('req: ', point.properties._data.request);
        });
      // Ссылка на активный маршрут.
      var activeRoute = multiRoute.getActiveRoute();
      if (activeRoute) {
        // Вывод информации об активном маршруте.
        console.log("Длина: " + activeRoute.properties.get("distance").text);
        console.log("Время прохождения: " + activeRoute.properties.get("duration").text);
        console.log("type: " + control.routePanel.state.get('type'));
                 var data=[[55.755753, 37.414912], [55.740867, 37.416619],
        [55.73653252833374, 37.424580296356176],
        [55.731272, 37.447198],[55.735986, 37.467078]];
     /////////
                   
                    $("<input hidden type='text' name = 'CoreInput[jsonb_8]' value='" + JSON.stringify(data) + "'>").appendTo('#locations');
                 //   $("<input  type='text' name = 'CoreInput[jsonb_9]' value='" + activeRoute.properties.get("duration").text + "'>").appendTo('#locations');
                  //  $("<input  type='text' name = 'CoreInput[jsonb_9]' value='" + control.routePanel.state.get('type') + "'>").appendTo('#locations');
                    
                    /*$("<input hidden type='text' name = '{name}["+ index + "][lat]' value=" + lat + ">").appendTo('#locations-{id}');
                    $("<input hidden type='text' name = '{name}["+ index + "][lng]' value=" + lng + ">").appendTo('#locations-{id}');  */
     /////////////
     
      }
    });
    multiRoute.options.set({
      // Цвет метки начальной точки.
      wayPointStartIconFillColor: "#B3B3B3",
      // Цвет метки конечной точки.
      wayPointFinishIconFillColor: "blue", 
      // Внешний вид линий (для всех маршрутов).
      routeStrokeColor: "00FF00"
    });  
  }, function (err) {
    console.log(err); 
  });
///////////////////

    // Зададим состояние панели для построения машрутов.
    control.routePanel.state.set({
        // Тип маршрутизации.
        type: '{masstransit}',  //masstransit
        // Выключим возможность задавать пункт отправления в поле ввода.
        fromEnabled: {fromEnabled}, //true,| false
        // Адрес или координаты пункта отправления.
        from: '{from}', //Москва, Льва Толстого 16
        // Включим возможность задавать пункт назначения в поле ввода.
        toEnabled: {toEnabled},//true, | false
        // Адрес или координаты пункта назначения.
        //to: 'Петербург'
    });

    // Зададим опции панели для построения машрутов.
    control.routePanel.options.set({
        // Запрещаем показ кнопки, позволяющей менять местами начальную и конечную точки маршрута.
        allowSwitch: {allowSwitch},  //true, | false
        // Включим определение адреса по координатам клика.
        // Адрес будет автоматически подставляться в поле ввода на панели, а также в подпись метки маршрута.
        reverseGeocoding: {reverseGeocoding},   //true, | false
        // Зададим виды маршрутизации, которые будут доступны пользователям для выбора.
        types: {types}
    });

    // Создаем кнопку, с помощью которой пользователи смогут менять местами начальную и конечную точки маршрута.
    var switchPointsButton = new ymaps.control.Button({
        data: {data},
        options: {options}
    });
    // Объявляем обработчик для кнопки.
    switchPointsButton.events.add('click', function () {
    
           
       
        // Меняет местами начальную и конечную точки маршрута.
        control.routePanel.switchPoints();
        
    });
    myMap.controls.add(switchPointsButton);
})


JS,


    ];

    public function asset()
    {
        //$this->fileJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=9c3673c0-e4ff-47fb-8214-9ccf58d21b25');
        $this->fileJs('https://api-maps.yandex.ru/2.1/?apikey=5fb7da25-bc18-4612-b304-83ea2266c510&lang=ru_RU');

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{routePanelControl}'=>$this->_config['controls'],
            '{zoom}'=>$this->_config['zoom'],
            '{masstransit}'=>$this->_config['type'],
            '{fromEnabled}'=>$this->_config['fromEnabled'],
            '{from}'=>$this->_config['from'],
            '{toEnabled}'=>$this->_config['toEnabled'],
            '{allowSwitch}'=>$this->_config['allowSwitch'],
            '{reverseGeocoding}'=>$this->_config['reverseGeocoding'],
            '{types}'=>$this->_config['types'],
            '{data}'=>$this->_config['data'],
            '{options}'=>$this->_config['options'],
        ]);

    }

}
