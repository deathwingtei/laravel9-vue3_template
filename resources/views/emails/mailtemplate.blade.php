<!DOCTYPE html>
<html>
<head>
    <title>Mail Info From Devuweb Laravel Template</title>
</head>
<body>
    <h1>Name : {{ $mailData['name'] }}</h1>
    <p>Email {{ $mailData['email'] }}</p>
    <p>Tel : {{ $mailData['tel'] }}</p>
    <br>
    <p>Message : {{ $mailData['message'] }}</p>
</body>
</html>