@extends('frontend/layouts/template/template-customer')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <h1 class="header-text text-center">สรุปจำนวนสต๊อกของทุกสาขา</h1>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <div class="row mb-2">
                    @php
                        // จำนวนที่มีในสต๊อก
                        $amount_main = DB::table('tyre_warehouse_main')->sum('amount');
                        $amount_kk = DB::table('tyre_warehouse_khokkloi')->sum('amount');
                        $amount_pn = DB::table('tyre_warehouse_phangnga')->sum('amount');
                        $amount_tl = DB::table('tyre_warehouse_thalang')->sum('amount');
                        $amount_tw = DB::table('tyre_warehouse_thaiwatsadu')->sum('amount');
                        $amount_bp = DB::table('tyre_warehouse_bypass')->sum('amount');
                        $amount_st = DB::table('tyre_warehouse_suratthani')->sum('amount');
                        $amount =
                            $amount_main + $amount_kk + $amount_pn + $amount_tl + $amount_tw + $amount_bp + $amount_st;

                        $amount_format = number_format($amount);

                        // จำนวนที่ต้องสต๊อก
                        $stock_main = DB::table('tyre_warehouse_main')->sum('stock');
                        $stock_kk = DB::table('tyre_warehouse_khokkloi')->sum('stock');
                        $stock_pn = DB::table('tyre_warehouse_phangnga')->sum('stock');
                        $stock_tl = DB::table('tyre_warehouse_thalang')->sum('stock');
                        $stock_tw = DB::table('tyre_warehouse_thaiwatsadu')->sum('stock');
                        $stock_bp = DB::table('tyre_warehouse_bypass')->sum('stock');
                        $stock_st = DB::table('tyre_warehouse_suratthani')->sum('stock');
                        $stock = $stock_main + $stock_kk + $stock_pn + $stock_tl + $stock_tw + $stock_bp + $stock_st;
                        $stock_format = number_format($stock);

                        // แต่ละแบรนด์ที่ต้องสต๊อก
                        $stock_sums = DB::table(
                            DB::raw("
                                (SELECT brand_id, amount FROM tyre_warehouse_main
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_khokkloi
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_phangnga
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_thalang
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_thaiwatsadu
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_bypass
                                UNION ALL
                                SELECT brand_id, amount FROM tyre_warehouse_suratthani)
                            as combined_warehouse
                            "),
                        )
                            ->join('tyre_brands', 'combined_warehouse.brand_id', '=', 'tyre_brands.id')
                            ->select(
                                'tyre_brands.id as brand_id',
                                'tyre_brands.brand_name as brand_name',
                                DB::raw('SUM(combined_warehouse.amount) as sum'),
                            )
                            ->groupBy('tyre_brands.id', 'tyre_brands.brand_name')
                            ->get();
                    @endphp
                    <div class="modal-body">
                        <p class="alert alert-success">จำนวนที่มีในสต๊อก {{ $amount_format }} เส้น</p>
                        <p class="alert alert-warning">จำนวนที่ต้องสต๊อก {{ $stock_format }} เส้น</p>
                        @foreach ($stock_sums as $stock_sum => $value)
                            <p>{{ $value->brand_name }} = {{ $value->sum }} เส้น</p>
                        @endforeach
                        <p style="color: red;">รวมทั้งหมด {{ $amount_format }} เส้น</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
