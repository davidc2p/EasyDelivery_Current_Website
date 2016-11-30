<?php
require_once('class/GeoAlgorithm.class.php');
$Geo = new GeoAlgorithm();

// include db connect class
require_once 'db/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// generic functions
require dirname(__FILE__).'/class/generic.class.php';
// model functions
require dirname(__FILE__).'/class/model.class.php';
$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ls_');

$model->email = 'dadomingues@gmail.com';

//getting base reference
$model->amenity = 'base';
$base = array();
$base = $model->getPointfromAmenity();
print_r($base);

//getting cafe reference
$model->amenity = 'cafe';
$cafes = array();
$cafes = $model->getPointfromAmenity();
print_r($cafes);
print '<br>';

$cafedist = array();

foreach ($cafes as $cafe) {
	array_push($cafedist, array("point_name"=>$cafe['point_name'], "point_lat"=>$cafe['point_lat'], "point_long"=>$cafe['point_long'], "point_distance"=>$Geo->HaversineInKM($base[0]['point_lat'], $base[0]['point_long'], $cafe['point_lat'], $cafe['point_long'])));
	//print 'Distance from Base to '.$cafe['point_name'].': '.$Geo->HaversineInKM($base[0]['point_lat'], $base[0]['point_long'], $cafe['point_lat'], $cafe['point_long']).'<br>';
}
/*
usort($cafedist, function($a, $b) {
    return $a['point_distance'] - $b['point_distance'];
});
*/
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


array_sort_by_column($cafedist, 'point_distance');

foreach ($cafedist as $cafe) {
	print 'Distance from Base to '.$cafe['point_name'].': '.$cafe['point_distance'].'<br>';
}


?>