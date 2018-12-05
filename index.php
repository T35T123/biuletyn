<?php 

	require_once("php/database/dbutils.php");

	$cinema = DbUtils::executeQuery('select title, date from cinema', [])->fetch_assoc();

  function convertTimestampToDate($timestamp){
	
		preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}/', $timestamp, $date);

		return $date[0];

	}

	function putDataInTemplate($template, $isContest){

		$result = DbUtils::executeQuery('select title, date, content from news where type="%s"',
			[$isContest ? "contest" : "statement"]);

		if(mysqli_fetch_array($result)->count > 1)
			$firstRow = $result->fetch_assoc();
		
		foreach($result as $r){

		  $r['date'] = convertTimestampToDate($r['date']);

			$r = array_map(function($v){
				return htmlentities($v, ENT_QUOTES, 'utf-8');
			}, $r);

			echo(strtr($template, $r));
		}

		if(!$isContest) echo(strtr($template, $firstRow));

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
     <span class='time-progress'></span>
     <div class='time-interval'>
	<span class='time-interval--begin'></span>
	<span class='time-interval--current_state'></span>
	<span class='time-interval--end'></span>
     </div>	
    </div>
    <div id="cinema">
    <h1>Wyjscie do kina</h1>
    <ul>
      <li><strong>Tytuł filmu: </strong><?php echo($cinema['title'])?></li>
      <li><strong>Data wyjścia: </strong><?php echo($cinema['date'])?></li>
    </ul>
		</div>
		<div id="info">
			<p>
				<strong>Author: </strong>
				<span>Wojciech Sadowski</span>
			</p>
			<p>
				<strong>Link do projektu: </strong>
				<span>github.com/wojtek2kdev/zst-info</span>
			</p>
			<p>Bug reporty / Bug fixy, Pull requesty oraz propozycje zmian mile widziane.</p>
		</div>
    <main>
      <div id="newses">
        <?php 

          $statementTemplate = '
            <article>
              <h1 class="news-header">title</h1>
              <div class="news">
                <strong>date</strong>
                <p>content</p>
              </div>
            </article>
					';

				putDataInTemplate($statementTemplate, false);

        ?>
      </div>
    </main> 
    <div id="contests">
      <div class='contests-title'><h1>Konkursy</h1></div>
      <div class="contests-slider">
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

				putDataInTemplate($contestTemplate, true);

      ?>
      </div>
    </div>
  </div>
  <script src="js/newses.js"></script>
  <script src="js/contests.js"></script>
  <script src="js/clock.js"></script>
  <script src="js/progress.js"></script>
</body>
</html>


