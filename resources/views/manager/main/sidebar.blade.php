<aside class="main-sidebar sidebar-dark-primary elevation-4 inverted">
  {{-- <a href="" class="brand-link">
    <img src="{{URL::to('/')}}/image/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
    @php preg_match_all('/(?<=\s|^)[a-z]/i', Auth::user()->getSchool->school_name, $schools); @endphp
    <span class="brand-text font-weight-light">{{strtoupper(implode('', $schools[0]))}} 
    @if(Auth::user()->getBatch)
      ({{Auth::user()->getBatch->name}})
    @endif
  </span>
  </a> --}}
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image pt-1">
        @php 
        $auth_name = Auth::user()->name.' '.Auth::user()->last_name; 
        preg_match_all('/(?<=\s|^)[a-z]/i', $auth_name, $matches); 
        @endphp
        <span class="border border-light rounded-circle py-1 {{count($matches[0]) == 1 ? 'px-2' : 'px-'.(3-count($matches[0]))}} bg-success text-light text-capitalize elevation-3">{{strtoupper(implode('', $matches[0]))}}</span>
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{ route('manager.address.index')}}" class="nav-link {{ (request()->is('manager/address*')) ? 'active' : '' }}">
            <i class="nav-icon fa-solid fa-location-dot"></i>
            <p>
              Address
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.day.index')}}" class="nav-link {{ (request()->is('manager/day*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Days
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.slider.index')}}" class="nav-link {{ (request()->is('manager/slider*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Slider
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('manager.category.index')}}" class="nav-link {{ (request()->is('manager/category*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Category
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.specialist.index')}}" class="nav-link {{ (request()->is('manager/specialist*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Specialist
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.hospital.index')}}" class="nav-link {{ (request()->is('manager/hospital*')) ? 'active' : '' }}">
            <i class="nav-icon fa-solid fa-house-medical"></i>
            <p>
              Hospital
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('manager.doctor.index')}}" class="nav-link {{ (request()->is('manager/doctor*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-md"></i>
            <p>
              Doctor
            </p>
          </a>
        </li> 
         <li class="nav-item">
          <a href="{{route('manager.prescription.index')}}" class="nav-link {{ (request()->is('manager/prescription*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
             Prescriptions
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
  </div>
</aside>