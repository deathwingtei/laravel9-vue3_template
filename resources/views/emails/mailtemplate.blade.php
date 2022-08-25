<!DOCTYPE html>
<html>
<head>
    <title>Mail Info From Devuweb Laravel Template</title>
</head>
<body>
    <h1>{{ $mailData['name'] }}</h1>
    <p>{{ $mailData['email'] }}</p>
    <p>{{ $mailData['tel'] }}</p>
    <br> <br>
    <p>{{ $mailData['message'] }}</p>
</body>
</html>