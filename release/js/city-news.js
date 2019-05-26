var userCity = null;
var rssUrl = null;

function detectAddressByIp(ip) {
  var token = "7196103ebea65111fa5bb31b98202a905599b574";
  var serviceUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address";
  if (ip) {
    serviceUrl += "?ip=" + ip;
  }
  var params = {
    type: "GET",
    contentType: "application/json",
    headers: {
      "Authorization": "Token " + token
    }
  };
  return $.ajax(serviceUrl, params);
}

function detect() {
  var ip = $("#ip").val();
  detectAddressByIp(ip).done(function(response) {
      var jsonString = JSON.stringify(response, null, 4);
      var user = JSON.parse(jsonString);
      userCity = user.location.data.region_with_type;

      switch (userCity) {
        case 'Московская обл':
          rssUrl = 'https://news.yandex.ru/Moscow_and_Moscow_Oblast/index.rss';
          break;
        case 'Москва':
          rssUrl = 'https://news.yandex.ru/Moscow/index.rss';
          break;
        default:
          rssUrl = 'https://news.yandex.ru/Russia/index.rss';
      }

      function displayNews (rssUrl) {
        $.ajax({
          url: 'modules/stuff/city_news.php',
          data: {
            "url": rssUrl
          },
          success: function(data) {
            $('#spinner').hide('medium');
            $('#test ul').html(data);

            // Скрываем лишние новости
            var elementList = document.querySelectorAll('#test li');

            for (var i = 5; i < elementList.length; i++) {
              $(elementList[i]).hide();
            }

          }
        });
      }

      displayNews(rssUrl);

      console.log(userCity);

      $('#city').text(userCity);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
      console.log(errorThrown);
    });
}

$("#ip").on("change", detect);

detect();
