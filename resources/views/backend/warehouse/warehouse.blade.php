@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1 class="header-text text-center">คลังสินค้า</h1>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">เบอร์โทรศัพท์</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($warehouses as $warehouse => $value)
                                            <tr>
                                                <td>{{ $NUM_PAGE * ($page - 1) + $warehouse + 1 }}</td>
                                                <td>{{ $value->warehouse_id }}</td>
                                                <th scope="row">
                                                    <span class="name mb-0 text-sm">{{ $value->name }}</span>
                                                </th>
                                                <td>{{ $value->tel }}</td>
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
                                                                href="#editWarehouse{{ $value->id }}">แก้ไข</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#deleteWarehouse{{ $value->id }}">ลบ</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Modal Edit Warehouse -->
                                                <div id="editWarehouse{{ $value->id }}" class="modal fade">
                                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
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
                                                                    href="{{ url('/edit-warehouse') }}/{{ $value->id }}">แก้ไขข้อมูล</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit Product -->
                                                <!-- Modal Delete Product -->
                                                <div id="deleteWarehouse{{ $value->id }}" class="modal fade">

                                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
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
                                                                    href="{{ url('/delete-warehouse') }}/{{ $value->id }}">ยืนยันการลบ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Delete Product -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
