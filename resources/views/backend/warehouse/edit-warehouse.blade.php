@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">แก้ไขข้อมูลคลังสินค้า</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('/update-warehouse') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="col-form-label">รหัสคลังสินค้า</label>
                                    <input id="warehouse_id" type="text" class="form-control" name="warehouse_id"
                                        placeholder="เช่น EKY01" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ชื่อคลังสินค้า
                                        @if ($errors->has('name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                        @endif
                                    </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ $warehouse->name }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">เบอร์โทรศัพท์
                                        @if ($errors->has('tel'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                        @endif
                                    </label>
                                    <input id="tel" type="text" class="phone_format form-control" name="tel"
                                        value="{{ $warehouse->tel }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                        <option value="{{ $warehouse->status }}">{{ $warehouse->status }}</option>
                                        <option value="ใช้งานได้">ใช้งานได้</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="hidden" name="id" value="{{ $warehouse->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        อัพเดตข้อมูลคลังสินค้า
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
@endsection
