<?php
/**
 * Swiff.Uploader Example Backend
 *
 * This file represents a simple logging, validation and output.
 *  *
 * WARNING: If you really copy these lines in your backend without
 * any modification, there is something seriously wrong! Drop me a line
 * and I can give you a good rate for fancy and customised installation.
 *
 * No showcase represents 100% an actual real world file handling,
 * you need to move and process the file in your own code!
 * Just like you would do it with other uploaded files, nothing
 * special.
 *
 * @license		MIT License
 *
 * @author		Harald Kirschner <mail [at] digitarald [dot] de>
 * @copyright	Authors
 *
 */

$upload_path = 'uploads/';
$tmp_path = $upload_path.'tmp/';
 
function  randomName($length = 10){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}
 
/**
 * Only needed if you have a logged in user, see option appendCookieData,
 * which adds session id and other available cookies to the sent data.
 *
 * session_name('SID'); // whatever your session name is, adapt that!
 * session_start();
 */
 
// Request log
 
/**
 * You don't need to log, this is just for the showcase. Better remove
 * those lines for production since the log contains detailed file
 * information.
 */
$result = array();
 
$result['time'] = date('r');
$result['addr'] = substr_replace(gethostbyaddr($_SERVER['REMOTE_ADDR']), '******', 0, 6);
$result['agent'] = $_SERVER['HTTP_USER_AGENT'];
 
if (count($_GET)) {
	$result['get'] = $_GET;
}
if (count($_POST)) {
	$result['post'] = $_POST;
}
if (count($_FILES)) {
	$result['files'] = $_FILES;
}
 
// we kill an old file to keep the size small
if (file_exists('script.log') && filesize('script.log') > 102400) {
	unlink('script.log');
}
 
$log = @fopen('script.log', 'a');
if ($log) {
	fputs($log, print_r($result, true) . "\n---\n");
	fclose($log);
}
 
 
// Validation
 
$error = false;
 
if (!isset($_FILES['Filedata'])) {
	$error = 'Invalid Upload';
}
 
/**
 * You would add more validation, checking image type or user rights.
 *
 
if (!$error && $_FILES['Filedata']['size'] > 2 * 1024 * 1024)
{
	$error = 'Please upload only files smaller than 2Mb!';
}
 
if (!$error && !($size = @getimagesize($_FILES['Filedata']['tmp_name']) ) )
{
	$error = 'Please upload only images, no other files are supported.';
}
 
if (!$error && !in_array($size[2], array(1, 2, 3, 7, 8) ) )
{
	$error = 'Please upload only images of type JPEG, GIF or PNG.';
}
 
if (!$error && ($size[0] < 25) || ($size[1] < 25))
{
	$error = 'Please upload an image bigger than 25px.';
}
*/
 
 
// Processing
do
	$tmp_name = randomName();
while (file_exists($tmp_path.$tmp_name));

if (!move_uploaded_file($_FILES['Filedata']['tmp_name'], $tmp_path.$tmp_name)) {
	$error = 'Invalid Upload';
} 

$return['src'] = $tmp_path.$tmp_name;
 
if ($error) {
 
	$return = array(
		'status' => 0,
		'error' => $error
	);
 
} else {
 
	$return['status'] = '1';
	$return['name'] = $_FILES['Filedata']['name'];
}
 
 
// Output
 
/**
 * Again, a demo case. We can switch here, for different showcases
 * between different formats. You can also return plain data, like an URL
 * or whatever you want.
 *
 * The Content-type headers are uncommented, since Flash doesn't care for them
 * anyway. This way also the IFrame-based uploader sees the content.
 */
 
if (isset($_REQUEST['response']) && $_REQUEST['response'] == 'xml') {
	header('Content-type: text/xml');
 
	// Really dirty, use DOM and CDATA section!
	echo '<response>';
	foreach ($return as $key => $value) {
		echo "<$key><![CDATA[$value]]></$key>";
	}
	echo '</response>';
} else {
	if (!isset($_REQUEST['response']) || $_REQUEST['response'] != 'nojson')
		header('Content-type: application/json');
	else
		$return[size] = $_FILES['Filedata']['size'];
	echo json_encode($return);
}
 
?>