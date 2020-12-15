<?php
/*
 Telegram.me/OneProgrammer
 Telegram.me/SpyGuard
                   ----[ Lotfan Copy Right Ro Rayat Konid <3 ]----
############################################################################################
# if you need Help for develop this source , You Can Send Message To Me With @SpyGuard_BOT #
############################################################################################
*/
define('API_KEY','BOTTOKEN');
//----######------

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
$chat_id = @$update->message->chat->id;
$message_id = @$update->message->message_id;
$from_id = @$update->message->from->id;
$name = @$update->message->from->first_name;
$username = @$update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$reply = isset($update->message->reply_to_message->forward_from->id)?$update->message->reply_to_message->forward_from->id:'';
$forward = @$update->message->forward_from;


$photo = @$update->message->photo;
$video = @$update->message->video;
$sticker = @$update->message->sticker;
$file = @$update->message->document;
$music = @$update->message->audio;
$voice = @$update->message->voice;

$admins  = [66443035,0];
//-------
function SendMessage($ChatId, $TextMsg,$message_id = null,$parse_mode="MarkDown",$keyboard=null)
{
   makereq('sendMessage',[
  'chat_id'=>$ChatId,
  'text'=>$TextMsg,
  'parse_mode'=>$parse_mode,
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>$keyboard

  ]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function is_admin($from_id){
global $admins;
   return in_array($from_id,$admins)?true:false;
}
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
//===========


 if($textmessage == '/start')
{
SendMessage($chat_id,"*Welcome* `#$name` :)\nYou Can Change This ;)");
}
elseif ($textmessage == '/fwrd')
{
SendMessage($chat_id,"Now I Forward Your Text To You :X");
Forward($chat_id,$chat_id,$message_id);
}
elseif ($textmessage == '/inlinekb')
{
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"_This Is Simple Inline Keyboard Only For Only for_ *training*",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [
                    ['text'=>"Join SpyGuard Channel 👑",'url'=>"https://telegram.me/SpyGuard"]
                ]
            ]
        ])
    ]));
}
else
{
SendMessage($chat_id,"*Command Not Found*");
}


?>
