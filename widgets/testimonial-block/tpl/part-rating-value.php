<?php if ( $settings['show_rating'] == 'yes' ) { ?>
<?php
	$rating = $rating['size'];
	if( is_numeric( $rating ) && $rating > 0) {
		if( $rating > 5 ) {
			$rating = 5;
		}
	} else {
		$rating = 0;
	}
?>
	<?php echo $rating; ?>
<?php } ?>