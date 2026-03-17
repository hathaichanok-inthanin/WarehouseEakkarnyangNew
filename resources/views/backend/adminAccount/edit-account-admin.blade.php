@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="header-text text-center">แก้ไขข้อมูลบัญชีผู้ดูแลระบบ</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ url('/update-account-admin') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    @php
                                        $random = rand(111, 999);
                                        $code = wordwrap($random, 3);
                                    @endphp
                                    <label class="col-form-label">รหัสแอดมิน</label>
                                    <input id="admin_id" type="text"
                                        class="form-control @error('admin_id') is-invalid @enderror" name="admin_id"
                                        value="EKY{{ $code }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">ชื่อ
                                        @if ($errors->has('name'))
                                            <span class="text-danger"
                                                style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                        @endif
                                    </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ $account->name }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">บทบาท</label>
                                    <select name="role" class="form-control">
                                        <option value="{{ $account->role }}">{{ $account->role }}</option>
                                        <option value="ดูได้ทุกคลัง">ดูได้ทุกคลัง</option>
                                        <option value="ดูได้เฉพาะคลังหลัก">ดูได้เฉพาะคลังหลัก</option>
                                        <option value="ดูได้ทุกคลัง ยกเว้นคลังหลัก">ดูได้ทุกคลัง ยกเว้นคลังหลัก</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">สถานะ</label>
                                    <select name="status" class="form-control">
                                        <option value="{{ $account->status }}">{{ $account->status }}</option>
                                        <option value="ใช้งานได้">ใช้งานได้</option>
                                        <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="hidden" name="id" value="{{ $account->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        อัพเดตข้อมูลบัญชีแอดมิน
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
