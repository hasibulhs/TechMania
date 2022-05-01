<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>TechMania</title>

    <!-- Latest compiled and minified CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <script type="text/javascript">
        window.baseUrl="{{URL::to('/')}}";
    </script>
    
    {{View::make('header')}}
    
	<div class="container custom-reg">
	<div class="row mb-3">
		<form action="register" method="POST" class="col-md-6 col-xs-12 offset-md-3 auth-form"  id="regitration_form">
			@csrf
			<div class="form-title">
				SIGN UP
			</div>
			<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" id="first_name" placeholder="First Name">
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" id="last_name" placeholder="Last Name">
				</div>
				</div>
			</div>
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted"></small>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" autocomplete="false" id="password" placeholder="Password">
			</div>

			<div class="form-group">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" autocomplete="false" id="confirm_password" placeholder="Confirm Password">
			</div>
			<div class="form-check">
				<input type="checkbox" {{(old('terms'))?'checked':''}} name="terms" id="terms" class="form-check-input">
				<label class="form-check-label" for="terms_check">Check our <a href="#">terms</a> and <a href="#">conditions</a></label>

			</div>
			<div id="terms_error"></div>
				<br><br>
			<div><button type="submit" class="btn btn-primary mt-2">Submit</button>&nbsp; Already have an account? <a href="/login">sign in</a> here</div>
		</form>
	</div>
	</div>

    <script type="text/javascript" src="{{ asset('js/auth.js') }}"></script>
</body>
</html>