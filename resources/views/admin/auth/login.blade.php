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
                            <h2>Hello Admin!</h2>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <!--Forms-->
                        <div>
                            
                            <form action="{{route('adminLogin')}}" method="POST">
                                @csrf
                                <h1>Login Form</h1>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" placeholder="email" class="form-control" name="email" value={{old('email')}}>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col">
                                        <input type="password" placeholder="password" class="form-control" name="password" value={{old('password')}}>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
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


