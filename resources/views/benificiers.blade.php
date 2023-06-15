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

            <div class="col-md-12" >
                <div class="card">
                    <div class="card-header"><h4 style="color: rgb(4, 52, 148);">{{ __('Listes des Bènèficiaires') }}</h4></div>

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
                                            
                                                <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Code_postal</th>
                            <th>Ville</th>
                            <th>Date_naissance</th>
                            <th>Numero-de-carte </th>
                            <th>Code_pin</th>
                            <th>Solde_dispo</th>
                            <th>Image</th>

                          
                                         
                                                <th style="text-align: center;"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z"/>
                                                  </svg></th>
                                                
                                                <th style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                  </svg></th>
                                            </tr>
                                            </thead>
                                            

             <tbody>
                @foreach($beneficiers  as $beneficier)

             <tr>
                    
                             <td> {{$beneficier->id}}</td>
                             <td>{{$beneficier->nom}}</td>
                             <td>{{$beneficier->prenom}}</td>
                             <td>{{$beneficier->email}}</td>
                            <td> {{$beneficier->code_postal}}</td>
                            <td> {{$beneficier->ville}}</td>
                            <td> {{$beneficier->date_naissance}}</td>   

                            <td>{{$beneficier->numero_de_carte}}</td>
                            <td>{{$beneficier->code_pin}}</td>
                            @if($beneficier->solde_dispo)
                            <td>{{$beneficier->solde_dispo}}€</td>
                            @else
                            <td>N/A</td>
                            @endif

                            <td>
                                <img style="width: 50%;height:50%;" src="data:image/jpeg;base64,{{$beneficier->image}}" />
                              </td>
                            @if($beneficier->numero_de_carte == null)

                            <form action="{{ route('generate.card', ['id' => $beneficier->id]) }}" method="POST">
                                @csrf
                            <td><button type="submit" class="btn btn-success mx-auto">Générer Carte</button></td>
                        </form>
                        @else
                        <td><button type="submit" class="btn btn-success mx-auto" disabled>Générer Carte</button></td>
                        @endif

                    <td>    
                        <form action="{{ route('delete.beneficier', ['id' => $beneficier->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-auto">Supprimer</button>
                        </form>
                    
                    </td>

                    <td>
              
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
@endsection
<style> button:hover{background-color: rgb(245, 236, 236);}</style>