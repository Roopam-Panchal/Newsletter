<?php 

/**
 * Add Metaboxx
 */
function myplugin_add_subscribe_metaboxes() {
    add_meta_box(
        'myplugin_movie_metabox_id',
        'Subscriber Options',
        'myplugin_subscribe_metaboxes_template',
        'subscriber'
    );
}
add_action( 'add_meta_boxes', 'myplugin_add_subscribe_metaboxes' );

/**
 * Metabox Template
 */
function myplugin_subscribe_metaboxes_template($post) {

    $first_name         = get_post_meta( $post->ID, '_first_name', true );
    $sub_email       = get_post_meta( $post->ID, '_sub_email', true );
    $last_name             = get_post_meta( $post->ID, '_last_name', true );
    // $sub_cat         = get_post_meta( $post->ID, '_sub_cat', true );
    $sub_check        = get_post_meta( $post->ID, '_sub_check', true );
    $sub_check2        = get_post_meta( $post->ID, '_sub_check2', true );


    ?>
    <table>
        <tr>
            <td>First Name: </td>
            <td>
                <input type="text" class="regular-text" name="first_name" value="<?php echo myplugin_get_subscriber_metavalues($first_name); ?>" required/>
            </td>
        </tr>
        <tr>
            <td>Last Name: </td>
            <td>
            <input type="text" class="regular-text" name="last_name" value="<?php echo myplugin_get_subscriber_metavalues($last_name); ?>" />
            </td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>
                <input type="email" class="regular-text" name="sub_email" value="<?php echo myplugin_get_subscriber_metavalues($sub_email); ?>" />
            </td>
        </tr>
        <!-- <tr>
            <td>Category: </td>
            <td>
                <select name="sub_cat" class="regular-text">
                    <option value="">Select One</option>
                    <option value="Business" <?php // selected('Business', myplugin_get_subscriber_metavalues($sub_cat) ); ?>>Business</option>
                    <option value="Electronics" <?php // selected('Electronics', myplugin_get_subscriber_metavalues($sub_cat) ); ?>>Electronics</option>
                </select>
            </td>
        </tr> -->
        <tr>
            <td>Tick If, interested: </td>
            <td>
                <input type="checkbox" name="sub_check" class="regular-text" value="ON" <?php checked( 'ON', myplugin_get_subscriber_metavalues($sub_check) ); ?> />
            </td>
        </tr>
        <tr>
            <td>Privacy Policy: </td>
            <td>
                <input type="checkbox" name="sub_check2" class="regular-text" value="ON" <?php checked( 'ON', myplugin_get_subscriber_metavalues($sub_check2) ); ?> />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save metabox values
 */
function myplugin_save_subscriber_metabox_values($post_id) {

    if( isset($_POST['first_name']) ) {
        update_post_meta( $post_id, '_first_name', sanitize_text_field($_POST['first_name']) );
    }
    if( isset($_POST['sub_email']) ) {
        update_post_meta( $post_id, '_sub_email', sanitize_email($_POST['sub_email']) );
    }
    if( isset($_POST['last_name']) ) {
        update_post_meta( $post_id, '_last_name', sanitize_text_field($_POST['last_name']) );
    }
    // if( isset($_POST['sub_cat']) ) {
    //     update_post_meta( $post_id, '_sub_cat', sanitize_text_field($_POST['sub_cat']) );
    // }

    if( isset($_POST['sub_check']) ) {
        update_post_meta( $post_id, '_sub_check', 'ON' );
    }else {
        update_post_meta( $post_id, '_sub_check', 'OFF' );
    }
    if( isset($_POST['sub_check2']) ) {
        update_post_meta( $post_id, '_sub_check2', 'ON' );
    }else {
        update_post_meta( $post_id, '_sub_check2', 'OFF' );
    }
    
}
add_action('save_post', 'myplugin_save_subscriber_metabox_values');

/**
 * Get the movie metavalues
 */
function myplugin_get_subscriber_metavalues($value) {
    if( isset($value) && ! empty($value) ) {
        return $value;
    }else {
        return '';
    }
}