<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @php
        $PermissionUsers = App\Models\RoleHasPermissionModel::getPermission('Users', Auth::user()->role_id);
        $PermissionRoles = App\Models\RoleHasPermissionModel::getPermission('Roles', Auth::user()->role_id);
        $PermissionSurat = App\Models\RoleHasPermissionModel::getPermission('Surat', Auth::user()->role_id);
        $PermissionSettings = App\Models\RoleHasPermissionModel::getPermission('Settings', Auth::user()->role_id);
        $PermissionSuratEksternal = App\Models\RoleHasPermissionModel::getPermission('Surat Eksternal', Auth::user()->role_id);
        $PermissionDisposisiSurat = App\Models\RoleHasPermissionModel::getPermission('Disposisi', Auth::user()->role_id);
      @endphp

      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('panel/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @if(!empty($PermissionUsers))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'users') collapsed @endif" href="{{ url('panel/users') }}">
          <i class="bi bi-person"></i>
          <span>Users</span>
        </a>
      </li>
      @endif
      
      @if(!empty($PermissionRoles))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'roles') collapsed @endif" href="{{ url('panel/roles') }}">
          <i class="bi bi-person"></i>
          <span>Roles</span>
        </a>
      </li>
      @endif
      
      @if(!empty($PermissionSurat))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'surat') collapsed @endif" href="{{ url('panel/surat') }}">
          <i class="bi bi-envelope"></i>
          <span>Surat</span>
        </a>
      </li>
      @endif
      
      @if(!empty($PermissionSuratEksternal))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'suratEksternal') collapsed @endif" href="{{ url('panel/suratEksternal') }}">
          <i class="bi bi-gear"></i>
          <span>Surat Eksternal</span>
        </a>
      </li>
      @endif

      @if(!empty($PermissionDisposisiSurat))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'disposisiSurat') collapsed @endif" href="{{ url('panel/disposisiSurat') }}">
          <i class="bi bi-gear"></i>
          <span>Disposisi Surat</span>
        </a>
      </li>
      @endif

      @if(!empty($PermissionSettings))
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(2) != 'settings') collapsed @endif" href="{{ url('panel/settings') }}">
          <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li>
      @endif
    </ul>

  </aside>