<?php 

include_once(__DIR__ . "./../index.php");

// indien geen zoekterm gepost is, stoppen...
if(!isset($_POST['zoekterm'])){
    die();
    };

//variabelen
$zoekterm = $_POST["zoekterm"];
$zoekin = $_POST["zoekin"];
$sorteer = $_POST["sorteerop"];

// checken op een leeg invoerveld
if(strlen($zoekterm)=="0"){
    echo '<p align="center"><strong>Er is niets ingevuld</strong></p>';
    die("");
    }

//connectie met databank
include_once(__DIR__ . "./../classes/Db.php");

//wordt alles gezocht dan:
if($sorteer=='alles'){

    $selectie="SELECT * FROM Interests WHERE ('sports' LIKE '%$zoekterm%') OR
                                              ('gaming' LIKE '%$zoekterm%') OR
                                              ('technology' LIKE '%$zoekterm%') OR
                                              ('food' LIKE '%$zoekterm%') OR
                                              ('fashion' LIKE '%$zoekterm%') OR
                                              ('animals' LIKE '%$zoekterm%') OR
                                              ('art' LIKE '%$zoekterm%') OR
                                              ('nature' LIKE '%$zoekterm%') OR
                                              ('travel' LIKE '%$zoekterm%') OR
                                              ('dancing' LIKE '%$zoekterm%') OR
                                              ('cosplay' LIKE '%$zoekterm%') OR
                                              ('photography' LIKE '%$zoekterm%') OR
                                              ('gadgets' LIKE '%$zoekterm%') OR
                                              ('cars' LIKE '%$zoekterm%') OR
                                              ('programming' LIKE '%$zoekterm%') OR
                                              ('singing' LIKE '%$zoekterm%') OR
                                              ('languages' LIKE '%$zoekterm%') OR
                                              ('parties' LIKE '%$zoekterm%') OR
                                              ('fitness' LIKE '%$zoekterm%') OR
                                              ('writing' LIKE '%$zoekterm%')
                                              ORDER BY $sorteer";
   
    
    }
// Wordt niet alles gezocht dan:
else {

    $selectie="SELECT * FROM Interests WHERE $zoekin LIKE '%$zoekterm%' ORDER BY $sorteer";
    echo("$selectie");
 
    }

?>
