<?php 

  require("vendor/autoload.php");

  use Symfony\Component\Yaml\Yaml;

  $cinema = Yaml::parseFile('data/kino.yml');

  function insertData($directory){

      $files = array_slice(scandir($directory), 2);

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

      foreach($files as $file){

        $data = Yaml::parseFile($directory.'/'.$file);

        echo(strtr($template, $data));

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
  <script src="weather.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet"> 
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

          insertData('data/komunikaty');

        ?>
      </div>
    </main> 
    <div id="contests">
      <h1>Konkursy</h1>
      <?php 
          insertData('data/konkursy');
      ?>
    </div>
  </div>
  <script>

    const slides = [...$('#newses>article')];
    const height = $('main').height();

    if($(slides[slides.length - 1]).height() < height) slides.pop();

    let jumps = [];

    slides.forEach(n => {

      const nodeHeight = $(n).height();

      if(nodeHeight < height) jumps.push(nodeHeight);

      else {

        const parts = Math.round(nodeHeight / height);

        for(let i=0; i<parts; i++){
          jumps.push(height);
        }

        jumps.push(nodeHeight - height*parts);

      }

    });

    let currentJump = 0;
    let offset = 0;

    $('#newses').on('transitionend', function(){

       if(currentJump == jumps.length){
         currentJump = -1;
         offset = 0;
         $(this).css('transform', `translate(0px, ${offset}px)`);
       }else{
         offset -= jumps[currentJump];
         $(this).css('transform', `translate(0px, ${offset}px)`);
       }

      ++currentJump;

    });

    $('#newses').css('transform', 'translate(0px, 0px)');


    console.log(jumps);

    setInterval(function(){

      const t = new Date(Date.now());

      const [hour, minute, second] = document.querySelectorAll('.time-hours,.time-minutes,.time-seconds');

      let h = t.getHours();
      let m = t.getMinutes();
      let s = t.getSeconds();

      hour.innerText = `${h < 10 ? '0' + h : h}`;
      minute.innerText = `${m < 10 ? '0' + m : m}`;
      second.innerText = `${s < 10 ? '0' + s : s}`;

    }, 1000);

  </script>
</body>
</html>


