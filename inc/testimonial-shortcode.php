<?php
// Add Shortcode
function wcd_testimonial_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'qty' => '1',
			'slide' => 'false',
		),
		$atts
	);

	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'testimonial' ),
		'posts_per_page'         => $atts['qty'],
	);
	
	if ( $atts['slide'] == 'true' ) {
	    $slide = 'testimonial-slider';
	}
	// The Query
	$query = new WP_Query( $args );
	
	// The Loop
	if ( $query->have_posts() ) {
	    echo '<div class="testimonals ' . $slide . '">';
		while ( $query->have_posts() ) {
	        $query->the_post(); 
	        $wcd_author_company = get_post_meta( $post->ID, 'wcd_author_company', true );
			$wcd_company_url = get_post_meta( $post->ID, 'wcd_company_url', true );
	        $wcd_author_position = get_post_meta( $post->ID, 'wcd_author_position', true );
	        if ( $wcd_company_url ) {
	            $company = '<a href="' . $wcd_company_url . '">' . $wcd_author_company . '</a>';
	        } else {
	            $company = $wcd_author_company;
	        }
	        ?>
			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                <div class="content">
	                    <?php the_content(); ?>
	                    <div class="testimonial-info">
	                        <?php the_title( '<h3 class="author-name">', '</h3>' ); ?>
	                        <p class="company-info"><?php echo $wcd_author_position; ?> | <?php echo $company; ?></p>
	                    </div>
	                </div><!-- content -->
	            </article>
		<?php }
		echo '</div><!-- testimonials -->';
	} else {
		// no posts found
	}
	
	// Restore original Post Data
	wp_reset_postdata();

}
add_shortcode( 'testimonial', 'wcd_testimonial_shortcode' );