<head>
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://fastly.jsdelivr.net/gh/jquery/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://fastly.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
    <meta charset="utf-8">
    <title>SKY·UPay</title>
    <style>
        .container {
            width: 60%;
            margin: 10% auto 0;
            background-color: #f0f0f01f;
            padding: 5% 5%;
            border-radius: 10px
        }

        ul {
            padding-left: 10px;
        }

            ul li {
                line-height: 2.3
            }

        a {
            color: #20a53a
        }
    </style>
<body>
     <script type="text/javascript" color="0,255,0" opacity='0.7' zIndex="-2" count="200" src="https://fastly.jsdelivr.net/gh/awerailgun/filescdn@main/JS/bjtx.js"></script>
    <div class="container" id="landlord">
    <div class="message" style="opacity:0" style="float:right"></div>
<?php
function curl_request($url, $data=null, $method='psot', $header = array("content-type: application/json"), $https=true, $timeout = 5){
        $method = strtoupper($method);
        $ch = curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);//访问的URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//只获取页面内容，但不输出
        if($https){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//https请求 不验证证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//https请求 不验证HOST
        }
        if ($method != "GET") {
            if($method == 'POST'){
                curl_setopt($ch, CURLOPT_POST, true);//请求方式为post请求
            }
            if ($method == 'PUT' || strtoupper($method) == 'DELETE') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//请求数据
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //模拟的header头
        //curl_setopt($ch, CURLOPT_HEADER, false);//设置不需要头信息
        $result = curl_exec($ch);//执行请求
        curl_close($ch);//关闭curl，释放资源
        return $result;
    }
function token($length){
 $str = md5(time());
 $token = substr($str,15,$length);
 return $token;
}//随机数生成函数
//echo token(10);//测试随机数生成功能
$amount = (double)0;
$getdata = (double)$_GET["n"];
if ($getdata > 0) //判断有没有N参数，没有则检查post数据
{$amount = $getdata;//从URL参数中的n=*获取amount数据
}
else
{$postdata0 =$_POST;
$postdata1 =json_encode(array('postdata' => $postdata0 ));//生成数据包，用到了的数组转json的jsonencode
$postdata2 =json_decode($postdata1, true);//解析数据
$postdata3 =$postdata2['postdata'];
$postdata4 =$postdata3['postdata'];
//print($postdata1);
//echo '<br/>换行符<br/>'; 
//print($postdata2);
//echo '<br/>换行符<br/>'; 
//print($postdata3);
//echo '<br/>换行符<br/>'; 
//print($postdata4);
//echo '<br/>换行符<br/>'; 
$amount = (double)$postdata4;//从URL参数中的n=*获取amount数据
}
//echo $amount;
$notify_url='【https://your.domain】';//Epusdt的异步回调地址，随便，无需管理的话
$redirect_url='【https://your.domain】';//Epusdt的同步跳转地址,付款成功后跳转到这里
$order_id=(string)token(10);//生成随机数用于订单号
$key='【yourkey】';//Epusdt的自定义密钥
$str = 'amount='.$amount.'&notify_url='.$notify_url.'&order_id='.$order_id.'&redirect_url='.$redirect_url.$key;//拼接字符串用于MD5计算
$signature = md5($str);//用MD5算法计算签名
$data=json_encode(array( 'order_id' => $order_id,//生成数据包，用到了的数组转json的jsonencode
'amount' => $amount,
'notify_url' => $notify_url,
'redirect_url' => $redirect_url,
'signature' => $signature));
$res=curl_request('【https://your.domain/api/v1/order/create-transaction】',$data,'post');//发起Curl请求并获取返回数据到变量
//echo '<br/>换行符<br/>'; 
//echo $data;
//echo '<br/>换行符<br/>'; 
//echo $res;
$arr = json_decode($res, true);//对返回数据进行json到数组的转换，用到了jsondecode
$resdata=$arr['data'];//提取返回数据的数组中的data段落
//echo '<br/>换行符<br/>'; 
//echo $resdata['payment_url'];
//echo '<br/>换行符<br/>'; 
$payurl= $resdata['payment_url'];//提取返回数据的数组中的data段落中的支付链接
$payamount=$resdata['actual_amount'];//提取返回数据的数组中的data段落中的转换后数值
//echo $payurl;
//echo '<br/>换行符<br/>';
echo '你的支付链接是 ';
echo $payurl;
echo '<br/>你的计划支付金额是';
echo $amount;
echo 'CNY';
echo '<br/>你的实际交易是';
echo $payamount;
echo 'USD';
echo '<br/>若上述为空则你没有填URL中的?n=*的参数且缺少Post数据';
echo '<br/>本站基准汇率为1USD=6.25CNY。请勿使用ERC/DEX/BSC进行转账发起。';//部分交易所的地址有黑名单机制，用钱包可解。汇率在Epusdt那边设置。
echo '<br/>为了辨识客户订单，请注意实际金额中的尾数不可忽略';//Epusdt使用了尾数来确认订单。注意本版本对接的是V0.0.1的Epusdt
echo '<br/><a href="'.$payurl.'">请点击这里跳转到支付页面</a>';
//仅供学习PHP对JSON的处理和PHP对接HTTP API的应用，请在24小时内删除。
//不得用于中国大陆或其他限制加密货币的地区，不得用于企业、商业用途。
//不得违反PRC、USA的相关法律法规。
//请阅读《关于进一步防范和处置虚拟货币交易炒作风险的通知》 https://www.spp.gov.cn/spp/zdgz/202109/t20210924_530777.shtml
//加密货币不具有与法定货币等同的法律地位、不具有法偿性、不应且不能作为货币在市场上流通使用
//加密货币没有FDIC保险、无银行担保、可能贬值、可能归零、可能跑路、可能无法使用、可能被限制
//使用或学习本代码的相关网站应主动阻止中国大陆IP访问、阻止中国大陆用户访问，直到清除相关代码
//因为作者即本人，仅完成代码的开发和开源活动(开源即任何人都可以下载使用或修改分发)，从未参与用户的任何运营和盈利活动。
//且不知晓用户后续将程序源代码用于何种用途，故用户使用过程中所带来的任何法律责任即由用户自己承担。
?>
</body>