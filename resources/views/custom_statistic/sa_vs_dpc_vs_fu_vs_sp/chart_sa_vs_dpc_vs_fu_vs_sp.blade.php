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
                <th scope="row">Sale (Ton)</th>
                @foreach ($data['sale'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Total Direct Production Cost (IDR Bio)</th>
                @foreach ($data['production_cost'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Fuel (Ltr)</th>
                @foreach ($data['fuel'] as $item)
                <td>{{number_format($item)}}</td>
                @endforeach
            </tr>
            <tr>
                <th scope="row" style="width: 13rem;">Spareparts (IDR Bio)</th>
                @foreach ($data['sparepart'] as $item)
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
            name: 'Sale (Ton)',
            type: 'line',
            data: @json($data['sale'])
        },
        {
            name: 'Total Direct Production Cost (IDR Bio)',
            type: 'line',
            data: @json($data['production_cost'])
        },
        {
            name: 'Fuel (Ltr)',
            type: 'line',
            data: @json($data['fuel'])
        },
        {
            name: 'Spareparts (IDR Bio)',
            type: 'line',
            data: @json($data['sparepart'])
        },
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'Sale (Ton)',
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah RIT'
                }
            },
            {
                show: false,
                opposite: true,
                seriesName: 'Total Direct Production Cost (IDR Bio)',
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
                seriesName: 'Fuel (Ltr)',
                opposite: true,
                max: 10000,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Orang'
                }
            }
            {
                show: false,
                opposite: true,
                seriesName: 'Spareparts (IDR Bio)',
                opposite: true,
                max: 5000,
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
