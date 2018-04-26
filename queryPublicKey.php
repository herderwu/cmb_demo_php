<?php
/**
 * Created by PhpStorm.
 * User: 80374806
 * Date: 2016/7/29
 * Time: 14:40
 */

include("./netPay.php");
$netpay = new NetPay();

$parasArr = array(
    'version' => $_POST['version'],
    'charset' => $_POST['charset'],
    'sign' => $_POST['sign'],
    'signType' => $_POST['signType'],
    'reqData' => array(
        'dateTime' => $_POST['dateTime'],
        'branchNo' => $_POST['branchNo'],
        'merchantNo' => $_POST['merchantNo'],
        'txCode' => $_POST['txCode']
    )
);

//获取响应报文
$result = $netpay->doBusiness($parasArr, $_POST['charset']);
$resArr = json_decode($result, true);;
echo $result."<br><br>";

//解析Json报文
echo "<link href='./bootstrap-3.3.5-dist/css/bootstrap.min.css' rel='stylesheet' type='text/css' />";
echo "接口版本号：".$resArr['version']."<br>";
echo "参数编码：".$resArr['charset']."<br>";
echo "应答数据如下"."<br>";
echo "--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";

$rspData = $resArr['rspData'];
echo "处理结果：".$rspData['rspCode']."<br>";

if($rspData['rspCode']=="SUC0000"){
    echo "时间戳：".$rspData['dateTime']."<br>";
    echo "招行公钥：".$rspData['fbPubKey']."<br>";

//    print_r($title);
}else{
    echo "失败信息：" . $rspData["rspMsg"];
}
echo"<br><a href='./index.html' class='btn btn-link'>返回</a>";

// 2018-04-26
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDZs4l8Ez3F4MG0kF7RRSL+pn8MmxVE3nfdXzjx6d3rH8IfDbNvNRLS0X0b5iJnPyFO8sbbUo1Im4zX0M8XA0xnnviGyn5E6occiyUXJRgokphWb5BwaYdVhnLldctdimHoJTk3NFEQFav3guygR54i3tymrDc8lWtuG8EczVu8FwIDAQAB


// //公钥
// $pub_key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDZs4l8Ez3F4MG0kF7RRSL+pn8MmxVE3nfdXzjx6d3rH8IfDbNvNRLS0X0b5iJnPyFO8sbbUo1Im4zX0M8XA0xnnviGyn5E6occiyUXJRgokphWb5BwaYdVhnLldctdimHoJTk3NFEQFav3guygR54i3tymrDc8lWtuG8EczVu8FwIDAQAB';
// //待验证签名字符串
// $toSign_str = 'branchNo=0101&dateTime=20160701123456&httpMethod=POST&merchantNo=123456&noticeSerialNo=201607019876543210&noticeType=ABCDEFGH&noticeUrl=http://99.12.38.88:8086/RecvNotice/NoticeRcv.ashx&param1=111&param2=a中转周末b';
// //签名结果(strSign)
// $sig_dat = 'Pez08MLS6tnrPTnO2febDbHmZ1FNB8Rgy1dp82XwPXkWbP0XPFZAy0ElRomJnMGuGNEwz9hC61TUNhRYhb22ZEHhFMpMNZWFeiN1ewXwIT5Sx7VmE4InfklQnVub0dRr1d6zJ3gprMHBoiQBe8xAxpd1y+82Jm5z7IkvLtgWXU4=';
// //处理证书
// $pem = chunk_split($pub_key, 64, "\n");
// $pem = "-----BEGIN PUBLIC KEY-----\n" . $pem . "-----END PUBLIC KEY-----\n";
// $pkid = openssl_pkey_get_public($pem);
// if (empty($pkid)) {
//     die('获取 pkey 失败');
// }
// //验证
// $ok = openssl_verify($toSign_str, base64_decode($sig_dat), $pkid, OPENSSL_ALGO_SHA1);
// var_dump($ok);
// die();
