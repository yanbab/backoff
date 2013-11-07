<?php

$url = url_segment(2);

if(!$url) $url = "https://www.google.com/analytics/reporting/?reset=1&id=4130661&scid=2239843";
else $url="http://$url";
