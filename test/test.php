<?php
require '../vendor/autoload.php';
use WorkWeChat\Contracts\BasicWorkWeChat;
use WorkWeChat\Contracts\Cache;
use WorkWeChat\User;
use WorkWeChat\Department;
use WorkWeChat\Tag;
use WorkWeChat\Batch;
use WorkWeChat\Externalcontact;
use WorkWeChat\Agent;

$config = [
    "corpid" => 'wwd0cd421b22c19613',
    "corpsecret" => 'qliwrLTKM6vXoyzPSqYH3ErDiv4tc8k2NSK7FaFI4gQ'
];

$obj = new Agent($config);

$d = '{
   "name": "广州研发中心",
   "name_en": "RDGZ",
   "parentid": 1,
   "order": 1,
   "id": 55
}';
$d = $obj->add_contact_way($d);
//$obj = (new BasicQyWeChat($config))->getAccessToken();
var_dump($d);exit;

//$cache = new Cache();
//$d = $cache->set("aaaa",1,2);
//$c = $cache->get("aaaa");
//var_dump($c);exit;