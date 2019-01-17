#!/usr/bin/php -d open_basedir=/usr/syno/bin/ddns
<?php

if ($argc !== 5) {
    echo 'badparam';
    exit();
}

$tmp = shell_exec('ip -6 addr | grep -E inet6.*global');

preg_match('/inet6.([^\/]+).*global/', $tmp, $matches);

if (count($matches) !== 2) {
    echo 'internal error';
    exit();
}

$account = strval($argv[1]);
$password = strval($argv[2]);
$hostname = strval($argv[3]);
$ip = $matches[1];

$url = sprintf(
    'https://update.spdyn.de/nic/update?hostname=%s&myip=%s',
    $hostname,
    $ip
);

try {
    $req = curl_init($url);
    curl_setopt($req, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($req, CURLOPT_USERPWD, "$account:$password");
    $res = curl_exec($req);
    curl_close($req);
} catch (Exception $e) {
    echo 'internal error';
    exit();
}

echo 'good';