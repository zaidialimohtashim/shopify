<?php

function getImageFromRoute($url){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}

if (! function_exists('makeSlug')) {

  function makeSlug($model,$slug){
    $slug = str_replace(" ","-",strtolower($slug));
    $slugCount =  $model::where("slug","LIKE",$slug."%")->count();
    if($slugCount > 0){
      $slug = $slug.$slugCount;
    }
    return $slug;
  }
}