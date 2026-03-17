@extends('backend/layouts/template/template-main')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <h1 class="header-text">Dashboard</h1>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <h1>คลังสินค้า</h1>
                        <div class="row mb-2">
                            @foreach ($warehouses as $warehouse => $value)
                                <div class="col-md-3">
                                    <a href="{{ url('/tyre') }}-{{ $value->url }}"
                                        class="btn btn-block btn-primary mt-3">{{ $value->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h1>จัดการคลังสินค้า</h1>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <a href="{{ url('/create-warehouse') }}"
                                            class="btn btn-block btn-success mt-3">เพิ่มคลังสินค้า</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/warehouse') }}"
                                            class="btn btn-block btn-success mt-3">ข้อมูลคลังสินค้า</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h1>จัดการธุรกิจค้าส่ง</h1>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <a href="{{ url('/register-wholesale-business') }}"
                                            class="btn btn-block btn-success mt-3">ลงทะเบียนใหม่</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/account-wholesale-business') }}"
                                            class="btn btn-block btn-success mt-3">ข้อมูลธุรกิจค้าส่ง</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h1>จัดการบัญชีสาขา</h1>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <a href="{{ url('/register-branch-account') }}"
                                            class="btn btn-block btn-success mt-3">ลงทะเบียนใหม่</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/account-branch') }}"
                                            class="btn btn-block btn-success mt-3">ข้อมูลบัญชีสาขา</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h1>จัดการบัญชีผู้ดูแลระบบ</h1>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <a href="{{ url('/register-admin') }}"
                                            class="btn btn-block btn-success mt-3">ลงทะเบียนใหม่</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/account-admin') }}"
                                            class="btn btn-block btn-success mt-3">ข้อมูลผู้ดูแลระบบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <h1>จัดการข้อมูลสินค้า</h1>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <a href="{{ url('/tyre-brand') }}"
                                    class="btn btn-block btn-warning mt-3">จัดการข้อมูลยี่ห้อยางรถยนต์</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ url('/tyre-model') }}"
                                    class="btn btn-block btn-warning mt-3">จัดการข้อมูลรุ่นยางรถยนต์</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
