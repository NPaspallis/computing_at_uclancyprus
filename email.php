<html>

<?php
if(isset($_POST['submit']) && !empty($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6Lc-iUYUAAAAAPHht-WaKOMsJAOg3oPB2l_RsYmA';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):

		// Your code here to handle a successful verification
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$source = $_POST['source'];
$bsc_computing = $_POST['bsc_computing'] === "true";
$msc_computing = $_POST['msc_computing'] === "true";
$msc_cybersecurity = $_POST['msc_cybersecurity'] === "true";
$msc_data_analytics = $_POST['msc_data_analytics'] === "true";

$recipient = "npaspallis@uclan.ac.uk"; // comma separated list of recipients
$title = "Contact form / Computing website [" . $email . "]";

// the message
$msg = "Contact form via http://computing.uclancyprus.ac.cy\n
*** Request for information ***\n
Name: " . $name  . "\n
From: " . $email . "\n
IP: " . $_SERVER['REMOTE_ADDR'] . "\n
Interested in:\n
 - BSc Computing      - " . ($bsc_computing ? "YES" : "") . "\n
 - MSc Computing      - " . ($msc_computing ? "YES" : "") . "\n
 - MSc Cybersecurity  - " . ($msc_cybersecurity ? "YES" : "") . "\n
 - MSc Data Analytics - " . ($msc_data_analytics ? "YES" : "") . "\n
Source: " . $source . "\n
Message: >>>>" . $message . "<<<<\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <cyprushelpdesk@uclan.ac.uk>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

// send email
mail($recipient,$title,$msg);
           
            $succMsg = 'Your contact request was submitted successfully.';
        else:
            $errMsg = 'Robot verification failed, please try again.';
        endif;
    else:
        $errMsg = 'Please click on the reCAPTCHA box.';
    endif;
else:
	$errMsg = 'Page error, please try again.';
endif;
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("images/parallax1-dithered.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
</head>
<body>

<div class="bg">

	<div style="margin: auto; width: 50%; height: 50%; padding-top: 100px;">
<?php
	if($errMsg):
		echo "Error: " . $errMsg . "<br/>";
	else:
    	echo "<h1>Thank you! Your message has been received.</h1>";
        echo "<br/>";
        echo "<br/>";
        echo "<h2>You can now return back to the <a href=\"http://computing.uclancyprus.ac.cy\">computing.uclancyprus.ac.cy</a> page.</h2>";
	endif;
?>
    </div>

</div>

</body>

</html>