<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>

    <form onsubmit="return validate()">
        <label>Name(2-20 characters)</label>
        <input oninput="validate()" type="text" data-validate="string" data-min="2" data-max="5">
        <label>Lastname(2-20 characters)</label>
        <input oninput="validate()" type="text" data-validate="string" data-min="2" data-max="5">
        <label>Price</label>
        <input oninput="validate()" type="text" data-validate="integer" data-min="1" data-max="99999">
        <label>Email</label>
        <input oninput="validate()" type="text" data-validate="email">

        <button>Sign up</button>

    </form>

    <script src="validate.js"></script>
</body>
</html>