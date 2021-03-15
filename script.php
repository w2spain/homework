<?php

// Command line execution:
// php index.php --url=XXXXXXXX

$val = getopt(null, ["url:"]);
$url = $val['url'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$head = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $head;
