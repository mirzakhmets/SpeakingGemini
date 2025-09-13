<?php
// Set headers to return JSON response
header('Content-Type: application/json');

// URL to send the POST request to
$url = 'https://api.telegram.org/bot8138927729:AAER6l5ljTWy8feAXkHPLdj2_6gX0CAgGAI/sendMessage';

function sanitizeInput($input) {
	return htmlspecialchars(strip_tags(trim($input)));
}

// Check if text parameter exists
if (!isset($_GET['text']) || empty($_GET['text'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Text parameter is required']);
    exit;
}

// Get and sanitize the text parameter
$text = sanitizeInput(urldecode($_GET['text']));

// Data to send (text input)
$data = array('chat_id' => '-1003016157732', 'text' => $text);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Optional: Set headers if needed
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);

?>
