<?php
 require 'phpmailer/PHPMailerAutoload.php';
 

if(isset($_POST['phonenumber'])) {
 
     

 
   $email_to = "hr@marisfibc.in";
 
    $email_subject = "Enquiry from website";


      // File attachment handling
      $attachment = $_FILES["upload"]["tmp_name"];
      $attachment_name = $_FILES["upload"]["name"];
      $attachment_size = $_FILES["upload"]["size"];
  
  
       // Allowed file types
      $allowed_extensions = array('png', 'jpg', 'jpeg', 'pdf', 'xlsx');
      $file_extension = strtolower(pathinfo($attachment_name, PATHINFO_EXTENSION));
  
      // Check if the uploaded file is valid
      if (!in_array($file_extension, $allowed_extensions)) {
          // die("Error: Invalid file format. Allowed formats: png, jpg, pdf, xlsx");
          echo '<script>alert("Error: Invalid file format. Allowed formats: png, jpg, jpeg, pdf, xlsx"); history.back();</script>';
          exit();
  
      }
  
      // Check if the file size is within the limit (10MB)
      $max_file_size = 2 * 1024 * 1024; // 10MB in bytes
      if ($attachment_size > $max_file_size) {
        //   // die("Error: File size exceeds the limit of 10MB.");
        //   echo '<script>alert("Error: File size exceeds the limit of 2MB."); history.back();</script>';
        //   exit();
      }
  
      $target_dir = "uploads/"; // Change this to the desired directory
      $target_path = $target_dir . $attachment_name;
      move_uploaded_file($attachment, $target_path);


 
   if(isset($_POST['phonenumber'])) {
      
  $firstname  = $_POST['firstname'];

    $lastname = $_POST['lastname']; // required
 
 
    $email = $_POST['email']; // required
 
    $phone = $_POST['phonenumber']; // required
 
   
     
//    $vehicle = $_POST['vehicle']; // required
   
//     $url = $_POST['url']; // required
   $email_from = $_POST['email']; // required

    $email_message = "Form details below.<br>";
 
     
 
    $email_message .= "First Name: ".clean_string($firstname)."<br>";
    $email_message .= "Last Name: ".clean_string($lastname)."<br>";
   $email_message .= "E-mail: ".clean_string($email)."<br>";
    
 
    
     $email_message .= "Phone: ".clean_string($phone)."<br>";
    // $email_message .= "Vehicle Type: ".clean_string($vehicle)."<br>";
 

         
        $headers = 'From: '.$email_from."\r\n".
         
        'Reply-To: '.$email_from."\r\n" .
         
        'X-Mailer: PHP/' . phpversion();

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mailenquiry055@gmail.com';
        $mail->Password = 'kcxjrpbemprllvkd';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SetFrom('mailenquiry055@gmail.com');
        $mail->AddAddress($email_to);

        // Attach a PDF file
        $attachment_path = 'uploads/' . $attachment_name; // Replace with the actual path to your PDF file
        // print_r($attachment_path);
        // die;
        $mail->addAttachment($attachment_path);

        $mail->isHTML(true);
        $mail->Subject = $email_subject;
        $mail->Body = $email_message;
        
        if($mail->send()){
             echo '<script>alert("Mail sent Successfully. \nThank you for contacting us. We will be in touch with you very soon.")</script>';
        echo'<script>window.location.href = "index.html";</script>';

        } else {
            echo 'We are sorry, but there appears to be a problem with the form you submitted.';
        }
        
        
         
        // @mail($email_to, $email_subject, $email_message, $headers);  
        // echo '<script>alert("Mail sent Successfully. \nThank you for contacting us. We will be in touch with you very soon.")</script>';
        // echo'<script>window.location.href = "'.  $url  .'";</script>';
         
 
     }else{
          died('We are sorry, but there appears to be a problem with the form you submitted.');       
     }
     
 
}

 function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
    
function died($error) {
 
 
        echo $error;
        die;
 
    }
?>