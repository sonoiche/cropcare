<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Password</title>
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
        <h3>Hi, {{ $user->fname }}!</h3>
        <p>We are pleased to inform you that your account has been successfully created on {{ config('app.name') }}. To get you started, we have generated a temporary password for you.</p>
        <p>Temporary Password: <h3>{{ $password }}</h3></p>
        <br><br>
        <p>Best regards,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>