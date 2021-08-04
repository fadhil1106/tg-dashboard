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
                <th scope="row" style="width: 13rem;">Production (TON)</th>
                @foreach ($data['production'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row">Sale (TON)</th>
                @foreach ($data['sales'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row">Sale (IDR)</th>
                @foreach ($data['salesIdr'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<script>
    var options_pvs = {
        chart: {
            type: 'line',
            height: '500',
        },
        series: [
        {
            name: 'PRODUCTION (TON)',
            type: 'line',
            data: @json($data['production'])
        },
        {
            name: 'SALES (TON)',
            type: 'line',
            data: @json($data['sales'])
        },
        {
            name: 'SALES (IDR)',
            type: 'bar',
            data: @json($data['salesIdr'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                show: true,
                seriesName: 'PRODUCTION (TON)',
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
                }
            },
            {
                seriesName: 'SALES (TON)',
                opposite: true,
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
                }
            },
            {
                show: false,
                seriesName: 'SALES (IDR)',
                max:300000000000,
                opposite: true,
                tickAmount: 5,
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
           var chart1 = new ApexCharts(document.querySelector("#chart"), options_pvs);
        //    var chart2 = new ApexCharts(document.querySelector("#chartdaily"), options_pvsd);
           chart1.render();
        //    chart2.render();
       })
    });
</script>
