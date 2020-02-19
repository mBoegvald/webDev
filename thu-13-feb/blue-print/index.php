<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
</head>
<body>

<div id="items">
    <div class="item">
        <?php
            $sData = file_get_contents("data.json");
            $jData = json_decode($sData);
            $sBluePrint = file_get_contents("blueprint.html");
            $sCopy = $sBluePrint;
            $sCopy = str_replace('{{name}}', $jData[0]->name, $sBluePrint);
            $sCopy = str_replace('{{price}}', $jData[0]->price, $sCopy);
            echo $sCopy;

        ?>
    </div>
</div>

<button onclick="getItems()">Get more items</button>    

<script>

    let sBluePrint = `<?php echo $sBluePrint; ?>`;
    
    async function getItems(){
        let jResponse = await fetch("api-get-items.php");
        let jData = await jResponse.json();
        let sCopy = sBluePrint;
        let sItem = sCopy.replace('{{name}}', jData[1].name);
        sItem = sItem.replace('{{price}}', jData[1].price);
        document.getElementById("items").insertAdjacentHTML('beforeend',sItem);
    }

    async function sendInfo() {
        let message = document.querySelector("input").value;
        let url = `api-send-sms.php?message=${message}`;
        let jResponse = await fetch(url);
        console.log(jResponse);
    }

</script>
</body>
</html>