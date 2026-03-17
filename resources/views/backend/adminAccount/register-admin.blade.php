@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">ลงทะเบียนแอดมินใหม่</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-0">กรอกข้อมูลเพื่อลงทะเบียนแอดมินใหม่</h3>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    @php
                                        $random = rand(111, 999);
                                        $code = wordwrap($random, 3);
                                    @endphp
                                    <label class="col-form-label">รหัสแอดมิน</label>
                                    <input id="admin_id" type="text"
                                        class="form-control @error('admin_id') is-invalid @enderror" name="admin_id"
                                        value="EKY{{ $code }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ชื่อ
                                        @if ($errors->has('name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                        @endif  
                                    </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ชื่อเข้าใช้งานระบบ
                                        @if ($errors->has('username'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('username') }})</span>
                                        @endif
                                    </label>
                                    <input id="username" type="text" class="form-control" name="username"
                                        value="{{ old('username') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">รหัสผ่าน
                                        @if ($errors->has('password_name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('password_name') }})</span>
                                        @endif
                                    </label>
                                    <input id="password_name" type="password" class="form-control" name="password_name">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label ">ยืนยันรหัสผ่าน
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('password_confirmation') }})</span>
                                        @endif
                                    </label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">บทบาท</label>
                                    <select name="role" class="form-control">
                                        <option value="ดูได้ทุกคลัง">ดูได้ทุกคลัง</option>
                                        <option value="ดูได้เฉพาะคลังหลัก">ดูได้เฉพาะคลังหลัก</option>
                                        <option value="ดูได้ทุกคลัง ยกเว้นคลังหลัก">ดูได้ทุกคลัง ยกเว้นคลังหลัก</option>
                                    </select>
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
                                        ลงทะเบียนแอดมิน
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
