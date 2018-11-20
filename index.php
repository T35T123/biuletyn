<?php 

  require("vendor/autoload.php");

  use Symfony\Component\Yaml\Yaml;

  $cinema = Yaml::parseFile('data/kino.yml');

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="weather.js"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="weather.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">   
  <title></title>
</head>
<body>
  <div id="app">
    <div id="weather">
      <h1>Pogoda</h1>
      <img src="" alt="weather_icon" id="weather_icon">
      <ul>
        <li>Temperatura: <span class="weather_info" id="temperature"></span></li>
        <li>Wilgotność: <span class="weather_info" id="humidity"></span>%</li>
        <li>Ciśnienie: <span class="weather_info" id="pressure"></span> hPa</li>
      </ul>
    </div>
    <div id="number"></div>
    <div id="cinema">
    <h1>Wyjscie do kina</h1>
    <ul>
      <li><strong>Tytuł filmu: </strong><?php echo($cinema['title'])?></li>
      <li><strong>Data wyjścia: </strong><?php echo($cinema['date'])?></li>
    </ul>
    </div>
    <main>
      <div id="newses">
        <?php 

            $files = array_slice(scandir('data/komunikaty'), 2);

            foreach($files as $file){

              $data = Yaml::parseFile('data/komunikaty/'.$file);


              $template = 
              "
                <article>
                  <h1 class='news-header'>title</h1>
                  <div class='news'>
                    <strong>date</strong>
                    <p>content</p>
                  </div>
                </article>
              ";

              echo(strtr($template, $data));

            }

        ?>
      </div>
    </main> 
    <div id="contests">
      <h1>Konkursy</h1>
    </div>
  </div>
</body>
</html>


