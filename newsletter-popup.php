<?php 
function my_newsletter_form($params, $content = null) {

extract(shortcode_atts(array(
    'type' => 'style1'
), $params));

ob_start();

if(isset($_POST['submit'])) {

$first_name = $_POST['first_name'];
$sub_email = isset($_POST['sub_email']) ? $_POST['sub_email'] : ' ';
$last_name = $_POST['last_name'];
$sub_check = isset($_POST['sub_check']) ? $_POST['sub_check'] : ' ';

$sub_check2 = isset($_POST['sub_check2']) ? $_POST['sub_check2'] : ' ';



$new_post = array(
  'post_type' => 'subscriber',
  'post_title' => $first_name,
  'last_name' => $last_name,
  'sub_email' => $sub_email, 
//   'sub_cat' => $sub_cat,
  'sub_check' => $sub_check,
  'sub_check2' => $sub_check2,
//   'post_category' => array($post_category),
  'post_status' => 'publish'
);

$post_id = wp_insert_post($new_post);
$post = get_post($post_id);

if($post_id  == true){
  echo 'Thanks for submission :)'; 
  
    $sub_email = isset($_POST['sub_email']) ? $_POST['sub_email'] : ' ';
    $to = $sub_email;
    $subject = 'Heya :) Roopam Here...';
    $body = 'Thanks for reaching out!!';
    $headers = "expertteamrspl@gmail.com";
    $returnmail = wp_mail( $to, $subject, $body, $headers );
    
    if(isset($returnmail)){
    echo '<script>alert("mail sent!")</script>';
    } else {
    echo '<script>alert("mail not sent")</script>';
    
    }  
  
} else {
echo 'Please try again! :(';

}    
 //wp_set_object_terms( $post_id, array($post_category), '< category_slug_name >' ); 
}      
?>    

<form method="post" enctype="multipart/form-data" > 
<label>First Name</label>
<input type="text" name="first_name" size="45" id="input-fname"/>
<label>Last Name</label>
<input type="text" name="last_name" size="245" id="input-lname"/>
<label>Email</label>
<input type="email" name="sub_email" id="input-email"/>
<!-- <label>Category</label> -->
<!-- <select name="sub_cat" class="regular-text">
    <option>Select One</option>
    <option>Business</option>
    <option>Electronics</option>
</select> -->
<?php  //wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1' ); ?>
<label>Tick, if interested!</label>
<input type="checkbox" name="sub_check" class="regular-text" />
<label>Privacy Policy</label>
<input type="checkbox" name="sub_check2" class="regular-text" />
<div class="submit-button"><button class="subput round" type="submit" name="submit">Submit</button></div>

</form>

<?php
return ob_get_clean();
}
add_shortcode('newsletter_form','my_newsletter_form');



// add_action('phpmailer_init', 'myphpmailer_example');
// function myphpmailer_example($phpmailer){
//    $phpmailer->isSMTP();
//    $phpmailer->HOST = SMTP_HOST;
//    $phpmailer->SMTPAUTH = SMTP_AUTH;
//    $phpmailer->Port = SMTP_PORT;
//    $phpmailer->Username = SMTP_USER;
//    $phpmailer->Password = SMTP_PASSWORD;
//    $phpmailer->SMTPSecure = SMTP_SECURE;
//    $phpmailer->From = SMTP_FROM;
//    $phpmailer->FromName = SMTP_NAME;

// }



