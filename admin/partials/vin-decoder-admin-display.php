<?php ?>

<form action="options.php" method="post">
	<?php settings_fields( 'vd_settings' );
	do_settings_sections( 'vd_settings' );
	submit_button( 'save settings');
	?>
</form>