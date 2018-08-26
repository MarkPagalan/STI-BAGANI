@extends('layouts.da')

@section('content')

         
                   
                  <div class="card">
                        <div class="header">
                            <h2>
                                VIEW CATEGORY DATES DETAILS
                               
                            </h2>
                        </div>
                        <div class="body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    You are logged in here!

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Billing Amount</th>
                                <th>View Details</th>
                                <th>Bill</th>
                                
                            </tr>
                        </thead>
                         <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Billing Amount</th>
                                <th>View Details</th>
                                <th>Bill</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php 
                                $user_loop = $user['users'] ;

                            @endphp
                            @foreach($user_loop as $user_temp)
                            <tr>
                                <td>{{ $user_temp->name }}</td>
                                <td>{{ $user_temp->id }}</td>
                                <td>

                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-view-details{{ $user_temp->id }}" 
                                    href="{{ URL::to('/survey/methods' . $user_temp->id) }}" data_value="{{ $user_temp->id }}">Edit 
                                    </a>

                                </td>


        <div class="modal fade" id="modal-view-details{{ $user_temp->id}}"" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green">
                            <h4 class="modal-title" id="defaultModalLabel">View Billing</h4>
                        </div>
                        <div class="modal-body">
                            <form ">
                                <div class="form-group">

                                    @php 
                                        $viewlevels = $user['viewmeter'] ;
                                        $total = 0;
                                        $count = 0;
                                            
                                    @endphp
                                    <div class="form-control panel  bg-green">
                                        <label> <span>Particulars </span> </label>
                                    </div>
                                    
                                    @foreach($viewlevels as $viewlevel)

                                        @if($user_temp->id == $viewlevel->id )
                                            @php

                                                $count = $count + 2;
                                                
                                            @endphp
                                       
                                            <label> <span>Date Read: </span> </label>
                                            <span class = "form-group " >{{ $viewlevel->created_at }}</span>
                                            </br>
                                        @endif
                                    @endforeach
                                        @php
                                            $total = $count * 10;
                                        @endphp
                                    </br></br>
                                     <label> <span>Total Pumping of Water: </span>       </label> 
                                    <span class = "form-group " >{{ $count/2 }} </span></br>
                                    <label> <span>Rate per Liters of Water Released:      </span> </label>
                                    <span class = "form-group " >PHP 10.00 </span>
                                    

                                    <div class="form-control panel bg-blue">
                                        <label> <span>Total Bill: </span> </label>
                                        <span class = "form-group " >PHP {{ $total }}.00</span>
                                    </div>

                            </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-green">
                           <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>-->
                            <button type="button" class="btn btn-primary btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
                                <td>
                                    
                                   
                                    <form action="/dashboard/assigns/{{$user_temp->id}}"> 
                                        <input name="id" type="hidden" class="form-control" placeholder="{{$user_temp->id }}" value="{{$user_temp->id}}"> 
                                        <input name="total" type="hidden" class="form-control" placeholder="{{$user_temp->id }}" value="{{$total}}"> 
                                        <button type="submit" name="delete" method="POST" class="btn btn-danger">Bill</button>
                                            {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                </div>
            </div>
        
  
    </div>

@endsection
