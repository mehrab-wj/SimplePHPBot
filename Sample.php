<?php
//Telegram.me/OneProgrammer
//Telegram.me/SpyGuard
//----------------------Lotfan Copy Right Ro Rayat Konid <3
define('API_KEY','BOTTOKEN');
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//---------
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$username = $update->message->from->username;
$userTEXT = isset($update->message->text)?$update->message->text:'';
$admin = 66443035;
//------
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}

if($userTEXT == '/start')
{
SendMessage($chat_id,"Welcome");
}
else
{
SendMessage($chat_id,"Command Not Found");
}

?>
