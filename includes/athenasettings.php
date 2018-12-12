<?php
/*
Includes sidebar fields and customizer entries
 */

 class UCF_settings_Meta_Box {

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
 			'ucf-athena-settings',
 			'UCF Athena Settings',
 			array( $this, 'render_metabox' ),
 			array( 'post', ' page' ),
 			'side',
 			'default'
 		);

 	}

 	public function render_metabox( $post ) {

 		// Add nonce for security and authentication.
 		wp_nonce_field( 'athena_setting_nonce_action', 'athena_setting_nonce' );

 		// Retrieve an existing value from the database.
 		$athena_setting_sidebar = get_post_meta( $post->ID, 'athena_setting_sidebar', true );
 		$athena_setting_content_layout = get_post_meta( $post->ID, 'athena_setting_content-layout', true );
 		$athena_setting_disable = get_post_meta( $post->ID, 'athena_setting_disable', true );

 		// Set default values.
 		if( empty( $athena_setting_sidebar ) ) $athena_setting_sidebar = '';
 		if( empty( $athena_setting_content_layout ) ) $athena_setting_content_layout = '';
 		if( empty( $athena_setting_disable ) ) $athena_setting_disable = array();

 		// Form fields.
 		echo '<table class="form-table">';

 		echo '	<tr>';
 		echo '		<th><label for="athena_setting_sidebar" class="athena_setting_sidebar_label">' . 'Sidebar' . '</label></th>';
 		echo '		<td>';
 		echo '			<select id="athena_setting_sidebar" name="athena_setting_sidebar" class="athena_setting_sidebar_field">';
 		echo '			<option value="athena_setting_right_sidebar " ' . selected( $athena_setting_sidebar, 'athena_setting_right_sidebar ', false ) . '> ' . ' Right Sidebar' . '</option>';
 		echo '			<option value="athena_setting_left_sidebar " ' . selected( $athena_setting_sidebar, 'athena_setting_left_sidebar ', false ) . '> ' . ' Left Sidebar' . '</option>';
 		echo '			<option value="athena_setting_no_sidebar " ' . selected( $athena_setting_sidebar, 'athena_setting_no_sidebar ', false ) . '> ' . ' No Sidebar' . '</option>';
 		echo '			</select>';
 		echo '		</td>';
 		echo '	</tr>';

 		echo '	<tr>';
 		echo '		<th><label for="athena_setting_content-layout" class="athena_setting_content-layout_label">' . 'Content Layout' . '</label></th>';
 		echo '		<td>';
 		echo '			<select id="athena_setting_content_layout" name="athena_setting_content-layout" class="athena_setting_content_layout_field">';
 		echo '			<option value="athena_setting_boxed " ' . selected( $athena_setting_content_layout, 'athena_setting_boxed ', false ) . '> ' . ' Boxed' . '</option>';
 		echo '			<option value="athena_setting_full_width " ' . selected( $athena_setting_content_layout, 'athena_setting_full_width ', false ) . '> ' . ' Full Width' . '</option>';
 		echo '			<option value="athena_setting_narrow " ' . selected( $athena_setting_content_layout, 'athena_setting_narrow ', false ) . '> ' . ' Narrow' . '</option>';
 		echo '			</select>';
 		echo '		</td>';
 		echo '	</tr>';

 		echo '	<tr>';
 		echo '		<th><label for="athena_setting_disable" class="athena_setting_disable_label">' . 'Disable' . '</label></th>';
 		echo '		<td>';
 		echo '			<label><input type="checkbox" name="athena_setting_disable[]" class="athena_setting_disable_field" value="' . esc_attr( '' ) . '" ' . ( in_array( '', $athena_setting_disable )? 'checked="checked"' : '' ) . '> ' . '' . '</label><br>';
 		echo '		</td>';
 		echo '	</tr>';

 		echo '</table>';

 	}

 	public function save_metabox( $post_id, $post ) {

 		// Add nonce for security and authentication.
 		$nonce_name   = isset( $_POST['athena_setting_nonce'] ) ? $_POST['athena_setting_nonce'] : '';
 		$nonce_action = 'athena_setting_nonce_action';

 		// Check if a nonce is set.
 		if ( ! isset( $nonce_name ) )
 			return;

 		// Check if a nonce is valid.
 		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
 			return;

 		// Check if the user has permissions to save data.
 		if ( ! current_user_can( 'edit_post', $post_id ) )
 			return;

 		// Check if it's not an autosave.
 		if ( wp_is_post_autosave( $post_id ) )
 			return;

 		// Check if it's not a revision.
 		if ( wp_is_post_revision( $post_id ) )
 			return;

 		// Sanitize user input.
 		$athena_setting_new_sidebar = isset( $_POST[ 'athena_setting_sidebar' ] ) ? $_POST[ 'athena_setting_sidebar' ] : '';
 		$athena_setting_new_content_layout = isset( $_POST[ 'athena_setting_content-layout' ] ) ? $_POST[ 'athena_setting_content-layout' ] : '';
 		$athena_setting_new_disable = isset( $_POST[ 'athena_setting_disable' ] ) ? array_intersect( (array) $_POST[ 'athena_setting_disable' ], array( '' ) )  : array();

 		// Update the meta field in the database.
 		update_post_meta( $post_id, 'athena_setting_sidebar', $athena_setting_new_sidebar );
 		update_post_meta( $post_id, 'athena_setting_content-layout', $athena_setting_new_content_layout );
 		update_post_meta( $post_id, 'athena_setting_disable', $athena_setting_new_disable );

 	}

 }

 new UCF_settings_Meta_Box;
