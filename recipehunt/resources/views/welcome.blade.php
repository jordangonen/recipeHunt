<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
<!--title -->
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>

<!--centered routing	-->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/redirect') }}">Login with Facebook</a>
                        <!--<a href="{{ url('/register') }}">Register</a>-->

                    @endif
                </div>
            @endif
<!--page title-->
            <div class="content">
                <div class="title m-b-md">
                    Recipe Hunt
				</div>
<!--					sub header-->
                <div class="sub-text">
                    <h4><i>Discover your next favorite recipe</i></h4>
                </div>
                <!---->
                <!--<div class="links">-->
                <!--    <a href="https://laravel.com/docs">Documentation</a>-->
                <!--    <a href="https://laracasts.com">Laracasts</a>-->
                <!--    <a href="https://laravel-news.com">News</a>-->
                <!--    <a href="https://forge.laravel.com">Forge</a>-->
                <!--    <a href="https://github.com/laravel/laravel">GitHub</a>-->
                <!--</div>-->
            </div>
        </div>
<!--			sub panels-->
     <section id="panel2">
        <div class="container flex-center">
            <div class="row margin-40">
            <div class="center">
                            <h2 class="white">How it Works</h2>

            </div>
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h4 class="white">It is as easy as Pie.</h4>
                </div>
            </div>
        </div>
        <!--<div class="row margin-80">-->
<!--		feature 1-->

        <div class="col-sm-6 feature-container">
            <!--<br />-->
            <ul class="list-unstyled feature-list text-center">
    					<li class="heading"><h3 class="white">Create & Share with Your Friends</h3></li>
                        <!--<br>-->
    					<li>Create <b>Custom</b> Recipes</li>
                        <li>Upload <b>step by step</b> guides</li>
                        <li><b>Share</b> to all your friends</li>
                        <li></li>
                        <!--<li><i class="fa fa-plus-square-o" aria-hidden="true"></i></li> -->
    					<!--<li class="features last btn btn-secondary btn-wide"><a href="#">Get Started</a></li>-->
                        <!--<br>-->
    				</ul>
        </div>
<!--			feature 2 -->
            <div class="col-sm-6 feature-container">
            <!--<br />-->
            <ul class="list-unstyled feature-list text-center">
    					<li class="heading"><h3 class="white">Discover New Recipes and Save For Later</h3></li>
                            <!--<br>-->
                        <li>Find <b>new</b> recipes when you need them</li>
                        <li><b>Filter</b> by food category</li>
                        <li>Save <b>unique</b> recipes for later</li>
    				</ul>
            </div>
      
    </section>
<!--		feature 3 (which is just sign up-->

     <section id="panel3">
        <div class="container flex-center">
            <div class="row margin-40">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h2 class="login-call">Sign Up</h2>

                </div>


            </div>
		</div>
	 </section>
    </body>
</html>
