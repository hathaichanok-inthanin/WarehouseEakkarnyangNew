@extends('frontend/layouts/template/template-login')

@section('content')
    <div class="container mt-5">
        <center><img src="{{ asset('assets/img/brand/logo-wholesale.png') }}" style="width:40%;"></center>
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">เข้าสู่ระบบ พนักงานขาย</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/staff/login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">ชื่อเข้าใช้งานระบบ
                                    :</label>

                                <div class="col-md-8">
                                    <input id="username" type="text" class="form-control" name="username"
                                        value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">รหัสผ่าน :</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            จดจำฉัน
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        เข้าสู่ระบบ
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
