<?php

include("./DES.php");

// 商户秘钥
$merKey = '***';
//先补8个0，再截取前8位
$merKey .= "00000000";
$des = new DES(substr($merKey, 0, 8));
$result = $des->encrypt('000201');
var_dump($result);
