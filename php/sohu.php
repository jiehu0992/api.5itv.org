<?php
header("Content-type:text/xml; charset=UTF-8");
define("URL",'http://'.$_SERVER['SERVER_NAME'].$_SERVER["SCRIPT_NAME"]);
if (isset ($_GET['lid'])){
$lid=$_GET['lid'];
$url_1="http://live.tv.sohu.com/live/player_json.jhtml?encoding=UTF-8&lid=".$lid."&type=1&af=1&out=0&g=8";
$url_2=g_contents($url_1);
$json=J($url_2);
$clipsURL = $json -> data -> clipsURL[0];
$src= $clipsURL;
$url_v=g_contents("http://".$src);
$json_v=J($url_v);
$v_url=$json_v -> url;
header("location:$v_url");
exit();
}else{
$url="http://tvimg.tv.itc.cn/live/stations.jsonp";
$url=g_contents($url);
preg_match_all('/{var par=(.*);channelList/imsU',$url,$data);
$json=J($data[1][0])->STATIONS;
foreach($json as $key=>$value){
$IsSohuSource  = $value -> IsSohuSource;
$STATION_ID = $value -> STATION_ID;
$STATION_NAME = $value -> STATION_NAME;
$STATION_PIC = $value -> STATION_PIC;
if($IsSohuSource == 1){
 $xml.='<m type="tv" src="'.URL.'?lid='.$STATION_ID.'" label="'.$STATION_NAME.'" image="'.$STATION_PIC.'" />'."\n";
}
$list="<list>\n".$xml."</list>\n";
}
echo $list;
}
function g_contents($url) {
        $user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $ch = curl_init ();
        $timeout = 30;
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt ( $ch, CURLOPT_USERAGENT, $user_agent );
        @ $c = curl_exec ( $ch );
        curl_close ( $ch );
        return $c;
}
function J($s) {
        return json_decode($s);
}
?>