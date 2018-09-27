<?php

require_once('./phpqrcode.php');

if(isset($_GET["url"])) {
    $url = $_GET["url"];
    QRcode::png($url, false, 'H', '6', '1');
}
else {
    echo "<script>window.location.href = '//' + window.location.hostname;</script>";
}

