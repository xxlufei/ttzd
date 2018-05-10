<?php
namespace App\Core\Misc;

class Util
{
    public static function Now($format="Y-m-d H:i:s")
    {
        return date($format);
    }

    public static function GMTNow($format="D, d M Y H:i:s")
    {
        return gmdate($format, time())." GMT";
    }

    public static function GMTTime($timestamp, $format="D, d M Y H:i:s")
    {
        return gmdate($format, $timestamp)." GMT";
    }

    public static function Today($format="Y-m-d")
    {
        return date($format);
    }
    public static function Tomorrow($format="Y-m-d")
    {
        return date($format,strtotime("+1 days"));
    }

    public static function Yesterday($format="Y-m-d")
    {
        return date($format,strtotime("-1 days"));
    }

    public static function TodayLongFormat($format="Y-m-d 00:00:00")
    {
        return date($format);
    }
    public static function getWeekday($date)
    {
        $week = date("w",strtotime($date));
        $weekday = self::getWeek($week);
        return $weekday;
    }
    public static function getWeekExDay($date)
    {
        $week = date("w",strtotime($date));
        $weekday = self::getWeekEx($week);
        return $weekday;
    }

    public static function getWeek ($week)
    {
        $weekArray =array('日','一','二','三','四','五','六');
        return '星期'.$weekArray[$week];
    }
    public static function getWeekEx ($week)
    {
        $weekArray =array('日','一','二','三','四','五','六');
        return '周'.$weekArray[$week];
    }
    public static function getMonth($month)
    {
        $monthArray = array('','一','二','三','四','五','六','七','八','九','十','十一','十二');
        return $monthArray[$month].'月';
    }
    public static function getHour()
    {
        $hourArray = array();
        for($i=0;$i<24;$i++)
            $hourArray[] = $i;
        return $hourArray;
    }
    public static function getTwoDayHour()
    {
        $hourArray = array();
        for($i=0;$i<48;$i++)
            $hourArray[] = $i;
        return $hourArray;
    }
    public static function getThismonthFirstday($date='')
    {
        if(!kempty($date))
            $resday = date('Y-m-01', strtotime($date));
        else
            $resday = date('Y-m-01');
        return  $resday;
    }
    public static function getThismonthLastday($date='')
    {
        if(!kempty($date))
            $firstday = date('Y-m-01', strtotime($date));
        else
            $firstday = date('Y-m-01');
        $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
        return $lastday;
    }
    public static function getThisseason($date='', $splitChar='-')
    {
        $firstDay = self::getThisseasonFirstday($date);
        $season = ceil((date('n', strtotime($firstDay)))/3);//当月是第几季度
        $year = date('Y', strtotime($firstDay));

        return $year.$splitChar.'0'.$season;
    }
    public static function getPreviousseason($date='', $splitChar='-')
    {
        $lastDay = self::DateAdd('d', -1, self::getThisseasonFirstday($date), "%Y-%m-%d");
        $season = ceil((date('n', strtotime($lastDay)))/3);//当月是第几季度
        $year = date('Y', strtotime($lastDay));

        return $year.$splitChar.'0'.$season;
    }
    public static function getNextseason($date='', $splitChar='-')
    {
        $firstDay = self::DateAdd('d', 1, self::getThisseasonLastday($date), "%Y-%m-%d");
        $season = ceil((date('n', strtotime($firstDay)))/3);//当月是第几季度
        $year = date('Y', strtotime($firstDay));

        return $year.$splitChar.'0'.$season;
    }
    public static function getThisseasonFirstday($date='')
    {
        if(!kempty($date))
        {
            $season = ceil((date('n', strtotime($date)))/3);//当月是第几季度
            $year = date('Y', strtotime($date));
        }
        else
        {
            $season = ceil((date('n'))/3);//当月是第几季度
            $year = date('Y');
        }

        $resday = date('Y-m-d', mktime(0, 0, 0, $season*3-3+1, 1, $year));
        return $resday;
    }
    public static function getThisseasonLastday($date='')
    {
        if(!kempty($date))
        {
            $season = ceil((date('n', strtotime($date)))/3);//当月是第几季度
            $year = date('Y', strtotime($date));
        }
        else
        {
            $season = ceil((date('n'))/3);//当月是第几季度
            $year = date('Y');
        }

        $resday = date('Y-m-d', mktime(0, 0, 0, $season*3, date('t', mktime(0, 0 , 0, $season*3, 1, $year)), $year));
        return  $resday;
    }
    public static function getSeasonFirstday($season)
    {
        // $season: like 2015-01, 2015-02 ...
        $year = (int)substr($season, 0, 4);
        $season = (int)substr($season, 5, 2);

        $resday = date('Y-m-d', mktime(0, 0, 0, $season*3-3+1, 1, $year));
        return $resday;
    }
    public static function getSeasonLastday($season)
    {
        // $season: like 2015-01, 2015-02 ...
        $year = (int)substr($season, 0, 4);
        $season = (int)substr($season, 5, 2);

        $resday = date('Y-m-d', mktime(0, 0, 0, $season*3, date('t', mktime(0, 0 , 0, $season*3, 1, $year)), $year));
        return $resday;
    }
    public static function getThisyearFirstday($date='')
    {
        if(!kempty($date))
            $resday = date('Y-01-01', strtotime($date));
        else
            $resday = date('Y-01-01');
        return  $resday;
    }
    public static function getThisyearLastday($date='')
    {
        if(!kempty($date))
            $firstday = date('Y-01-01', strtotime($date));
        else
            $firstday = date('Y-01-01');
        $lastday = date('Y-m-d', strtotime("$firstday +1 year -1 day"));
        return $lastday;
    }
    public static function getFormatDate ($date)
    {
        $day = strtotime($date);
        $week = Util::getWeek(date('w',$day));
        $month = Util::getMonth(date('n',$day));
        // return $week.",".$month.",".date('d,Y',$day);
        return  date('Y-m-d',$day)."（".$week."）";
    }
    public static function TodaytimeStampFromZeroClock()
    {
        return time()-strtotime(self::Today());
    }

    public static function ThisYear($date='')
    {
        if(!kempty($date))
            $year= date('Y', strtotime($date));
        else
            $year = date('Y');
        return $year;
    }

    public static function getThisMonth ($date='')
    {
        if(!kempty($date))
            $month = date('m', strtotime($date));
        else
            $month = date('m');
        return $month;
    }

    public static function getLastMonth ($date='')
    {
        if(!kempty($date))
            $firstDay = date('Y-m-01', strtotime($date));
        else
            $firstDay = date('Y-m-01');

        $month = date('Y-m',strtotime($firstDay.' -1 day'));
        return $month;
    }

    public static function DateAdd($interval, $number, $date, $format="%Y-%m-%d %H:%M:%S")
    {
        $date_time_array = getdate(strtotime($date));
        $hours = $date_time_array["hours"];
        $minutes = $date_time_array["minutes"];
        $seconds = $date_time_array["seconds"];
        $month = $date_time_array["mon"];
        $day = $date_time_array["mday"];
        $year = $date_time_array["year"];
        switch ($interval) {
        case "yyyy": $year +=$number; break;
        case "q": $month +=($number*3); break;
        case "m": $month +=$number; break;
        case "y":
        case "d":
        case "w": $day+=$number; break;
        case "ww": $day+=($number*7); break;
        case "h": $hours+=$number; break;
        case "n": $minutes+=$number; break;
        case "s": $seconds+=$number; break;
        default: throw new BizException("Error: unsupport this interval($interval)!");
        }
        $timestamp = mktime($hours, $minutes, $seconds, $month, $day, $year);
        return strftime($format, $timestamp);
    }

    public static function DateDiff($interval, $date1, $date2)
    {
        //$date1 = strtotime(date('Y-m-d', strtotime($date1)));
        //$date2 = strtotime(date('Y-m-d', strtotime($date2)));
        $date1 = strtotime(substr($date1,0,10));
        $date2 = strtotime(substr($date2,0,10));
        switch ($interval) {
        case "d": $secondunit=3600*24; break;
        case "h": $secondunit=3600; break;
        case "n": $secondunit=60; break;
        case "s": $secondunit=1; break;
        default: throw new BizException("Error: unsupport this interval($interval)!");
        }
        return floor(($date2-$date1)/$secondunit);
    }

    public static function DateFormat($format, $date)
    {
        return date($format, strtotime($date));
    }
    public static function emptyResult($start=0, $count=10)
    {
        return array(
            'total' => 0,
            'start' => $start,
            'count' => $count,
            'data' => array(),
        );
    }

    public static function emptySqlStruct()
    {
        return array(
            'where' => '',
            'sort' => '',
            'limit' => '',
        );
    }

    public static function TagsFormat($tags, $targetSplit=" ")
    {
        $splits = "　 ,";
        $p = "[$splits]+";

        return mb_eregi_replace($p, $targetSplit, $tags);
    }

    public static function toBoolString($val)
    {
        if ($val)
            return "true";

        return "false";
    }

    public static function fromBoolString($val)
    {
        if (strcasecmp($val, "true") == 0)
            return 1;

        return 0;
    }

    public static function escape($thing)
    {
        return htmlentities($thing);
    }

    public static function redirect301($url) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url);
        exit;
    }

    public static function redirect302($url) {
        header("HTTP/1.1 302 Found");
        header("Location: ".$url);
        exit;
    }

    public static function notFound404() {
        header("HTTP/1.1 404 Not Found");
        echo "File not found.";
        exit;
    }

    public static function badRequest400($err) {
        header("HTTP/1.1 400 Bad Request");
        echo $err;
        exit;
    }
    public static function hadChineseCharacter ($str)
    {
        return preg_match("/([\x81-\xfe][\x40-\xfe])/",$str) ;
    }
    public static function setFromid()
    {
        $query_arr = $_GET;
        $query_str = '';
        if(!empty($query_arr)){
            foreach($query_arr as $k=>$v){
                $tmp[]= $k.'='.$v;
            }
            $query_str = implode('&', $tmp);
        }
        if(!empty($query_str) && empty($_COOKIE['kxfromid'])){
            setCookie('kxfromid', $query_str, time()+86400, '/');
            setCookie('kxfromid', $query_str, time()+86400, '/','.hotel.kuxun.cn');
            $_COOKIE['kxfromid'] = $query_str;
        }
        // __utmkx cookie 记录在 kuxun.cn 根域名下，用于记录外部推广来源，如果这个cookie有值，则覆盖现有的kxfromid
        if(isset($_COOKIE['__utmkx']) && !empty($_COOKIE['__utmkx'])){
            $utmkx = explode("|>", $_COOKIE['__utmkx']);
            if (isset($utmkx) && isset($utmkx[2]) && !empty($utmkx[2]))
            {
                setCookie('kxfromid', $utmkx[2], time()+86400, '/');
                setCookie('kxfromid', $utmkx[2], time()+86400, '/','.hotel.kuxun.cn');
                $_COOKIE['kxfromid'] = $utmkx[2];
            }
        }
        $refer_str = $_SERVER['HTTP_REFERER'];
        if(!empty($refer_str) && empty($_COOKIE['kxrefer'])){
            setCookie('kxrefer', $refer_str, time()+86400, '/');
            setCookie('kxrefer', $refer_str, time()+86400, '/','.hotel.kuxun.cn');
            $_COOKIE['kxrefer'] = $refer_str;
        }
    }

    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $PI = 3.1415926;
        $RADIO = 6371.004;
        return $RADIO*(acos(cos($lat2*$PI/180)*cos($lat1*$PI/180)*cos(($lon2-$lon1)*$PI/180)+sin($lat2*$PI/180)*sin($lat1*$PI/180)));
    }

    public static function timeSpace($time)
    {
        $t = time() - $time;
        if($t>28800){
            return '8小时前';
        }else if($t>3600){
            return floor($t/3600).'小时前';
        }else if($t>60){
            return floor($t/60).'分钟前';
        }else if($t>0){
            return $t.'秒钟前';
        }else{
            return '1秒钟前';
        }
    }

    public static function secondConvertTime($seconds)
    {
        $secs = $minutes = $hours = $days = 0;
        if(($var = floor($seconds/60)) > 0)
        {
            $secs = $seconds%60;
            if(($var1 = floor($var/60)) > 0)
            {
                $minutes = $var%60;
                if(($var2 = floor($var1/24)) > 0)
                {
                    $hours = $var1%60;
                    $days = $var2;
                }else
                {
                    $hours = $var1;
                }
            }else{
                $minutes = $var;
            }
        }else {
            $secs = $seconds;
        }
        $str = '';
        if($days > 0)
            $str .= $days."天";
        if($hours > 0)
            $str .= $hours."小时";
        if($minutes > 0)
            $str .= $minutes."分钟";
        if($secs > 0)
            $str .= $secs."秒";
        return $str;
    }

    public static function genTrackerKey($hotelId)
    {
        return $hotelid.(microtime(true)*100);
    }
    //获得用户的ip
    public static  function getIp(){

        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        } else {
            $onlineip = '127.0.0.1';
        }

        return $onlineip;
    }

    public static function getBrowser(){
        $browser = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/360SE/',$browser)){
            $browser = "360se";
        }elseif(preg_match('/Maxthon/',$browser)){
            $browser ="Maxthon";
        }elseif(preg_match('/Tencent/',$browser)){
            $browser = "Tencent Browser";
        }elseif(preg_match('/Green/',$browser)){
            $browser = "Green Browser";
        }elseif(preg_match('/baidu/',$browser)){
            $browser = "baidu";
        }elseif(preg_match('/TheWorld/',$browser)){
            $browser = "The World";
        }elseif(preg_match('/MetaSr/',$browser)){
            $browser = "Sogou Browser";
        }elseif(preg_match('/Firefox/',$browser)){
            $browser = "Firefox";
        }elseif(preg_match('/MSIE\s6\.0/',$browser)){
            $browser ="IE6.0";
        }elseif(preg_match('/MSIE\s7\.0/',$browser)){
            $browser = "IE7.0";
        }elseif(preg_match('/MSIE\s8\.0/',$browser)){
            $browser = "IE8.0";
        }elseif(preg_match('/MSIE\s9\.0/',$browser)){
            $browser = "IE9.0";
        }elseif(preg_match('/Netscape/',$browser)){
            $browser = "Netscape";
        }elseif(preg_match('/Opera/',$browser)){
            $browser ="Opera";
        }elseif(preg_match('/Chrome/',$browser)){
            $browser =  "Chrome";
        }elseif(preg_match('/Gecko/',$browser)){
            $browser ="Gecko";
        }elseif(preg_match('/Safari/',$browser)){
            $browser = "Safari";
        }else{
            $browser = "Unknow browser";
        }
        return $browser;
    }

    public static function getOS(){
        $os = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/NT\s5\.1/',$os)){
            $os = "Windows XP";
        }elseif(preg_match('/NT\s6\.0/',$os)){
            $os =  "Windows Vista \ server 2008";
        }elseif(preg_match('/NT\s5\.2/',$os)){
            $os = "Windows Server 2003";
        }elseif(preg_match('/NT\s5/',$os)){
            $os = "Windows 2000";
        }elseif(preg_match('/NT\s6\.1/',$os)){
            $os = "Windows 7";
        }elseif(preg_match('/NT/',$os)){
            $os ="Windows NT";
        }elseif(preg_match('/Linux/',$os)){
            $os ="Linux";
        }elseif(preg_match('/Unix/',$os)){
            $os = "Unix";
        }elseif(preg_match('/Mac/',$os)){
            $os = "Macintosh";
        }elseif(preg_match('/NT\s6\.1/',$os)){
            $os ="Windows 7";
        } else {
            $os ="Unknow OS";
        }
        return $os;
    }
    public static function isLooselySpider ()
    {
        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";

        if (empty($userAgent))
            return false;
        if (stripos($userAgent, 'spider') !== false || stripos($userAgent, 'bot') )
            return true;

        return false;
    }

    public static function isSpider()
    {
        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";

        if (empty($userAgent))
            return false;

        $spiderAgents = array(
            'Baiduspider',
            'Googlebot',
            'Sosospider',
            'Yahoo! Slurp',
            'Sogou inst spider',
            'Sogou web spider',
            'msnbot',
            'Mediapartners-Google',
            '360Spider',
            'JikeSpider',
            'bingbot',
            'YisouSpider',
            'CollapsarDEEP',
            'YoudaoBot'
        );

        foreach ($spiderAgents as $spiderAgent)
        {
            if (stripos($userAgent, $spiderAgent) !== false)
                return true;
        }

        return false;
    }
    public static function safeSearch ($str)
    {
        $unSafeChar = array('.','/','<','>','[',']','#','$','"','\\','@');
        foreach($unSafeChar as $char)
        {
            if(strpos($str,$char))
            {
                return false;
            }
        }
        return true;
    }
    public static function redirect4TuiGuang($paramNames)
    {
        $domain = "http://hotel.kuxun.cn";

        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        if (self::isSpider($userAgent))
        {
            $redirectUrl = $_SERVER['REQUEST_URI'];
            $doRedirect = false;

            foreach ($paramNames as $paramName)
            {
                if (isset($_GET[$paramName]))
                {
                    $redirectUrl = preg_replace("|$paramName=[^?&]*[&]?|is", "", $redirectUrl);
                    $doRedirect = true;
                }
            }

            if ($doRedirect)
            {
                $lastChar = substr($redirectUrl, -1, 1);
                if ($lastChar == "&" || $lastChar == "?")
                    $redirectUrl = substr($redirectUrl, 0, strlen($redirectUrl)-1);
                $redirectUrl = $domain.$redirectUrl;

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$redirectUrl);

                exit;
            }
        }
    }
    public static function redirect($url) {
        header("Location:$url");
        exit;
    }
    public static function topRedirect($url) {
        echo "<script>top.location.href='$url'</script>";
        exit;
    }
    public static function  jsRedirect($url)
    {
        echo "<script>location.href='$url'</script>";
        exit;
    }
    public static function jsErrorTip($errorMsg,$url=null,$isCloseWindow=false)
    {
        $str = "<script>alert('$errorMsg');";
        if(!kempty($url))
            $str .= "location.href='$url';";
        if($isCloseWindow)
            $str .= "window.close();";
        $str .= "</script>";
        echo $str;
        exit;
    }
    public static function jsRedirectAndRefreshOpener($url,$topLevelDomain)
    {
        echo $str = "<script>location.href='$url';document.domain='$topLevelDomain';window.opener.location.reload();</script>";
        exit;
    }
    public static function getSelfUrl()
    {
        return "http://".$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        //return "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    }
    public static function getRefererUrl()
    {
        return  getenv("HTTP_REFERER");
    }

    public static function isPostBack()
    {
        return $_SERVER['REQUEST_METHOD']=='POST';
    }
    public  static function redirectMsgUrl($url,$next=null,$msg=null)
    {
        if ($next !== null)
        {
            $urlParam .= 'next=' . urlencode($next) . '&';
        }
        else{
            $urlParam .= 'next=' . urlencode(self::getSelfUrl()). '&';
        }
        if ($msg !== null)
        {
            $urlParam .= 'msg=' . urlencode($msg) . '&';
        }
        if(!kempty($urlParam))
        {
            if(strstr($url,"?"))
            {
                $url .= "&".$urlParam;
            }
            else
            {
                $url .= "?".$urlParam;
            }
        }
        $url = trim($url,"&");
        self::redirect($url);
    }
    public static function isIE()
    {
        if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE")){
            return true;
        }else{
            return false;
        }
    }
    public static function moneyit($money) {
        return rtrim(rtrim(sprintf('%.2f',$money), '0'), '.');
    }
    public static function searchNumToChare($num)
    {
        return chr($num+64);
    }
    public static function getRandomString($length = 5, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $cLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $cLength - 1)];
        }
        return $randomString;
    }
    public static function getRandomNumber($min,$max,$decimal=0){
        $min = floatVal($min);
        $max = floatval($max);
        $decimal = intval($decimal);
        if($max == $min){
            return $max;
        }
        if($max < $min){
            $tmp = $min;
            $min = $max;
            $max = $tmp;
        }
        $minInt = intval($min);
        $maxInt = intval($max);

        if($decimal == 0){
            return mt_rand($minInt,$maxInt);
        }
        $maxDecimal = str_repeat(9,$decimal);

        $randomInt = mt_rand($minInt,$maxInt);
        $randomDecimal = mt_rand(0,$maxDecimal);
        $randomNumber = $randomInt + $randomDecimal/(10*$decimal);

        if($randomNumber > $max){
            $randomNumber = $max;
        }
        if($randomNumber < $min){
            $randomNumber = $min;
        }
        return floatval($randomNumber);
    }
    public static function getUserNameByOpenId($openId)
    {
        $codeId = md5($openId);
        $userName = substr($codeId,1,10).self::getRandomString(5,'abcdefghjkmnpqrstuvwxyz98765432');
        return $userName;
    }
    public static function getUserNameByMobile($mobile)
    {
        $userName = (intval($mobile)+1)*11;
        $userName = substr($userName,1,strlen($userName)-3).self::getRandomString(5,'abcdefghjkmnpqrstuvwxyz98765432');
        return $userName;
    }
    public static function getUserNameByEmail($email)
    {
        $useremail = md5($email);
        $userName = substr($useremail,1,10).self::getRandomString(5,'abcdefghjkmnpqrstuvwxyz98765432');
        return $userName;
    }
    public static function convertArray2CsvFile($fileName,$result,$headArray= false)
    {
        $fp = fopen($filename, 'w');
        if($headArray)
        {
            foreach ($head as $i => $v) {
                $head[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $head);
        }
        foreach ($result as $row )
        {
            foreach ($row as $i => $v)
            {
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public static function hexstr($hexstr)
    {
        $hexstr = str_replace(' ', '', $hexstr);
        $hexstr = str_replace('\x', '', $hexstr);
        $retstr = pack('H*', $hexstr);
        return $retstr;
    }

    public static function strhex($string)
    {
        $hexstr = unpack('H*', $string);
        return array_shift($hexstr);
    }
    public static function  dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' )
    {
        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );

        while( $current < $last ) {

            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }

        return $dates;
    }

    public static function getLocalMachineIp($onlyOne=false)
    {
        $ips = array();
        @exec("/sbin/ifconfig|grep -o 'inet addr:[0-9.]*'|awk -F: '{print $2}'|grep -vi '127.0.0.1'|grep -vi '192.168'", $ips);

        if (kempty($ips))
            return null;

        if ($onlyOne)
            return reset($ips);

        return $ips;
    }

    public static function get_animal($birth_year)
    {
        if (kempty($birth_year)) {
            return false;
        }
        $animal = array(
            'rat','ox','tiger','hare',
            'dragon','snake','horse','sheep',
            'monkey','cock','dog','boar'
        );
        $my_animal = ($birth_year-1900)%12;
        return $animal[$my_animal];
    }

    public static function get_zodiac_sign($month, $day)
    {
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
            return (false);
        $signs = array(
            array( "20" => "水瓶座"),
            array( "19" => "双鱼座"),
            array( "21" => "白羊座"),
            array( "20" => "金牛座"),
            array( "21" => "双子座"),
            array( "22" => "巨蟹座"),
            array( "23" => "狮子座"),
            array( "23" => "处女座"),
            array( "23" => "天秤座"),
            array( "24" => "天蝎座"),
            array( "22" => "射手座"),
            array( "22" => "摩羯座")
        );
        list($sign_start, $sign_name) = each($signs[(int)$month-1]);
        if ($day < $sign_start)
            list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]);
        return $sign_name;
    }

    public static function isSmartMobileAgent ($userAgent)
    {
        $smartMobileAgentArray = array('iphone', 'ipod', 'android', 'adr', 'firefox/1.0.7', 'ucweb', 'mqqbrowser', 'micromessenger', 'iemobile');
        foreach($smartMobileAgentArray as $smartMobileAgent)
        {
            if(false !== strpos(strtolower($userAgent), $smartMobileAgent))
            {
                return true;
            }
        }
        return false;
    }

    public static function isIpadAgent()
    {
        return strpos($_SERVER['HTTP_USER_AGENT'],'iPad') === false ? false : true;
    }

    public static function getAgeGroup($birth_year)
    {
        if (kempty($birth_year)) {
            return false;
        }
        $age_group = array('00后','10后','20后','30后','40后','50后','60后','70后','80后','90后');
        $key = substr($birth_year,2,1);
        return $age_group[$key];
    }

    public static function getNewAgeGroup($birth_year)
    {
        if (kempty($birth_year)) 
        {
            return false;
        }

        $age_group = array('0','1','2','3','4','5','6','7','8','9');
        $key = substr($birth_year, 2, 1);
        $yearLast = substr($birth_year, 3, 1);

        return  $yearLast <5 ? $age_group[$key]. '0后' : $age_group[$key]. '5后';
    }

    public static function truncate_utf8_string($string, $length, $etc = '...')
    {
        if ($length == 0) return '';

        $mblen = mb_strlen($string, 'utf-8');
        $asclen = strlen($string);

        if ($mblen == $asclen)
        {
            if ($mblen <= $length*2)
                return $string;
            else
                return substr($string,0,$length*2).$etc;
        }
        else if ($mblen*3 == $asclen)
        {
            if ($mblen <= $length)
                return $string;
            else
                return mb_substr($string, 0, $length, "utf-8").$etc;
        }
        else
        {
            $triByteCharCount = ($asclen - $mblen) / 2;
            $convertmblen = ($mblen - $triByteCharCount) / 2 + $triByteCharCount;

            if ($convertmblen > $length) {

                for ($i = 0, $charCurrentLen = 0, $monoByteCharCount = 0, $triByteCharCount = 0; $charCurrentLen < $length; $i++)
                {
                    if (preg_match("/[\x20-\x7e]/", $string[$i])){
                        // $value is one-bit byte char
                        $monoByteCharCount++;
                    } else {
                        // $value is part of three-bit byte char
                        $triByteCharCount++;
                    }
                    $charCurrentLen = $monoByteCharCount / 2 + $triByteCharCount / 3;
                    // final length: $lengthForReturn = $triByteCharCount/3 + $monoByteCharCount
                    $lenForReturn = $monoByteCharCount + $triByteCharCount / 3;
                }
                // $string for return
                $string = mb_substr($string, 0, ceil($lenForReturn), 'utf-8');

                return $string . $etc;
            } else {
                return $string;
            }
        }
    }

    public static function getUtf8StrLength($string, $hansLen = 2, $ensLen = 1){
        //一个汉字算是两个字符，其余算是一个字符
        $mblen = mb_strlen($string, 'utf-8');
        $asclen = strlen($string);

        if ($mblen == $asclen){
            return $mblen*$ensLen;
        } else if ($mblen*3 == $asclen){
            return $mblen*$hansLen;
        } else {
            $triByteCharCount = ($asclen - $mblen) / 2;
            $singleByteCharCount = $mblen-$triByteCharCount;
            return $triByteCharCount*$hansLen+$singleByteCharCount*$ensLen;
        }
    }

    public static function array_sort($arr,$keys,$type='asc') {
        $keysvalue = $new_array = array();
        foreach ($arr as $k=>$v) {
            $keysvalue[$k] = $v[$keys];
        }
        if($type == 'asc') {
            asort($keysvalue);
        } else {
            arsort($keysvalue);
        }
        reset($keysvalue);
        foreach ($keysvalue as $k=>$v){
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }

    public static function getPastTimeDisplay($time)
    {
        $timestamp = strtotime($time);
        $nowTimestamp = strtotime(self::Now());

        $minutes = floor(($nowTimestamp - $timestamp)/60);
        $retStr = "";

        if($minutes <= 1)
        {
            $retStr = "1分钟内";
        }else if($minutes < 60)
        {
            $retStr = $minutes."分钟前";
        }else if ($minutes < 60*24)
        {
            $retStr = floor($minutes/60)."小时前";
        }else if ($minutes < 60*24*30)
        {
            $retStr = floor($minutes/60/24)."天前";
        }else if($minutes < 60*24*30*12)
        {
            $retStr = floor($minutes/60/24/30)."月前";
        }else
        {
            $retStr = floor($minutes/60/24/30/12)."年前";
        }

        return $retStr;
    }

    public static function regroupImgUrl4Size($image,$width,$height)
    {
        $imgUrlParam = explode('/',$image);
        $thumbParam = $imgUrlParam[3];
        $thumbArr = explode(',',$thumbParam);
        $thumbArr[1] = $width;
        $thumbArr[2] = $height;
        $newThumbParam = implode(',',$thumbArr);
        $imgUrlParam[3] = $newThumbParam;
        $newImageUrl = implode('/',$imgUrlParam);
        return $newImageUrl;
    }

    function mb_stringToArray ($string) {
        $strlen = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string,0,1,"utf8");
            $string = mb_substr($string,1,$strlen,"utf8");
            $strlen = mb_strlen($string);
        }
        return $array;
    }

    public static function getCityByMobile($mobile)
    {
        $json =  iconv('gbk','utf-8',file_get_contents("http://life.tenpay.com/cgi-bin/mobile/MobileQueryAttribution.cgi?chgmobile={$mobile}"));
        preg_match_all('/<city>(.*)<\/city>/',$json,$location);
        if($location[1])
            return $location[1][0];
        return null;
    }

    public static function getAgeByBirthday($birthday)
    {
        if(kempty($birthday))
            return 0;
        list($by,$bm,$bd)=explode('-',$birthday);
        $cm=date('n');
        $cd=date('j');
        $age=date('Y')-$by-1;
        if ($cm>$bm || $cm==$bm && $cd>$bd) $age++;
        return $age;
    }
    public static function getAgeByBirthYear($birthYear=null)
    {
        if(kempty($birthYear))
            return 0;
        $age = date('Y') - $birthYear;
        return $age;
    }
    public static function stripHtml($string)
    {
        $string=strip_tags($string);
        $string=preg_replace("/\r\n/is",'',$string);
        $string=preg_replace("/\t/is",'',$string);
        $string=preg_replace("/|/is",'',$string);
        $string=preg_replace("/&nbsp;/is",'',$string);
        $string=trim($string);
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
        if(is_array($string) && !kempty($string[0]))
        {
            $string=implode('',$string[0]);
        }else
        {
            $string='';
        }
        return $string;
    }

    private function calc_suffix_d ($base)
    {
        if (strlen($base) <> 17){
            die('Invalid Length');
        }
        $factor = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        $sums = 0;
        for ($i=0;$i< 17;$i++){

            $sums += substr($base,$i,1) * $factor[$i];
        }

        $mods = $sums % 11;//10X98765432

        switch ($mods){
            case 0:  return '1';break;
            case 1:  return '0';break;
            case 2:  return 'X';break;
            case 3:  return '9';break;
            case 4:  return '8';break;
            case 5:  return '7';break;
            case 6:  return '6';break;
            case 7:  return '5';break;
            case 8:  return '4';break;
            case 9:  return '3';break;
            case 10: return '2';break;

        }
    }

    public static function genRandomIDCardNo()
    {
        $content = '';
        //产生身份证的数量
        $total_ids_showed = 1;
        //身份证起止年月 eg：1990年12月31日  mktime(0,0,0,12,31,1990)
        $Year_start = mktime(0,0,0,1,1,1950);
        $Year_end = mktime(0,0,0,12,31,2000);
        //全国区域代码 共3131
        $Region= array(110101,110102,110105,110106,110107,110108,110109,110111,110112,110113,110114,110115,110116,110117,110228,110229,120101,120102,120103,120104,120105,120106,120110,120111,120112,120113,120114,120115,120116,120221,120223,120225,130101,130102,130103,130104,130105,130107,130108,130121,130123,130124,130125,130126,130127,130128,130129,130130,130131,130132,130133,130181,130182,130183,130184,130185,130201,130202,130203,130204,130205,130207,130208,130209,130223,130224,130225,130227,130229,130281,130283,130301,130302,130303,130304,130321,130322,130323,130324,130401,130402,130403,130404,130406,130421,130423,130424,130425,130426,130427,130428,130429,130430,130431,130432,130433,130434,130435,130481,130501,130502,130503,130521,130522,130523,130524,130525,130526,130527,130528,130529,130530,130531,130532,130533,130534,130535,130581,130582,130601,130602,130603,130604,130621,130622,130623,130624,130625,130626,130627,130628,130629,130630,130631,130632,130633,130634,130635,130636,130637,130638,130681,130682,130683,130684,130701,130702,130703,130705,130706,130721,130722,130723,130724,130725,130726,130727,130728,130729,130730,130731,130732,130733,130801,130802,130803,130804,130821,130822,130823,130824,130825,130826,130827,130828,130901,130902,130903,130921,130922,130923,130924,130925,130926,130927,130928,130929,130930,130981,130982,130983,130984,131001,131002,131003,131022,131023,131024,131025,131026,131028,131081,131082,131101,131102,131121,131122,131123,131124,131125,131126,131127,131128,131181,131182,140101,140105,140106,140107,140108,140109,140110,140121,140122,140123,140181,140201,140202,140203,140211,140212,140221,140222,140223,140224,140225,140226,140227,140301,140302,140303,140311,140321,140322,140401,140402,140411,140421,140423,140424,140425,140426,140427,140428,140429,140430,140431,140481,140501,140502,140521,140522,140524,140525,140581,140601,140602,140603,140621,140622,140623,140624,140701,140702,140721,140722,140723,140724,140725,140726,140727,140728,140729,140781,140801,140802,140821,140822,140823,140824,140825,140826,140827,140828,140829,140830,140881,140882,140901,140902,140921,140922,140923,140924,140925,140926,140927,140928,140929,140930,140931,140932,140981,141001,141002,141021,141022,141023,141024,141025,141026,141027,141028,141029,141030,141031,141032,141033,141034,141081,141082,141101,141102,141121,141122,141123,141124,141125,141126,141127,141128,141129,141130,141181,141182,150101,150102,150103,150104,150105,150121,150122,150123,150124,150125,150201,150202,150203,150204,150205,150206,150207,150221,150222,150223,150301,150302,150303,150304,150401,150402,150403,150404,150421,150422,150423,150424,150425,150426,150428,150429,150430,150501,150502,150521,150522,150523,150524,150525,150526,150581,150601,150602,150621,150622,150623,150624,150625,150626,150627,150701,150702,150721,150722,150723,150724,150725,150726,150727,150781,150782,150783,150784,150785,150801,150802,150821,150822,150823,150824,150825,150826,150901,150902,150921,150922,150923,150924,150925,150926,150927,150928,150929,150981,152201,152202,152221,152222,152223,152224,152501,152502,152522,152523,152524,152525,152526,152527,152528,152529,152530,152531,152921,152922,152923,210101,210102,210103,210104,210105,210106,210111,210112,210113,210114,210122,210123,210124,210181,210201,210202,210203,210204,210211,210212,210213,210224,210281,210282,210283,210301,210302,210303,210304,210311,210321,210323,210381,210401,210402,210403,210404,210411,210421,210422,210423,210501,210502,210503,210504,210505,210521,210522,210601,210602,210603,210604,210624,210681,210682,210701,210702,210703,210711,210726,210727,210781,210782,210801,210802,210803,210804,210811,210881,210882,210901,210902,210903,210904,210905,210911,210921,210922,211001,211002,211003,211004,211005,211011,211021,211081,211101,211102,211103,211121,211122,211201,211202,211204,211221,211223,211224,211281,211282,211301,211302,211303,211321,211322,211324,211381,211382,211401,211402,211403,211404,211421,211422,211481,220101,220102,220103,220104,220105,220106,220112,220122,220181,220182,220183,220201,220202,220203,220204,220211,220221,220281,220282,220283,220284,220301,220302,220303,220322,220323,220381,220382,220401,220402,220403,220421,220422,220501,220502,220503,220521,220523,220524,220581,220582,220601,220602,220605,220621,220622,220623,220681,220701,220702,220721,220722,220723,220724,220801,220802,220821,220822,220881,220882,222401,222402,222403,222404,222405,222406,222424,222426,230101,230102,230103,230104,230108,230109,230110,230111,230112,230123,230124,230125,230126,230127,230128,230129,230182,230183,230184,230201,230202,230203,230204,230205,230206,230207,230208,230221,230223,230224,230225,230227,230229,230230,230231,230281,230301,230302,230303,230304,230305,230306,230307,230321,230381,230382,230401,230402,230403,230404,230405,230406,230407,230421,230422,230501,230502,230503,230505,230506,230521,230522,230523,230524,230601,230602,230603,230604,230605,230606,230621,230622,230623,230624,230701,230702,230703,230704,230705,230706,230707,230708,230709,230710,230711,230712,230713,230714,230715,230716,230722,230781,230801,230803,230804,230805,230811,230822,230826,230828,230833,230881,230882,230901,230902,230903,230904,230921,231001,231002,231003,231004,231005,231024,231025,231081,231083,231084,231085,231101,231102,231121,231123,231124,231181,231182,231201,231202,231221,231222,231223,231224,231225,231226,231281,231282,231283,232721,232722,232723,310101,310104,310105,310106,310107,310108,310109,310110,310112,310113,310114,310115,310116,310117,310118,310120,310230,320101,320102,320103,320104,320105,320106,320107,320111,320113,320114,320115,320116,320124,320125,320201,320202,320203,320204,320205,320206,320211,320281,320282,320301,320302,320303,320305,320311,320312,320321,320322,320324,320381,320382,320401,320402,320404,320405,320411,320412,320481,320482,320501,320505,320506,320507,320508,320509,320581,320582,320583,320585,320601,320602,320611,320612,320621,320623,320681,320682,320684,320701,320703,320705,320706,320721,320722,320723,320724,320801,320802,320803,320804,320811,320826,320829,320830,320831,320901,320902,320903,320921,320922,320923,320924,320925,320981,320982,321001,321002,321003,321012,321023,321081,321084,321101,321102,321111,321112,321181,321182,321183,321201,321202,321203,321281,321282,321283,321284,321301,321302,321311,321322,321323,321324,330101,330102,330103,330104,330105,330106,330108,330109,330110,330122,330127,330182,330183,330185,330201,330203,330204,330205,330206,330211,330212,330225,330226,330281,330282,330283,330301,330302,330303,330304,330322,330324,330326,330327,330328,330329,330381,330382,330401,330402,330411,330421,330424,330481,330482,330483,330501,330502,330503,330521,330522,330523,330601,330602,330621,330624,330681,330682,330683,330701,330702,330703,330723,330726,330727,330781,330782,330783,330784,330801,330802,330803,330822,330824,330825,330881,330901,330902,330903,330921,330922,331001,331002,331003,331004,331021,331022,331023,331024,331081,331082,331101,331102,331121,331122,331123,331124,331125,331126,331127,331181,340101,340102,340103,340104,340111,340121,340122,340123,340124,340181,340201,340202,340203,340207,340208,340221,340222,340223,340225,340301,340302,340303,340304,340311,340321,340322,340323,340401,340402,340403,340404,340405,340406,340421,340501,340503,340504,340506,340521,340522,340523,340601,340602,340603,340604,340621,340701,340702,340703,340711,340721,340801,340802,340803,340811,340822,340823,340824,340825,340826,340827,340828,340881,341001,341002,341003,341004,341021,341022,341023,341024,341101,341102,341103,341122,341124,341125,341126,341181,341182,341201,341202,341203,341204,341221,341222,341225,341226,341282,341301,341302,341321,341322,341323,341324,341501,341502,341503,341521,341522,341523,341524,341525,341601,341602,341621,341622,341623,341701,341702,341721,341722,341723,341801,341802,341821,341822,341823,341824,341825,341881,350101,350102,350103,350104,350105,350111,350121,350122,350123,350124,350125,350128,350181,350182,350201,350203,350205,350206,350211,350212,350213,350301,350302,350303,350304,350305,350322,350401,350402,350403,350421,350423,350424,350425,350426,350427,350428,350429,350430,350481,350501,350502,350503,350504,350505,350521,350524,350525,350526,350527,350581,350582,350583,350601,350602,350603,350622,350623,350624,350625,350626,350627,350628,350629,350681,350701,350702,350721,350722,350723,350724,350725,350781,350782,350783,350784,350801,350802,350821,350822,350823,350824,350825,350881,350901,350902,350921,350922,350923,350924,350925,350926,350981,350982,360101,360102,360103,360104,360105,360111,360121,360122,360123,360124,360201,360202,360203,360222,360281,360301,360302,360313,360321,360322,360323,360401,360402,360403,360421,360423,360424,360425,360426,360427,360428,360429,360430,360481,360482,360501,360502,360521,360601,360602,360622,360681,360701,360702,360721,360722,360723,360724,360725,360726,360727,360728,360729,360730,360731,360732,360733,360734,360735,360781,360782,360801,360802,360803,360821,360822,360823,360824,360825,360826,360827,360828,360829,360830,360881,360901,360902,360921,360922,360923,360924,360925,360926,360981,360982,360983,361001,361002,361021,361022,361023,361024,361025,361026,361027,361028,361029,361030,361101,361102,361121,361122,361123,361124,361125,361126,361127,361128,361129,361130,361181,370101,370102,370103,370104,370105,370112,370113,370124,370125,370126,370181,370201,370202,370203,370205,370211,370212,370213,370214,370281,370282,370283,370284,370285,370301,370302,370303,370304,370305,370306,370321,370322,370323,370401,370402,370403,370404,370405,370406,370481,370501,370502,370503,370521,370522,370523,370601,370602,370611,370612,370613,370634,370681,370682,370683,370684,370685,370686,370687,370701,370702,370703,370704,370705,370724,370725,370781,370782,370783,370784,370785,370786,370801,370802,370811,370826,370827,370828,370829,370830,370831,370832,370881,370882,370883,370901,370902,370911,370921,370923,370982,370983,371001,371002,371081,371082,371083,371101,371102,371103,371121,371122,371201,371202,371203,371301,371302,371311,371312,371321,371322,371323,371324,371325,371326,371327,371328,371329,371401,371402,371421,371422,371423,371424,371425,371426,371427,371428,371481,371482,371501,371502,371521,371522,371523,371524,371525,371526,371581,371601,371602,371621,371622,371623,371624,371625,371626,371701,371702,371721,371722,371723,371724,371725,371726,371727,371728,410101,410102,410103,410104,410105,410106,410108,410122,410181,410182,410183,410184,410185,410201,410202,410203,410204,410205,410211,410221,410222,410223,410224,410225,410301,410302,410303,410304,410305,410306,410311,410322,410323,410324,410325,410326,410327,410328,410329,410381,410401,410402,410403,410404,410411,410421,410422,410423,410425,410481,410482,410501,410502,410503,410505,410506,410522,410523,410526,410527,410581,410601,410602,410603,410611,410621,410622,410701,410702,410703,410704,410711,410721,410724,410725,410726,410727,410728,410781,410782,410801,410802,410803,410804,410811,410821,410822,410823,410825,410882,410883,410901,410902,410922,410923,410926,410927,410928,411001,411002,411023,411024,411025,411081,411082,411101,411102,411103,411104,411121,411122,411201,411202,411221,411222,411224,411281,411282,411301,411302,411303,411321,411322,411323,411324,411325,411326,411327,411328,411329,411330,411381,411401,411402,411403,411421,411422,411423,411424,411425,411426,411481,411501,411502,411503,411521,411522,411523,411524,411525,411526,411527,411528,411601,411602,411621,411622,411623,411624,411625,411626,411627,411628,411681,411701,411702,411721,411722,411723,411724,411725,411726,411727,411728,411729,419001,420101,420102,420103,420104,420105,420106,420107,420111,420112,420113,420114,420115,420116,420117,420201,420202,420203,420204,420205,420222,420281,420301,420302,420303,420321,420322,420323,420324,420325,420381,420501,420502,420503,420504,420505,420506,420525,420526,420527,420528,420529,420581,420582,420583,420601,420602,420606,420607,420624,420625,420626,420682,420683,420684,420701,420702,420703,420704,420801,420802,420804,420821,420822,420881,420901,420902,420921,420922,420923,420981,420982,420984,421001,421002,421003,421022,421023,421024,421081,421083,421087,421101,421102,421121,421122,421123,421124,421125,421126,421127,421181,421182,421201,421202,421221,421222,421223,421224,421281,421301,421303,421321,421381,422801,422802,422822,422823,422825,422826,422827,422828,429004,429005,429006,429021,430101,430102,430103,430104,430105,430111,430112,430121,430124,430181,430201,430202,430203,430204,430211,430221,430223,430224,430225,430281,430301,430302,430304,430321,430381,430382,430401,430405,430406,430407,430408,430412,430421,430422,430423,430424,430426,430481,430482,430501,430502,430503,430511,430521,430522,430523,430524,430525,430527,430528,430529,430581,430601,430602,430603,430611,430621,430623,430624,430626,430681,430682,430701,430702,430703,430721,430722,430723,430724,430725,430726,430781,430801,430802,430811,430821,430822,430901,430902,430903,430921,430922,430923,430981,431001,431002,431003,431021,431022,431023,431024,431025,431026,431027,431028,431081,431101,431102,431103,431121,431122,431123,431124,431125,431126,431127,431128,431129,431201,431202,431221,431222,431223,431224,431225,431226,431227,431228,431229,431230,431281,431301,431302,431321,431322,431381,431382,433101,433122,433123,433124,433125,433126,433127,433130,440101,440103,440104,440105,440106,440111,440112,440113,440114,440115,440116,440183,440184,440201,440203,440204,440205,440222,440224,440229,440232,440233,440281,440282,440301,440303,440304,440305,440306,440307,440308,440401,440402,440403,440404,440501,440507,440511,440512,440513,440514,440515,440523,440601,440604,440605,440606,440607,440608,440701,440703,440704,440705,440781,440783,440784,440785,440801,440802,440803,440804,440811,440823,440825,440881,440882,440883,440901,440902,440903,440923,440981,440982,440983,441201,441202,441203,441223,441224,441225,441226,441283,441284,441301,441302,441303,441322,441323,441324,441401,441402,441421,441422,441423,441424,441426,441427,441481,441501,441502,441521,441523,441581,441601,441602,441621,441622,441623,441624,441625,441701,441702,441721,441723,441781,441801,441802,441821,441823,441825,441826,441827,441881,441882,445101,445102,445121,445122,445201,445202,445221,445222,445224,445281,445301,445302,445321,445322,445323,445381,450101,450102,450103,450105,450107,450108,450109,450122,450123,450124,450125,450126,450127,450201,450202,450203,450204,450205,450221,450222,450223,450224,450225,450226,450301,450302,450303,450304,450305,450311,450321,450322,450323,450324,450325,450326,450327,450328,450329,450330,450331,450332,450401,450403,450404,450405,450421,450422,450423,450481,450501,450502,450503,450512,450521,450601,450602,450603,450621,450681,450701,450702,450703,450721,450722,450801,450802,450803,450804,450821,450881,450901,450902,450921,450922,450923,450924,450981,451001,451002,451021,451022,451023,451024,451025,451026,451027,451028,451029,451030,451031,451101,451102,451121,451122,451123,451201,451202,451221,451222,451223,451224,451225,451226,451227,451228,451229,451281,451301,451302,451321,451322,451323,451324,451381,451401,451402,451421,451422,451423,451424,451425,451481,460101,460105,460106,460107,460108,460201,460321,460322,460323,469001,469002,469003,469005,469006,469007,469021,469022,469023,469024,469025,469026,469027,469028,469029,469030,500101,500102,500103,500104,500105,500106,500107,500108,500109,500110,500111,500112,500113,500114,500115,500116,500117,500118,500119,500223,500224,500226,500227,500228,500229,500230,500231,500232,500233,500234,500235,500236,500237,500238,500240,500241,500242,500243,510101,510104,510105,510106,510107,510108,510112,510113,510114,510115,510121,510122,510124,510129,510131,510132,510181,510182,510183,510184,510301,510302,510303,510304,510311,510321,510322,510401,510402,510403,510411,510421,510422,510501,510502,510503,510504,510521,510522,510524,510525,510601,510603,510623,510626,510681,510682,510683,510701,510703,510704,510722,510723,510724,510725,510726,510727,510781,510801,510802,510811,510812,510821,510822,510823,510824,510901,510903,510904,510921,510922,510923,511001,511002,511011,511024,511025,511028,511101,511102,511111,511112,511113,511123,511124,511126,511129,511132,511133,511181,511301,511302,511303,511304,511321,511322,511323,511324,511325,511381,511401,511402,511421,511422,511423,511424,511425,511501,511502,511503,511521,511523,511524,511525,511526,511527,511528,511529,511601,511602,511621,511622,511623,511681,511701,511702,511721,511722,511723,511724,511725,511781,511801,511802,511803,511822,511823,511824,511825,511826,511827,511901,511902,511921,511922,511923,512001,512002,512021,512022,512081,513221,513222,513223,513224,513225,513226,513227,513228,513229,513230,513231,513232,513233,513321,513322,513323,513324,513325,513326,513327,513328,513329,513330,513331,513332,513333,513334,513335,513336,513337,513338,513401,513422,513423,513424,513425,513426,513427,513428,513429,513430,513431,513432,513433,513434,513435,513436,513437,520101,520102,520103,520111,520112,520113,520114,520121,520122,520123,520181,520201,520203,520221,520222,520301,520302,520303,520321,520322,520323,520324,520325,520326,520327,520328,520329,520330,520381,520382,520401,520402,520421,520422,520423,520424,520425,520502,520521,520522,520523,520524,520525,520526,520527,520602,520603,520621,520622,520623,520624,520625,520626,520627,520628,522301,522322,522323,522324,522325,522326,522327,522328,522601,522622,522623,522624,522625,522626,522627,522628,522629,522630,522631,522632,522633,522634,522635,522636,522701,522702,522722,522723,522725,522726,522727,522728,522729,522730,522731,522732,530101,530102,530103,530111,530112,530113,530114,530122,530124,530125,530126,530127,530128,530129,530181,530301,530302,530321,530322,530323,530324,530325,530326,530328,530381,530402,530421,530422,530423,530424,530425,530426,530427,530428,530501,530502,530521,530522,530523,530524,530601,530602,530621,530622,530623,530624,530625,530626,530627,530628,530629,530630,530701,530702,530721,530722,530723,530724,530801,530802,530821,530822,530823,530824,530825,530826,530827,530828,530829,530901,530902,530921,530922,530923,530924,530925,530926,530927,532301,532322,532323,532324,532325,532326,532327,532328,532329,532331,532501,532502,532503,532523,532524,532525,532526,532527,532528,532529,532530,532531,532532,532601,532622,532623,532624,532625,532626,532627,532628,532801,532822,532823,532901,532922,532923,532924,532925,532926,532927,532928,532929,532930,532931,532932,533102,533103,533122,533123,533124,533321,533323,533324,533325,533421,533422,533423,540101,540102,540121,540122,540123,540124,540125,540126,540127,542121,542122,542123,542124,542125,542126,542127,542128,542129,542132,542133,542221,542222,542223,542224,542225,542226,542227,542228,542229,542231,542232,542233,542301,542322,542323,542324,542325,542326,542327,542328,542329,542330,542331,542332,542333,542334,542335,542336,542337,542338,542421,542422,542423,542424,542425,542426,542427,542428,542429,542430,542521,542522,542523,542524,542525,542526,542527,542621,542622,542623,542624,542625,542626,542627,610101,610102,610103,610104,610111,610112,610113,610114,610115,610116,610122,610124,610125,610126,610201,610202,610203,610204,610222,610301,610302,610303,610304,610322,610323,610324,610326,610327,610328,610329,610330,610331,610401,610402,610403,610404,610422,610423,610424,610425,610426,610427,610428,610429,610430,610431,610481,610501,610502,610521,610522,610523,610524,610525,610526,610527,610528,610581,610582,610601,610602,610621,610622,610623,610624,610625,610626,610627,610628,610629,610630,610631,610632,610701,610702,610721,610722,610723,610724,610725,610726,610727,610728,610729,610730,610801,610802,610821,610822,610823,610824,610825,610826,610827,610828,610829,610830,610831,610901,610902,610921,610922,610923,610924,610925,610926,610927,610928,610929,611001,611002,611021,611022,611023,611024,611025,611026,620101,620102,620103,620104,620105,620111,620121,620122,620123,620201,620301,620302,620321,620401,620402,620403,620421,620422,620423,620501,620502,620503,620521,620522,620523,620524,620525,620601,620602,620621,620622,620623,620701,620702,620721,620722,620723,620724,620725,620801,620802,620821,620822,620823,620824,620825,620826,620901,620902,620921,620922,620923,620924,620981,620982,621001,621002,621021,621022,621023,621024,621025,621026,621027,621101,621102,621121,621122,621123,621124,621125,621126,621201,621202,621221,621222,621223,621224,621225,621226,621227,621228,622901,622921,622922,622923,622924,622925,622926,622927,623001,623021,623022,623023,623024,623025,623026,623027,630101,630102,630103,630104,630105,630121,630122,630123,632121,632122,632123,632126,632127,632128,632221,632222,632223,632224,632321,632322,632323,632324,632521,632522,632523,632524,632525,632621,632622,632623,632624,632625,632626,632721,632722,632723,632724,632725,632726,632801,632802,632821,632822,632823,640101,640104,640105,640106,640121,640122,640181,640201,640202,640205,640221,640301,640302,640303,640323,640324,640381,640401,640402,640422,640423,640424,640425,640501,640502,640521,640522,650101,650102,650103,650104,650105,650106,650107,650109,650121,650201,650202,650203,650204,650205,652101,652122,652123,652201,652222,652223,652301,652302,652323,652324,652325,652327,652328,652701,652722,652723,652801,652822,652823,652824,652825,652826,652827,652828,652829,652901,652922,652923,652924,652925,652926,652927,652928,652929,653001,653022,653023,653024,653101,653121,653122,653123,653124,653125,653126,653127,653128,653129,653130,653131,653201,653221,653222,653223,653224,653225,653226,653227,654002,654003,654021,654022,654023,654024,654025,654026,654027,654028,654201,654202,654221,654223,654224,654225,654226,654301,654321,654322,654323,654324,654325,654326,659001,659002,659003,659004);

        $seed = mt_rand(0,3130);//total of region code
        $Birth = mt_rand($Year_start,$Year_end);
        $Birth_format = date('Ymd',$Birth);
        $suffix_a = mt_rand(0,9);
        $suffix_b = mt_rand(0,9);
        $suffix_c = mt_rand(0,9);//male or female
        $base = $Region[$seed].$Birth_format.$suffix_a.$suffix_b.$suffix_c;

        $content = $base.self::calc_suffix_d($base);
        return $content;
    }

    public static function getBirthyears()
    {/*{{{*/
        $thisYear = Util::ThisYear();
        $start = $thisYear-100;
        $array = array();

        for($start; $start <= $thisYear; $start ++)
        {
            $array[$start] = $start;
        }
        return $array;
    }/*}}}*/

    public static function getYMFormatDate ($date)
    {
       return  date('Y年m月',strtotime($date));
    }
    public static function getMDFormatDate ($date)
    {
       return  date('m月d日',strtotime($date));
    }
    public static function genRandomEmail()
    {
        $email = "";

        $domains = array('@163.com', '@hotmail.com', '@qq.com', '@gmail.com', '@263.com', '@126.com', '@yeah.net', '@sina.com', '@sina.cn', '@sohu.com');
        $len = mt_rand(5,12);

        for ($i=1; $i<=$len; $i++)
        {
            $c = '';

            $o = mt_rand(1,3);
            if ($o == 1)
            {
                $c = chr(mt_rand(ord('a'),ord('z')));
            }
            else if ($o == 2)
            {
                $c = chr(mt_rand(ord('A'),ord('Z')));
            }
            else if ($o == 3)
            {
                $c = chr(mt_rand(ord(0),ord(9)));
            }

            $email .= $c;
        }

        $email .= $domains[array_rand($domains)];

        return $email;
    }

    public static function filterEmoji($string)
    {/*{{{*/
        //designed for comment content,temporary disabled
        //return $string;
        if(strlen($string) < 4) return $string;

        $convertString = '';
        for($i=0; ; $i++)
        {
            $char = mb_substr($string, $i, 1, 'utf-8');
            if($char !== '0' && kempty($char)  ) break;

            if(mb_strlen($char) > 3) continue;
            $convertString .= $char;
        }

        return $convertString;
    }/*}}}*/

    public static function calMedian($array)
    {/*{{{*/
        $median = 0;
        sort($array);
        $count = count($array);
        if($count%2 == 0)
        {
            $n = $count/2;
            $median = ($array[$n-1]+$array[$n])/2;
        }else
        {
            $median = $array[($count+1)/2-1];
        }
        return $median;
    }/*}}}*/

    public static function genRandomEmailByChinese($chineseName)
    {/*{{{*/
        $email = "";
        $py = new Pinyin();

        $domains = array('@163.com', '@hotmail.com', '@qq.com', '@gmail.com', '@263.com', '@126.com', '@yeah.net', '@sina.com', '@sina.cn', '@sohu.com');

        $o = mt_rand(1,36);
        if ($o == 1) // 全拼 大写 无分隔符 , 加年月 无分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 2) // 全拼 大写 无分隔符 , 加年月 _分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 3) // 全拼 大写 无分隔符 , 加年月 -分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 4) // 全拼 大写 _分隔符 , 加年月 无分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 5) // 全拼 大写 _分隔符 , 加年月 _分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 6) // 全拼 大写 _分隔符 , 加年月 -分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 7) // 全拼 大写 -分隔符 , 加年月 无分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 8) // 全拼 大写 -分隔符 , 加年月 _分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 9) // 全拼 大写 -分隔符 , 加年月 -分隔符
        {
            $pyStr = strtoupper($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 10) // 全拼 小写 无分隔符 , 加年月 无分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 11) // 全拼 小写 无分隔符 , 加年月 _分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 12) // 全拼 小写 无分隔符 , 加年月 -分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,""));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 13) // 全拼 小写 _分隔符 , 加年月 无分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 14) // 全拼 小写 _分隔符 , 加年月 _分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 15) // 全拼 小写 _分隔符 , 加年月 -分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"_"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 16) // 全拼 小写 -分隔符 , 加年月 无分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 17) // 全拼 小写 -分隔符 , 加年月 _分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "_" . $randstr . $domains[array_rand($domains)];
        }
        else if ($o == 18) // 全拼 小写 -分隔符 , 加年月 -分隔符
        {
            $pyStr = strtolower($py->str2py($chineseName,"-"));
            $randstr = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $email = $pyStr . "-" . $randstr . $domains[array_rand($domains)];
        }

        else if ($o == 19) // 简拼 大写 无分隔符 , 加年月 无分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 20) // 简拼 大写 无分隔符 , 加年月 无分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 21) // 简拼 大写 无分隔符 , 加年月 无分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 22) // 简拼 大写 无分隔符 , 加年月 _分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 23) // 简拼 大写 无分隔符 , 加年月 _分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 24) // 简拼 大写 无分隔符 , 加年月 _分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 25) // 简拼 大写 无分隔符 , 加年月 -分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 26) // 简拼 大写 无分隔符 , 加年月 -分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 27) // 简拼 大写 无分隔符 , 加年月 -分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtoupper($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 28) // 简拼 小写 无分隔符 , 加年月 无分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 29) // 简拼 小写 无分隔符 , 加年月 无分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 30) // 简拼 小写 无分隔符 , 加年月 无分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 31) // 简拼 小写 无分隔符 , 加年月 _分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 32) // 简拼 小写 无分隔符 , 加年月 _分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 33) // 简拼 小写 无分隔符 , 加年月 _分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "_" . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 34) // 简拼 小写 无分隔符 , 加年月 -分隔符 , 加随机数 无分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 35) // 简拼 小写 无分隔符 , 加年月 -分隔符 , 加随机数 _分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . "_" . $randstr2 . $domains[array_rand($domains)];
        }
        else if ($o == 36) // 简拼 小写 无分隔符 , 加年月 -分隔符 , 加随机数 -分隔符
        {
            $pyStr = strtolower($py->getShortPinyin($chineseName));
            $randstr1 = sprintf("%02d%02d", mt_rand(1,12), mt_rand(1,30));
            $randstr2 = mt_rand(1000,9999);
            $email = $pyStr . "-" . $randstr1 . "-" . $randstr2 . $domains[array_rand($domains)];
        }

        return $email;
    }/*}}}*/
    public static function convertIpAddress ($ipAddress)
    {
        $ipItem = explode('.',$ipAddress);
        if(count($ipItem) <> 4) return 0;
        return $ipItem[0] * 256 * 256 * 256 + $ipItem[1] * 256 * 256 + $ipItem[2] * 256 + $ipItem[3]; 
    } 

    /**
     * 返回N个工作日前的日期
     * 默认返回17个工作日
     * 返回日期 eg: 2013-09-12
     */

    function subWorkday($day = 17,$sdate = null) 
    {
        $day = $day+1;
        $now = kempty($sdate) ? time () : strtotime($sdate);
        $m = 24 * 60 * 60;  //一天的秒数
        for($i = 0; $i <= 100; $i ++) {  //超过一百天无法计算
            $diff = $now - $i * $m;
            $date = date ( "Y-m-d H:i:s", $diff );
            $week = date ( 'N', $diff );    //返回一个星期几,一周中的第N天

            if (! in_array ( $week, array ('6', '7') )) {       //周末不计算
                $day --;
            }
            if ($day == 0) {    //到达17个工作日就结束循环
                break;
            }
        }
        return $date;
    }

    /*
     *i返回当前日期后的某一天的日期
     */
    public static function nowAfterDay($days,$format="Y-m-d H:i:s")
    {
        return date($format,strtotime("+{$days} days"));
    }

    /*
     * 数字转中文
     */
    public static function toChinaseNum($num)
    {
        $char = array("零","一","二","三","四","五","六","七","八","九");
        $dw = array("","十","百","千","万","亿","兆");
        $retval = "";
        $proZero = false;
        for($i = 0;$i < strlen($num);$i++) {
            if($i > 0) {
                $temp = (int)(($num % pow (10,$i+1)) / pow (10,$i));
            } else {
                $temp = (int)($num % pow (10,1));
            }
            if($proZero == true && $temp == 0) continue;
                        
            if($temp == 0) $proZero = true;
            else $proZero = false;
            
            if($proZero) {
                if($retval == "") continue;
                $retval = $char[$temp].$retval;
            } else {
                $retval = $char[$temp].$dw[$i].$retval;
            }
        }
        if($retval == "一十") $retval = "十";
        return $retval;
    }


    public static function emoji_encode($string){
        $strEncode = '';
        $length = mb_strlen($string,'utf-8');
        for ($i=0; $i < $length; $i++) {
            $_tmpStr = mb_substr($string,$i,1,'utf-8');
            if(strlen($_tmpStr) >= 4){
                $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
            }else{
                $strEncode .= $_tmpStr;
            }
        }
        return $strEncode;
    }

    public static function emoji_decode($string)
    {
        $pattern = '/\[\[EMOJI:(.*?)\]\]/';
        $str = preg_replace($pattern,"$1",$string);
        $str = rawurldecode($str);
        return $str;
    }

    public static function substr_cut_username($user_name){
        $strlen     = mb_strlen($user_name, 'utf-8');
        $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
        return $firstStr . str_repeat("*", $strlen - 1) ;
    }

    public static function substr_cut_mobile($mobile){
        $strlen     = strlen($mobile);
        $firstStr     = substr($mobile, 0, 3);
        $lastStr     = substr($mobile, $strlen-3, 3);
        return $firstStr . str_repeat("*", $strlen - 6). $lastStr ;
    }
}

?>
