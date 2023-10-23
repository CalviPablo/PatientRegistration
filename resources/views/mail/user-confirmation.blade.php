<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your inline CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .button {
            display: block;
            width: 200px;
            background-color: #3498db;
            color: #fff;
            text-align: center;
            text-decoration: none;
            padding: 10px 20px;
            margin: 20px auto;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            color: #777;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>The patient has been succesfully registered.</h2>
        </div>
        <p>Thank you for registering with our website! To complete your registration, please click the button below to confirm your email address.</p>
        <p>Thanks,<br>{{ config('app.name') }}</p>
        <div class="footer">
            Patient Registration
        </div>
    </div>
</body>
</html>
