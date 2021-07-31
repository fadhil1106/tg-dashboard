<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart">
    </div>
</div>
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Bulan</th>
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
    var options = {
        chart: {
            type: 'line',
            height: '500',
        },
        series: [
        {
            name: 'production (TON)',
            data: {!!$data['production']!!}
        },
        {
            name: 'sales (TON)',
            data: {!!$data['sales']!!}
        },
        {
            name: 'sales (IDR)',
            data: {!!$data['salesIdr']!!}
        },
        ],
        xaxis: {
            categories: {!!$data['label']!!},
            tickPlacement: 'between'
        },
        yaxis: [
            {
                show: true,
                seriesName: 'production (TON)',
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
                }
            },
            {
                seriesName: 'sales (TON)',
                opposite: true,
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
                }
            },
            {
                show: false,
                seriesName: 'sales (IDR)',
                max:300000000000,
                opposite: true,
                tickAmount: 5,
                title: {
                    text: 'sales (IDR)'
                }
            }
        ],
        dataLabels: {
            enabled: true,
            formatter: function (value){
                return new Intl.NumberFormat().format(value);
            },
        },
        textAnchor: 'middle',
        toolbar: {
            show: false
        }
    }

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script>
