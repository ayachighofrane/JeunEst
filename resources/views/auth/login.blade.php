@extends('layouts.app')

@section('content')


  



<div class="container" >
    <div class="row justify-content-center" >
        
        <div class="col-md-8">
  <!-- Add logo -->
    <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo">
         <br/>  <br/> 
        

<div class="card"  style="  border-color: rgb(30, 30, 120);
border-style: solid;
border-width: 5px;">

                <div class="card-header" >{{ __('Connexion') }}</div>

                <div class="card-body">


<br/> 
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="  font-weight: bolder;
                            color: rgb(30, 30, 120);">{{ __(' Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br/>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="  font-weight: bolder;
                            color: rgb(30, 30, 120);">{{ __('Mot de passe ') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Souviens moi ') }}
                                    </label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="  font-weight: bolder;
                            color: rgb(30, 30, 120);">
                                {{ __('Mot de passe oubliè ?') }}
                            </a>
                        @endif
                        </div>
                      
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                
                                <button type="submit" class="btn btn-success" style=" background-color: rgb(46, 53, 124);
                                border-style: solid;
                                border-radius: 6%;  width:55%; margin-top:-5%;">
                                    {{ __('Connexion') }}
                                </button>
                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<style>

.card-header{
    text-align: center;
    font-weight: bolder;
    color: rgb(30, 30, 120);
    letter-spacing: 2px;

}

.card{
    width: 73%; 
    height:34%;
    margin-left: 15%;
    margin-bottom: 50%;
  

}


img{
width: 88%;
height:15%;
padding-left: 15%;
margin-top: 5%;
}



</style>