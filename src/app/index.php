<?php
require_once '../../vendor/autoload.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="ajax/createTile.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body style="margin:0px; padding:0px;">
    hello!

    <div id="footer" class="footer">
        <div id="footer_parts">
            <div class="footer_left"></div>
            <div class="footer_center">
                <div id="add_button" class="add_button"></div>
                <div id="confirm_button" class="confirm_button" onclick="submitLink();"></div>
            </div>
            <div class="footer_right">
                <div id="close_icon" class="close_icon"></div>
            </div>
			<div id="insert_area" class="insert_area">
				<input type="text" id="url" />
			</div>
        </div>
    </div>
    <script type="text/javascript">
		$("#close_icon").click(function() {
			if ( $("#footer").height() != 50) {
				$("#footer").animate({height: 50}, 300);
				$("#confirm_button").delay(0).hide(0);
				$("#add_button").delay(300).show(0);
				$("#close_icon").delay(300).hide(0);
				$("#insert_area").delay(300).hide(0);
			}
		});
        $("#add_button").click(function() {
            $("#footer").animate({height: 200}, 300);
			$("#confirm_button").delay(0).show(0);
            $("#add_button").delay(300).hide(0);
            $("#close_icon").delay(300).show(0);
            $("#insert_area").delay(300).show(0);
        });

    </script>
    </body>
</html>