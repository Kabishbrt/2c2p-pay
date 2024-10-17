
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2C2P Sandbox Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding-inline: 1rem;
            padding-block: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: grid;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>2C2P Sandbox Payment Form</h1>
        <form action="initiate_payment.php" method="post">
          
            <label for="invoiceNo">Invoice No:</label>
            <input type="text" name="invoiceNo" value="<?php echo time(); ?>">
            
            <label for="description">Description:</label>
            <input type="text" name="description" value="2 days 1 night">
            
            <label for="amount">Amount:</label>
            <input type="text" name="amount" value="1000">

            <label for="frontendReturnUrl">Frontend Return URL:</label>
            <input type="text" name="frontendReturnUrl" value="http://localhost/payment/frontend_response.php">
            
            <label for="backendReturnUrl">Backend Return URL:</label>
            <input type="text" name="backendReturnUrl" value="http://localhost/payment/payment_callback.php">
            
      
            <input type="submit" value="Submit Payment (Sandbox)">
        </form>
    </div>
</body>
</html>