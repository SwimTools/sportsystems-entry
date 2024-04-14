<center><table>
<img src="img/swim.gif">
<?php
// Entry Viewer - Standard Version v1.12.5

//SwimTools Form Redirection Script

$full_event_string = '' ;
$entry = 0 ;
foreach ($_POST as $key => $value) {
	$userArray = explode(',', $value);
	$withdrawel_url = ($userArray[0]) ;
	$meetname = ($userArray[1]) ;
	$check_entry = substr($withdrawel_url,0,4);

//echo 'CHECK: = ' . $check_entry . '</br>' ;
if (strpos($check_entry, 'http') !== false) 
{} else
	{
	$entry = $entry + 1 ;
	$event_no = $key;
	$swimmer_name = ($userArray[0]) ;
	$swimmer_club = ($userArray[1]) ;
	$swimmer_yob = ($userArray[2]) ;
	$competitor_no = ($userArray[3]) ;
	$event_name = ($userArray[4]) ;
	
	$event_details = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name . '</br>' ;

	if ($entry == 1) { $ss_ev1 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 2) { $ss_ev2 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 3) { $ss_ev3 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 4) { $ss_ev4 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 5) { $ss_ev5 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 6) { $ss_ev6 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 7) { $ss_ev7 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 8) { $ss_ev8 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 9) { $ss_ev9 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 10) { $ss_ev10 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 11) { $ss_ev11 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 12) { $ss_ev12 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 13) { $ss_ev13 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 14) { $ss_ev14 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 15) { $ss_ev15 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;
	if ($entry == 16) { $ss_ev16 = 'Event: ' . $event_no . ' (C: ' . $competitor_no . ') - ' . $event_name ; } ;

	$full_event_string = $full_event_string . $event_details. '</br>' ;

	echo '<tr><td colspan="2">' . $event_details . '</td></tr>' ;

	//if ($entry = 1) { echo 'ONE'; }

	}

}
echo '<tr><td colspan="2"><hr><center></td></tr>' ;
echo '<tr><td align="right">Swimmer Name: = </td><td>' . $swimmer_name . '</td></tr>' ;
echo '<tr><td align="right">Swimmer Club: = </td><td>' . $swimmer_club . '</td></tr>' ;
echo '<tr><td align="right">Swimmer YOB: = </td><td>' . $swimmer_yob . '</td></tr>' ;
echo '<tr><td colspan="2"><hr><center></td></tr>' ;
echo '<tr><td align="right">Withdrawel URL: = </td><td>' . $withdrawel_url . '</td></tr>' ;
echo '<tr><td align="right">Meet Name: = </td><td>' . $meetname . '</td></tr>' ;
echo '<tr><td colspan="2"><hr><center></td></tr>' ;
echo '<tr><td colspan="2" align="center">SwimTools.uk<center></td></tr>' ;
echo '</table>' ;
$withdrawel_url_full = $withdrawel_url . '?swimmer=' . $swimmer_name . '&yob=' . $swimmer_yob . '&club=' . $swimmer_club . '&events=' . $full_event_string ;
$withdrawel_url_full = $withdrawel_url_full . '&ev1=' . $ss_ev1 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev2=' . $ss_ev2 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev3=' . $ss_ev3 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev4=' . $ss_ev4 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev5=' . $ss_ev5 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev6=' . $ss_ev6 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev7=' . $ss_ev7 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev8=' . $ss_ev8 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev9=' . $ss_ev9 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev10=' . $ss_ev10 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev11=' . $ss_ev11 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev12=' . $ss_ev12 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev13=' . $ss_ev13 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev14=' . $ss_ev14 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev15=' . $ss_ev15 ;
$withdrawel_url_full = $withdrawel_url_full . '&ev16=' . $ss_ev16 ;

$withdrawel_url_full = $withdrawel_url_full . '&meetname=' . $meetname ;

echo '<meta http-equiv="refresh" content="1; url=' . $withdrawel_url_full . '">' ;
?>
