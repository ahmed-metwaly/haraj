<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
<h2>رابط استعادة كلمة المرور</h2>
<div>
	
	
	{{ URL::route('reset-password', ['active' => $token]) }}.
	<br>
</div>

</body>
</html>