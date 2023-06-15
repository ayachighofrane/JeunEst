@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex flex-row"  style="margin-left:70%;">
                <div class="card"        style="background-color:rgb(142, 85, 159);">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="p-2">
                                <a href="/dashboard" >
                                <button type="button" class="btn btn-muted mx-auto">Transactions</button></a>

                            </div>
                            <div class="p-2">
                                <a href="/partenaires" >
                                    <button type="button" class="btn btn-muted mx-auto">Partenaires</button></a>
                            </div>
                            <div class="p-2">
                                
                                <a href="/benificiers" >
                                    <button type="button" class="btn btn-muted mx-auto">Beneficiaires</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div><br/>
        </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4 style="color: rgb(4, 52, 148);">{{ __('Listes des partenaires') }}</h4></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    @if(session('success'))
                                        <div class="alert alert-success">{{session('success')}}</div><br>
                                    @endif
                                    @if(session('error'))
                                        <div class="alert alert-danger">{{session('error')}}</div><br>
                                    @endif
                                    <div class="table-responsive">
                                      
                                        <table id="myTable" class="table table-striped">
                                           
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Siret </th>
                                                <th>Raison_sociale</th>
                                                <th>Nom</th>
                        <th>Prenom</th><th>Email</th>
                           
                                     
                                                
                                                <th ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                  </svg></th>
                                            </tr>
                                            </thead>
                                            
                                          @foreach($partenaires as $partenaire)
                                                <tbody>
                                                <tr>
                                                     <td> {{$partenaire->id}}</td>
                                                    <td>{{$partenaire->siret}}</td>
                                                                    <td> {{$partenaire->raison_sociale}}</td>
        
                                                    <td>{{$partenaire->nom}}</td>
                             <td>{{$partenaire->prenom}}</td>
                             <td>{{$partenaire->email}}</td>
                                       
                                        
                                                    
                             <td>
                                <form action="{{ route('delete.partenaire', ['id' => $partenaire->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-auto">Supprimer</button>
                                </form>
                            </td>

                    
                                                 
        
                                                </tr>
                                                @endforeach
        
                                                </tbody>
                                        </table>
                                    
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> button:hover{background-color: rgb(245, 236, 236);}</style>