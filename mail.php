<?php
//var_dump($_POST);
$name = $_POST['firstname'];
$email = $_POST['email'];
function sendmail($name,$email,$tempname){
include_once "vendor/autoload.php";
try {
    $mandrill = new Mandrill('');
    $template_name = $tempname;
    $template_content = array(
        array(
            'name' => '',
            'content' => ''
        )
    );
    $message = array(
        'html' => '',
        'text' => '',
        'subject' => '',
        'from_email' => '',
        'from_name' => 'Nikhil John',
        'to' => array(
            array(
                'email' => $email,
                'name' => '',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => ''),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => 'message.bcc_address@example.com',
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'merge1',
                'content' => 'merge1 content'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => $email,
                'vars' => array(
                    array(
                        'name' => 'FNAME',
                        'content' => $name
                    )
                )
            )
        ),
        'tags' => array('password-resets'),
        // 'subaccount' => 'customer-123',
        'google_analytics_domains' => array('cloudrecruit.co'),
        'google_analytics_campaign' => 'message.from_email@example.com',
        'metadata' => array('website' => 'www.cloudrecruit.co'),
        'recipient_metadata' => array(
            array(
                'rcpt' => '',
                'values' => array('user_id' => 123456)
            )
         )
        // 'attachments' => array(
        //     array(
        //         'type' => 'text/plain',
        //         'name' => 'myfile.txt',
        //         'content' => 'ZXhhbXBsZSBmaWxl'
        //     )
        // ),
        // 'images' => array(
        //     array(
        //         'type' => 'image/png',
        //         'name' => 'IMAGECID',
        //         'content' => 'ZXhhbXBsZSBmaWxl'
        //     )
        // )
    );
    // $async = false;
    // $ip_pool = 'Main Pool';
    // date_default_timezone_set("UTC");
    // $t = date("Y-m-d H:i:s", time());
    // echo $t;
    // $send_at = $t;
    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message);
    //echo $result['status'];
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
return $result;
}
?>
