<?php
/**
*  Added by SAMARTH 03-OCT-2016
**/
/**
* change date format from dd/mm/yyyy become yyyy-mm-dd.
* @param <type> $date
* @return date
*/
function encode_date($date) 
{
	$current_date = explode('/', $date);
	$new_date = $current_date[2]. "-".$current_date[1]."-".$current_date[0];
	return $new_date;
}

/**
* change date format from dd/mm/yyyy h:i become yyyy-mm-dd h:i.
* @param <type> $date
* @return date
*/
function encode_datetime($date) 
{
	$date_first = explode(' ', $date);
	$current_date = explode('/', $date_first[0]);
	$new_date = $current_date[2] . "-" . $current_date[1] . "-" . $current_date[0].' '.$date_first[1];
	return $new_date;
}

/**
* change date format from dd/mm/yyyy h:i become yyyy-mm-dd.
* @param <type> $date
* @return date
*/
function encode_datetime_rmtime($date) 
{
	$date_first = explode(' ', $date);
	$current_date = explode('/', $date_first[0]);
	$new_date = $current_date[2] . "-" . $current_date[1] . "-" . $current_date[0];
	return $new_date;
}

/**
* change date format from yyyy-mm-dd become dd/mm/yyyy
* @param <type> $date
* @return date
*/
function decode_date($date) {
	$current_date = explode('-', $date);
	$new_date = $current_date[2] . "/" . $current_date[1] . "/" . $current_date[0];
	return $new_date;
}

/**
* change date format from dd/mm/yyyy h:i become yyyy-mm-dd h:i.
* @param <type> $date
* @return date
*/
function decode_datetime($date) {
 $date_first = explode(' ', $date);
	$current_date = explode('-', $date_first[0]);
	$new_date = $current_date[2] . "/" . $current_date[1] . "/" . $current_date[0].' '.$date_first[1];
	return $new_date;
}
/**
* change date format from dd/mm/yyyy h:i become yyyy-mm-dd.
* @param <type> $date
* @return date
*/
function decode_datetime_rmtime($date) {
 $date_first = explode(' ', $date);
	$current_date = explode('-', $date_first[0]);
	$new_date = $current_date[2] . "/" . $current_date[1] . "/" . $current_date[0];
	return $new_date;
}
/**
* Download any of files from our server.
* @param <type> $file_name
* @return
*/
function downloadreport($file_name)
{
	$asfname=$file_name;
	$file_path = "./uploads/".$file_name;
	$fsize=filesize($file_path);
	$mtype=mime_content_type($file_path);
	//$mtype=get_mime_by_extension($file_path);
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Type: $mtype");
	header("Content-Disposition: attachment; filename=\"$asfname\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . $fsize);
	// download
	@readfile($file_path);
	$file = @fopen($file_path,"rb");
}
/**
* Upload images.
* @param <type> $input_name, $path, $width, $height
* @return image name
*/
function upload_image_files($input_name='image', $path='',$width=100,$height=100)
{
	$CI = &get_instance();
	if($_FILES[$input_name]['name'] != "")
	{
		$config['upload_path']     = $path;
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		//$config['allowed_types']   = '*';
		$config['remove_spaces']   = true;
		$config['encrypt_name']    = true;
		$config['max_width']       = '';
		$config['max_height']      = '';

		$CI->load->library('upload', $config);
		$CI->upload->initialize($config);	

		if (!$CI->upload->do_upload($input_name))
		{
			
			$error = array('error' => $CI->upload->display_errors());
			echo $path.'<br />';
			print_r($error);
			//exit();			
			return '';
		}
		else
		{
			$image = $CI->upload->data();
			if ($image['file_name'])
			{
				$data['file1'] = $image['file_name'];
			}

			$product_image = $data['file1'];

			$config['image_library']	= 'gd2';
			$config['source_image']		= $path.$data['file1'];
			$config['new_image']		= $path.'resize/'.$data['file1'];
			$config['maintain_ratio']	= TRUE;
			$config['width']			= $width;
			$config['height']			= $height;
			$config['master_dim']		= 'width';
			$CI->load->library('image_lib', $config); //load library
			$CI->image_lib->clear();
			$CI->image_lib->initialize($config);
			$CI->image_lib->resize(); //do whatever specified in config

			return $image['file_name'];
		}
	}
	else
	{
		return '';
	}
}
/**
* Sent SMTP Mail.
* @param <type> $load_view, $from, $to, $subject, $email_data, $cc, $bcc
* @return
*/
function smtp_mail($load_view = '',$from = '',$to = '',$subject = '',$email_data = '',$cc='',$bcc='')
{
	$CI = &get_instance();
	$mail_body = $CI->load->view($load_view,$email_data,true);
	//print_r($email_data);
	$config['charset'] = "utf-8";
	$config['mailtype'] = 'html';
	$config['newline'] = "\r\n"; 
	$CI->load->library('email', $config); 
	$CI->email->initialize($config);
	$CI->email->from($from);
	$CI->email->to($to);  
	if($cc != '')
	{
		$CI->email->cc($cc);  
	}
	if($bcc != '')
	{
		$CI->email->bcc($bcc);  
	}
	$CI->email->subject($subject);
	$CI->email->message($mail_body);	
	$CI->email->send();
	
	/*$config['protocol'] = "smtp";
	$config['smtp_host'] = "mail.jayandjov.com";
	$config['smtp_port'] = "587";
	$config['smtp_user'] = "test@jayandjov.com"; 
	$config['smtp_pass'] = "test123@";
	$config['charset'] = "utf-8";
	$config['mailtype'] = "html";
	$config['newline'] = "\r\n"; 
	$config['mailtype'] = 'html';
	$CI->load->library('email', $config); 
	$CI->email->initialize($config);
	$CI->email->from($from);  
	$CI->email->to($to);  
	if($cc != '')
	{
		$CI->email->cc($cc);  
	}
	if($bcc != '')
	{
		$CI->email->bcc($bcc);  
	}
	$CI->email->subject($subject);  
	$CI->email->message($mail_body);  
	$CI->email->send();*/
	
	//echo $CI->email->print_debugger();
}
/**
* Send json in API
* @param <type> $status, $message, $data
* @return json
*/
function json_data($status = '',$message = '',$fetch_data = '')
{
   if($status != '')
   {
		$data['status'] = $status;
   }
   if($message != '')
   {
		$data['message'] = $message;
   }
   if($fetch_data != '')
   {
	   $data['data'] = $fetch_data;
   }
   header('Content-type: application/json'); 
   echo json_encode($data);
}
/**
* Make string as encode
* @param <type> $string
* @return encrypted string
*/
function encode($string) 
{
	return base64_encode(urlencode($string));
}
/**
* Make string as decode
* @param <type> $string
* @return decrypted string
*/
function decode($string) 
{
	return urldecode(base64_decode($string));
}
/**
* Popup page reload
* @param <type> $string
* @return server information
*/
function reloadpage()
{
	echo "<script language=\"javascript\">  parent.location.reload(true);</script>";
}
/**
* remove special character put space
* @param 
* @return space
*/
function clean($string) 
{
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
   //echo clean('a|"bc!@£de^&$f g');
}
?>