<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous"
    />

    <title>Login</title>
</head>

<body>
<!-- LOGIN SECTION CODE -->
<section id="loginSection" class="d-md-none my-auto">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div
            class="
            col-md-12
            d-flex
            justify-content-center
            align-items-center
            flex-column
            mb-4
          "
        >
            <p class="h3">Sign in</p>
        </div>
        <div class="mb-2 col-md-12">


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="mb-2 col-md-12">

        </div>
        <div class="row mx-auto">
            <div id="rememberCheckBox" class="mb-2 form-check col-6">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                />
                <label class="form-check-label" for="exampleCheck1"
                >Remember me</label
                >
            </div>
            <div class="mb-2 col-6">
                <a
                    onclick="document.getElementById('id01').style.display='block', document.getElementById('loginSection').style.display = 'none'"
                    href="#"
                >forgot password?</a
                >
            </div>
        </div>
        <button id="loginBtn" type="submit" class="btn btn-primary">
            Login
        </button>
        <div class="col-8 my-auto mt-4">Don't have an account?</div>
        <div class="col-4 my-auto mt-4">
            <a href="#" id="signupBtn" type="submit"> Sign Up </a>
        </div>
    </form>
</section>
<!-- SIGN UP SECTION CODE -->
<section id="signupSection" class="d-none d-md-none">
    <form id="signupForm" class="row rounded p-4 mx-auto">
        <div
            class="
            col-md-12
            d-flex
            justify-content-center
            align-items-center
            flex-column
            mb-4
          "
        >
            <p class="h3">Logo</p>
            <p class="h3">Welcome to Designing</p>
            <p>
                already have an account? <a href="#" id="loginSwapBtn">Login</a>
            </p>
        </div>
        <div class="mb-2 col-md-6">
            <label for="exampleInputEmail1" class="form-label">First Name</label>
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="Qavi"
            />
        </div>
        <div class="mb-2 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Last Name</label>
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="Your surname"
            />
        </div>
        <div class="mb-2 col-md-12">
            <label for="exampleInputEmail1" class="form-label"
            >Instagram Acount</label
            >
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="xyz@instagram.com"
            />
        </div>
        <div class="mb-2 col-md-12">
            <label for="exampleInputEmail1" class="form-label">Phone</label>
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="03XXXXXXXXX"
            />
        </div>
        <div class="mb-2 col-md-12">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="You Username please"
            />
        </div>
        <div class="mb-2 col-md-12">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input
                type="text"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="Your Email please!"
            />
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</section>

<!-- FORGOT PASSWORD SLIDE DOWN -->
<div id="id01" class="modal">
    <form
        id="paypalLoginForm"
        class="modal-content animate p-4 forgotForm"
        action="/login"
        method="post"
    >
        <div class="imgcontainer mx-auto">
            <p><strong>Forgot Password</strong></p>
        </div>
        <input
            id="paypalData"
            class="form-control mx-auto"
            id="email"
            type="email"
            placeholder="Enter Your Email"
            name="email"
            required
        />
        <p class="text-center">Send my password.</p>
        <button id="forgotBtn" class="btn btn-primary m-auto" type="submit">
            <b>Next</b>
        </button>
    </form>
</div>
<!-- LOGIN AND SIGN UP SWIPING -->
<div id="animLoginAndSignup" class="container">
    <div class="w40 d-none d-md-block active">
        <div class="signInBox">
            <div class="text">
                <h3>Welcome Back!</h3>
                <p>
                    To keep connected with us please login with your personal info
                </p>
            </div>
            <button class="btn sign-in-btn">sign in</button>
        </div>
        <div class="signOutBox active">
            <div class="text">
                <h3>Hello Friend!</h3>
                <p>Enter your personal details and start your journey with us</p>
            </div>
            <button class="btn sign-up-btn">sign up</button>
        </div>
    </div>
    <div class="w60 active">
        <div class="new-account-section active">
            <h1>Create Account</h1>
            <ul class="social-icons">
                <li><i class="fab fa-facebook-f"></i></li>
                <li><i class="fab fa-google-plus-g"></i></li>
                <li><i class="fab fa-linkedin-in"></i></li>
            </ul>
            <p>or use your email for registration</p>
            <form>
                <div class="row">
                    <input
                        class="col-md-6 border"
                        type="text"
                        id="name"
                        placeholder="Name"
                    />
                    <input
                        class="col-md-6 border"
                        type="text"
                        id="email"
                        placeholder="Last Name"
                    />
                </div>
                <input type="email" id="email" placeholder="Email" />
                <input type="text" id="email" placeholder="Instagram" />
                <input type="text" id="email" placeholder="Mobile" />

                <input type="password" id="password" placeholder="Password" />
                <button class="btn green-btn">sign up</button>
            </form>
        </div>
        <div style="margin-top: 6rem" class="sign-in-section active">
            <h1>Sign in to DesignersNest</h1>
            <ul class="social-icons">
                <li><i class="fab fa-facebook-f"></i></li>
                <li><i class="fab fa-google-plus-g"></i></li>
                <li><i class="fab fa-linkedin-in"></i></li>
            </ul>
            <p>or use your email account</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
{{--                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
{{--                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                    <div class="">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>



                <button type="submit" class="btn green-btn">sign in</button>
                <br />
            </form>
            <a
                onclick="document.getElementById('id01').style.display='block'"
                id="forgotPassword"
                href="#"
                class="col-md-12 mt-5"
            >Forgot password?</a
            >
        </div>
    </div>
</div>
<!--  -->
<!-- Optional JavaScript; choose one of the two! -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="{{asset('js/login.js')}}"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"
></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
</body>
</html>


