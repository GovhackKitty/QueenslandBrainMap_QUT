<?php include 'includes/html.inc' ?>
<html>
    <head>
        <?php include 'includes/head.inc' ?>
        <title>QBM: Unavailable</title>
		<script src="js/main.js" type="text/javascript"></script>
    </head>
    
    <body>
        <?php include 'includes/header.inc' ?>
        <div class="contentTab">
            Oops Sorry!
        </div>
        <div class="content">
            <p class="large-font">This Page is currently unavailable</p>
            <?php
                for ($i = 0; $i<10; $i++){
                    echo "<br/>";
                }
            ?>
        </div>
	</body>
</html>