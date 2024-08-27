<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
       .content {
            padding: 20px;
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="content">
        <h3>Hi, {{ $president->fname }}!</h3>
        <p>{{ $message }}</p>
        <p>Agriculturist: <h3>{{ $user->fullname }}</h3></p>
        <br><br>
        <p>Best regards,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>