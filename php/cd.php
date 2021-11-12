<?php
$cuowuurl="Error！";
$id=$_GET['id'];
if($id){
        $url="http://www.cditv.cn/show-192-".$id."-1.html";
        $info=file_get_contents($url);
        preg_match('|<embed src=\'(.*?)\' quality=\'high\' width|i',$info,$m);
        $xor=$m[1];
        if ($xor) {
                header('location:'.$m[1]);
        }else{
                echo "该视频不存在";
        }
}else{
        Get_CW();
}
function Get_CW(){
        echo $cuowuurl;
        exit;
}

?>