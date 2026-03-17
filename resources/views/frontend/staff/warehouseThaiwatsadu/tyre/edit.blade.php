@extends('frontend/layouts/template/template-staff')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">แก้ไขข้อมูลสินค้า</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('staff/thaiwatsadu/update-tyre') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                @php
                                    $brands = DB::table('tyre_brands')->where('status', 'ใช้งานได้')->get();
                                    $brand_name = DB::table('tyre_brands')
                                        ->where('id', $product->brand_id)
                                        ->value('brand_name');

                                    $models = DB::table('tyre_models')->where('status', 'ใช้งานได้')->get();
                                    $model = DB::table('tyre_models')->where('id', $product->model_id)->value('model');
                                @endphp
                                <div class="col-md-12">
                                    <label class="col-form-label">ยี่ห้อสินค้า</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="{{ $product->brand_id }}">{{ $brand_name }}</option>
                                        @foreach ($brands as $brand => $value)
                                            <option value="{{ $value->id }}">{{ $value->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">รุ่นสินค้า</label>
                                    <select name="model_id" class="form-control">
                                        <option value="{{ $product->model_id }}">{{ $model }}</option>
                                        @foreach ($models as $model => $value)
                                            <option value="{{ $value->id }}">{{ $value->model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ขนาดยางรถยนต์
                                        @if ($errors->has('size'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('size') }})</span>
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="size" value="{{ $product->size }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">จำนวนสินค้าที่มีในสต๊อก
                                        @if ($errors->has('amount'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('amount') }})</span>
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="amount"
                                        value="{{ $product->amount }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ปีผลิต
                                        @if ($errors->has('year'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('year') }})</span>
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="year" value="{{ $product->year }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สัปดาห์ยาง (DOT)
                                        @if ($errors->has('dot'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('dot') }})</span>
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="dot" value="{{ $product->dot }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">จำนวนที่ต้องสต๊อก
                                        @if ($errors->has('stock'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('stock') }})</span>
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="stock"
                                        value="{{ $product->stock }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สต๊อก / ไม่สต๊อก</label>
                                    <select name="stock_required" class="form-control">
                                        <option value="{{ $product->stock_required }}">{{ $product->stock_required }}
                                        </option>
                                        <option value="ต้องสต๊อก">ต้องสต๊อก</option>
                                        <option value="ไม่ต้องสต๊อก">ไม่ต้องสต๊อก</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                        <option value="{{ $product->status }}">{{ $product->status }}</option>
                                        <option value="เปิดใช้งาน">เปิดใช้งาน</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        อัพเดตข้อมูลสินค้า
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
