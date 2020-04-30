<?php 
$arr1 = array("Mobile","shop","software","hardware");
$arr2 = array("shop","Mobile","software");

// Get values from arr2 which exist in arr1
$overlap = array_intersect($arr2, $arr1);

// Count how many times each value exists
$length = count($overlap);
echo $length;


?>