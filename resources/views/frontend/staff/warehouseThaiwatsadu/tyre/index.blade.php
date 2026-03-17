@extends('frontend/layouts/template/template-staff')

@section('content')
    @php
        $warehouse_id = DB::table('warehouse')
            ->where('id', auth('staff')->user()->warehouse_id)
            ->value('warehouse_id');
    @endphp
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <h1 class="header-text text-center">คลังสินค้า สาขาไทวัสดุ</h1>
                <center>
                    <div class="col-md-3">
                        <input type="hidden" value="check" name="check">
                        <div style="color: #ffffff;">
                            <input type="checkbox" id="check_have_product" onclick="func_Check_have_product()">
                            แสดงเฉพาะสินค้าที่มี
                        </div>
                    </div>
                    @if ($warehouse_id == 'EKY04')
                        <a href="{{ url('/staff/create-tyre-warehouse-thaiwatsadu') }}" class="btn btn-danger mt-3"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสินค้าใหม่เข้าคลัง</a>
                    @endif
                    <a href="#stock" data-toggle="modal" class="btn btn-warning mt-3"><i class="fa fa-exclamation-circle"
                            aria-hidden="true"></i> สรุปจำนวนสต๊อกแต่ละยี่ห้อ</a>
                </center>
                <!-- modal stock -->
                @php
                    $amount = DB::table('tyre_warehouse_thaiwatsadu')->sum('amount');
                    $amount_format = number_format($amount);
                    $stock = DB::table('tyre_warehouse_thaiwatsadu')->sum('stock');
                    $stock_format = number_format($stock);

                    $stock_sums = DB::table('tyre_warehouse_thaiwatsadu')
                        ->join('tyre_brands', 'tyre_warehouse_thaiwatsadu.brand_id', '=', 'tyre_brands.id')
                        ->select(
                            'tyre_brands.id as brand_id',
                            'tyre_brands.brand_name as brand_name',
                            DB::raw('SUM(tyre_warehouse_thaiwatsadu.amount) as sum'),
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
                        <form action="{{ url('/staff/search/tyre-warehouse-thaiwatsadu') }}" method="POST">
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
                                            @if ($warehouse_id == 'EKY04')
                                                <th></th>
                                            @endif
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
                                                @if ($warehouse_id == 'EKY04')
                                                    <td>
                                                        @if ($value->amount == 0)
                                                            <div class="flex-container">
                                                                <div class="col-sm-1">
                                                                    <a type="button" data-toggle="modal"
                                                                        data-target="#delete"
                                                                        data-id="{{ $value->id }}">
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="dont_have_amount" style="color: red;">หมด
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <a type="button" data-toggle="modal" data-target="#add"
                                                                        data-id="{{ $value->id }}"><i
                                                                            class="fa fa-plus-circle"
                                                                            style="color:blue;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="flex-container">
                                                                <div class="col-sm-1">
                                                                    <a type="button" data-toggle="modal"
                                                                        data-target="#delete"
                                                                        data-id="{{ $value->id }}"><i
                                                                            class="fa fa-minus-circle"
                                                                            style="color:red;"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-1 have_amount">
                                                                    {{ $value->amount }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <a type="button" data-toggle="modal"
                                                                        data-target="#add"
                                                                        data-id="{{ $value->id }}"><i
                                                                            class="fa fa-plus-circle"
                                                                            style="color:blue;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td>
                                                        @if ($value->amount == 0)
                                                            <div class="flex-container">
                                                                <div class="col-sm-1">
                                                                    <div class="dont_have_amount" style="color: red;">หมด
                                                                    </div>
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
                                                @endif
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
                                                @if ($warehouse_id == 'EKY04')
                                                    <td>
                                                        <a style="color:#0035ff;" class="dropdown-item"
                                                            data-toggle="modal" href="#editProduct{{ $value->id }}"><i
                                                                class="fa fa-edit"></i></a>
                                                    </td>
                                                @endif
                                                <!-- Modal Edit Product -->
                                                <div id="editProduct{{ $value->id }}" class="modal fade">
                                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"
                                                                    aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="icon-box">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </div>
                                                            <h4 class="modal-title">คุณแน่ใจใช่หรือไม่ ?</h4>

                                                            <div class="modal-body">
                                                                <p>คุณต้องการแก้ไขข้อมูลสินค้าใช่หรือไม่ ?
                                                                    <br>ข้อมูลที่แก้ไขแล้วไม่สามารถย้อนกลับได้
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <a class="btn btn-danger"
                                                                    href="{{ url('/staff/thaiwatsadu/edit-tyre') }}/{{ $value->id }}">แก้ไขข้อมูล</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit Product -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- modal delete -->
                                <div id="delete" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="icon-box">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="modal-title">ต้องการลบจำนวนสินค้าใช่หรือไม่ ?</h4>

                                            <form action="{{ url('staff/thaiwatsadu/delete-stock-tyre') }}"
                                                method="POST" enctype="multipart/form-data" autocomplete="off">@csrf
                                                <div class="modal-body">

                                                    <div class="modal-body">
                                                        <input type="text" class="form-control" name="amount"
                                                            placeholder="จำนวนสินค้าที่ต้องการลบ">
                                                        <input type="hidden" name="id">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-danger">ลบจำนวนสินค้า</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal delete -->
                                <!-- modal add -->
                                <div id="add" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="icon-box-success">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="modal-title">ต้องการเพิ่มจำนวนสินค้าใช่หรือไม่ ?</h4>

                                            <form action="{{ url('staff/thaiwatsadu/add-stock-tyre') }}" method="POST"
                                                enctype="multipart/form-data" autocomplete="off">@csrf
                                                <div class="modal-body">

                                                    <div class="modal-body">
                                                        <input type="text" class="form-control" name="amount"
                                                            placeholder="จำนวนสินค้าที่ต้องการเพิ่ม">
                                                        <input type="hidden" name="id">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <button type="submit"
                                                        class="btn btn-success">เพิ่มจำนวนสินค้า</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal add -->
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

    {{-- ฟังก์ชั่นเพิ่มจำนวนสต๊อก --}}
    <script>
        $(document).ready(function() {
            console.log('id');
            $('#add').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')

                var modal = $(this)

                modal.find('.modal-body input[name="id"]').val(id)
            })
        });
    </script>

    {{-- ฟังก์ชั่นลบจำนวนสต๊อก --}}
    <script>
        $(document).ready(function() {

            $('#delete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')

                var modal = $(this)

                modal.find('.modal-body input[name="id"]').val(id)
            })
        });
    </script>
@endsection
