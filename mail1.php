
<?php
include_once "vendor/autoload.php";
try {
$mandrill = new Mandrill('');
$fname = 'manoj';
$lname = 'kumar';
$email = 'manrox.drag@gmail.com';
$message = array(
    'subject' => 'Thanks for Signup',
    'from_email' => 'nikhil@cloudrecruit.co',
    'to' => array(array('email' => '$email', 'name' => '$fname')),
    'merge_vars' => array(array(
        'rcpt' => 'manrox.drag@gmail.com',
        'vars' =>
        array(
            array(
                'name' => 'FIRSTNAME',
                'content' => $fname),
            array(
                'name' => 'LASTNAME',
                'content' => $lname)
    ))));

$template_name = 'signup';

$template_content = array(
    array(
        'name' => 'header',
        'content' => 'Dear *|FIRSTNAME|* *|LASTNAME|*,'),
    array(
        'name' => 'main',
        'content' => 'Thanks for signing up.'),
    array(
        'name' => 'body',
        'content' => "We're project recruiters in the eCommerce space.<br/>

We use automated video interviewing to speed up recruitment."),

    array(
        'name' => 'footer',
        'content' => 'Cloudrecruit.co.')

);

$response = $mandrill->messages->sendTemplate($template_name, $template_content, $message);
print_r($response);
}
catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
?>
