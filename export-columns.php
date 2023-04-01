<?php
function admin_post_list_add_export_button( $which ) {
    global $typenow;
    if ( 'subscriber' === $typenow && 'top' === $which ) {
        ?>
        <input type="submit" name="aweb_export_posts" class="button button-primary" value="<?php _e('Export Posts'); ?>" />
        <?php
    }
}
add_action( 'manage_posts_extra_tablenav', 'admin_post_list_add_export_button');

function aweb_export_posts() {
    if(isset($_GET['aweb_export_posts'])) {
        $args = array(
            'post_type' => 'subscriber',
            'post_status' => 'publish',
        );
 
        if ( isset($_GET['post']) ) {
            $args['post__in'] = $_GET['post'];
        } else {
            $args['posts_per_page'] = -1;
        }
  
        global $post;
        $arr_post = get_posts($args);
        if ($arr_post) {
  
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="wp-posts.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
  
            $file = fopen('php://output', 'w');
  
            fputcsv($file, array('Post ID', 'First Name', 'Last Name', 'Email','Tick, if interested', 'Privacy Policy'));
  
            foreach ($arr_post as $post) {
                setup_postdata($post);
				$fname = get_post_meta( get_the_ID(), '_first_name', TRUE );
				$lname = get_post_meta( get_the_ID(), '_last_name', TRUE );
				$email = get_post_meta( get_the_ID(), '_sub_email', TRUE );
				$sub_check = get_post_meta( get_the_ID(), '_sub_check', TRUE );
				$sub_check2 = get_post_meta( get_the_ID(), '_sub_check2', TRUE );

                $categories = get_the_category();
                $cats = array();
                if (!empty($categories)) {
                    foreach ( $categories as $category ) {
                        $cats[] = $category->name;
                    }
                }
  
                $post_tags = get_the_tags();
                $tags = array();
                if (!empty($post_tags)) {
                    foreach ($post_tags as $tag) {
                        $tags[] = $tag->name;
                    }
                }
  
                fputcsv($file, array(get_the_ID(), $fname, $lname,$email, $sub_check, $sub_check2));
            }
  
            exit();
        }
    }
}
 
add_action( 'admin_init', 'aweb_export_posts' );