<?php
/**
 * @var array $points
 * @var string $domain_city_name
 */

$geo_maps = '<script type="text/javascript"> 

        function loadScript(url, callback){
          var script = document.createElement("script");
         
          if (script.readyState){  // IE
            script.onreadystatechange = function(){
              if (script.readyState == "loaded" ||
                      script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
              }
            };
          } else {  // Другие браузеры
            script.onload = function(){
              callback();
            };
          }
         
          script.src = url;
          document.getElementsByTagName("head")[0].appendChild(script);
        }


        var res;
        var col;
        var mmap;
        
       
        var map;
        
        setTimeout(function(){ 
              loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=8d4f6e9a-7df0-4f00-85d8-1f86a1675271", function(){
              ymaps.load(init);
        });   
            
        },4000);
        
      
        
        function init(){
        
            ymaps.ready(function(){
                myGeocoder = ymaps.geocode("' . strip_tags(html_entity_decode($domain_city_name)) . '");
                myGeocoder.then( function (res) {
                    var coords = res.geoObjects.get(0).geometry.getCoordinates();
                    
                    myPlacemark = new ymaps.Placemark(coords, {
                        hintContent: "Почтовое отделение"
                    });
                                          
                    map = new ymaps.Map ("map", {
                        center: coords,
                        zoom: 14
                    });
                    
                    addPoints();
                    
                });
            });
        }
        
        function addPoints() {
        var geoObjectsCollection = new ymaps.GeoObjectCollection();
        ';

$addresses = '';

if (count($points) > 4) {
    $addresses .= "<p class='priority-points'>Популярные пункты выдачи в {city_gde}:</p>";
}

$addresses .= '<div class="geo-map-info">';

$i = 0;

foreach ($points as $key => $point) {

    $i++;
    $address = '{region_ip} ' . $point['name'] . " " . $point['street_type'] . " " . $point['street'] . " " . $point['number_house'];

    $geo_maps .= '  
                ymaps.ready(function(){
                    myGeocoder = ymaps.geocode("' . strip_tags(html_entity_decode($address)) . '");
                    myGeocoder.then(
                    function (res) {
                        var coords = res.geoObjects.get(0).geometry.getCoordinates();
                        myPlacemark = new ymaps.Placemark(coords, {
                                        hintContent: "' . strip_tags(html_entity_decode($address)) . '"
                                     });
                        geoObjectsCollection.add(myPlacemark);
                    });
                });
            ';
    if ($i <= 4) {
        $addresses .= '<div class="delivery-point-address"><p><span>Адрес: </span>' . html_entity_decode($address) . '</p>
                    <p><span>Время работы: </span>' . html_entity_decode($point['work_regime']) . '</p></div>';
    }
}

$addresses .= '</div>';

$geo_maps .= '

            map.setBounds(map.getBounds(), {checkZoomRange:true})
            col = geoObjectsCollection;
            mmap = map;
            map.geoObjects.add(geoObjectsCollection);
            setTimeout(\'mmap.setBounds(col.getBounds(), {checkZoomRange:true})\', 2000);
            }
           
            
            </script> 
            <div id="map"></div>' . $addresses;
$geo_maps .= '';
echo $geo_maps;