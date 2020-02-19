<?php
$sData = file_get_contents("https://kea.dk");
$sData = str_replace("HVER TREDJE KEA-STUDERENDE FÅR ARBEJDE GENNEM STUDIEJOB OG PRAKTIK", "MACBOOK PRO", $sData);
echo $sData;