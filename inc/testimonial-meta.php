<?php
class wcd_testimonial_cpt_fields {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'author_info',
			__( 'Author Info', 'translate' ),
			array( $this, 'render_metabox' ),
			'testimonial',
			'side',
			'high'
		);

	}

	public function render_metabox( $post ) {

		// Retrieve an existing value from the database.
		$wcd_author_company = get_post_meta( $post->ID, 'wcd_author_company', true );
		$wcd_company_url = get_post_meta( $post->ID, 'wcd_company_url', true );
		$wcd_author_position = get_post_meta( $post->ID, 'wcd_author_position', true );

		// Set default values.
		if( empty( $wcd_author_company ) ) $wcd_author_company = '';
		if( empty( $wcd_company_url ) ) $wcd_company_url = '';
		if( empty( $wcd_author_position ) ) $wcd_author_position = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="wcd_author_company" class="wcd_author_company_label">' . __( 'Company Name', 'translate' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="wcd_author_company" name="wcd_author_company" class="wcd_author_company_field" placeholder="' . esc_attr__( '', 'translate' ) . '" value="' . esc_attr( $wcd_author_company ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="wcd_company_url" class="wcd_company_url_label">' . __( 'Company URL', 'translate' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="url" id="wcd_company_url" name="wcd_company_url" class="wcd_company_url_field" placeholder="' . esc_attr__( '', 'translate' ) . '" value="' . esc_attr( $wcd_company_url ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="wcd_author_position" class="wcd_author_position_label">' . __( 'Author Position', 'translate' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="wcd_author_position" name="wcd_author_position" class="wcd_author_position_field" placeholder="' . esc_attr__( '', 'translate' ) . '" value="' . esc_attr( $wcd_author_position ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Sanitize user input.
		$wcd_new_author_company = isset( $_POST[ 'wcd_author_company' ] ) ? sanitize_text_field( $_POST[ 'wcd_author_company' ] ) : '';
		$wcd_new_company_url = isset( $_POST[ 'wcd_company_url' ] ) ? esc_url( $_POST[ 'wcd_company_url' ] ) : '';
		$wcd_new_author_position = isset( $_POST[ 'wcd_author_position' ] ) ? sanitize_text_field( $_POST[ 'wcd_author_position' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'wcd_author_company', $wcd_new_author_company );
		update_post_meta( $post_id, 'wcd_company_url', $wcd_new_company_url );
		update_post_meta( $post_id, 'wcd_author_position', $wcd_new_author_position );

	}

}

new wcd_testimonial_cpt_fields;