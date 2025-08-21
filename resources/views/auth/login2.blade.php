@extends('auth.layout.template')

@section('title', 'Login')
@section('content')
{{-- LOGIN/REGISTRATION FORM STARTS --}}
    <div class="container" style="min-height: 350px">
        <div class="row mt-3">
            <div class="col-8 offset-2">
                <div class="row mt-2">
                    <div class="col-md-4 ">
                        <!--Data or Content-->
                        <div class="">
                            <h2>Hello!</h2>
                            <form action="{{route('register')}}" method='GET'>
                                @csrf
                                <button class="btn btn-success" >Sign up</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!--Forms-->
                        <div>
                            @foreach ($errors->all() as $message)
                                    <p><small class="text-danger">{{$message}}</small></p>
                            @endforeach
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <h1>Login Form</h1>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" placeholder="email" class="form-control" name="email" value={{old('email')}}>
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col">
                                        <input type="password" placeholder="password" class="form-control" name="password" value={{old('password')}}>
                                    </div>
                                </div>

                                <div class="row ">
                                    <!-- Remember Me -->
                                    <div class="col-6">
                                        <div class="">
                                            <label for="remember_me" class="">
                                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" >Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






@section('scripts')
<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>


        function signup()
{
    document.querySelector(".login-form-container").style.cssText = "display: none;";
    document.querySelector(".signup-form-container").style.cssText = "display: block;";
    document.querySelector(".login-container").style.cssText = "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
    document.querySelector(".button-1").style.cssText = "display: none";
    document.querySelector(".button-2").style.cssText = "display: block";

};

function login()
{
    document.querySelector(".signup-form-container").style.cssText = "display: none;";
    document.querySelector(".login-form-container").style.cssText = "display: block;";
    document.querySelector(".login-container").style.cssText = "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
    document.querySelector(".button-2").style.cssText = "display: none";
    document.querySelector(".button-1").style.cssText = "display: block";

}



</script>

@endsection

{{-- footer --}}


