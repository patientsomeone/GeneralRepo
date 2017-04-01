<?php



if($_POST['J_mailto'] == '') {

	echo $emailToError = 'You forgot to enter the email address to send to.';

	} else if (!@eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $_POST['J_mailto'])) {

		echo $emailToError = 'Enter a valid email address to send to.';

	}

	if($_POST['J_email'] == '') {

		echo $emailFromError = 'You forgot to enter the email address to send from.';
	
	} else if (!@eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $_POST['J_email'])) {

		echo $emailToError = 'Please enter a valid email address.';
	} 

	if($_POST['J_firstname'] == '') {

		echo $messageError = 'Please enter your first name.';

	}
	
	if($_POST['J_lastname'] == '') {

		echo $messageError = 'Please enter your last name.';

	}
	if($_POST['J_question'] == '') {

		echo $nameError = 'Plese enter your question.';

	}

	

	if(!isset($emailToError) && !isset($emailFromError)  && !isset($messageError)) {

		$emailTo = $_POST['J_mailto'];

		$emailFrom = $_POST['J_email'];

		$subject = $_POST['J_firstname'];

		$message = $_POST['J_question'];

		$from = $emailFrom;

		$headers = "From: $from";

			

	if(mail($emailTo, $subject, $message, $headers))

	{

		echo "<h1 class='success'>Success</h1>";

		echo "<p>Your email has been sent.</p>";

		}else{

		echo "error";

	}



}



?>