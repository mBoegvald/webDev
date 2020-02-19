<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
 <form id="frmSignUp" onsubmit="return false">

        <input type="text" name="txtEmail" value="Email">
        <input type="text" name="txtPassword" value="Password">
        <input type="text" name="txtName" value="Name">
        <button onclick="signUp()">Sign up</button>
    </form>

    <script>
        async function signUp() {
            let oForm = document.querySelector("#frmSignUp");

            let jConnection = await fetch("send-email.php", {
            method: "POST",
            body: new FormData(oForm)
            });
            let jResponse = await jConnection.text();
        }

    </script>
</body>
</html>