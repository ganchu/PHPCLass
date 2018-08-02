<?php   
//小程序生成二维码，用于线下，流程->通过微信id跟秘钥获取token->用token跟参数post去微信api接口（有ABC接口看业务类型选）->返回二维码图片（保存服务器）

/*数据库sql
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `access_token`;
CREATE TABLE `access_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
*/
    $wxId = 'wx405ca5b18c8da110';
    $wxSecret = 'a6ead8efa94186d55e57ce7d87a25590';
    get_code(20);//使用方法
    public function get_code($id)
    {
		//获取token
        $getToken = $this->getToken($wxId,$wxSecret);
         // get请求
        $result = file_get_contents($getToken);
        // json转成数组
        $arrResult = json_decode($result, TRUE);
        // 获得token
        $token = $arrResult['access_token'];
        $data  = json_encode(array( 'scene' => $id));//传的值，参考api文档

        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$token";

        $result = $this->curl_post($url,$data);//二维码图片

        $path ="/upload/".$arr['id'].'.jpg';//设置保存的路径
        file_put_contents($path,$result);
        //file_put_contents(ROOT_PATH . 'public' . DS .$path,$result);//tp保存路径不同

        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        
        echo json_encode($http_type.$_SERVER['HTTP_HOST'] . $path);//获取域名+图片路径
	}
    public function curl_post($url,$data)
    {   
        if(!is_array($data)) echo "参数必须为array";
        $data =  json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            print curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    //获取token
    public function getToken($wxId,$wxSecret)
    {
        header('Content-Type:image/jpg');
        //先向数据库提取access_token的时间判断是否超过7200s
        //ob_end_clean();//如果还有乱码，请解放我
        date_default_timezone_set('PRC');
        $times =time();
        //这里是tp方法，可以改成原生sql即可  
        $access_token = db("access_token");
        $tokenlist = $access_token ->where('id',1)-> find();
        //tp结束
        $timeLong = $times -$tokenlist['time'];//当前时间-数据库时间看token是否过期

        //用微信id和秘钥获取token，存数据库

        if($tokenlist == null||$timeLong > 7200){
            //如果token过期了，重新请求
            $getToken = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$wxId&secret=$wxSecret";
             // get请求
            $result = file_get_contents($getToken);// json转成数组
            $arrResult = json_decode($result, TRUE);// 获得新token
            $token = $arrResult['access_token'];
            $arr  = array('token' =>  $token,'time' =>$times );
            $access_token ->where('id',1)-> update($arr);//把token写数据库
            return $token;
           
        }else{
            $token =$tokenlist['token'];
            return $token;//如果没token没过期，则用数据库的
        }
       
    }
