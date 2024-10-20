<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('public/assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">David Grey. H</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Quản lý thành viên</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.index') }}">Quản lý thành viên</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.catalogue.index') }}">Quản lý
                            nhóm</a>
                    </li>
                </ul>
            </div>
        </li> --}}
        @foreach (config('apps.module.module') as $key => $val)
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#{{$val['id']}}" aria-expanded="false"
                    aria-controls="{{$val['id']}}">
                    <span class="menu-title">{{ $val['title'] }}</span>
                    <i class="menu-arrow"></i>
                    <i class="{{ $val['icon'] }} menu-icon"></i>
                </a>
                @if (isset($val['subModule']))
                    <div class="collapse" id="{{$val['id']}}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($val['subModule'] as $module)
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('user.index') }}">{{ $module['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
