<div id="leftbar">

<?php

//Zeitzone
date_default_timezone_set('Europe/Berlin');

//Monatswechselpfeile
if (isset($_GET['ym'])){
	$ym = $_GET['ym'];
}

else{
	$ym = date('Y-m');
}

//Format prüfen
$timestamp = strtotime($ym, "-01");
if ($timestamp == false){
	$timestamp = time();
}

//Heute
$today = date('Y-m-j', time());

//Monat und Jahr Überschrift
$html_title = date('m | Y', $timestamp);

//Vor und Zurück
$prev = date('Y-m', mktime(0,0,0,date('m', $timestamp)-1,1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0,0,0,date('m', $timestamp)+1,1, date('Y', $timestamp)));

//Tage im Monat
$day_count = date('t', $timestamp);

//Wochenablauf
$str = date('w', mktime(0,0,0,date('m', $timestamp),0, date('Y', $timestamp)));

//Kalender erstellen
$weeks = array();
$week = '';

//Leere Zelle einfügen
$week .= str_repeat('<td></td>', $str);

	for($day = 1; $day <= $day_count; $day++, $str++){
		$date = $ym. '-' .$day;
		
		if($today == $date){
			$week .= '<td class="today">'.$day;
		}
		else{
			$week .= '<td>'.$day;
		}
		
		$week .= '</td>';
		
		//Ende der Woche / des Monats
		if($str % 7 == 6 || $day == $day_count){
			
			if($day == $day_count){
				$week .= str_repeat('<td></td>', 6 - ($str % 7));
			}
			
			$weeks[] = '<tr>' .$week. '</tr>';
			
			//Neue Woche vorbereiten
			$week = '';
		}
	}


?>

	<h3>
		<a href="?ym=<?php echo $prev; ?>">&#10094;</a>
		<?php echo $html_title; ?>
		<a href="?ym=<?php echo $next; ?>">&#10095;</a>
	</h3>
	
	<center>
	<table class="caltable">
		<tr>
			<th>Mo</th>
			<th>Di</th>
			<th>Mi</th>
			<th>Do</th>
			<th>Fr</th>
			<th>Sa</th>
			<th>So</th>
		</tr>
		
		<?php
			foreach($weeks as $week){
				echo $week;
			}
		?>		
	</table>
	</center>
</div>