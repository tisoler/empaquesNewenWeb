<?php
//die();
include ( "class.phpmailer.php");

class bnm_formmail {

	var $to, $subject, $from, $msg, $redirect, $headers, $attach_file, $go;
	var $no_send, $text_body, $__Email, $body_file, $from_name;

	function bnm_formmail()
	{



			$this->to 			= (isset( $_REQUEST['to'])) ? $_REQUEST['to'] : "";
			$this->subject 		= (isset( $_REQUEST['subject'])) ? $_REQUEST['subject'] : "Comment form";
			$this->__Email 		= (isset( $_REQUEST['__Email'])) ? $_REQUEST['__Email'] : "";
			if (isset ($_REQUEST["email_from"])) 
					$this->__Email = $_REQUEST["email_from"];
			$this->from_name 	= (isset($_REQUEST["name_from"])) ? $_REQUEST["name_from"] : "";

			$this->redirect 		= (isset( $_REQUEST['redirect'])) ? "../" . $_REQUEST['redirect'] : "";
			$this->text_body		= (isset( $_REQUEST['text_body'])) ? $_REQUEST['text_body'] : "";
			$this->go 			= (isset( $_REQUEST['go'])) ? $_REQUEST['go'] : "";
			$this->body_file		= (isset( $_REQUEST['body_file'])) ? $_REQUEST['body_file'] : "";
			$this->headers 		= "From: " . $this->from ;
		      $this->no_send 		= array ("to", "subject","redirect","send", "text_body","__utma","__utmz");
			
			ini_set ("sendmail_from",$this->__Email);

	}


	 function send()
	 {
	 
		$this-> _create_msg();

		$mail = new PHPMailer();
		$mail->CharSet = "UTF-8";
		$mail->IsHTML(true);
		$mail->From     = "info@empaquesnewen.com.ar";
		$mail->FromName = "mail Newen";

		//$mail->Mailer   = "mail";
		$mail->Host     = "smtp.zoho.com:587"; //"127.0.0.1:25";
		$mail->Mailer   = "mail";
		$mail->Body    = $this->msg;
		$mail->Subject = $this->subject;
		$mail->AddAddress("diegompaz@gmail.com", "mail Diego");
		$mail->AddAddress("info@empaquesnewen.com.ar", "mail Newen");
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Username   = "info@empaquesnewen.com.ar"; //"info@empaquesnewen.com.ar"; // SMTP account username
		$mail->Password   = "oso1220$"; // SMTP account password
		
		
		if ($_FILES['fileAttached']['name'] != "") 
			
			if ( is_uploaded_file ( $_FILES['fileAttached']['tmp_name']))
				$mail->AddAttachment ($_FILES['fileAttached']['tmp_name'], $_FILES['fileAttached']['name']);
			
			
		if(!$mail->Send()) {
//echo "<pre>";print_r($mail);die();
			echo "There has been a mail error sending to ";
			echo $mail->ErrorInfo;
		} else {
			if($this->redirect != "") 
				HTMLRedirect($this->redirect);
		}
	}

	function _create_msg () {
	
		$this->msg = $this->text_body ."<br><br>";

		if (empty($this->body_file)) {
			foreach ( $_REQUEST as $field => $data) {
				if (!in_array ($field, $this->no_send) && trim(substr ($field,0,2)) == "__" ) {
						$label =  substr($field,2, strlen($field));
						//agregado para que separe un array por comas
						if  (is_array($data)){
							foreach($data as $element){
									$varAux.=$element.", ";
							}
							$data=substr($varAux,0, (strlen($varAux))-2);
						}						
						//agregado para que separe un array por comas
						$this->msg .=  str_replace ("_", " ", $label) . ": " . $data ." <br>" ;
				}
			}
			
		} else {
			
			$html_file = file_get_contents($this->body_file);
			foreach ( $_REQUEST as $field => $data) {
				$html_file 	= str_replace("%" . $field . "%", $data, $html_file);
			}
			$this->msg = $html_file;
		}
		
	}
}
?>
