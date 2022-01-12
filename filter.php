<?php

$data = file_get_contents('data.json');

$json = json_decode($data);

foreach ($json->data->response->billdetails as $value) {
    $str = explode(":",$value->body[0]);
        if($str[1] >= 100000){
            $arr[] = $str[1];
        }
}

print_r($arr);
