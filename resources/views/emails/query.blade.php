<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h2>
        User Details:
    </h2>
    <h3>
        Name:
    </h3>
    <p>
        {{$name}}
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
        Message:
    </h3>
    <p>
        {{$text}}
    </p>

</div>
</body>
</html>
