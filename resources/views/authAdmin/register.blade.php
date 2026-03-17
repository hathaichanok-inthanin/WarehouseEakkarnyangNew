@extends('backend/layouts/template/template-login')

@section('content')
    <div class="container mt-5">
        <center><img src="{{ asset('assets/img/brand/logo-wholesale.png') }}" style="width:40%;"></center>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                            </p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header">ลงทะเบียน ผู้ดูแลระบบ</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                            @csrf
                            @php
                                $random = rand(111, 999);
                                $code = wordwrap($random, 3);
                            @endphp
                            <div class="row mb-2">
                                <label for="admin_id" class="col-md-4 col-form-label text-md-end">รหัสแอดมิน</label>

                                <div class="col-md-7">
                                    <input id="admin_id" type="text"
                                        class="form-control @error('admin_id') is-invalid @enderror" name="admin_id"
                                        value="EKY{{ $code }}" autofocus>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <center><span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                </center>
                            @endif
                            <div class="row mb-2">

                                <label for="name" class="col-md-4 col-form-label text-md-end">ชื่อ</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                            @if ($errors->has('username'))
                                <center><span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('username') }})</span>
                                </center>
                            @endif
                            <div class="row mb-2">

                                <label for="username" class="col-md-4 col-form-label text-md-end">ชื่อเข้าใช้งานระบบ</label>

                                <div class="col-md-7">
                                    <input id="username" type="text" class="form-control" name="username"
                                        value="{{ old('username') }}">
                                </div>
                            </div>

                            @if ($errors->has('password_name'))
                                <center><span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('password_name') }})</span>
                                </center>
                            @endif
                            <div class="row mb-2">

                                <label for="password_name" class="col-md-4 col-form-label text-md-end">รหัสผ่าน</label>

                                <div class="col-md-7">
                                    <input id="password_name" type="password" class="form-control" name="password_name">
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <center><span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('password_confirmation') }})</span>
                                </center>
                            @endif

                            <div class="row mb-2">

                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-end">ยืนยันรหัสผ่าน</label>

                                <div class="col-md-7">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label text-md-end">บทบาท</label>
                                <div class="col-md-7">
                                    <select name="role" class="form-control">
                                        <option value="ดูได้ทุกคลัง">ดูได้ทุกคลัง</option>
                                        <option value="ดูได้เฉพาะคลังหลัก">ดูได้เฉพาะคลังหลัก</option>
                                        <option value="ดูได้ทุกคลัง ยกเว้นคลังหลัก">ดูได้ทุกคลัง ยกเว้นคลังหลัก</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="col-md-4 col-form-label text-md-end">สถานะ</label>
                                <div class="col-md-7">
                                    <select name="status" class="form-control">
                                        <option value="ใช้งานได้">ใช้งานได้</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ลงทะเบียนแอดมิน
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
