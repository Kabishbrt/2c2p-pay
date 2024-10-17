<?php

require_once 'utilities/logger.php';
$logger->log("Full request: " . json_encode($_REQUEST), 'DEBUG');

$logger = new PaymentLogger();
$logger->log("Processing 2C2P payment response.", 'INFO');

$secret_key = "ECC4E54DBA738857B84A7EBC6B5DC7187B8DA68750E88AB53AAA41F548D6F2D9";

if (!isset($_REQUEST['paymentResponse'])) {
    http_response_code(400);
    
    $logger->log("Missing paymentResponse in request", 'ERROR');
    echo json_encode(["status" => "error", "message" => "Missing paymentResponse"]);
    exit();
}

$response_payload_json = $_REQUEST["paymentResponse"];
$logger->log("Received payment response payload.", 'DEBUG');

?>