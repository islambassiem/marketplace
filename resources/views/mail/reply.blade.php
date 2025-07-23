<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Email</title>
</head>
<body style="font-family: sans-serif; background-color: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <h2 style="color: #2d3748;">{{ $subject ?? 'Hello!' }}</h2>
        <p style="color: #4a5568;">{{ $intro }}</p>

        @isset($actionText)
            <p>
                <a href="{{ $actionUrl }}"
                   style="display: inline-block; background-color: #3490dc; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                   {{ $actionText }}
                </a>
            </p>
        @endisset

        <p style="color: #4a5568;">{{ $content }}</p>

        @if (!empty($outro))
            <hr>
            <p style="color: #718096;">{{ $outro }}</p>
        @endif

        <p style="margin-top: 30px;">Thanks,<br>{{ config('app.name') }}</p>
    </div>
</body>
</html>
