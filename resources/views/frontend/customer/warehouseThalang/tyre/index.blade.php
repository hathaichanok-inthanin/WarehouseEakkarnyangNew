@extends('frontend/layouts/template/template-customer')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <h1 class="header-text text-center">คลังสินค้า สาขาถลาง</h1>
                <center>
                    <div class="col-md-3">
                        <input type="hidden" value="check" name="check">
                        <div style="color: #ffffff;">
                            <input type="checkbox" id="check_have_product" onclick="func_Check_have_product()">
                            แสดงเฉพาะสินค้าที่มี
                        </div>
                    </div>
                    <a href="#stock" data-toggle="modal" class="btn btn-warning mt-3"><i class="fa fa-exclamation-circle"
                            aria-hidden="true"></i> สรุปจำนวนสต๊อกแต่ละยี่ห้อ</a>
                </center>
                <!-- modal stock -->
                @php
                    $amount = DB::table('tyre_warehouse_thalang')->sum('amount');
                    $amount_format = number_format($amount);
                    $stock = DB::table('tyre_warehouse_thalang')->sum('stock');
                    $stock_format = number_format($stock);

                    $stock_sums = DB::table('tyre_warehouse_thalang')
                        ->join('tyre_brands', 'tyre_warehouse_thalang.brand_id', '=', 'tyre_brands.id')
                        ->select(
                            'tyre_brands.id as brand_id',
                            'tyre_brands.brand_name as brand_name',
                            DB::raw('SUM(tyre_warehouse_thalang.amount) as sum'),
                        )
                        ->groupBy('tyre_brands.id', 'tyre_brands.brand_name')
                        ->get();
                @endphp
                <div id="stock" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <h4 class="modal-title mt--3">สรุปจำนวนสต๊อก</h4>
                            <div class="modal-body">
                                @foreach ($stock_sums as $stock_sum => $value)
                                    <p>{{ $value->brand_name }} = {{ $value->sum }} เส้น</p>
                                @endforeach
                                <p style="color: red;">รวมทั้งหมด {{ $amount_format }} เส้น</p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal stock -->
                {{-- Search --}}
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ url('/customer/search/tyre-warehouse-thalang') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group mb-3 mt-3">

                                <input type="text" name="search" class="form-control"
                                    placeholder="ค้นหาสินค้า เช่น 185/60R15" aria-label="ค้นหาสินค้า เช่น 185/60R15"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"
                                            aria-hidden="true"></i>
                                        ค้นหา</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                {{-- End Search --}}
                {{-- สรุปจำนวนสต๊อก --}}
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="alert alert-success" style="font-size: 16px; text-align:center;">
                            จำนวนที่มีในสต๊อกทั้งหมด <strong>{{ $amount_format }}</strong> เส้น
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-danger" style="font-size: 16px; text-align:center;">
                            จำนวนที่ต้องสต๊อก <strong>{{ $stock_format }}</strong> เส้น
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                {{-- จบจำนวนสต๊อก --}}
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ขนาด</th>
                                            <th scope="col">ยี่ห้อ</th>
                                            <th scope="col">รุ่น</th>
                                            <th scope="col">จำนวน</th>
                                            <th scope="col">ปีผลิต</th>
                                            <th scope="col">สัปดาห์ยาง (DOT)</th>
                                            <th scope="col">จำนวนที่ต้องสต๊อก</th>
                                            <th scope="col">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($products as $product => $value)
                                            @php
                                                $brand = DB::table('tyre_brands')
                                                    ->where('id', $value->brand_id)
                                                    ->value('brand_name');
                                                $model = DB::table('tyre_models')
                                                    ->where('id', $value->model_id)
                                                    ->value('model');
                                            @endphp
                                            <tr>
                                                <td>{{ $NUM_PAGE * ($page - 1) + $product + 1 }}</td>
                                                <td>{{ $value->size }}</td>
                                                <td>{{ $brand }}</td>
                                                <td>{{ $model }}</td>
                                                {{-- จำนวน --}}
                                                <td>
                                                    @if ($value->amount == 0)
                                                        <div class="flex-container">
                                                            <div class="col-sm-1">
                                                                <div class="dont_have_amount" style="color: red;">หมด</div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="flex-container">
                                                            <div class="col-sm-1 have_amount">
                                                                {{ $value->amount }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                {{-- จบจำนวน --}}
                                                <td>{{ $value->year }}</td>
                                                <td>{{ $value->dot }}</td>
                                                {{-- จำนวนที่ต้องสต๊อก --}}
                                                @if ($value->stock_required == 'ต้องสต๊อก')
                                                    <td>
                                                        @if ($value->stock == 0)
                                                            <div class="table-data__info__stock__have">
                                                                0
                                                            </div>
                                                        @else
                                                            <div class="table-data__info__stock__have">
                                                                {{ $value->stock }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                @elseif($value->stock_required == 'ไม่ต้องสต๊อก')
                                                    <td>
                                                        @if ($value->stock == 0)
                                                            <div class="table-data__info__stock__not">
                                                                0
                                                            </div>
                                                        @else
                                                            <div class="table-data__info__stock__not">
                                                                {{ $value->stock }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endif
                                                {{-- จบจำนวนที่ต้องสต๊อก --}}
                                                <td>{{ $value->comment }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>

    {{-- ฟังก์ชั่นแสดงเฉพาะสินค้าที่มี --}}
    <script>
        function func_Check_have_product() {
            // Get the checkbox
            var checkBox = document.getElementById("check_have_product");
            console.log(checkBox);
            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                $.each($('.dont_have_amount'), function(index, val) {
                    $(val).parents('tr')[0].style.display = "none"
                });
            } else {
                $.each($('.dont_have_amount'), function(index, val) {
                    $(val).parents('tr')[0].style.display = "table-row"
                });
            }
        }
    </script>
@endsection
