<?php
// Headers
ob_start();
header("Cache-control: private, no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Pragma: no-cache");
header("Cache: no-cahce");
ini_set('max_execution_time', 90000);
ini_set("memory_limit", -1);

// Search parameters that comes inside the url
$page = $_REQUEST["page"];
$pagesize = $_REQUEST["pagesize"];
$query = $_REQUEST["query"];

// if we have all the neccesaries parameters
if ($page && $pagesize && $query) {
   // Cache the response
   include('top-cache.php'); 
   // API URL
   $url = 'https://api.stackexchange.com/2.3/search?page=' . $page . '&pagesize=' . $pagesize . '&intitle=' . $query . '&site=stackoverflow';

   // Using CURL to make the request to the API
   $curl = curl_init();
   curl_setopt_array(
      $curl,
      array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
            'Cookie: prov=b105113d-4ae4-438b-818f-bdb07d3b1ed9'
         ),
      )
   );
   $response = curl_exec($curl);
   curl_close($curl);

   // Converting the response to json object
   $response = json_decode($response);
   $response_arr = [];
   foreach ($response->items as $item) {

      // Json object for each item in the search
      $object = array(
         "title" => $item->title,
         "answer_count" => $item->answer_count,
         "username" => $item->owner->display_name,
         "profile_picture_url" => $item->owner->profile_image ?? ""
      );
      array_push($response_arr, $object);
   }
   

   echo json_encode($response_arr);

   // Cache the response
   include('bottom-cache.php');
} else {
   $response_arr = array(
      "status" => false,
      "message" => "We need more parameters in the url, valid are: page, pagesize and query."
   );
   echo json_encode($response_arr);
}