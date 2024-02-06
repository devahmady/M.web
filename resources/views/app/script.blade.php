<script src="{{ asset('mikman') }}/js/tabler.min.js?1668287865" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('mikman') }}/js/highcharts.js" defer></script>
<script>

    function convertToReadableFormat(bytes) {
        var sizes = ['Bytes', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (!bytes) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function requestData() {
        var selectedInterface = $("#interface").val();
        var rx = parseInt(document.getElementById('nilaiRX').value);
        var tx = parseInt(document.getElementById('nilaiTX').value);
        $.ajax({
            url: "{{ url('graf') }}/" + selectedInterface,
            datatype: "json",
            success: function(data) {
                if (data.length > 0) {
                    var TX = parseInt(data[0].data[0]);
                    var RX = parseInt(data[1].data[0]);
                    var TXFormatted = convertToReadableFormat(TX);
                    var RXFormatted = convertToReadableFormat(RX);
                    var x = (new Date()).getTime();
                    shift = chart.series[0].data.length > 19;
                    chart.series[0].addPoint({
                        x: x,
                        y: TX,
                        name: 'Mikman Traffic TX (' + TXFormatted + ')'
                    }, true, shift);
                    chart.series[1].addPoint({
                        x: x,
                        y: RX,
                        name: 'Mikman Traffic RX (' + RXFormatted + ')'
                    }, true, shift);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                console.error("Error: " + errorThrown);
            }
        });
    }

    $(document).ready(function() {
        $('#interface').on('change', function() {
            var selectedInterface = $(this).val();
        });
    });

    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            },
        });

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graph',
                animation: Highcharts.svg,
                type: 'spline',
                events: {
                    load: function() {
                        setInterval(function() {
                            requestData();
                        }, 1000);
                    }
                }
            },
            plotOptions: {
                spline: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            var type = this.series.name.includes('RX') ? '' : '';
                            var formattedValue = convertToReadableFormat(this.y);
                            return formattedValue + ' ' + type;
                        }
                    },
                    enableMouseTracking: true
                }
            },

            title: {
                text: '[ Monitoring Traffic ]'
            },
            xAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000,

            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return convertToReadableFormat(this.value);
                    },
                },
            },
            series: [{
                name: 'Mikman Traffic TX',
                data: []
            }, {
                name: 'Mikman Traffic RX',
                data: []
            }],
            tooltip: {
                formatter: function() {
                    var type = this.series.name.includes('RX') ? 'RX' :
                    'TX'; 
                    var formattedValue = convertToReadableFormat(this.y);
                    return '<b>' + type + '</b><br/>Timestamp: ' + Highcharts.dateFormat(
                        '%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + formattedValue + ' ' + type;
                }
            }


        });

    });
</script>

