<?php 
header("Access-Control-Allow-Origin: *");
$imei=$_GET['devid'];
if(isset($imei)&& $imei!=NULL)
{
$imfile="loclog/".$imei.".txt";
$line = '';

$f = fopen($imfile, 'r');
$cursor = -1;

fseek($f, $cursor, SEEK_END);
$char = fgetc($f);

/**
 * Trim trailing newline chars of the file
 */
while ($char === "\n" || $char === "\r") {
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}

/**
 * Read until the start of file or first newline char
 */
while ($char !== false && $char !== "\n" && $char !== "\r") {
    /**
     * Prepend the new char
     */
    $line = $char . $line;
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}

$buff= explode(',',$line);
//echo $buff[999999999];
$infoarr= array('hq' => $buff[0], 'imei' => $buff[1] , 'CMD' => $buff[2], 'hhmmss' => $buff[3], 'valid' => $buff[4], 'lat' => $buff[5], 'NS' => $buff[6], 'long' => $buff[7], 'EW' => $buff[8], 'speed' => $buff[9], 'direction' => $buff[10], 'date' => $buff[11], 'VS' => $buff[12]);


echo json_encode($infoarr); 






    } 
else
{
echo "please provide Device Id!";
}

?> 

