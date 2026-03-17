@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">จัดการข้อมูลรุ่นยางรถยนต์</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('create-tyre-model') }}" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-0">เพิ่มรุ่นยางรถยนต์</h3>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="col-form-label">ยี่ห้อยางรถยนต์</label>
                                    <select name="brand_id" class="form-control">
                                        @foreach ($tyre_brands as $tyre_brand => $value)
                                            <option value="{{ $value->id }}">{{ $value->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">รุ่นยางรถยนต์
                                        @if ($errors->has('model'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('model') }})</span>
                                        @endif
                                    </label>
                                    <input id="model" type="text" class="form-control" name="model"
                                        value="{{ old('model') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                        <option value="ใช้งานได้">ใช้งานได้</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        เพิ่มรุ่นยางรถยนต์
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ยี่ห้อยางรถยนต์</th>
                                            <th scope="col">รุ่นยางรถยนต์</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($tyre_models as $tyre_model => $value)
                                            <tr>
                                                <td>{{ $NUM_PAGE * ($page - 1) + $tyre_model + 1 }}</td>
                                                @php
                                                    $brand_name = DB::table('tyre_brands')
                                                        ->where('id', $value->brand_id)
                                                        ->value('brand_name');
                                                @endphp
                                                <td>{{ $brand_name }}</td>
                                                <td>{{ $value->model }}</td>
                                                <td>{{ $value->status }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#editModel{{ $value->id }}">แก้ไข</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                href="#deleteModel{{ $value->id }}">ลบ</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete Brand -->
                                            <div id="deleteModel{{ $value->id }}" class="modal fade">

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
                                                                href="{{ url('/delete-tyre-model') }}/{{ $value->id }}">ยืนยันการลบ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Delete Brand -->
                                            <!-- Modal Edit Model -->
                                            <div id="editModel{{ $value->id }}" class="modal fade">
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
                                                            <p>คุณต้องการแก้ไขข้อมูลใช่หรือไม่ ?
                                                                <br>ข้อมูลที่แก้ไขแล้วไม่สามารถย้อนกลับได้
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info"
                                                                data-dismiss="modal">ยกเลิก</button>
                                                            <a class="btn btn-danger"
                                                                href="{{ url('/edit-tyre-model') }}/{{ $value->id }}">แก้ไขข้อมูล</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Edit Model -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
