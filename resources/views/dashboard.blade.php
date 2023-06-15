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

        
        </div>
    </div>
    <div><br/>
    </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-md-11" style="margin-left:5%">
    <div class="card">
        <div class="card-header"><h4 style="color: rgb(4, 52, 148);">{{ __('Listes des transactions') }}</h4></div>

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
                                    <th>Id </th>
                                    <th>Nom du partenaire </th>
                                    <th>Nom du bénéficiaire</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Montant_à_débiter</th>
                                    <th>Porte-monnaie</th>
            
               
                         
                                    
                                   
                                </tr>
                                </thead>
                                
                              @foreach($transactions as $trasaction)
                                    <tbody>
                                    <tr>
                                         <td> {{$trasaction->id}}</td>
                                        <td>{{$trasaction->partner_name}}</td>
                                                        <td> {{$trasaction->beneficiary_name}}</td>
                                                        <td> {{$trasaction->statut}}</td>
                                                        <td> {{$trasaction->date_RMH}}</td>
                                                        <td> {{$trasaction->montant_debiter}}€</td>
                                                        <td> {{$trasaction->Pm}}</td>
               
            
                           
                            
                                        
      

        
                                     

                                    </tr>
                                    @endforeach

                                    </tbody>
                            </table>
                        
                        </div>
























@endsection
<style> button:hover{background-color: rgb(245, 236, 236);}</style>