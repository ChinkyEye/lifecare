<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
	<div class="py-3 control-sidebar-content">
    {{-- <h5>Customize AdminLTE</h5><hr class="mb-2"/> --}}
    <ul class="nav nav-sidebar flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.fee-report.index')}}" class="nav-link {{ (request()->is('home/account-section/report/fee-report*')) ? 'active' : '' }}">
          {{-- <i class="far fa-circle nav-icon"></i> --}}
          <i class="fas fa-file-alt nav-icon"></i>
          <span>Fee Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.teacher.profile')}}" class="nav-link {{ (request()->is('home/report/teacher*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Teacher Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.student.profile')}}" class="nav-link {{ (request()->is('home/report/student*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Student Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.teacherattendance-report.index')}}" class="nav-link {{ (request()->is('home/attendance/report/teacherattendance-report*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Teacher Attendance Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.studentattendance-report.index')}}" class="nav-link {{ (request()->is('home/attendance/report/studentattendance-report*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Student Attendance Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.earning.index')}}" class="nav-link {{ (request()->is('home/report/earning*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Earning Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.payment.index')}}" class="nav-link {{ (request()->is('home/report/payment*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Payment Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.earningpayment.index')}}" class="nav-link {{ (request()->is('home/report/earningpayment*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Earning Payment Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.anumanitaayabaya.index')}}" class="nav-link {{ (request()->is('home/report/anumanitaayabaya*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Anumanit AayeByaya Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.kharchajinsi.index')}}" class="nav-link {{ (request()->is('home/report/kharchajinsi*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Kharcha Jinsi Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.khapnejinsi.index')}}" class="nav-link {{ (request()->is('home/report/khapnejinsi*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Khapne Jinsi Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.khatapana.index')}}" class="nav-link {{ (request()->is('home/report/khatapana*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Khata Pana Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.jinsimaagfarum.index')}}" class="nav-link {{ (request()->is('home/report/jinsimaagfarum*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Jinsi Maag Farum Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.report.gharjagga.index')}}" class="nav-link {{ (request()->is('home/report/gharjagga*')) ? 'active' : '' }}">
          <i class="fas fa-file-signature nav-icon"></i>
          <span>Ghar Jagga Report</span>
        </a>
      </li>
    </ul>
  </div>
</aside>