<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    {{-- <li class="nav-item d-none d-sm-inline-block my-auto" style="transform: rotate( 270deg);" >
      <input id="toggle-event" type="checkbox" data-onstyle="warning" data-offstyle="dark" data-toggle="toggle" data-size="mini" data-on="<i class='fas fa-sun'></i>" data-off="<i class='fas fa-moon'></i>" data-style="slow">
    </li> --}}

    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url()->previous()}}" class="nav-link">Back</a>
     
    </li>

    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link"  href="{{ route('admin.user.index') }}">
        <i class="fas fa-user-tie mr-1" title="Add School"></i> Create User
      </a>
     
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('admin.student.create') }}">
        <i class="fas fa-user-tie mr-1" title="Add School"></i> Add Student
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('admin.teacher.create') }}">
        <i class="fas fa-chalkboard-teacher mr-1" title="Add School"></i> Add Teacher
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('admin.setting.index')}}">
        <i class="fas fa-tools mr-1" title="School Setting"></i> Setting
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('admin.profile.index')}}">
        <i class="fas fa-tools mr-1" title="Profile Setting"></i> Profile
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('admin.password.index') }}">
        <i class="fas fa-key fa-lg"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('logout') }}"  class="nav-link bg-danger float-right"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      <i class="fa fa-power-off"></i>
      </a>
     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
     </form>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.report.index')}}" class="nav-link" data-widget="" data-slide="true">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true">
        <i class="fas fa-th-large"></i>
      </a>
    </li> --}}
  </ul>
</nav>