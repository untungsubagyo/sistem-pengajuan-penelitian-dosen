@extends('layout.root')

@section('content')
<div id="app">
   <div id="sidebar" class='active'>
      <div class="sidebar-wrapper active">
         <div class="sidebar-header">
            <h1>Reviewer</h1>
            <!-- <img src="assets/images/logo.svg" alt="" srcset=""> -->
         </div>
         <div class="sidebar-menu">
            <ul class="menu">
               <li class="sidebar-item">
                  <a href="{{ route('reviewer') }}" class='sidebar-link'>
                     <i data-feather="home" width="20"></i>
                     <span>Daftar Proposal</span>
                  </a>
               </li>
               <li class="sidebar-item">
                  <a href="{{ route('reviewer.viewAllDraf') }}" class='sidebar-link'>
                     <i data-feather="book" width="20"></i>
                     <span>Draf Review</span>
                  </a>
               </li>
            </ul>
         </div>
         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
   </div>
   <div id="main">
      <nav class="navbar navbar-header navbar-expand navbar-light">
         <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
         <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
               {{-- account --}}
               <li class="dropdown">
                  <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                     <div class="avatar me-1">
                        <img src="https://pa1.narvii.com/6474/bc2b4e9086166d632df3aebf1518fc2527cb344a_128.gif" alt="" srcset="">
                     </div>
                     <div class="d-none d-md-block d-lg-inline-block">Hi, Sagiri Izumi</div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                     <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                  </div>
               </li>
            </ul>
         </div>
      </nav>
      @yield('content-reviewer')
   </div>
</div>
@endsection