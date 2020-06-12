 <!--Start sidebar-wrapper-->
 <div id="sidebar-wrapper" class="sidebar-kaprodi" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
   <a href="index.html">
    <img src="{{ asset('images/uogp.png') }}" class="logo-icon" alt="logo icon">
    <h5 class="logo-text">PRODI {{ Auth::user()->dosen->prodi->nm_prodi }}</h5>
  </a>
</div>
<div class="user-details">
 <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
   <div class="avatar"><img class="mr-3 side-user-img" src="{{ asset('images/uogp.png') }}" alt="user avatar"></div>
    <div class="media-body">
    <h6 class="side-user-name">{{ Auth::user()->dosen->nm_dosen }}</h6>
   </div>
    </div>
  <div id="user-dropdown" class="collapse">
   <ul class="user-setting-menu">
     <li><a href="{{ route('kaprodiProfile.index') }}"><i class="icon-user"></i>  Profile</a></li>
     <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-power"></i> Logout</a></li>
   </ul>
  </div>
   </div>
<ul class="sidebar-menu">
   <li class="sidebar-header">MENU KAPRODI</li>
   <li>
     <a href="{{ route('kaprodi') }}" class="waves-effect">
       <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
     </a>
  </li>
   <li>
     <a href="{{ route('kaprodiDosen.index') }}" class="waves-effect">
       <i class="zmdi zmdi-male-female"></i> <span>Dosen</span>
     </a>
  </li>
   <li>
     <a href="{{ route('kaprodiJadwal.index') }}" class="waves-effect">
       <i class="zmdi zmdi-accounts-outline"></i> <span>Jadwal</span>
     </a>
  </li>
 </ul>

</div>
<!--End sidebar-wrapper-->