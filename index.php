<?php
$TextBgColor = '#F0FFF0'; //фоновый цвет текста
$BlightToday = 1; //подвсетка текущей даты
$TodayBgColor = '#ADD8E6';
$TodayTextColor = '#FF7F50'; //цвет текста текущей даты
$ColumnWidth = 22; //ширина ячейки (стольца)

//Функция СТОП для вывода даты
function GenSetStop ($month, $year) {
	if ($month=='12') {
		$month=1;
		$year++;
	}
	else $month++;
	$Stop = date("d", mktime(0,0,0, $month, 0, $year));
	return $Stop;
}

//функция, выводящая календарь
/**
 * @param $month
 * @param $year
 * @param $Stop
 * @param $ColumnWidth
 */
function GenCalendarMonth ($month, $year, $Stop, $ColumnWidth) {
	global $BlightToday, $TodayBgColor, $TodayTextColor;

	$month = (intval($month));

	if ($month == 12) {
		$PrevMonth = $month - 1;
		$PrevYear = $year;
		$NextMonth = 1;
		$NextYear = $year + 1;
	} else if ($month == 1) {
		$PrevMonth = 12;
		$PrevYear = $year - 1;
		$NextMonth = $month + 1;
		$NextYear = $year;
	} else {
		$PrevMonth = $month - 1;
		$PrevYear = $year;
		$NextMonth = $month + 1;
		$NextYear = $year;
	}
//создаем массив месяцев
	$MonthText['1'] = 'Январь';
	$MonthText['2'] = 'Февраль';
	$MonthText['3'] = 'Март';
	$MonthText['4'] = 'Апрель';
	$MonthText['5'] = 'Май';
	$MonthText['6'] = 'Июнь';
	$MonthText['7'] = 'Июль';
	$MonthText['8'] = 'Август';
	$MonthText['9'] = 'Сентябрь';
	$MonthText['10'] = 'Октябрь';
	$MonthText['11'] = 'Ноябрь';
	$MonthText['12'] = 'Декабрь';

	$string = '<tr>'.
	'<td colspan="7">'.$year.' год-'.$MonthText["$month"].'</td>'.
	'</tr>'.
	'<tr><td width="'.$ColumnWidth.'">Пн</td>'.
	'<td width="'.$ColumnWidth.'">Вт</td>'.
	'<td width="'.$ColumnWidth.'">Ср</td>'.
	'<td width="'.$ColumnWidth.'">Чт</td>'.
	'<td width="'.$ColumnWidth.'">Пт</td>'.
	'<td width="'.$ColumnWidth.'" style="color:#8B0000;">Сб</td>'.
	'<td width="'.$ColumnWidth.'" style="color:#8B0000;">Вс</td>'.

	'<tr>';

	$Start = date("w", mktime(0,0,0,$month,1,$year))-1;

	if ($Start == -1) $Start = 6;
	for ($i=0;$i<$Start;$i++) $string.='<td>&nbsp;</td>';

		$Frame = $Start -1;

	for ($i=1; $i<=$Stop; $i++) {
		$day = mktime(0,0,0,date("m"), $i, date("Y"));
		$Frame++;
		if ($Frame>6){
			$string.='</tr>';
			if ($i<=$Stop)$string.='<tr>';
			$Frame=0;
		}

		if ($month == date("m", $day) && $year == date("Y", $day) && date("d") == date("d", $day) && $BlightToday=1) {
			$string.='<td width='.$ColumnWidth.' style = "background:'.$TodayBgColor.';color:'.$TodayTextColor.';">'.$i.'</td>';
			continue;
		}
		if ($Frame == 5 || $Frame ==6) {
			$string.= '<td width='.$ColumnWidth.' style="color:#8B0000;">'.$i.'</td>';
		} else {
			$string.= '<td width='.$ColumnWidth.' style="color:#A9A9A9;">'.$i.'</td>';
		}
	}

	for ($i=1; $Frame < 6; $Frame++) $string.='<td>&nbsp;</td>';
		if ($Frame > 6) $string.='</tr>';
	return $string;
}
?>

<style type="text/css">
td{
	font-family: Tahoma;
	font-size: 15px;
	text-align: center;
	font-weight: bold;

}

</style>

<table cellpadding="0" cellspacing="0" border="0" align="center"
style="width: 300px; height: 300px;">

<?php
if (@!$month) {
	$month = date('m');
	$year = date('Y');
}
$DayNumber = GenSetStop ($month, $year);
print $MidHTML = GenCalendarMonth ($month, $year, $DayNumber, $ColumnWidth);




?>
</table>
</boby>

