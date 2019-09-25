<!-- Imtiaz Bin Gias
imtiaz.akil@softbd.com
01870762472
Software Engineer -->

<?php
function rand_string( $length ) {
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++) { $str .= $chars[ rand( 0, $size - 1 ) ]; }
	return $str;
}
function redirect_to_merchant($url) {
  
	?>
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head><script type="text/javascript">
        function closethisasap() { document.forms["redirectpost"].submit(); } 
      </script></head>
      <body onLoad="closethisasap();">
      
        <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
      </body>
    </html>
    <?php	
    exit;
} 
$cur_random_value=rand_string(10);
$url = 'https://sandbox.aamarpay.com/request.php';
$fields = array(
    'store_id' => 'aamarpay', 'amount' => '10', 'payment_type' => 'VISA',
    'currency' => 'BDT', 'tran_id' => $cur_random_value,
    'cus_name' => 'Mr. ABC', 'cus_email' => 'abc@abc.com',
    'cus_add1' => 'House B-158, Road 22', 'cus_add2' => 'Mohakhali DOHS',
    'cus_city' => 'Dhaka', 'cus_state' => 'Dhaka', 'cus_postcode' => '1206',
    'cus_country' => 'Bangladesh', 'cus_phone' => '01826323538',
    'cus_fax' => 'Not¬Applicable', 'ship_name' => 'Mr. XYZ',
    'ship_add1' => 'House B-121, Road 21', 'ship_add2' => 'Mohakhali',
    'ship_city' => 'Dhaka', 'ship_state' => 'Dhaka',
    'ship_postcode' => '1212', 'ship_country' => 'Bangladesh',
    'desc' => 'T-Shirt', 'success_url' => 'http://localhost/aamarpayCurl/success.php',
    'fail_url' => 'http://localhost/aamarpayCurl/fail.php',
    'cancel_url' => 'http://localhost/aamarpayCurl/cancel.php',
    'opt_a' => 'Optional Value A', 'opt_b' => 'Optional Value B',
    'opt_c' => 'Optional Value C', 'opt_d' => 'Optional Value D',
    'signature_key' => '28c78bb1f45112f5d40b956fe104645a');
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string = rtrim($fields_string, '&'); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_URL, $url);  
curl_setopt($ch, CURLOPT_POST, count($fields)); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
curl_close($ch); 
redirect_to_merchant($url_forward);
?>
