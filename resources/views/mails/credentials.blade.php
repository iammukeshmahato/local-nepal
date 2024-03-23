<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Credentials</title>
</head>

<body>

    <h1>Congratulations</h1>
    <p>Your are successfully registered as Guide in <strong>Local Nepal</strong>. Below are your credentails:</p>

    <h1>Login Credentials</h1>
    <p>Dear {{ $name }},</p>
    <p>Your login credentials are:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
        <li><strong>URL: </strong>{{ $url }}</li>
    </ul>
    <p>Please keep your login credentials confidential and do not share them with anyone.</p>
    <p>Thank you!</p>
</body>

</html>
