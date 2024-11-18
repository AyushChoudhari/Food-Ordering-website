<?php
	
include '../functions/functions.php';
	
if(isset($_POST['contact_name']) && isset($_POST['contact_email']) && isset($_POST['contact_subject']) && isset($_POST['contact_message'])) {
		
	$contact_name = htmlspecialchars(test_input($_POST['contact_name']));
	$contact_email = htmlspecialchars(test_input($_POST['contact_email']));
	$contact_subject = htmlspecialchars(test_input($_POST['contact_subject']));
	$contact_message = htmlspecialchars(test_input($_POST['contact_message']));
	
	if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Invalid email format!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		return;
	}

	$contact_subject = str_replace(array("\r", "\n"), '', $contact_subject);
	$headers = "From: $contact_name <$contact_email>" . "\r\n" .
	           "Reply-To: $contact_email" . "\r\n" .
	           "X-Mailer: PHP/" . phpversion();

	$mail = mail("danielwage22@gmail.com", $contact_subject, $contact_message, $headers);

	if($mail) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				The message has been sent successfully
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			  </div>';
	} else {
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				A problem occurred while trying to send the message, please try again!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			  </div>';
	}
}
?>
