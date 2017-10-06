<?php
/*
 Telegram.me/OneProgrammer
 Telegram.me/SpyGuard
                   ----[ Lotfan Copy Right Ro Rayat Konid <3 ]----
############################################################################################
# if you need Help for develop this source , You Can Send Message To Me With @SpyGuard_BOT #
############################################################################################
*/
define('API_KEY',"PUT YOUR BOT TOKEN HERE");
define('path',"https://api.telegram.org/bot".API_KEY."/");

function objectToArray( $object ) {
  if( !is_object( $object ) && !is_array( $object ) ) {
    return $object;
  }
  if( is_object( $object ) ) {
    $object = get_object_vars( $object );
  }
  return array_map( "objectToArray", $object );
}

function request($method,$data = []) {
  //$data = json_decode($data);
  $result = file_get_contents(path.$method."?".http_build_query($data));
  return objectToArray(json_decode($result));

}
function getme() {
  return request("getme");
}
$bot_username = getme()["result"]["username"];
$bot_name = getme()["result"]["first_name"];
$bot_id = getme()["result"]["id"];

echo "Bot <a href=\"https://t.me/$bot_username\">$bot_name</a> runned successfully ;)
<br>
Developed By <a href=\"https://mehrab.xyz\">M3HR4B</a>";
?>
