<?php 

  require("vendor/autoload.php");

  use Symfony\Component\Yaml\Yaml;

  $cinema = Yaml::parseFile('data/kino.yml');

  function insertData($directory, $template, $isVerticalSlide){

      $files = array_slice(scandir($directory), 2);

      foreach($files as $file){

        $data = Yaml::parseFile($directory.'/'.$file);

        echo(strtr($template, $data));

      }

      if($isVerticalSlide){

        $firstArticle = Yaml::parseFile($directory.'/'.$files[0]);

        echo(strtr($template, $firstArticle));

      }

  }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="js/weather.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="styles/style.css">
  <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet"> 
  <link rel="stylesheet" href="styles/weather.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">   
  <title></title>
</head>
<body>
  <div id="app">
    <div id="weather">
      <h1>Pogoda</h1>
      <img src="" id="weather_icon">
      <ul>
        <li>Temperatura: <span class="weather_info" id="temperature"></span></li>
        <li>Wilgotność: <span class="weather_info" id="humidity"></span>%</li>
        <li>Ciśnienie: <span class="weather_info" id="pressure"></span> hPa</li>
      </ul>
    </div>
    <div id="time-container">
      <div id="time">
        <span class="time time-hours"></span><span>:</span><!--
        --><span class="time time-minutes"></span><span>:</span><!--
        --><span class="time time-seconds"></span>
      </div>
    </div>
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

          $newsTemplate = "
            <article>
              <h1 class='news-header'>title</h1>
              <div class='news'>
                <strong>date</strong>
                <p>content</p>
              </div>
            </article>
          ";

          insertData('data/komunikaty', $newsTemplate, true);

        ?>
      </div>
    </main> 
    <div id="contests">
      <h1>Konkursy</h1>
      <?php 

        $contestTemplate = "
          <article>
            <h1 class='news-header'>title</h1>
            <div class='news'>
              <strong>date</strong>
              <p>content</p>
            </div>
          </article>
        ";

        insertData('data/konkursy', $contestTemplate);


      ?>

    </div>
  </div>
  <script src="js/newses.js"></script>
  <script src="js/clock.js"></script>
</body>
</html>


