<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <div class="fadeIn first">
            <p>&nbsp;</p>
          </div>
      
          <!-- Login Form -->
        <form action="{{route('dologin')}}" method="post">
            @csrf
            <input type="email" id="login" class="fadeIn second" name="email" value="{{old('email')}}" placeholder="login">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
             @enderror
             @if($errors->any())
                 <div class="text-danger">{{ $errors->first() }}</div>
            @endif
            <input type="submit" class="fadeIn fourth" value="Log In">
          </form>
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            {{-- <a class="underlineHover" href="#">Forgot Password?</a> --}}
          </div>
      
        </div>
      </div>
     
</body>
</html>
