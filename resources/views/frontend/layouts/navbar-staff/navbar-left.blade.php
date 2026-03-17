@php
    $warehouses = DB::table('warehouse')->where('status', 'ใช้งานได้')->get();
@endphp
<!-- Sidenav -->
<nav class="navbar navbar-vertical  fixed-left  navbar-expand-lg navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('assets/img/brand/logo-eky.png') }}" class="navbar-brand-img" alt="...">
            </a>
            <!-- Toggle Button -->
            <button class="navbar-toggler d-block d-lg-none" type="button" data-toggle="collapse"
                data-target="#sidenav-collapse-main">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-inner mt-3">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="#wholesale" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="wholesale">
                            <i class="fa fa-inbox"></i>
                            <span class="nav-link-text">คลังสินค้า</span>
                        </a>
                        <div class="collapse show" id="wholesale">
                            <ul class="nav nav-sm flex-column">
                                @foreach ($warehouses as $warehouse => $value)
                                    <li class="nav-item">
                                        <a href="{{ url('staff/tyre') }}-{{ $value->url }}"
                                            class="nav-link">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span class="nav-link-text">ออกจากระบบ</span>
                        </a>
                        <form id="logout-form"
                            action="{{ 'App\Staff' == Auth::getProvider()->getModel() ? route('staff.logout') : route('staff.logout') }}"
                            method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>