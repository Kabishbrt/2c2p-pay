<?php
include "conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentResponseEncoded = $_POST['paymentResponse'] ?? '';

    $paymentResponseDecoded = urldecode($paymentResponseEncoded);

    $paymentResponseJson = base64_decode($paymentResponseDecoded);

    $paymentResponseData = json_decode($paymentResponseJson, true); 
    if ($paymentResponseData) {
          $locale = $paymentResponseData['locale'] ?? "Not Available";
          $invoiceNo = $paymentResponseData['invoiceNo'] ?? "Not Available";
          $channelCode = $paymentResponseData['channelCode'] ?? "Not Available";
          $respCode = $paymentResponseData['respCode'] ?? "Not Available";
          $respDesc = $paymentResponseData['respDesc'] ?? "Not Available";
  
          $stmt = $conn->prepare("INSERT INTO payment_responses (locale, invoice_no, channel_code, response_code, response_desc) VALUES (?, ?, ?, ?, ?)");
  
          $stmt->bind_param("sssss", $locale, $invoiceNo, $channelCode, $respCode, $respDesc);
  
          if ($stmt->execute()) {
          } else {
              echo "Error: " . $stmt->error;
          }
  

        $stmt->close();
    } else {
        echo "Invalid payment response data.";
    }

    $conn->close();
    echo '<pre>';
    echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .info {
            margin-bottom: 15px;
        }

        .info label {
            font-weight: bold;
        }

        .info p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Payment Response</h1>
        <div class="info">
            <label for="locale">Locale:</label>
            <p id="locale"><?php echo $paymentResponseData['locale'] ?? "Not Available"; ?></p>
        </div>
        <div class="info">
            <label for="invoiceNo">Invoice No:</label>
            <p id="invoiceNo"><?php echo $paymentResponseData['invoiceNo'] ?? "Not Available"; ?></p>
        </div>
        <div class="info">
            <label for="channelCode">Channel Code:</label>
            <p id="channelCode"><?php echo $paymentResponseData['channelCode'] ?? "Not Available"; ?></p>
        </div>
        <div class="info">
            <label for="respCode">Response Code:</label>
            <p id="respCode"><?php echo $paymentResponseData['respCode'] ?? "Not Available"; ?></p>
        </div>
        <div class="info">
            <label for="respDesc">Response Description:</label>
            <p id="respDesc"><?php echo $paymentResponseData['respDesc'] ?? "Not Available"; ?></p>
        </div>
        <div class="footer">
            <p>Thank you for your transaction!</p>
        </div>
    </div>

</body>

</html>