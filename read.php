<?php
// Begin the SQL connection
$con = SQL_Begin("HOST", "USER", "PASSWORD", "DATABASE_NAME");
SQL_End($con);

require_once("/home/whocare2/public_html/art/resources/kits/serverKit.php");
require_once("/home/whocare2/public_html/art/resources/kits/webKit.php");
require_once("/home/whocare2/public_html/art/resources/modules/comicBook.php");

$series = "resonance";
$issue = $_GET["issue"];

$checkIssue = mysqli_real_escape_string($con, $series."_".$issue);
$results = mysqli_query($con, "SELECT * FROM comicWriter_Comics WHERE ID='$checkIssue'");
if($results->num_rows == 0) { exit("<p>No comic exists '.$checkIssue.'</p>"); }
$comic = $results->fetch_assoc();
$max = $comic["Pages"];
$min = 0;
$value = 1;
if (isset($_GET["value"])){
if ($_GET["value"] == "cover")
$value = 0;
else if ($_GET["value"] == "end")
$value = $max + 1;
else if ($_GET["value"] >= 0 && $_GET["value"] <= $max)
$value = intval($_GET["value"]);}
if ($value >= 0)
$nValue = $value + 1;
else
$nValue = $max;
if ($value <= $max)
$pValue = $value - 1;
else
$pValue = $max;
if ($pValue < $min)
$pValue = $min;
if ($nValue > $max)
$nValue = $max;
if ($_GET["value"] == "cover" || $_GET["value"] == "end")
$value = $_GET["value"];
CreateComicNavigation("http://art.whocaresarts.com/comics/$series/read/$issue", "cover");
DIV_Begin(array("class"=>"row"));
$img_value = hash("md5", $series."_".$issue."_".$value);
if($value == 0)
$img_value = "cover";
$src = "http://artisan.whocaresarts.com/cw/placeholder.gif";
if (file_exists("/home/whocare2/public_html/img/comics/$series/$issue/$img_value.png"))
$src = "http://img.whocaresarts.com/comics/$series/$issue/$img_value.png";
else if (file_exists("/home/whocare2/public_html/img/comics/$series/$issue/$img_value.gif"))
$src = "http://img.whocaresarts.com/comics/$series/$issue/$img_value.gif";
else if (file_exists("/home/whocare2/public_html/img/comics/$series/$issue/$img_value.jpg"))
$src = "http://img.whocaresarts.com/comics/$series/$issue/$img_value.jpg";
else if (file_exists("/home/whocare2/public_html/img/comics/$series/$issue/$img_value.jpeg"))
$src = "http://img.whocaresarts.com/comics/$series/$issue/$img_value.jpeg";
DIV_Begin(array("class"=>"col-lg-4 col-lg-offset-4", "id"=>"comic"), 'alt="Nothing here?"');
IMG_Begin(array("style"=>"width:100%", "src"=>$src), 'alt="Nothing here?"');
IMG_End();
DIV_End();
DIV_End();
CreateComicNavigation("http://art.whocaresarts.com/comics/$series/read/$issue", "cover");
