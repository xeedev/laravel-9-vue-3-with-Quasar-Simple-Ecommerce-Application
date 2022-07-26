<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
<h2>Congratulations! You have a new order from {{$user}}</h2>
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
