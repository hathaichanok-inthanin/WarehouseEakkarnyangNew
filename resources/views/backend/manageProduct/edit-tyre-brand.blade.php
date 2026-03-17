@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">แก้ไขยี่ห้อยางรถยนต์</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('update-tyre-brand') }}" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-0">แก้ไขยี่ห้อยางรถยนต์</h3>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="col-form-label">ยี่ห้อยางรถยนต์
                                        @if ($errors->has('brand_name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('brand_name') }})</span>
                                        @endif
                                    </label>
                                    <input id="brand_name" type="text" class="form-control" name="brand_name"
                                        value="{{ $tyre_brand->brand_name }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                        <option value="{{ $tyre_brand->status }}">{{ $tyre_brand->status }}</option>
                                        <option value="ใช้งานได้">ใช้งานได้</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="hidden" name="id" value="{{ $tyre_brand->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        อัพเดตยี่ห้อยางรถยนต์
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
