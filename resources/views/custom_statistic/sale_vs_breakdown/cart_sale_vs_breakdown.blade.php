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
                <th scope="row">Sale (TON)</th>
                @foreach ($data['sales'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Breakdown (Unit)</th>
                @foreach ($data['breakdown'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<script>
    // console.log(@json($data))
    var options_pvs = {
        chart: {
            type: 'line',
            height: '500',
        },
        series: [
        {
            name: 'SALES (TON)',
            type: 'line',
            data: @json($data['sales'])
        },
        {
            name: 'BREAKDOWN (Unit)',
            type: 'bar',
            data: @json($data['breakdown'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'SALES (TON)',
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
                }
            },
            {
                show: true,
                opposite: true,
                seriesName: 'BREAKDOWN (Unit)',
                opposite: true,
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
           var chart1 = new ApexCharts(document.querySelector("#chart"), options_pvs);
           chart1.render();
       })
    });
</script>
