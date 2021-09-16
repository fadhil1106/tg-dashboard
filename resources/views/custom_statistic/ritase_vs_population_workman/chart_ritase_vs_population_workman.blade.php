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
                <th scope="row">Ritase (Rit)</th>
                @foreach ($data['ritase'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Population (Unit)</th>
                @foreach ($data['population'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Workman (Person)</th>
                @foreach ($data['workman'] as $item)
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
            name: 'RITASE (Rit)',
            type: 'line',
            data: @json($data['ritase'])
        },
        {
            name: 'POPULATION (Unit)',
            type: 'line',
            data: @json($data['population'])
        },
        {
            name: 'WORKMAN (Person)',
            type: 'line',
            data: @json($data['workman'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'RITASE (Rit)',
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah RIT'
                }
            },
            {
                show: false,
                opposite: true,
                seriesName: 'POPULATION (Unit)',
                opposite: true,
                max: 10000,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Unit'
                }
            },
            {
                show: false,
                opposite: true,
                seriesName: 'WORKMAN (Person)',
                opposite: true,
                max: 10000,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Orang'
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
