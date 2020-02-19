<?php
$sData = file_get_contents('https://kea.dk');
$sData = str_replace(
  'Hver tredje KEA-studerende får arbejde gennem studiejob og praktik', 
  'NICE PROXY', 
  $sData);
echo $sData;