@extends('crudbooster::admin_template')
@push('head')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
@section('content')
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart2">
    </div>
</div>
<div class="row" style="padding-left: 10px;padding-right: 10px">
    <div id="chart">
    </div>
</div>
<script>
    var options_pvs = {
        chart: {
            id: 'options_pvs',
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
            name: 'PRODUCTION (MT)',
            type: 'bar',
            data: @json($data['production'])
        },
        {
            name: 'SALES (MT)',
            type: 'bar',
            data: @json($data['sales'])
        },
        ],
        noData: {
            text: 'Loading Data.....'
        },
        xaxis: {
            categories: @json($data['label']),
            tickPlacement: 'between'
        },
        yaxis: [
            {
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah MT'
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

    var label = @json($data['label'])

    var options_svb = {
        chart: {
            id : 'options_svb',
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
            name: 'SALES (MT)',
            type: 'bar',
            data: @json($data['sales'])
        },
        {
            name: 'BREAKDOWN (Unit)',
            type: 'bar',
            data: @json($data['breakdown'])
        },
        ],
        noData: {
            text: 'Loading Data.....'
        },
        xaxis: {
            categories: label,
            tickPlacement: 'between'
        },
        yaxis: [
            {
                seriesName: 'SALES (MT)',
                show: true,
                tickAmount: 10,
                title: {
                    text: 'Jumlah MT'
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
        divChart2 = document.querySelector("#chart2");
        var chart1 = new ApexCharts(divChart, options_svb);
        var chart2 = new ApexCharts(divChart2, options_pvs);
        chart1.render()
        chart2.render()
        var type = 'line'

        loop = () => {
            setTimeout(() => {
                $.ajax({
                    url: "{{route('get.all.data')}}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        ApexCharts.exec('options_svb', 'updateSeries', [
                            {
                                name: 'SALES (MT)',
                                type: type,
                                data: data['sales']
                            },
                            {
                                name: 'BREAKDOWN (Unit)',
                                type: type,
                                data: data['breakdown']
                            }
                        ],true);
                        ApexCharts.exec('options_svb', 'updateOptions', {
                            xaxis: {
                                categories: data['label'],
                            }
                        }, true, true);


                        ApexCharts.exec('options_pvs', 'updateSeries', [
                            {
                                name: 'PRODUCTION (MT)',
                                type: type,
                                data: data['production']
                            },
                            {
                                name: 'SALES (MT)',
                                type: type,
                                data: data['sales']
                            }
                        ],true);
                        ApexCharts.exec('options_pvs', 'updateOptions', {
                            xaxis: {
                                categories: data['label'],
                            }
                        }, true, true);

                        if (type == 'line') {
                            type = 'bar'
                        } else {
                            type = 'line'
                        }
                    },
                    error: function() {}
                })
                loop();
            }, 60000)

        }
        loop()
    //    })
    });
</script>
@endsection
