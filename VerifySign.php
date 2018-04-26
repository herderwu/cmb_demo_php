<?php

// 使用招行公钥验签

include("./netPay.php");
$netpay = new NetPay();

//公钥
$pub_key = '***';

//处理证书
$pem = chunk_split($pub_key, 64, "\n");
$pem = "-----BEGIN PUBLIC KEY-----\n" . $pem . "-----END PUBLIC KEY-----\n";
$pkid = openssl_pkey_get_public($pem);
if (empty($pkid)) {
    die('获取 pkey 失败');
}

//待验证签名字符串
// $toSign_str = '*=*&*=*';

// 结果通知报文
$returnData = [
  'jsonrequestdata' => '{"*":"","*":{"":""},"*":"*","*":"*","*":"*"}',
];

$jsonrequestdata = json_decode($returnData['jsonrequestdata'], true);
$jsonArr = $jsonrequestdata['noticeData'];
$toSign_str = $netpay->signForCmbCheck($jsonArr);

//签名结果(strSign)
// $sig_dat = '***';
$sig_dat = $jsonrequestdata['sign'];

var_dump($toSign_str, $sig_dat);

//验证
$ok = openssl_verify($toSign_str, base64_decode($sig_dat), $pkid, OPENSSL_ALGO_SHA1);
var_dump($ok);
die();
