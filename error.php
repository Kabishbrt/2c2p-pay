<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Oops!</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            color: #721c24;
            font-family: Arial, sans-serif;
        }

        .error-container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .error-code {
            font-size: 5rem;
            font-weight: bold;
            margin: 0;
        }

        .error-message {
            font-size: 1.5rem;
            margin: 10px 0;
        }

        p {
            margin: 15px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">Oops!</div>
        <div class="error-message">Something went wrong.</div>
        <p>We are experiencing technical difficulties. Please try again later.</p>
        <a href="/" class="btn">Return Home</a>
    </div>
</body>
</html>
