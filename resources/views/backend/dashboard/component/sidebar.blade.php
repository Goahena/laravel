@php
    $segment = request()->segment(1);
    $segment2 = request()->segment(2);
    $avatar = Session::get('UserImage');
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ isset($avatar) ? asset($avatar) : asset('assets/images/faces-clipart/pic-1.png') }}" class="me-2" alt="image">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Session::get('UserName')}}</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        @foreach (config('apps.module.module') as $key => $val)
            <li class="nav-item {{ ($val['name']==$segment) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#{{$val['id']}}" aria-expanded="false"
                    aria-controls="{{$val['id']}}">
                    <span class="menu-title">{{ $val['title'] }}</span>
                    <i class="menu-arrow"></i>
                    <i class="{{ $val['icon'] }} menu-icon"></i>
                </a>
                @if (isset($val['subModule']))
                    <div class="collapse {{ ($val['name']==$segment) ? 'show' : '' }}" id="{{$val['id']}}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($val['subModule'] as $module)
                                <li class="nav-item"> 
                                    <a class="nav-link {{ ($module['name']==$segment2) ? 'active' : '' }}"
                                        href="{{ route($module['route']) }}"> {{ $module['title'] }}</a>
                                    </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
