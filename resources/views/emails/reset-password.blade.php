<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset Request</h2>

    <p>You requested to reset your password.</p>

    <p>
        <a href="{{ $url }}"
           style="padding:10px 16px;background:#4f46e5;color:#fff;
                  text-decoration:none;border-radius:6px;">
            Reset Password
        </a>
    </p>

    <p>This link will expire in 60 minutes.</p>

    <p>If you didn’t request this, ignore this email.</p>
</body>
</html>
