<?php
$to = "kaurnavprit5@gmail.com"; // <-- apna receiving email yahan likho

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo "Method Not Allowed";
  exit;
}

$name    = trim($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $subject === "" || $message === "") {
  http_response_code(400);
  echo "Please fill all fields.";
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Invalid email.";
  exit;
}

$fullSubject = "Portfolio Contact: " . $subject;
$body = "Name: $name\nEmail: $email\n\nMessage:\n$message\n";

$headers  = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $fullSubject, $body, $headers)) {
  echo "OK";
} else {
  http_response_code(500);
  echo "Email failed (server mail not configured).";
}
?>