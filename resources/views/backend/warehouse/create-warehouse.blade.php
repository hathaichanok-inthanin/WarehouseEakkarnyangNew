@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">เพิ่มคลังสินค้าใหม่</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('create-warehouse') }}" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-0">กรอกข้อมูลเพื่อเพิ่มคลังสินค้าใหม่</h3>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="col-form-label">รหัสคลังสินค้า
                                        @if ($errors->has('warehouse_id'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('warehouse_id') }})</span>
                                        @endif
                                    </label>
                                    <input id="warehouse_id" type="text" class="form-control" name="warehouse_id"
                                        placeholder="เช่น EKY01">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ชื่อคลังสินค้า
                                        @if ($errors->has('name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                        @endif
                                    </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">url ภาษาอังกฤษ
                                        @if ($errors->has('url'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('url') }})</span>
                                        @endif
                                    </label>
                                    <input id="url" type="text" class="form-control" name="url"
                                        placeholder="เช่น warehouse-khokkloi">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">เบอร์โทรศัพท์
                                        @if ($errors->has('tel'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                        @endif
                                    </label>
                                    <input id="tel" type="text" class="phone_format form-control" name="tel"
                                        value="{{ old('tel') }}">
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
                                        เพิ่มคลังสินค้าใหม่
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
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>
@endsection
