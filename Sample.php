<?php
$script = file_get_contents("botadd.txt"); //inja matne script khodet Ro Qarar Midi Dakhele Ye FIle TXT;)
$un = ""; //username bot jadid bas bezari to in moteqayer
$myfile = fopen($un.".php", "w") or die("Unable to open file!");
$script = str_replace("BOTTOKENISHERE", $userTEXT , $script); 
//toye script khodet ke qarar Copy She , Hatman Jayi Ke Token Migire Ro Be "BOTTOKENISHERE" Taqir Bede !!
fwrite($myfile, $script);
	fclose($myfile);
?>
