<?php

/**
 * Created by PhpStorm.
 * User: georgebabu
 * Date: 06/19/2018
 * Time: 3:05 PM
 */
try {
    if ((!isset($_POST['name']) || $_POST['name'] === '') ||  
        (!isset($_POST['subject']) || $_POST['subject'] === '') ||
        (!isset($_POST['email']) || $_POST['email'] === '') ||
        (!isset($_POST['message']) || $_POST['message'] === '')
    ) {
        echo "Please fill out the all fields";
    } else {
		print_r($_POST);exit();
        require_once "../Mail.php";
        $from = '<premieredentalstudios@gmail.com>';
        $to = '<geomathew1992@gmail.com>';
        $subject = "Message from ".$_POST['name'];
        $body = "Hi,\n\n".  "Name: ".$_POST['name']."\n".
                            "subject: ". $_POST['subject']."\n".
                            "Email: ".$_POST['email']."\n".
                            "Message: ".$_POST['message'];

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'premieredentalstudios@gmail.com',
            'password' => 'Fuzelab@123'
        ));

        $mail = $smtp->send($to, $headers, $body);

        if ((new PEAR)->isError($mail)) {
            echo $mail->getMessage();
        } else {
            echo 'Thank you for contacting us!';
        }
    }
} catch (Exception $e) {
    echo "Try again";
}


