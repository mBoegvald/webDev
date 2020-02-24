    <?php 


    
        $name = $_GET["name"];
        $test = "home";
        require_once('top.php'); 
    ?>
    
    <h1>HOME</h1>

    <script>
        console.log("<?= $name; ?>");
        
    </script>

</body>
</html>