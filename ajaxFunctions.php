<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');			
defined('WEB_PATH') ? NULL : define('WEB_PATH', '/99aed.com/');

require("includes/db.php"); 

if ((isset($_GET['action'])) && ($_GET['action'] != "")){

	$ajaxFuncs = new ajaxFunctions;

	switch($_GET['action']){
		case "checkData" : return $ajaxFuncs->checkAnyRecordsAvailable(); break;
		case "grabInitialDeals" : return $ajaxFuncs->getInitialDeals(); break;
		case "grabDeal" : return $ajaxFuncs->getNextDeal(); break;
		case "grabDealPriceInfo" : return $ajaxFuncs->getNextDealPriceInfomation(); break;
		case "grabDealInfo" : return $ajaxFuncs->getNextDealInfomation(); break;
	}		
}

class ajaxFunctions{

	public static $instance;
	private $DbObject = NULL;
	private $userId;
	
	public function __construct() {}	
	
	static function getInstance() { if (self::$instance == NULL) return new self; }
	
	public function checkAnyRecordsAvailable(){

		$select = mysql_query("SELECT max(id) as topId from deals");
		$row = mysql_fetch_array($select);
		if (($_GET['current'] + 5) < $row['topId']){
			$available = 'yes';
		}else{
			$available = 'No';
		}
		echo json_encode(array('dataAvailablity' => $available, 'totalRecords' => $row['topId']));		
	}
	
	public function getInitialDeals(){
	
		/* This belongs to intial left column deals */
		$initialDealsHtml = "";
		$select = mysql_query("select id, market_price, deals_price, image from deals LIMIT 0, 5");
		while($row = mysql_fetch_array($select)){
$initialDealsHtml .= '<div id="'.$row["id"].'" class="featuredDeal"><span>instead of '.round($row["market_price"]).' pay</span><span>'.round($row["deals_price"]).'</span><span>aed</span><img class="smallDealImg" src="public/images/price_label.png"><img src="'.WEB_PATH.$row["image"].'" width="160" height="92" /></div>';		
		}
		/* This belongs to the middle image details */
		$select = mysql_query("select MIN(id) AS firstId from deals");
		$fetch = mysql_fetch_array($select);
		$select = mysql_query("select notice, detail, summary, market_price, deals_price, image from deals where id = " . $fetch["firstId"]);
		$fetch = mysql_fetch_array($select);
		$initalMainImageDetails .= "<div><span>".$fetch['summary']."</span><img width='450' height='322' src='".WEB_PATH.$fetch['image']."' /></div>";
		/* This belongs to the right panel details */
		$briefIntro = $fetch["summary"];
		$dealImage = $fetch["image"];
		$finePrint = $fetch["notice"];
		$benefitsDetails = $fetch["detail"];
		$marketPrice = $fetch["market_price"];
		$marketValue = explode(".",$marketPrice);
		$marketWholeValue = $marketValue[0];
		$marketCentValue = $marketValue[1];
		$sellingPrice = $fetch["deals_price"];
		$sellingValue = explode(".",$sellingPrice);
		$sellingWholeValue = $sellingValue[0];
		$sellingCentValue = $sellingValue[1];
		$saveWholePrice = $marketWholeValue- $sellingWholeValue;
		$saveCentPrice = $marketCentValue - $sellingCentValue;
		
$priceDetailsHtml .= "<div class='priceDetailNodes'><div><span>99aed.com</span><span>Everything is under 99AED</span></div><div><span>PREORDER NOW</span><span>only </span><span>".$sellingWholeValue."</span><div><span> .".$sellingCentValue." </span><span>AED</span></div></div><div><span>You save</span><span>".$saveWholePrice."</span><div><span> .".$saveCentPrice."</span><span>AED</span></div></div><div><span>Original Price</span><span>".$marketWholeValue."</span><div><span> .".$marketCentValue."</span><span>AED</span></div></div><div><span>DISCOUNT</span><span>-".$result["discount"]."%</span><div><span>Thank you for buying</span></div></div></div></div>";
		
		echo json_encode(
				array(
					'initialDealsHtml' => $initialDealsHtml, 
					'initalMainImageDetails' => $initalMainImageDetails,
					'priceDetailsHtml' => $priceDetailsHtml,
					'otherDetails' => array('finePrint' => $finePrint, 'benefits' => $benefitsDetails)
					)
				);
	}
    	
	public function getNextDeal(){
	
	    $selectdeals = mysql_query("select * from deals") or die ("select * from deals".mysql_error());
		$select = mysql_query("select * from deals LIMIT ".($_GET['next'] + $_GET['initial']).",1");
		$fetch = mysql_fetch_array($select);
		echo '<div id="'.$fetch["id"].'" class="featuredDeal"><span>instead of '.round($fetch["market_price"]).' pay</span><span>'.round($fetch["deals_price"]).'</span><span>aed</span><img class="smallDealImg" src="public/images/price_label.png"><img src="http://localhost/99aed.com/'.$fetch['image'].'" width="160" height="92" /></div>';		
	}
	
	public function getNextDealInfomation(){
		
		$deal_id = $_GET["dealId"];
		$selectQuery = mysql_query("select * from deals LIMIT ".($_GET['next'] + $_GET['initial']).",1");
		$result = mysql_fetch_array($selectQuery);
		$briefIntro = $result["summary"];
		$dealImage = $result["image"];
		$finePrint = $result["notice"];
		$benefitsDetails = $result["detail"];
		$marketPrice = $result["market_price"];
		$marketValue = explode(".",$marketPrice);
		$marketWholeValue = $marketValue[0];
		$marketCentValue = $marketValue[1];
		$sellingPrice = $result["deals_price"];
		$sellingValue = explode(".",$sellingPrice);
		$sellingWholeValue = $sellingValue[0];
		$sellingCentValue = $sellingValue[1];
		$saveWholePrice = $marketWholeValue- $sellingWholeValue;
		$saveCentPrice = $marketCentValue - $sellingCentValue;
		
		$dealMainImageDetails .= "<div><span>".$briefIntro."</span><img width='450' height='322' src='http://localhost/99aed.com/".$dealImage."' /></div>";
		
$priceDetailsHtml .= "<div class='priceDetailNodes'><div><span>99aed.com</span><span>Everything is under 99AED</span></div><div><span>PREORDER NOW</span><span>only </span><span>".$sellingWholeValue."</span><div><span> .".$sellingCentValue." </span><span>AED</span></div></div><div><span>You save</span><span>".$saveWholePrice."</span><div><span> .".$saveCentPrice."</span><span>AED</span></div></div><div><span>Original Price</span><span>".$marketWholeValue."</span><div><span> .".$marketCentValue."</span><span>AED</span></div></div><div><span>DISCOUNT</span><span>-".$result["discount"]."%</span><div><span>Thank you for buying</span></div></div></div></div>";

		echo json_encode(
			array(
					'dealMainImageDetails' => $dealMainImageDetails, 
					'priceDetailsHtml' => $priceDetailsHtml, 
					'otherDetails' => array(
											'finePrint' => $finePrint, 
											'benefits' => $benefitsDetails
											)
				)
			);
	}
	
	public function getNextDealPriceInfomation(){
	
	    $selectdeals = mysql_query("select * from deals") or die ("select * from deals".mysql_error());
		$priceDetailsHtml .= "<div class='priceDetailNodes'><div><span>99aed.com</span><span>Everything is under 99AED</span></div><div><span>PREORDER NOW</span><span>only </span><span>".$sellingWholeValue."</span><div><span> .".$sellingCentValue." </span><span>AED</span></div></div><div><span>You save</span><span>".$saveWholePrice."</span><div><span> .".$saveCentPrice."</span><span>AED</span></div></div><div><span>Original Price</span><span>".$marketWholeValue."</span><div><span> .".$marketCentValue."</span><span>AED</span></div></div><div><span>DISCOUNT</span><span>-".$result["discount"]."%</span><div><span>Thank you for buying</span></div></div></div></div>";
		echo $priceDetailsHtml;
	}
}