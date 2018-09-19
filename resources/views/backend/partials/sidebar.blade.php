<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <ul class="app-menu">

    <li><a class="app-menu__item {{ (Route::is('admin.dashboard') ? 'active' : '') }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.courseTeacher.index') ? 'active' : '') }}" href="{{ route('admin.courseTeacher.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Course Teacher</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.student.index') ? 'active' : '') }}" href="{{ route('admin.student.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Student</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.teacher.index') ? 'active' : '') }}" href="{{ route('admin.teacher.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Teacher</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.course.index') ? 'active' : '') }}" href="{{ route('admin.course.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Course</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.department.index') ? 'active' : '') }}" href="{{ route('admin.department.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Deparment</span></a></li>

    <li><a class="app-menu__item {{ (Route::is('admin.faculty.index') ? 'active' : '') }}" href="{{ route('admin.faculty.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Faculty</span></a></li>
    
    <li><a class="app-menu__item {{ (Route::is('admin.question.index') ? 'active' : '') }}" href="{{ route('admin.question.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Review Question</span></a></li>
  </ul>
</aside>
