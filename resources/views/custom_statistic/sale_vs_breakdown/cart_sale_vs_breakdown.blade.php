<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart">
    </div>
</div>
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{$data['labelType']}}</th>
                @foreach ($data['label'] as $item)
                <th scope="col">{{$item}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="width: 13rem;">Breakdown TI (Rata-Rata Unit)</th>
                @foreach ($data['breakdown_ti'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Breakdown TM (Rata-Rata Unit)</th>
                @foreach ($data['breakdown_tm'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Breakdown Total (Rata-Rata Unit)</th>
                @foreach ($data['breakdown_total'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart2">
    </div>
</div>
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{$data['labelType']}}</th>
                @foreach ($data['label'] as $item)
                <th scope="col">{{$item}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="width: 13rem;">Sales TI (MT)</th>
                @foreach ($data['sales_ti'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Sales TM (MT)</th>
                @foreach ($data['sales_tm'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Sales Total (MT)</th>
                @foreach ($data['sales_total'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<script>
    var sales_chart = {
        chart: {
            type: 'line',
            height: '500',
        },
        title: {
            text: 'Sales TI dan TM (IDR)',
            align: 'center',
            margin: 10,
            floating: false,
            style: {
                fontSize:  '15px',
                fontWeight:  'bold',
                color:  '#263238'
            },
        },
        series: [
        {
            name: 'SALES TI (IDR)',
            type: 'line',
            data: @json($data['sales_ti'])
        },
        {
            name: 'SALES TM (IDR)',
            type: 'line',
            data: @json($data['sales_tm'])
        },
        {
            name: 'SALES TOTAL (IDR)',
            type: 'line',
            data: @json($data['sales_total'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'SALES (IDR)',
                show: true,
                tickAmount: 5,
                title: {
                    text: 'Jumlah Penjualan'
                },
                labels : {
                    formatter: function(value, index) {
                        return new Intl.NumberFormat().format(value);
                    }
                }
            },
        ],
        plotOptions:{
            bar: {
                dataLabels: {
                    position: "top", // top, center, bottom
                    offsetY: -15,
                }
            }
        },
        dataLabels: {
            enabled: true,
            offsetY: -10,
            formatter: function (value){
                return new Intl.NumberFormat().format(value);
            },
        },
        textAnchor: 'middle',
        toolbar: {
            show: false
        },
        tooltip:{
            y: {
                formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                return new Intl.NumberFormat().format(value);
                }
            }
        }
    }

    var breakdown_chart = {
        chart: {
            type: 'line',
            height: '500',
        },
        title: {
            text: 'Rata-Rata Breakdown TI dan TM (UNIT)',
            align: 'center',
            margin: 10,
            floating: false,
            style: {
                fontSize:  '15px',
                fontWeight:  'bold',
                color:  '#263238'
            },
        },
        series: [
        {
            name: 'BREAKDOWN TI (UNIT)',
            type: 'line',
            data: @json($data['breakdown_ti'])
        },
        {
            name: 'BREAKDOWN TM (UNIT)',
            type: 'line',
            data: @json($data['breakdown_tm'])
        },
        {
            name: 'BREAKDOWN TOTAL (UNIT)',
            type: 'line',
            data: @json($data['breakdown_total'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                show: true,
                opposite: false,
                seriesName: 'BREAKDOWN (Unit)',
                tickAmount: 5,
                title: {
                    text: 'Jumlah Breakdown'
                }
            }
        ],
        plotOptions:{
            bar: {
                dataLabels: {
                    position: "top", // top, center, bottom
                    offsetY: -15,
                }
            }
        },
        dataLabels: {
            enabled: true,
            offsetY: -10,
            formatter: function (value){
                return new Intl.NumberFormat().format(value);
            },
        },
        textAnchor: 'middle',
        toolbar: {
            show: false
        },
        tooltip:{
            y: {
                formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                return new Intl.NumberFormat().format(value);
                }
            }
        }
    }

    $(document).ready(function () {
       $.getScript('https://cdn.jsdelivr.net/npm/apexcharts', function () {
           console.log('render')
           var chart1 = new ApexCharts(document.querySelector("#chart"), breakdown_chart);
           chart1.render();
           var chart2 = new ApexCharts(document.querySelector("#chart2"), sales_chart);
           chart2.render();
       })
    });
</script>
