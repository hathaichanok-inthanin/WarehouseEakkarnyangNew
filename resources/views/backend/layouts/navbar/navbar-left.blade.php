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
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="ni ni-tv-2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wholesale" data-toggle="collapse" role="button" aria-expanded="true"
                            aria-controls="wholesale">
                            <i class="fa fa-inbox"></i>
                            <span class="nav-link-text">คลังสินค้า</span>
                        </a>

                        <div class="collapse show" id="wholesale">
                            <ul class="nav nav-sm flex-column">
                                @foreach ($warehouses as $warehouse => $value)
                                    <li class="nav-item">
                                        <a href="{{ url('/tyre') }}-{{ $value->url }}"
                                            class="nav-link">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#wholesalebusiness" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="wholesalebusiness">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-link-text">ธุรกิจค้าส่ง</span>
                        </a>

                        <div class="collapse" id="wholesalebusiness">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('register-wholesale-business') }}">
                                        ลงทะเบียนใหม่
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('account-wholesale-business') }}">
                                        ข้อมูลธุรกิจค้าส่ง
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#branchaccount" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="branchaccount">
                            <i class="fa fa-users"></i>
                            <span class="nav-link-text">จัดการบัญชีสาขา</span>
                        </a>

                        <div class="collapse" id="branchaccount">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('register-branch-account') }}">
                                        ลงทะเบียนใหม่
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('account-branch') }}">
                                        ข้อมูลบัญชีสาขา
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#adminaccount" data-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="adminaccount">
                            <i class="fa fa-user-secret"></i>
                            <span class="nav-link-text">จัดการบัญชีผู้ดูแลระบบ</span>
                        </a>

                        <div class="collapse" id="adminaccount">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('register-admin') }}">
                                        ลงทะเบียนใหม่
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('account-admin') }}">
                                        ข้อมูลผู้ดูแลระบบ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
