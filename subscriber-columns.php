<?php
function bcw_cpt_columns($lastName){

        $lastName["firstName"] = "First Name";	
        $lastName["lastName"] = "Last Name";
        $lastName["email"] = "Email";
        // $lastName["category"] = "Category";
        $lastName["subCheck1"] = "Tick, if interested";
        $lastName["subCheck2"] = "Privacy Policy";
        return $lastName;
    }
    
    add_filter('manage_edit-subscriber_columns', 'bcw_cpt_columns');
    function bcw_cpt_column($colname, $last_name) {
        if($colname == 'firstName'){
            echo get_post_meta( $last_name, '_first_name', true );
        } elseif($colname == 'lastName'){
            echo get_post_meta( $last_name, '_last_name', true );
        } elseif($colname == 'email'){
            echo get_post_meta( $last_name, '_sub_email', true );
        } elseif($colname == 'subCheck1'){
            echo get_post_meta( $last_name, '_sub_check', true );
        } else{
            echo get_post_meta( $last_name, '_sub_check2', true );
        }
    }
    add_action('manage_subscriber_posts_custom_column', 'bcw_cpt_column', 10, 2);