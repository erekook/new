<?php
		
define('HTTP_SERVER', 'http://www.2comu.com');

/* DIR_DOCUMENT_FS_ROOT points to section's file system path */
define('DIR_DOCUMENT_WS_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

/* path for upload */
define('DIR_WS_UPLOAD', DIR_DOCUMENT_WS_ROOT. 'upload/');

	
define('DIR_DOCUMENT_FS_ROOT', $_SERVER['DOCUMENT_ROOT']);

define('DIR_FS_UPLOAD',DIR_DOCUMENT_FS_ROOT.'/upload/');


/* function to get the extension of the filename */
function get_extension($name)	{
	$ext = strrchr($name,".");
	return $ext;
}

/* function to get the filename of the filename */
function get_filename($name)	{
	$pos = strrpos($name,".");
	$file = substr($name , 0, $pos);
	return $file;
}


function AddResume($input)
 {  
	if(!empty($_FILES[$input]['name']))
	{  		
		$ext = get_extension($_FILES[$input]['name']);
		$src= $_FILES[$input]['tmp_name'];
		$dest_filename = 'GEMS_' . get_filename($_FILES[$input]['name']) . $ext;
		$dest = DIR_FS_UPLOAD . $dest_filename;
		
		move_uploaded_file($src, $dest);

		return $dest_filename;
	}
}


if($_POST['action'] == 'fileUpload')
{
	$photofileName = AddResume("fileAttach");

	$Name = $_POST['Name'];
	$Organization = $_POST['Organization'];
	$email = $_POST['email'];
	$Phone = $_POST['Phone'];
	$strMessage = $_POST['Message'];
	
	//$strAdminAdd ="chitra@123triad.com"; // to Receiptient 
	$strAdminAdd ="wenyu@2comu.com";
	 $to =$strAdminAdd; 

	 $subject = "GEMS ----Contact Form ----";   
	 $headers = "From: comu.com \n";
	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	 $message = '<html>
		 <head>
		   <title>:: Posting From: Contact Form ::</title>
		 </head>
		 <body>		
		<b>Posted details are as follows :</b><br><br>
			<table width="100%" border="0" cellpadding="0" cellspacing="2">
				<tr>
				  <td width="30%" valign="top" align="left">Name :</td>
				  <td width="70%">'. $Name .'</td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td valign="top" align="left">Organization :</td>
				  <td>'. $Organization .'</td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top">Contact Email :</td>
				  <td>'. $email .'</td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top">Phone number :</td>
				  <td>'. $Phone .'</td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top">Message :</td>
				  <td>'. $strMessage .'</td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>				
				<tr>
				  <td valign="top" align="left">File Attachment : </td>
				  <td>
					<table width="90%" cellspacing="0" cellpadding="2">
						<tr>
							<td valign="middle"><a href="http://123triadpro.com/triad11/wen_yu/upload/' . $photofileName . '">Dowload Here</a></td>
						</tr>
					</table>
				  </td>
				</tr>
				<tr>
				  <td align="left" valign="top">&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>				
			  </table>														
			<br>
			<br><br>Thanks & Regards,
			<br><b>2COMU.</b>
		</body>
	</html>';

	//echo $message;
	//exit;
	

	mail($to,$subject,$message,$headers);

	header("location:thankyou.html");
}
?>