<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h1>Greetings {{$user}}!</h1>
    <p>Thank You So much, for your order. We'll soon start to process your order right after
    the payment confirmation. Please preview your order details below and in case of any mistake or issue,
    please respond back to this email and let us fix this for you, thanks</p>
    <h2>
        User Details:
    </h2>
    <h3>
        Name:
    </h3>
    <p>
        {{$user}}
    </p>
    <h3>
        Email:
    </h3>
    <p>
        {{$email}}
    </p>
    <h3>
        Contact
    </h3>
    <p>
        {{$contact}}
    </p>
    <h3>
        Order Details:
    </h3>
    <p>
        {{$text}} <br>
    </p>
    <p>
        Total: {{$total}} <br>
        Transaction ID: {{$transaction_id}} <br>
        Address: {{$address}} <br> {{$city}} <br> {{$country}} <br>
    </p>

</div>
</body>
</html>
