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
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">   
  <title></title>
</head>
<body>
  <div id="app">
    <div id="weather">
      <h1>Pogoda</h1>
      <img src="" alt="weather_icon" id="weather_icon">
      <span id="temperature"></span>
    </div>
    <div id="number"></div>
    <div id="cinema">
    <h1>Wyjscie do kina</h1>
    <ul>
      <li><strong>Tytul filmu: </strong><?php echo($cinema['title'])?></li>
      <li><strong>Data wyjscia: </strong><?php echo($cinema['date'])?></li>
    </ul>
    </div>
    <main>
      <div id="newses"></div>
    </main> 
    <div id="contests"></div>
  </div>
</body>
</html>


