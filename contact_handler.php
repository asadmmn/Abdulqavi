<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configuration
$config = [
    'to_email' => 'asadm8975@gmail.com', // Your email address
    'to_name' => 'Abdul Qavi',
    'from_email' => 'noreply@yourwebsite.com', // Use your domain email
    'from_name' => 'Portfolio Contact Form',
    'subject_prefix' => '[Portfolio] ',
    'smtp_host' => 'smtp.gmail.com', // Change if using different provider
    'smtp_port' => 587,
    'smtp_username' => 'asadm8975@gmail.com', // Your email
    'smtp_password' => 'your_app_password', // Use App Password for Gmail
    'use_smtp' => false // Set to true if you want to use SMTP
];

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sendEmailWithPHPMailer($to, $subject, $message, $fromEmail, $fromName, $config) {
    // This function requires PHPMailer library
    // Install with: composer require phpmailer/phpmailer
    
    require_once 'vendor/autoload.php';
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config['smtp_port'];
        
        // Recipients
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($to, $config['to_name']);
        $mail->addReplyTo($fromEmail, $fromName);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

function sendEmailWithPHPMail($to, $subject, $message, $fromEmail, $fromName) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: ' . $fromName . ' <' . $fromEmail . '>',
        'Reply-To: ' . $fromEmail,
        'X-Mailer: PHP/' . phpversion()
    ];
    
    return mail($to, $subject, $message, implode("\r\n", $headers));
}

function logMessage($message) {
    $logFile = 'contact_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND | LOCK_EX);
}

// Response function
function sendResponse($success, $message, $data = []) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit();
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    sendResponse(false, 'Method not allowed. Please use POST request.');
}

// Get and validate input data
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
$message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

// Validation
$errors = [];

if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Name must be at least 2 characters long.';
}

if (empty($email) || !validateEmail($email)) {
    $errors[] = 'Please provide a valid email address.';
}

if (empty($subject) || strlen($subject) < 5) {
    $errors[] = 'Subject must be at least 5 characters long.';
}

if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters long.';
}

// Basic spam protection
$spamKeywords = ['viagra', 'casino', 'lottery', 'winner', 'congratulations', 'million dollars'];
$messageText = strtolower($message . ' ' . $subject);
foreach ($spamKeywords as $keyword) {
    if (strpos($messageText, $keyword) !== false) {
        $errors[] = 'Message contains prohibited content.';
        break;
    }
}

// Rate limiting (simple file-based)
$rateLimitFile = 'rate_limit.json';
$currentTime = time();
$clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if (file_exists($rateLimitFile)) {
    $rateLimitData = json_decode(file_get_contents($rateLimitFile), true);
} else {
    $rateLimitData = [];
}

// Clean old entries (older than 1 hour)
$rateLimitData = array_filter($rateLimitData, function($timestamp) use ($currentTime) {
    return ($currentTime - $timestamp) < 3600;
});

// Check if IP has sent more than 3 messages in the last hour
$ipCount = 0;
foreach ($rateLimitData as $ip => $timestamp) {
    if ($ip === $clientIP) {
        $ipCount++;
    }
}

if ($ipCount >= 3) {
    $errors[] = 'Too many messages sent. Please wait before sending another message.';
}

if (!empty($errors)) {
    http_response_code(400);
    sendResponse(false, 'Validation failed.', ['errors' => $errors]);
}

// Create email content
$emailSubject = $config['subject_prefix'] . $subject;
$emailMessage = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>New Contact Form Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .field { margin-bottom: 20px; }
        .field-label { font-weight: bold; color: #6366f1; margin-bottom: 5px; }
        .field-value { background: white; padding: 10px; border-radius: 5px; border: 1px solid #ddd; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>🚀 New Message from Portfolio Contact Form</h2>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='field-label'>👤 From:</div>
                <div class='field-value'><strong>$name</strong></div>
            </div>
            <div class='field'>
                <div class='field-label'>📧 Email:</div>
                <div class='field-value'><a href='mailto:$email'>$email</a></div>
            </div>
            <div class='field'>
                <div class='field-label'>📋 Subject:</div>
                <div class='field-value'>$subject</div>
            </div>
            <div class='field'>
                <div class='field-label'>💬 Message:</div>
                <div class='field-value'>" . nl2br($message) . "</div>
            </div>
            <div class='footer'>
                <p>📅 Sent: " . date('Y-m-d H:i:s T') . "</p>
                <p>🌐 IP Address: $clientIP</p>
                <p>📱 User Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'Not provided') . "</p>
            </div>
        </div>
    </div>
</body>
</html>
";

// Send email
$emailSent = false;

if ($config['use_smtp'] && class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    $emailSent = sendEmailWithPHPMailer(
        $config['to_email'], 
        $emailSubject, 
        $emailMessage, 
        $email, 
        $name, 
        $config
    );
} else {
    $emailSent = sendEmailWithPHPMail(
        $config['to_email'], 
        $emailSubject, 
        $emailMessage, 
        $email, 
        $name
    );
}

// Log the submission
$logEntry = "Contact form submission - Name: $name, Email: $email, Subject: $subject, IP: $clientIP, Email Sent: " . ($emailSent ? 'Yes' : 'No');
logMessage($logEntry);

// Update rate limiting
$rateLimitData[$clientIP . '_' . uniqid()] = $currentTime;
file_put_contents($rateLimitFile, json_encode($rateLimitData));

if ($emailSent) {
    http_response_code(200);
    sendResponse(true, 'Thank you for your message! I\'ll get back to you within 24 hours.', [
        'name' => $name,
        'email' => $email
    ]);
} else {
    http_response_code(500);
    sendResponse(false, 'Sorry, there was an error sending your message. Please try again or contact me directly at ' . $config['to_email'] . '.');
}
?>