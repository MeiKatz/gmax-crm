@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body p-4 py-5 text-center">
               <img src="https://ui-avatars.com/api/?name={{$client->name}}&color=7F9CF5&background=EBF4FF" class="avatar avatar-rounded avatar-xl mb-4 bg-cyan-lt">
                <h3 class="mb-0">{{$client->name}}</h3>
                <p class="text-muted">Added : {{$client->created_at->diffForHumans()}}</p>
                <p class="mb-3">
                    <span class="badge bg-green">Active</span>
                </p>
                <div>
                  

                </div>
                <a href="tel:{{$client->phone}}" style="margin-top: 10px;" type="button"
                    class="btn btn-dark btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <path
                            d="M4 4h5l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v5a1 1 0 0 1 -1 1a16 16 0 0 1 -16 -16a1 1 0 0 1 1 -1">
                        </path>
                        <path d="M15 7a2 2 0 0 1 2 2"></path>
                        <path d="M15 3a6 6 0 0 1 6 6"></path>
                    </svg> Call Now</a>
            </div>
            <div class="progress card-progress">
                <div class="progress-bar bg-lime" style="width: 100%" role="progressbar" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
        <br> <br>
     
        <div class="dropdown-menu dropdown-menu-demo" style="margin-top:15px;">
            <span class="dropdown-header">Menu</span>
            <a class="dropdown-item " href="#invoices">
                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                Invoices
            </a>
            <a class="dropdown-item " href="#quotes">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right:10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="16" width="3" height="5" rx="1" /><path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z" /><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3" /></svg>
               Quotations
            </a>
            <a class="dropdown-item " href="#projects">
              
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" style="margin-right:10px;" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12v-4" /><path d="M15 12v-2" /><path d="M12 12v-1" /><path d="M3 4h18" /><path d="M4 4v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-10" /><path d="M12 16v4" /><path d="M9 20h6" /></svg>
                Projects
            </a>

        </div>
      
        
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Basic info
                  <form method="post" action="{{ route('clients.destroy', [ $client ]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="float: right; margin-left:10px;" class="btn btn-sm btn-warning ml-2">Delete Client</button>
                  </form>
                  <a href="{{ route('clients.edit', [ $client ]) }}" style="float: right; margin-left:10px;" class="btn btn-sm btn-primary ml-2">Edit Client</a>
                </div>
                <div class="mb-2">
                
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                    Name : <strong>{{$client->name}}</strong>
                </div>
                <div class="mb-2">
                  
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                    Email : <strong>{{$client->email}}</strong>
                </div>
                <div class="mb-2">
           
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>
                    Phone : <strong>{{$client->phone}}</strong>
                </div>
                <div class="mb-2">
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="7" width="18" height="13" rx="2" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><line x1="12" y1="12" x2="12" y2="12.01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg> 
    
    Business : <strong> {{$client->business}} </strong>
                </div>
                <div class="mb-2">
              
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                     Tax No :  <strong> {{$client->taxid}} </strong>
                </div>
                <div class="mb-2">
                  
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
      Address : <strong> {{$client->address}} </strong>
                  </div>
                  <div class="mb-2">
             
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
      Address Line :
      <strong> {{$client->address2}} </strong>
                  </div>
                  <div class="mb-2">
                 
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                       City : <strong> {{$client->city}} </strong>
                  </div>
                  <div class="mb-2">
                 
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                                     State : <strong> {{$client->state}} </strong>
               </div>

               <div class="mb-2">
                 
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                                 Country : <strong> {{$client->country}} </strong>
           </div>

           <div class="mb-2">
                 
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                             Zip  : <strong> {{$client->zip}} </strong>
       </div>

            </div>
        </div>


        <div class="card" id="projects"  style="margin-top:15px;">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>
            </div>
            <div class="table-responsive" id="theTable">
                <table class="table card-table table-vcenter text-nowrap datatable" >
                  <thead>
                      <tr>
                          <th>ID </th>
                          <th>Title </th>
                          <th>Client </th>
                          <th>Start Date </th>
                          <th>Deadline </th>           
                          <th>Staus</th>
                          
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    
                      @foreach($projects as $project)
                      <tr>
                         
                          <td>
                            
                             # {{$project->id}}
                          </td>
                          <td><a href="{{route('viewproject', ['id' => $project->id])}}"> {{$project->projectname}}</a></td>
                          <td>
                            <a href="{{ route('clients.show', [ 'client' => $project->clientdata->id ]) }}">{{$project->clientdata->name}}</a>
                          </td>
                          <td>
                              {{$project->startdate}}
                          </td>
                          <td> {{$project->deadline}}
                          </td>  
                        
                          <td>
                            <x-project-status :project="$project" />
                          </td>
                         
                          <td class="text-right">
                             
                                  <a href="/project/{{$project->status}}" class="btn  btn-sm "
                                    >View Project</a>
                                 
                            
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing  {{$projects->count()}} entries</p>
                <ul class="pagination m-0 ms-auto">
                  {{$projects->links()}}
                </ul>
              </div>
        </div>

        
        <div class="card" id="invoices"  style="margin-top:15px;">
            <div class="card-header">
                <h3 class="card-title">Invoices</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                      <tr>
                          <th>Invo ID </th>
                          <th>Title </th>                         
                          <th>Date </th>
                          <th>Due Date </th>
                          <th>Amount</th>
                          <th>Paid</th>
                          <th>Type</th>                          
                          <th>Staus</th>
                          
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    
                      @foreach($invoices as $invoice)
                      <tr>
                         
                          <td>
                           
                             # {{$invoice->invoid}}
                          </td>
                          <td><a href="{{route('editinvoice', ['id' => $invoice->id])}}"> {{$invoice->title}}</a></td>
                         
                          <td>
                              {{$invoice->invodate}}
                          </td>
                          <td> {{$invoice->duedate}}
                          </td>
                          <td> {{$invoice->totalamount}}
                          </td>
                          <td> {{$invoice->paidamount}}
                          </td>
                          <td>
                            @if($invoice->recorringtype==NULL)One Time @endif
                            @if($invoice->recorringtype==1)Daily @endif
                            @if($invoice->recorringtype==2)Weekly @endif
                            @if($invoice->recorringtype==3)Monthly @endif
                            @if($invoice->recorringtype==4)Yearly @endif
                        </td>                        
                          <td>
                            <x-invoice-status :invoice="$invoice" />
                          </td>
                         
                          <td class="text-right">
                              <span class="dropdown ml-1">
                                  <button class="btn  btn-sm dropdown-toggle align-text-top"
                                      data-boundary="viewport" data-toggle="dropdown">Actions</button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="{{ route('invoices.edit', [ $invoice ]) }}">
                                          Edit Invoice
                                      </a>
                                      <form method="post" action="{{ route('invoices.destroy', [ $invoice ]) }}"  onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Delete Invoice</button>
                                      </form>
                                  </div>
                              </span>
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing  {{$invoices->count()}} entries</p>
                <ul class="pagination m-0 ms-auto">
                  {{$invoices->links()}}
                </ul>
              </div>
            </div>


        <div class="card" id="quotes"  style="margin-top:15px;">
            <div class="card-header">
                <h3 class="card-title">Quotes</h3>
            </div>

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                      <tr>
                          <th> ID </th>
                          <th>Title </th>                         
                          <th>Date </th>
                          <th>Due Date </th>
                          <th>Amount</th>                        
                          <th>Staus</th>
                          
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    
                      @foreach($quotes as $quote)
                      <tr>
                         
                          <td>
                              
                             # {{$quote->quoteid}}
                          </td>
                          <td><a href="{{route('editquote', ['id' => $quote->id])}}"> {{$quote->title}}</a></td>
                         
                          <td>
                              {{$quote->invodate}}
                          </td>
                          <td> {{$quote->duedate}}
                          </td>
                          <td> {{$quote->totalamount}}
                          </td>
                         
                          <td>
                            <x-offer-status :offer="$quote" />
                          </td>
                         
                          <td class="text-right">
                              <span class="dropdown ml-1">
                                  <button class="btn  btn-sm dropdown-toggle align-text-top"
                                      data-boundary="viewport" data-toggle="dropdown">Actions</button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="/quote/edit/{{$quote->id}}">
                                          Edit Quote
                                      </a>
                                      <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                          href="/invoices/delete/{{$quote->id}}">
                                          Delete Delete
                                      </a>
                                  </div>
                              </span>
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing  {{$quotes->count()}} entries</p>
                <ul class="pagination m-0 ms-auto">
                  {{$quotes->links()}}
                </ul>
              </div>
            </div>
            
   

            
        </div>

    </div>
</div>

 



@endsection
