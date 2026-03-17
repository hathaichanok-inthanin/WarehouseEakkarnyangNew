  @php
      $warehouses = DB::table('warehouse')->where('status', 'ใช้งานได้')->get();
      $warehouse_mains = DB::table('warehouse')->where('warehouse_id', 'EKY00')->where('status', 'ใช้งานได้')->get();
      $warehouse_3s = DB::table('warehouse')
          ->where('warehouse_id', 'EKY00')
          ->Orwhere('warehouse_id', 'EKY04')
          ->Orwhere('warehouse_id', 'EKY05')
          ->where('status', 'ใช้งานได้')
          ->get();
      $warehouse_surats = DB::table('warehouse')->where('warehouse_id', 'EKY07')->where('status', 'ใช้งานได้')->get();
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
                          <a class="nav-link" href="#wholesale" data-toggle="collapse" role="button"
                              aria-expanded="true" aria-controls="wholesale">
                              <i class="fa fa-inbox"></i>
                              <span class="nav-link-text">คลังสินค้า</span>
                          </a>

                          <div class="collapse show" id="wholesale">
                              <ul class="nav nav-sm flex-column">
                                  @if (auth('customer')->user()->role == 'ดูได้ทุกคลัง')
                                      @foreach ($warehouses as $warehouse => $value)
                                          <li class="nav-item">
                                              <a href="{{ url('customer/tyre') }}-{{ $value->url }}"
                                                  class="nav-link">{{ $value->name }}</a>
                                          </li>
                                      @endforeach
                                  @endif
                                  @if (auth('customer')->user()->role == 'ดูได้เฉพาะคลังหลัก')
                                      @foreach ($warehouse_mains as $warehouse_main => $value)
                                          <li class="nav-item">
                                              <a href="{{ url('customer/tyre') }}-{{ $value->url }}"
                                                  class="nav-link">{{ $value->name }}</a>
                                          </li>
                                      @endforeach
                                  @endif
                                  @if (auth('customer')->user()->role == 'ดูได้เฉพาะคลังหลัก คลังไทวัสดุ และคลังบายพาส')
                                      @foreach ($warehouse_3s as $warehouse_3 => $value)
                                          <li class="nav-item">
                                              <a href="{{ url('customer/tyre') }}-{{ $value->url }}"
                                                  class="nav-link">{{ $value->name }}</a>
                                          </li>
                                      @endforeach
                                  @endif
                                  @if (auth('customer')->user()->role == 'ดูได้เฉพาะคลังสุราษฎร์ธานี')
                                      @foreach ($warehouse_surats as $warehouse_surat => $value)
                                          <li class="nav-item">
                                              <a href="{{ url('customer/tyre') }}-{{ $value->url }}"
                                                  class="nav-link">{{ $value->name }}</a>
                                          </li>
                                      @endforeach
                                  @endif
                              </ul>
                          </div>
                      </li>
                      @if (auth('customer')->user()->username == 'EkyWarehouse')
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('customer/stock-all-warehouse') }}">
                                  <i class="ni ni-tv-2"></i>
                                  <span class="nav-link-text">สรุปสต๊อกสินค้า</span>
                              </a>
                          </li>
                      @endif
                      <div class="dropdown-divider"></div>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('customer.logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="ni ni-user-run"></i>
                              <span class="nav-link-text">ออกจากระบบ</span>
                          </a>
                          <form id="logout-form"
                              action="{{ 'App\WholesaleBusiness' == Auth::getProvider()->getModel() ? route('customer.logout') : route('customer.logout') }}"
                              method="POST" style="display: none;">
                              @csrf
                          </form>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </nav>
