<?php
function my_theme_enqueue_styles() {

    $parent_style = 'unite-style'; // This is 'unite-style' for the unite theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'unite-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style( 'unite-child-datepicker-css',
        get_stylesheet_directory_uri() . '/bootstrap-datepicker.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_scripts_method() {
    $parent_js = 'unite-bootstrapjs'; // This is 'unite-bootstrapjs' for the unite theme.
    wp_enqueue_script(
        $parent_js,
        get_template_directory_uri() . '/inc/js/bootstrap.min.js',
        array( 'jquery' )
    );
    wp_enqueue_script(
        'unite-functions',
        get_template_directory_uri() . '/inc/js/main.min.js',
        array( 'jquery' )
    );
    wp_enqueue_script(
        'unite-child-datepicker',
        get_template_directory_uri() . '/bootstrap-datepicker.js',
        array( 'jquery' )
    );
	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// wp_enqueue_script( 'comment-reply' );
	// }
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

// Our custom post type function
function create_posttype() {
 
    register_post_type( 'Films',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Films' ),
                'singular_name' => __( 'Film' )
            ),
            'taxonomies' => array( 'genre', 'country', 'year', 'actors' ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Films'),
        )
    );
    register_taxonomy_for_object_type( 'category', 'Films' );
	register_taxonomy_for_object_type( 'post_tag', 'Films' );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'Films', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
    global $post;  
    
		$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

  <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

  <p>
    <label for="your_fields[ticket_price]">Ticket Price</label>
    <br>
    <input type="text" name="your_fields[ticket_price]" id="your_fields[ticket_price]" class="regular-text" value="<?php if (is_array($meta) && isset($meta['ticket_price'])) {	echo $meta['ticket_price']; } ?>">
  </p>
  <p>
    <label for="your_fields[release_date]">Release Date</label>
    <br>
    <input type="text" name="your_fields[release_date]" id="your_fields[release_date]" class="regular-text datepicker" value="<?php if (is_array($meta) && isset($meta['release_date'])) {	echo $meta['release_date']; } ?>">
  </p>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  <script>
    jQuery(document).ready(function ($) {
            $('.datepicker').datepicker({ 
                autoclose: true,   
                format: 'yyyy-mm-dd'
             });  
    });
  </script>

  <?php }
function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( isset($_POST['your_meta_box_nonce']) 
			&& !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id; 
		}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if (isset($_POST['post_type'])) { //Fix 2
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }  
        }
    }
	
	$old = get_post_meta( $post_id, 'your_fields', true );
		if (isset($_POST['your_fields'])) { //Fix 3
			$new = $_POST['your_fields'];
			if ( $new && $new !== $old ) {
				update_post_meta( $post_id, 'your_fields', $new );
			} elseif ( '' === $new && $old ) {
				delete_post_meta( $post_id, 'your_fields', $old );
			}
		}
}
add_action( 'save_post', 'save_your_fields_meta' );

?>