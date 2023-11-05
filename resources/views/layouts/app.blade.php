<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$settings->companyname}}</title>

     
        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>

        <link rel="icon" href="/images/icon.png" type="image/png"/>
        <link rel="shortcut icon" href="/images/icon.png" type="image/png"/>
        <!-- CSS files -->
        <link href="/dist/css/tabler.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="/dist/css/demo.min.css" rel="stylesheet"/>

        <script src="/js/jquery.min.js"></script>
        <style>
          .input-money > .input-group-text {
            border-right: none;
            background-color: #fff;
          }

          .theme-dark .input-money > .input-group-text {
            background-color: #1b2434;
          }

          .input-money > .form-control {
            border-left: none;
          }

          #hideMe {
            -webkit-animation: cssAnimation 5s forwards; 
            animation: cssAnimation 5s forwards;
            position: fixed;
                    right: 0;
                    margin-top:80px;
        }
        @keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
        @-webkit-keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
         </style>


        @livewireStyles
        @stack('scripts')

        <!-- Scripts -->
        <script src="/js/alpine.js" defer></script>
    </head>
    <body class="layout-fluid ">
        <div class="page">
          <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark d-none d-lg-block">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
              </button>
              <h1 class="navbar-brand navbar-brand-autodark">
                <a href="/">
                  <img src="/storage/uploads/{{$settings->logo}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                </a>
              </h1>
             
              <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav pt-lg-3">
                  <li @class([
                    'nav-item',
                    'active' => Request::routeIs('dashboard'),
                  ])>
                    <a class="nav-link" href="/" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.dashboard />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Dashboard') }}
                      </span>
                    </a>
                  </li>

                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('clients.*'),
                  ])>
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.client />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Clients') }}
                      </span>
                    </a>
                    <ul class="dropdown-menu  ">
                      <li >
                        <a class="dropdown-item" href="{{ route('clients.index') }}" >
                          {{ __('Client_Manager') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('clients.create') }}" >
                          {{ __('Add_New_Client') }}
                        </a>
                      </li>
                     
                     
  
                     
                    </ul>
                  </li>

                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('invoices.*'),
                  ])>
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.invoice />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Invoices') }}
                      </span>
                    </a>
                    <ul class="dropdown-menu ">
                      <li >
                        <a class="dropdown-item" href="{{ route('invoices.index') }}" >
                          {{ __('All Invoices') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('invoices.index', [
                          'filter' => [
                            'invostatus' => 1,
                          ]
                        ]) }}">
                          {{ __('Unpaid Invoices') }}
                        </a>
                      </li>

                      <li >
                        <a class="dropdown-item" href="{{ route('invoices.index', [
                          'filter' => [
                            'invostatus' => 2,
                          ]
                        ]) }}">
                          {{ __('Part paid Invoices') }}
                        </a>
                      </li> 
                      
                      <li >
                        <a class="dropdown-item" href="{{ route('invoices.index', [
                          'filter' => [
                            'invostatus' => 3,
                          ]
                        ]) }}">
                          {{ __('Paid Invoices') }}
                        </a>
                      </li>                  
                     
  
                     
                    </ul>
                  </li>

                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('offers.*'),
                  ])>
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.offer />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Quotation') }}
                      </span>
                    </a>
                    <ul class="dropdown-menu  ">
                      <li >
                        <a class="dropdown-item" href="{{ route('offers.index') }}">
                          {{ __('Quotation') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('offers.index', [
                          'filter' => [
                            'quotestat' => 1,
                          ]
                        ]) }}">
                          {{ __('Pending Quotes') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('offers.index', [
                          'filter' => [
                            'quotestat' => 2,
                          ]
                        ]) }}">
                          {{ __('Approved Quotes') }}
                        </a>
                      </li>
                     
                     
  
                     
                    </ul>
                  </li>

                  
                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('projects.*'),
                  ])>
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.project />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Projects') }}
                      </span>
                    </a>
                    <ul class="dropdown-menu  ">
                      <li >
                        <a class="dropdown-item" href="{{ route('projects.index') }}" >
                          {{ __('Projects') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('projects.index', [
                          'filter' => [
                            'status' => 2,
                          ]
                        ]) }}">
                          {{ __('Ongoing Projects') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('projects.index', [
                          'filter' => [
                            'status' => 5,
                          ]
                        ]) }}">
                          {{ __('Completed Projects') }}
                        </a>
                      </li>
                     
                     
  
                     
                    </ul>
                  </li>

                  
                
                 

                  

                  
                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('tasks.*'),
                  ])>
                    <a class="nav-link" href="{{ route('tasks.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.task />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Tasks') }}
                      </span>
                    </a>
                  </li>

                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::routeIs('expenses.*'),
                  ])>
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.expense />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Expenses') }}
                      </span>
                    </a>
                  </li>

               

                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::is('file-manager'),
                  ])>
                    <a class="nav-link" href="{{ route('file-manager') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.file-manager />
                      </span>
                      <span class="nav-link-title">
                        {{ __('File_Manager') }}
                      </span>
                    </a>
                  </li>
                
                  @if( auth()->user()->is_admin )
                  <li @class([
                    'nav-item',
                    'dropdown',
                    'active' => Request::is('lead'),
                  ])>
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon.admin-panel />
                      </span>
                      <span class="nav-link-title">
                        {{ __('Admin_Panel') }}
                      </span>
                    </a>
                    <ul class="dropdown-menu  ">
                      <li >
                        <a class="dropdown-item" href="{{route('admin.users.index')}}" >
                          {{ __('Admin_Manager') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{route('admin.settings.show')}}" >
                          {{ __('Settings') }}
                        </a>
                      </li>
                      <li >
                        <a class="dropdown-item" href="{{ route('admin.settings.invoice.show') }}" >
                          {{ __('Customize Invoice') }}
                        </a>
                      </li>
                     
                     
  
                     
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
          </aside>

          <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl ">
              <div class="d-block d-lg-none">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a href="{{ route('dashboard') }}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                <img src="/storage/uploads/{{$settings->logo}}"  style="margin-top: -5px;" alt="{{$settings->companyname}}" class="navbar-brand-image">
              </a>
              </div>
              <div class="navbar-nav flex-row order-md-last">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                  <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                  <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                </a>
               <!-- <div class="nav-item dropdown d-none d-md-flex me-3">
                  <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
          
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="badge bg-red"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Last updates</h3>
                      </div>
                      <div class="list-group list-group-flush list-group-hoverable">
                        
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-auto"><span class="status-dot d-block"></span></div>
                            <div class="col text-truncate">
                              <a href="#" class="text-body d-block">Example 2</a>
                              <div class="d-block text-muted text-truncate mt-n1">
                                justify-content:between ⇒ justify-content:space-between (#29734)
                              </div>
                            </div>
                            <div class="col-auto">
                              <a href="#" class="list-group-item-actions show">
                              
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                      
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ auth()->user()->profile_photo_url }})"></span>
                    <div class="d-none d-xl-block ps-2">
                      <div>{{ auth()->user()->name }}</div>
                      <div class="mt-1 small text-muted">{{ auth()->user()->email }}</div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Edit_profile') }}</a>
                    <div class="dropdown-divider"></div>
             
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">

<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M7 12h14l-3 -3m0 6l3 -3" /></svg>
                     {{ __('Logout') }}
                 </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                  </div>
                </div>
            
         
             
               
              </div>
            



              <div class="collapse navbar-collapse" id="navbar-menu">
                <div class=" d-block  d-lg-none">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                  <ul class="navbar-nav">
                    
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('dashboard'),
                    ])>
                      <a class="nav-link" href="/" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="13" r="2"></circle>
                            <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                            <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                         </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Dashboard') }}
                        </span>
                      </a>
                    </li>
  
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('clients.*'),
                    ])>
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Clients') }}
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="{{ route('clients.index') }}">
                            {{ __('Client_Manager') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('clients.create') }}">
                            {{ __('Add_New_Client') }}
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>
  
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('invoices.*'),
                    ])>
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Invoices') }}
                        </span>
                      </a>
                      <ul class="dropdown-menu ">
                        <li >
                          <a class="dropdown-item" href="{{ route('invoices.index') }}" >
                            {{ __('All Invoices') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('invoices.index', [
                            'filter' => [
                              'invostatus' => 1,
                            ]
                          ]) }}">
                            {{ __('Unpaid Invoices') }}
                          </a>
                        </li>
                        
                        <li >
                          <a class="dropdown-item" href="{{ route('invoices.index', [
                            'filter' => [
                              'invostatus' => 3,
                            ]
                          ]) }}">
                            {{ __('Paid Invoices') }}
                          </a>
                        </li>                  
                       
    
                       
                      </ul>
                    </li>
  
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('offers.*'),
                    ])>
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-quote" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 11h-4a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v6c0 2.667 -1.333 4.333 -4 5"></path>
                            <path d="M19 11h-4a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v6c0 2.667 -1.333 4.333 -4 5"></path>
                         </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Quotation') }}
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="{{ route('offers.index') }}" >
                            {{ __('Quotation') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('offers.index', [
                            'filter' => [
                              'quotestat' => 1,
                            ]
                          ]) }}">
                            {{ __('Pending Quotes') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('offers.index', [
                            'filter' => [
                              'quotestat' => 2,
                            ]
                          ]) }}">
                            {{ __('Approved Quotes') }}
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>
  
                    
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('projects.*'),
                    ])>
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-alt" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="4" y="8" width="4" height="4"></rect>
                            <line x1="6" y1="4" x2="6" y2="8"></line>
                            <line x1="6" y1="12" x2="6" y2="20"></line>
                            <rect x="10" y="14" width="4" height="4"></rect>
                            <line x1="12" y1="4" x2="12" y2="14"></line>
                            <line x1="12" y1="18" x2="12" y2="20"></line>
                            <rect x="16" y="5" width="4" height="4"></rect>
                            <line x1="18" y1="4" x2="18" y2="5"></line>
                            <line x1="18" y1="9" x2="18" y2="20"></line>
                         </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Projects') }}
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="{{ route('projects.index') }}" >
                            {{ __('Projects') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('projects.index', [
                            'filter' => [
                              'status' => 2,
                            ]
                          ]) }}">
                            {{ __('Ongoing Projects') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('projects.index', [
                            'filter' => [
                              'status' => 5,
                            ]
                          ]) }}">
                            {{ __('Completed Projects') }}
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>
  
                    
                  
                   
  
                    
  
                    
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('tasks.*'),
                    ])>
                      <a class="nav-link" href="{{ route('tasks.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="6" rx="1" /><rect x="4" y="14" width="6" height="6" rx="1" /><rect x="14" y="14" width="6" height="6" rx="1" /><line x1="14" y1="7" x2="20" y2="7" /><line x1="17" y1="4" x2="17" y2="10" /></svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Tasks') }}
                        </span>
                      </a>
                    </li>
  
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::routeIs('expenses.*'),
                    ])>
                      <a class="nav-link" href="{{ route('expenses.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                            <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                         </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Expenses') }}
                        </span>
                      </a>
                    </li>
  
                 
  
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::is('file-manager'),
                    ])>
                      <a class="nav-link" href="{{ route('file-manager') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-upload" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
                            <polyline points="9 15 12 12 15 15"></polyline>
                            <line x1="12" y1="12" x2="12" y2="21"></line>
                         </svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('File_Manager') }}
                        </span>
                      </a>
                    </li>
                  
                    @if( auth()->user()->is_admin )
                    <li @class([
                      'nav-item',
                      'dropdown',
                      'active' => Request::is('lead'),
                    ])>
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                        </span>
                        <span class="nav-link-title">
                          {{ __('Admin_Panel') }}
                        </span>
                      </a>
                      <ul class="dropdown-menu  ">
                        <li >
                          <a class="dropdown-item" href="{{route('admin.users.index')}}" >
                            {{ __('Admin_Manager') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{route('admin.settings.show')}}" >
                            {{ __('Settings') }}
                          </a>
                        </li>
                        <li >
                          <a class="dropdown-item" href="{{ route('admin.settings.invoice.show') }}">
                            {{ __('Customize Invoice') }}
                          </a>
                        </li>
                       
                       
    
                       
                      </ul>
                    </li>
                    @endif
                </ul>
               
                  <div class="ml-md-auto pl-md-4 py-2 py-md-0 mr-md-4 order-first order-md-last flex-grow-1 flex-md-grow-0">
                   
                  </div>
                </div>
              </div>
            </div>
            </div>
          </header>


          <div class="page-wrapper">
            <div class="container-xl">
          
          
          <div class="content">
            <div class="container-xl d-flex flex-column justify-content-center mt-3">
            <!-- Page Content -->
            <main>
              @yield('content')
            </main>
          </div>
          </div>
        </div>
        @stack('modals')

        @livewireScripts
        @if (\Session::has('success'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-green">Success</span>
                       {!! \Session::get('success') !!}
                  
            </div>
          </div>
          @endif 
          
          @if (\Session::has('warning'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-yellow">Warning</span>
                       {!! \Session::get('warning') !!}
                  
            </div>
          </div>
          @endif 

          @if (\Session::has('danger'))
        <div id='hideMe'>
          <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
              <span class="avatar avatar-xs me-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
              <strong class="me-auto">System</strong>
              <small>1 sec ago</small>
              <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">            
              <span class="badge bg-red">Error</span>
                       {!! \Session::get('danger') !!}
                  
            </div>
          </div>
          @endif 

        

        </div>

        <footer class="footer footer-transparent">
            <div class="container">
              <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ml-lg-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                   <a href="https://docs.coderprokit.com/" target="_blank" class="link-secondary">Documentation</a> 
                 
                    
                  </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                  Copyright © {{ date('Y') }}
                  <a href="." class="link-secondary">{{$settings->companyname}}</a>. 
                  All rights reserved.
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
  
      <!-- Libs JS -->
      <script src="/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="/dist/libs/jquery/dist/jquery.slim.min.js"></script>
      <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="/dist/libs/jqvmap/dist/jquery.vmap.min.js"></script>
      <script src="/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="/dist/libs/peity/jquery.peity.min.js"></script>
      <!-- Tabler Core -->
      <script src="/dist/js/tabler.min.js"></script>
      <script src="/dist/js/demo.min.js" defer></script>
     
      <script>
        document.body.style.display = "block"
      </script>
          <script src="/dist/libs/selectize/dist/js/standalone/selectize.min.js"></script>
          <script src="/dist/libs/flatpickr/dist/flatpickr.min.js"></script>
          <script src="/dist/libs/flatpickr/dist/plugins/rangePlugin.js"></script>
          <script src="/dist/libs/nouislider/distribute/nouislider.min.js"></script>
  
    </body>
</html>
