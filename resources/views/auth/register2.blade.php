@extends('auth.layout.template')
@section('title', 'Register')
@section('content')
<div class="container" style="min-height: 350px">
    <div class="row ">
        <div class="col-8 offset-2">
            <div class="row mt-2">
                <div class='col-md-4'>
                    <div>
                        <h2>Hello!</h2>
                        <form action="{{route('login')}}" method="GET">
                            @csrf
                            <button class="btn btn-primary" >Login</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <h1 class="mt-2">Sign Up Form</h1>
                        <div class="row px-2">
                            <div class="col-12">
                                <input type="text" placeholder="Name" class="form-control" name='name' value="{{old('name')}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3 px-2">
                            <div class="col">
                                <input type="email" placeholder="Email" class="form-control" name='email' value="{{old('email')}}">
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="phone" placeholder="Phone" class="form-control" name='phone' value="{{old('phone')}}">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3 px-2">
                            <div class="col">
                                <input type="password" placeholder="Password" class="form-control" name='password'>
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="password" placeholder="Confirm password" class="form-control" name='password_confirmation'>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <button class="btn btn-success" >Sign Up</button>
                        </div>
                    </form>
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

