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
    <div class="container custom-login">
        <div class="row mb-3">
            <form action="login" method="POST" class="col-md-6 col-xs-12 offset-md-3 auth-form"  id="login_form">
                @csrf
                <div class="form-title">
                    SIGN IN
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" value="{{old('email')}}" id="exampleInputEmail1" name="email"  placeholder="Enter email">
                    @if($errors->any('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" autocomplete="false" id="exampleInputPassword1" placeholder="Enter Password">
                    @if($errors->any('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div><button type="submit" class="btn btn-primary mt-2">Login</button>&nbsp; Don't have an account <a href="/register">sign up</a> here</div>
            </form>	
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/auth.js') }}"></script>
</body>
</html>