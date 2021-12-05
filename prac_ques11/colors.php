<?php
	$background_colour = array('white','green','red','yellow','blue','orange','black','purple','peach','cyan');
    $rand_background = $background_colour[array_rand($background_colour)];
    
?>
<html>
	<head>
    </head>
    <body style="background: <?php echo $rand_background;?>;">
    
    </body>
</html>