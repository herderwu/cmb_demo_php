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
        'txCode' => $_POST['txCode'],
        'merchantSerialNo' => $_POST['merchantSerialNo'],
        'agrNo' => $_POST['agrNo']
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
    echo "商户流水号：".$rspData['merchantSerialNo']."<br>";
    echo "银行流水号：".$rspData['bankSerialNo']."<br>";


//    print_r($title);
}else{
    echo "失败信息：" . $rspData["rspMsg"];
}
echo"<br><a href='./index.html' class='btn btn-link'>返回</a>";
