<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Allow POST and OPTIONS methods
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization"); // Allow specific headers

function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function base64UrlDecode($input)
{
    $remainder = strlen($input) % 4;
    if ($remainder) {
        $input .= str_repeat('=', 4 - $remainder);
    }
    return base64_decode(strtr($input, '-_', '+/'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $SECRETKEY = "ECC4E54DBA738857B84A7EBC6B5DC7187B8DA68750E88AB53AAA41F548D6F2D9";
    $MERCHANTID ="JT01";
    $currencyCode = "NPR";

    $payload = [
        "merchantID" => $MERCHANTID,
        "invoiceNo" => "INV12345",
        "description" => "Test Payment",
        "amount" => $_POST["amount"],
        "currencyCode" => $currencyCode,
        "frontendReturnUrl" => "http://localhost/frontend_response.php",
        "backendReturnUrl" => "http://localhost/payment_callback.php",
        "locale" => "en",
        "nonceStr" => time()
    ];

    $payload = (object) array_filter((array) $payload);
    $payloadJson = json_encode($payload);

    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $headerB64 = base64url_encode($header);
    $payloadB64 = base64url_encode($payloadJson);
    $signature = hash_hmac('sha256', $headerB64 . "." . $payloadB64, $SECRETKEY, true);
    $signatureB64 = base64url_encode($signature);
    $apiUrlProd = "https://pgw.2c2p.com/payment/4.3/paymentToken";
    // Use this API for production
    $apiUrl = "https://sandbox-pgw.2c2p.com/payment/4.3/paymentToken"; 

    $headers = [
        "Content-Type: application/json",
        "Accept: application/json"
    ];

    $jwt = $headerB64 . "." . $payloadB64 . "." . $signatureB64;

    $finalPayload = json_encode(["payload" => $jwt]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $finalPayload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
        exit;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $responseData = json_decode($response, true);
    
    if (isset($responseData['payload'])) {
        $jwtParts = explode('.', $responseData["payload"]);
        $payload = base64UrlDecode($jwtParts[1]);
        $decodedPayload = json_decode($payload, true);

        if (isset($decodedPayload["webPaymentUrl"])) {
            $webPaymentUrl = $decodedPayload["webPaymentUrl"];
            // Return the URL as a JSON response
            echo json_encode(["redirect_url" => $webPaymentUrl]);
        } else {
            echo json_encode(['error' => 'Web payment URL not found.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid response data.', 'response' => $responseData]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
