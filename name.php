<?php 
header("Content-Type: application/json");
http_response_code(200);

// echo '{"name":"A B"}';

$sData = file_get_contents("name.json");
echo $sData;