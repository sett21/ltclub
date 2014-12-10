<?php

class Default_AviaController extends Zend_Controller_Action {

    public function indexAction() {
    }

    public function getcityAction() {
    	include(APPLICATION_PATH.'/configs/airportsData_ru.php');

    	$cityArr = array();
    	foreach ($destinations as $val)
    	{
    		$city = explode(';', $val);

			if (preg_match("/".$_POST['city']."/i", $city[1])) 
			    $cityArr[] = $city;
    	}

    	echo json_encode($cityArr);
    	
    	exit;
    }

}