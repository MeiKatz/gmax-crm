@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<link href="/dist/libs/fullcalendar/core/main.min.css" rel="stylesheet"/>
<link href="/dist/libs/fullcalendar/daygrid/main.min.css" rel="stylesheet"/>
<link href="/dist/libs/fullcalendar/timegrid/main.min.css" rel="stylesheet"/>
<link href="/dist/libs/fullcalendar/list/main.min.css" rel="stylesheet"/>


    <div class="row">
        <div class="col-md-3 mb-2">
          <a href="/invoices?filter[invostatus]=1">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-yellow text-white avatar">                       
	                     <x-icon.invoice />
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ __('Unpaid_Invoices') }}
                      </div>
                      <div class="text-muted">
                        {{$counts['unpaid']}}   {{ __('Unpaid_Invoices') }}
                      </div>
                    </div>
                  </div>
                </div>          
              </div></a>
        </div>
        <div class="col-md-3 mb-2"> 
          <a href="/invoices?filter[invostatus]=3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-lime text-white avatar">
                        <x-icon.paid-invoice />
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ __('Paid_Invoices') }}
                      </div>
                      <div class="text-muted">
                        {{$counts['paid']}}   {{ __('Paid_Invoices') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>

        <div class="col-md-3 mb-2">
          <a href="/quotes">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-teal text-white avatar">                   
	                     <x-icon.offer />
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ __('Quotes') }}
                      </div>
                      <div class="text-muted">
                        {{$counts['quotes']}}  {{ __('Quotes') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>

        <div class="col-md-3 mb-2">
          <a href="/projects?filter[status]=2">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-blue text-white avatar">
	                       <x-icon.project />
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ __('Active_Projects') }}
                      </div>
                      <div class="text-muted">
                        {{$counts['prjinprogress']}}  {{ __('Active_Projects') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-body">
                  <h3 class="card-title"> {{ __('Accounts_Summary') }}</h3>
                  <div id="chart-mentions" class="chart-lg"></div>
                </div>
              </div>

        </div>
        <div class="col-md-4 mb-2">
           
                <div class="card ">
                  <div class="card-body mb-4">
                    <h3 class="card-title"> {{ __('Project_summary') }}</h3>
                    <div id="chart-demo-pie"></div>
                  </div>
                </div>
            
        </div>
    </div>


    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">               
            <div id="calendar-main" class="card-calendar"></div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">

    
          <div class="card">
            <div class="card-body">               
              <h3 class="card-title"> {{ __('Notifications') }}</h3>
              <div class="list-group list-group-flush list-group-hoverable">
                @foreach($notifications as $notif)
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-auto"><span class="status-dot status-dot-animated {{$notif->style}} d-block"></span></div>
                    <div class="col text-truncate">
                      <a href="{{$notif->link}}" class="text-body d-block">From {{$notif->added->name}} {{$notif->created_at->diffForHumans()}}</a>
                      <div class="d-block text-muted text-truncate mt-n1">
                       {{$notif->message}}
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="/notification/update/{{$notif->id}}" class="list-group-item-actions">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <polyline points="9 11 12 14 20 6"></polyline>
                          <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                       </svg>
                      </a>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
            </div>
          </div>
    

        <div class="card mt-3">
          <div class="card-body">               
            <h3 class="card-title"> {{ __('My_Tasks') }}</h3>
            @foreach($tasks as $task)  
        <div class="col-12 mb-3">
            <div class="card card-sm">
              <div class="ribbon ribbon-top ribbon-bookmark {{$task->type}}">
                @if($task->status==1)
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="12" y1="6" x2="12" y2="3"></line>
                  <line x1="16.25" y1="7.75" x2="18.4" y2="5.6"></line>
                  <line x1="18" y1="12" x2="21" y2="12"></line>
                  <line x1="16.25" y1="16.25" x2="18.4" y2="18.4"></line>
                  <line x1="12" y1="18" x2="12" y2="21"></line>
                  <line x1="7.75" y1="16.25" x2="5.6" y2="18.4"></line>
                  <line x1="6" y1="12" x2="3" y2="12"></line>
                  <line x1="7.75" y1="7.75" x2="5.6" y2="5.6"></line>
               </svg>
                @else 
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M7 12l5 5l10 -10"></path>
                  <path d="M2 12l5 5m5 -5l5 -5"></path>
               </svg>
                @endif
              </div>
              <div class="card-body">
                @if($task->status==1)<a href="/mytasks/view/{{$task->id}}"> <h3 class="card-title">Project Name - Case ID #{{$task->id}}</h3></a> @else
                <a href="/mytasks/view/{{$task->id}}">  <s> <h3 class="card-title">Project Name - Case ID #{{$task->id}}</h3></a> </s> @endif

             
                <div class="text-muted">{{$task->task}}</div>
                <div class="mt-4">
                  <div class="row">
                    <div class="col">
                      <div class="avatar-list avatar-list-stacked">
                        @if($task->assignedto)                          
                       <span class="avatar  rounded-circle" data-toggle="tooltip" data-placement="bottom" style="background-image: url({{$task->assigned->profile_photo_url}})" title="Assigned to : {{$task->assigned->name}} "></span>                      
                         @endif
                   
                       
                      </div>
                    </div>
                    <div class="col-auto text-muted">
                        <div class="spinner-grow {{$task->type}}" style="height: 12px; width:12px; padding-top: -15px" role="status"></div>
                 
                    </div>
                    <div class="col-auto">
                      <a href="#" class="link-muted"><!-- Download SVG icon from http://tabler-icons.io/i/message -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path><line x1="8" y1="9" x2="16" y2="9"></line><line x1="8" y1="13" x2="14" y2="13"></line></svg>
                       {{$task->comments->count()}}</a>
                    </div>
                    <div class="col-auto">
                        <a href="/project/tasks/delete/{{$task->id}}" onclick="return confirm('Are you sure?')" class="text-muted">
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @endforeach
          </div>
        </div>
      </div>
      

    </div>  
  
        
<div class="card mt-3">
    <div class="card-header">
      <h3 class="card-title">{{ __('Unpaid_Invoices') }}</h3>
      <button type="button" data-toggle="modal" data-target="#modal-simple"
      style="float: right; right:0; margin-right:10px; position: absolute;"
      class="btn btn-warning btn-sm">{{ __('Create_new_invoice') }}</button>
    </div>

    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th>{{ __('INVO_ID') }} </th>
                <th>{{ __('TITLE') }} </th>
                <th>{{ __('CLIENT') }} </th>
                <th>{{ __('DATE') }} </th>
                <th>{{ __('DUE_DATE') }}  </th>
                <th>{{ __('AMOUNT') }}</th>
                <th>{{ __('PAID') }}</th>
                <th>{{ __('STATUS') }}</th>
                
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
                  <a href="/client/ {{ !empty($invoice->client) ? $invoice->client->id:'' }}">   {{ !empty($invoice->client) ? $invoice->client->name:'Removed' }} </a>
                </td>
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
                  <x-invoice-status :invoice="$invoice" />
                </td>
               
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn  btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/invoices/edit/{{$invoice->id}}">
                              {{ __('Edit_Invoice') }}
                            </a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                href="/invoices/delete/{{$invoice->id}}">
                                {{ __('Delete_Invoice') }}
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
      <p class="m-0 text-muted">{{ __('Showing') }}  {{$invoices->count()}} {{ __('entries') }}</p>
      <ul class="pagination m-0 ms-auto">
        {{$invoices->links()}}
      </ul>
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Invoice</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('createnewinvoice')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Invoice Title</label>
                <input type="text" class="form-control" name="title" placeholder="Invoice Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('clients.create')}}" style="float:right;"> Add New Client </a></label>
                <x-select-client
                  name="userid"
                  id="select-users"
                />
            </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Invoice</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    


  <script src="/dist/libs/fullcalendar/core/main.min.js"></script>
  <script src="/dist/libs/fullcalendar/daygrid/main.min.js"></script>
  <script src="/dist/libs/fullcalendar/interaction/main.min.js"></script>
  <script src="/dist/libs/fullcalendar/timegrid/main.min.js"></script>
  <script src="/dist/libs/fullcalendar/list/main.min.js"></script>



    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>

<script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 240,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: true
                    },
                    stacked: false,
                },
                plotOptions: {
                    bar: {
                        columnWidth: '40%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Income",
                    data: [ @for($i=0; $i<40; $i++) '{{ $datas[$i]['count']}}' , @endfor ]
                },
                {
                    name: "Expense",
                    data: [ @for($i=0; $i<40; $i++) '{{ $quotedata[$i]['count']}}' , @endfor ]
                }],
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                xaxis: {
                    labels: {
                        padding: 0
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [ @for($i=0; $i<40; $i++) ' {{ $datas[$i]['date']}} ' , @endfor
                    ],
                colors: ["#74B816", "#F59F00", "#bfe399"],
                legend: {
                    show: true,
                    position: 'bottom',
                    height: 32,
                    offsetY: 8,
                    markers: {
                        width: 8,
                        height: 8,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                    },
                },
            })).render();
        });
        // @formatter:on
      </script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
            chart: {
                type: "donut",
                fontFamily: 'inherit',
                height: 240,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            series: [{{$counts['prjnotstart']}}, {{$counts['prjinprogress']}}, {{$counts['prjinreview']}}, {{$counts['prjincompleted']}}],
            labels: ["Not Started", "In Progress", "In Review", "Completed"],
            grid: {
                strokeDashArray: 4,
            },
            colors: ["#C6CAD0", "#4299E1", "#F59F00", "#2FB344"],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
            tooltip: {
                fillSeriesColor: false
            },
        })).render();
    });
    // @formatter:on
  </script>


  
  <script>
      document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar-main'),
               today = new Date(),
               y = today.getFullYear(),
               m = today.getMonth(),
               d = today.getDate();
            window.FullCalendar && (new FullCalendar.Calendar(calendarEl, {
      	   plugins: [ 'interaction', 'dayGrid','dayGridWeek' ],
               themeSystem: 'standard',
      	   header: {
      		   left: 'dayGrid,dayGridWeek,dayGridMonth',
      		   center: '',
      		   right: 'prev,next,'
      	   },
      	   selectable: true,
      	   selectHelper: true,
      	   nowIndicator: true,
      	   views: {
      		   dayGridMonth: { buttonText: ' Month' },
      		   dayGridWeek: { buttonText: ' Week' },
                 dayGrid: { buttonText: 'Today' }
      		  
      	   },
      	   defaultView: 'dayGridMonth',
      	   timeFormat: 'H(:mm)',
      	   events: [
       
            @foreach($tasks as $task)            
                 {
                     title: '{{$task->task}}',
                     start: '{{$task->created_at}}',
                     className: '{{$task->type}}',
                     url: '/mytasks/view/{{$task->id}}'
                  },
                  @endforeach
                 
               ]
         })).render();
      });
    </script>

@endsection
