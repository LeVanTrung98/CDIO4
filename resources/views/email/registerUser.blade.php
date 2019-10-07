<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Send mail register</title>
	<style>
		*{
			margin: 0px;
			padding: 0px;
		}
		.container{
			width: 60%;
			margin: auto;
		}
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>{{ucfirst($name)}} thân mến!</h2>
		<div>
			<p>{{ucfirst($name)}} vui lòng click vào link bên dưới để kích hoạt tài khoản</p>
			<a href="{{route('registerUser')}}">Click Here!</a>
		</div>
	</div>
</body>
</html>