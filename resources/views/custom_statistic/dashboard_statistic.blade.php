@extends('crudbooster::admin_template')
@push('head')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
@section('content')
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart">
    </div>
</div>
<script>
    var options_pvs = {
        chart: {
            type: 'line',
            height: '500',
        },
        title: {
            text: 'Production vs Sales',
            align: 'center',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
            fontSize:  '20px',
            fontWeight:  'bold',
            color:  '#263238'
            },
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
        ],
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah Ton'
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

    var options_svb = {
        chart: {
            type: 'line',
            height: '500',
        },
        title: {
            text: 'Sales vs Breakdown',
            align: 'center',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
            fontSize:  '20px',
            fontWeight:  'bold',
            color:  '#263238'
            },
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
    //    $.getScript('https://cdn.jsdelivr.net/npm/apexcharts', function () {
            console.log('render')
            divChart = document.querySelector("#chart");
            var chart1 = new ApexCharts(divChart, options_pvs);
            let chart = [options_pvs, options_svb]
            var index = 0
            chart1.render()

            loop = () => {
                index++
                if (index > chart.length-1) {
                    index = 0
                }

                setTimeout(() => {
                    chart1.updateOptions (chart[index], true, true);
                    loop();
                }, 10000)

            }
           loop()
    //    })
    });
</script>
@endsection
