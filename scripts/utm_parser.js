//Парсим ссылку на наличие UTM данных
function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var utm_list = ['utm_source', 'utm_keyword', 'utm_campaign', 'utm_medium', 'utm_term', 'utm_content', 'type', 'source', 'added', 'block', 'position', 'keyword', 'ad', 'region', 'roistat', 'roistat_referrer', 'roistat_pos', 'cm_id'];
var utms = {};

//Получаем UTM
utm_list.forEach(
  function(value, key) {
    utm = getParameterByName(value);
    if (utm.length > 0) {
      utms[value] = utm;
    }
  }
);

//Сравниваем новые UTM данные с сохранёнными, если есть новые то чистим Storage
for (var key in utms) {
  var value = utms[key];
  saved_utm = sessionStorage.getItem(key);
  if (saved_utm != value) {
   // console.log('Новый запрос, чистим UTM');
    utm_list.forEach(
      function(value, key) {
        sessionStorage.removeItem(value);
      }
    );
    break;
  }
}

//Сохраняем UTM данные в storage
for (var key in utms) {
  sessionStorage.setItem(key, utms[key]);
  // console.log('Сохраняем UTM ' + key, utms[key]);
}

//Загружаем UTM данные из storage
utm_list.forEach(
  function(value, key) {
    saved_utm = sessionStorage.getItem(value);
    if (saved_utm && saved_utm.length > 0) {
      utms[value] = saved_utm;
      // console.log('Загрузили UTM ' + value, utms[value]);
    }
  }
);

//Добавляем скрытые инпуты с UTM данными к формам
function add_utm_inputs(form) {
  for (var key in utms) {
    var value = utms[key];
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = value;
    form.appendChild(input);
  }
	var input = document.createElement('input');
	input.type = 'hidden';
    input.name = 'yuid'; 
	input.value = localStorage.getItem("_ym_uid").slice(1).slice(0,-1);
    form.appendChild(input);

	var input = document.createElement('input');
	input.type = 'hidden';
    input.name = 'clientId'; 
	input.value = ga.getAll()[0].get('clientId');;
    form.appendChild(input);
}


document.addEventListener('submit', function(e) {
  add_utm_inputs(e.target);
})


