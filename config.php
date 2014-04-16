<?php
	include widget_config_form('title');
	include widget_config_form( 'forum', array(	'no' => 9 ) );
	for ($i=1; $i<=9; $i++) {
		echo "<span class='caption'>Menu $i Name:</span> : <input type='text' name='post-with-image-2-menu-name$i' value='".$widget_config['post-with-image-2-menu-name'.$i]."'/><br>";
	}
	include widget_config_form('css');
	
	