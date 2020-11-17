<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login_panel.css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2|Aldrich|Oxanium|Play&display=swap" rel="stylesheet">
    <meta name="description" content="{{__('login_panel_description')}}">
	 <meta name="author" content="Imaggo">
    <title>{{__('imaggo_project_menager_register_panel')}}</title>
</head>
<body class="login-panel-body">
   @if($errors->any())
   <div class="error-information-container">
      <div class="error-header">
         <x-icon-error-cross/>{{__('incorrect_login_data')}}<x-icon-error-cross/>
      </div>
   </div>
   @endif
   <main class="login-form-container">
      <img src="/images/decoration/imaggo_logo.svg" alt="" class="immago-logo">
      <form action="{{route('auth.login')}}" method="POST" class="login-form">
         @csrf
         <label for="login" class="login-form-label">{{__('login')}}</label>
         <input type="text" class="login-form-input" name="login" id="login">
         <label for="password" class="login-form-label">{{__('password')}}</label>
         <input type="password" class="login-form-input" name="password" id="password">
         <button class="login-button" type="submit">{{__('log_in')}}</button>
      </form>
   </main>
</body>
</html>