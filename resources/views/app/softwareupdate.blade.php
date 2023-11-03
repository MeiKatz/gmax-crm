 <!-- CSS files -->
 <link href="./dist/css/tabler.min.css?1657267040" rel="stylesheet"/>
 <link href="./dist/css/tabler-flags.min.css?1657267040" rel="stylesheet"/>
 <link href="./dist/css/tabler-payments.min.css?1657267040" rel="stylesheet"/>
 <link href="./dist/css/tabler-vendors.min.css?1657267040" rel="stylesheet"/>
 <link href="./dist/css/demo.min.css?1657267040" rel="stylesheet"/>
</head>
<body  class=" border-top-wide border-primary d-flex flex-column">
 <div class="page page-center">
   <div class="container-tight py-4">
     <div class="text-center mb-4">
       <a href="." class="navbar-brand navbar-brand-autodark"><img src="/images/businesslogo.png" height="36" alt=""></a>
     </div>
     <form class="card card-md" action="." method="get" autocomplete="off">
       <div class="card-body text-center">
         <div class="mb-4">
           <h2 class="card-title">Software Update</h2>
           <p class="text-muted">Update Your Software to the latest version</p>
         </div>
        
         
         <div>
           <a href="{{ route('runupdate') }}" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
             </svg>
             Update Now
           </a>
         </div>
       </div>
     </form>
   </div>
 </div>


 <script src="./dist/js/tabler.min.js?1657267040" defer></script>
 <script src="./dist/js/demo.min.js?1657267040" defer></script>
</body>
