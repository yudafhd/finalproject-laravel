@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  @if (auth()->user()->access_type == 'superadmin')
                  <div class="col-lg-3">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center">
                                    <i
                                        class="mdi mdi-home text-white"
                                        style="font-size: 2em;"
                                    ></i>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="text-white m-t-10 m-b-0">
                                        Total Ewarong Registered
                                    </h6>
                                    <h2 class="m-t-0 text-white">
                                        {{ $ewarong_total }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card bg-info">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center">
                                    <i
                                        class="mdi mdi-account text-white"
                                        style="font-size: 2em;"
                                    ></i>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="text-white m-t-10 m-b-0">
                                        Total Member Registered
                                    </h6>
                                    <h2 class="m-t-0 text-white">
                                        {{ $user_total }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  @endif
                  @if (auth()->user()->access_type == 'superadmin')
                  <div class="col-lg-3">
                      @else
                    <div class="col-lg-6">
                  @endif
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center">
                                        <i
                                            class="mdi mdi-account text-white"
                                            style="font-size: 2em;"
                                        ></i>
                                    </div>
                                    <div class="align-self-center">
                                        <h6 class="text-white m-t-10 m-b-0">
                                            Total Orders
                                        </h6>
                                        <h2 class="m-t-0 text-white">
                                            {{ $order_total }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->access_type == 'superadmin')
                    <div class="col-lg-3">
                        @else
                    <div class="col-lg-6">
                    @endif
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center">
                                        <i
                                            class="mdi mdi-account text-white"
                                            style="font-size: 2em;"
                                        ></i>
                                    </div>
                                    <div class="align-self-center">
                                        <h6 class="text-white m-t-10 m-b-0">
                                            Total Items
                                        </h6>
                                        <h2 class="m-t-0 text-white">
                                            {{ $items_total }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h3 class="card-title m-b-5">
                            <span class="lstick"></span>Penjualan
                        </h3>
                    </div>
                </div>
            </div>
            <div class="bg-theme stats-bar">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="p-20">
                            <h3 class="text-white"> {{ date("M Y") }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="p-20">
                            <h6 class="text-white" style="text-align: right">Total</h6>
                            <h3 class="text-white m-b-0"  style="text-align: right">
                                {{"Rp " . number_format($penjualan_bulan_ini_total,2,',','.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div
                    id="sales-overview2"
                    class="p-relative"
                    style="height: 360px;"
                ></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h4 class="card-title">
                            <span class="lstick"></span>Item Popular
                        </h4>
                    </div>
                    <div class="ml-auto">
                        tahun 2020
                    </div>
                </div>
                <div class="table-responsive m-t-20">
                    <table class="table vm no-th-brd no-wrap pro-of-month">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($popular_items as $popular_item )
                            <tr>
                                <td>
                                    <h6>{{$popular_item->nama}}</h6>
                                    <small class="text-muted"
                                        >{{$popular_item->deskripsi}}
                                    </small>
                                </td>
                                <td>{{$popular_item->total_terjual}} pcs</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        new Chartist.Line(
            "#sales-overview2",
            {
                labels: [
                    @for ($day = 1; $day <= $total_days; $day++)
                     {{ $day }},
                    @endfor
                ],
                series: [
                    {
                        meta: "Penghasilan (Rp)",
                        data: [
                            @foreach($penjualan_bulan_chart_convert as $penjualan_bulan_chart_convert)
                                {{ $penjualan_bulan_chart_convert }},
                            @endforeach
                        ],
                    },
                ],
            },
            {
                low: 0,
                high: 100000,
                showArea: true,
                divisor: 10,
                lineSmooth: false,
                fullWidth: true,
                showLine: true,
                chartPadding: 30,
                axisX: {
                    showLabel: true,
                    showGrid: false,
                    offset: 50,
                },
                plugins: [Chartist.plugins.tooltip()],
                // As this is axis specific we need to tell Chartist to use whole numbers only on the concerned axis
                axisY: {
                    onlyInteger: true,
                    showLabel: true,
                    scaleMinSpace: 50,
                    showGrid: true,
                    offset: 10,
                    labelInterpolationFnc: function (value) {
                        return value / 1000 + "k";
                    },
                },
            }
        );

        // Offset x1 a tiny amount so that the straight stroke gets a bounding box
        // Straight lines don't get a bounding box
        // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
        chart.on("draw", function (ctx) {
            if (ctx.type === "area") {
                ctx.element.attr({
                    x1: ctx.x1 + 0.001,
                });
            }
        });

        // Create the gradient definition on created event (always after chart re-render)
        chart.on("created", function (ctx) {
            var defs = ctx.svg.elem("defs");
            defs.elem("linearGradient", {
                id: "gradient",
                x1: 0,
                y1: 1,
                x2: 0,
                y2: 0,
            })
                .elem("stop", {
                    offset: 0,
                    "stop-color": "rgba(255, 255, 255, 1)",
                })
                .parent()
                .elem("stop", {
                    offset: 1,
                    "stop-color": "rgba(38, 198, 218, 1)",
                });
        });
    });
</script>
@endsection
