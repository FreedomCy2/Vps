<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Support request</title>
</head>
<body style="font-family:system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
  <h2>New support request</h2>
  <p><strong>Name:</strong> {{ $data['name'] }}</p>
  <p><strong>Email:</strong> {{ $data['email'] }}</p>
  @if(!empty($data['subject']))
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
  @endif
  <p><strong>Message:</strong></p>
  <div style="white-space:pre-wrap; border-left:4px solid #e5e7eb; padding:8px;">
    {{ $data['message'] }}
  </div>
  <hr>
  <p>This message was submitted from the Clinic Flow admin support form.</p>
</body>
</html>