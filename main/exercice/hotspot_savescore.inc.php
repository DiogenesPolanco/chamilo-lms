<?php
/* For licensing terms, see /license.txt */

/**
*	This file saves every click in the hotspot tool into track_e_hotspots
*	@package chamilo.exercise
* 	@author Toon Keppens
* 	@version $Id: admin.php 10680 2007-01-11 21:26:23Z pcool $
*/
require_once '../inc/global.inc.php';
$courseCode   = $_GET['coursecode'];
$questionId   = $_GET['questionId'];
$coordinates  = $_GET['coord'];
$objExcercise = $_SESSION['objExercise'];
$exerciseId   = $objExcercise->selectId();
// Save clicking order
$answerOrderId = count($_SESSION['exerciseResult'][$questionId]['ids'])+1;
if ($_GET['answerId'] == "0") // click is NOT on a hotspot
{
	$hit = 0;
	$answerId = NULL;
}
else // user clicked ON a hotspot
{
	$hit = 1;
	$answerId = api_substr($_GET['answerId'],22,2);
	// Save into session
	$_SESSION['exerciseResult'][$questionId][$answerId] = $hit;
}
//round-up the coordinates
$coords = explode('/',$coordinates);
$coordinates = '';
foreach ($coords as $coord) {
    list($x,$y) = explode(';',$coord);
    $coordinates .= round($x).';'.round($y).'/';
}
$coordinates = substr($coordinates,0,-1);

$TBL_TRACK_E_HOTSPOT = Database::get_main_table(TABLE_STATISTIC_TRACK_E_HOTSPOT);
// Save into db
$sql = "INSERT INTO $TBL_TRACK_E_HOTSPOT (user_id , course_id , quiz_id , question_id , answer_id , correct , coordinate ) VALUES (
			".intval($_user['user_id']).",
			'".Database::escape_string($courseCode)."',
			".intval($exerciseId).",
			".intval($questionId).",
			".intval($answerId).",
			".intval($hit)."',
			'".Database::escape_string($coordinates)."')";
$result = Database::query($sql);
// Save insert id into session if users changes answer.
$insert_id = Database::insert_id();
$_SESSION['exerciseResult'][$questionId]['ids'][$answerOrderId] = $insert_id;
