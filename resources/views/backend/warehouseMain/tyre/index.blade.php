@extends('backend/layouts/template/template-main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <h1 class="header-text text-center">คลังสินค้าหลัก</h1>
                <center>
                    <div class="col-md-3">
                        <input type="hidden" value="check" name="check">
                        <div style="color: #ffffff;">
                            <input type="checkbox" id="check_have_product" onclick="func_Check_have_product()">
                            แสดงเฉพาะสินค้าที่มี
                        </div>
                    </div>
                    <a href="{{ url('/create-tyre-warehouse-main') }}" class="btn btn-danger mt-3"><i
                            class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสินค้าใหม่เข้าคลัง</a>
                    <a href="#stock" data-toggle="modal" class="btn btn-warning mt-3"><i class="fa fa-exclamation-circle"
                            aria-hidden="true"></i> สรุปจำนวนสต๊อกแต่ละยี่ห้อ</a>
                </center>
                <!-- modal stock -->
                @php
                    $amount = DB::table('tyre_warehouse_main')->sum('amount');
                    $amount_format = number_format($amount);
                    $stock = DB::table('tyre_warehouse_main')->sum('stock');
                    $stock_format = number_format($stock);

                    $stock_sums = DB::table('tyre_warehouse_main')
                        ->join('tyre_brands', 'tyre_warehouse_main.brand_id', '=', 'tyre_brands.id')
                        ->select(
                            'tyre_brands.id as brand_id',
                            'tyre_brands.brand_name as brand_name',
                            DB::raw('SUM(tyre_warehouse_main.amount) as sum'),
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
                        <form action="{{ url('/search/tyre-warehouse-main') }}" method="POST">
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
                {{-- nav pills brand --}}
                @php
                    $brands = DB::table('tyre_brands')
                        ->where('brand_name', '!=', 'ยางใหญ่')
                        ->where('status', 'ใช้งานได้')
                        ->get();
                @endphp
                <ul class="nav nav-pills mb-3">
                    @foreach ($brands as $brand => $value)
                        <li class="nav-item" style="margin-right:0.2rem;">
                            <a href="{{ url('/brand-tyre') }}/{{ $value->brand_name }}"
                                class="nav-link mt-2">{{ $value->brand_name }}</a>
                        </li>
                    @endforeach
                </ul>
                {{-- end nav pills brand --}}
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- <th scope="col">#</th> --}}
                                            <th scope="col">ขนาด</th>
                                            <th scope="col">ยี่ห้อ</th>
                                            <th scope="col">รุ่น</th>
                                            <th scope="col">จำนวน</th>
                                            <th scope="col">ราคาต้นทุนส่ง</th>
                                            <th scope="col">ปีผลิต</th>
                                            <th scope="col">สัปดาห์ยาง (DOT)</th>
                                            <th scope="col">จำนวนที่ต้องสต๊อก</th>
                                            <th scope="col">หมายเหตุ</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col"></th>
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
                                                {{-- <td>{{ $NUM_PAGE * ($page - 1) + $product + 1 }}</td> --}}
                                                <td>{{ $value->size }}</td>
                                                <td>{{ $brand }}</td>
                                                <td>{{ $model }}</td>
                                                {{-- จำนวน --}}
                                                <td>
                                                    @if ($value->amount == 0)
                                                        <div class="flex-container">
                                                            <div class="col-sm-1">
                                                                <a type="button" data-toggle="modal" data-target="#delete"
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
                                                                        class="fa fa-plus-circle" style="color:blue;"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="flex-container">
                                                            <div class="col-sm-1">
                                                                <a type="button" data-toggle="modal"
                                                                    data-target="#delete"
                                                                    data-id="{{ $value->id }}"><i
                                                                        class="fa fa-minus-circle" style="color:red;"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-1 have_amount">
                                                                {{ $value->amount }}
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <a type="button" data-toggle="modal" data-target="#add"
                                                                    data-id="{{ $value->id }}"><i
                                                                        class="fa fa-plus-circle" style="color:blue;"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                {{-- จบจำนวน --}}
                                                <td>{{ $value->cost }}</td>
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
                                                <td>{{ $value->status }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v" style="line-height:unset;"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#editProduct{{ $value->id }}">แก้ไข</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#deleteProduct{{ $value->id }}">ลบ</a>
                                                        </div>
                                                    </div>
                                                </td>
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
                                                                    href="{{ url('/main/edit-tyre') }}/{{ $value->id }}">แก้ไขข้อมูล</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit Product -->
                                                <!-- Modal Delete Product -->
                                                <div id="deleteProduct{{ $value->id }}" class="modal fade">

                                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"
                                                                    aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="icon-box">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </div>
                                                            <h4 class="modal-title">คุณแน่ใจใช่หรือไม่ ?</h4>


                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบข้อมูลสินค้าจริงหรือไม่ ?
                                                                    <br>ข้อมูลไม่สามารถแก้ไขได้
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <a class="btn btn-danger"
                                                                    href="{{ url('/main/delete-tyre') }}/{{ $value->id }}">ยืนยันการลบ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Delete Product -->
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

                                            <form action="{{ url('/main/delete-stock-tyre') }}" method="POST"
                                                enctype="multipart/form-data" autocomplete="off">@csrf
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

                                            <form action="{{ url('/main/add-stock-tyre') }}" method="POST"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
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
