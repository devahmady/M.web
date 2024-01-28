<!-- Libs JS -->
<script src="{{ asset('dist') }}/js/demo-theme.min.js?1668287865"></script>
<script src="{{ asset('dist') }}/libs/apexcharts/dist/apexcharts.min.js?1668287865" defer></script>
<script src="{{ asset('dist') }}/libs/jsvectormap/dist/js/jsvectormap.min.js?1668287865" defer></script>
<script src="{{ asset('dist') }}/libs/jsvectormap/dist/maps/world.js?1668287865" defer></script>
<script src="{{ asset('dist') }}/libs/jsvectormap/dist/maps/world-merc.js?1668287865" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('dist') }}/js/tabler.min.js?1668287865" defer></script>
<script src="{{ asset('dist') }}/js/print.js" defer></script>
<script src="{{ asset('dist') }}/js/demo.min.js?1668287865" defer></script>
{{-- <script src="https://code.highcharts.com/modules/bullet.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
<script src="{{ asset('dist') }}/js/highcharts.js" defer></script>
<!-- Skrip jsPDF dari CDN -->
<!-- Skrip html2pdf dari CDN -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var printButton = document.getElementById('printButton');
        var printForm = document.getElementById('printForm');
        searchButton.addEventListener('click', function() {
            printForm.action = '{{ route('print') }}'; // Ganti rute sesuai kebutuhan
            printForm.submit(); // Mengirimkan formulir
        });
    });
    
</script>
<script>
    document.getElementById('name').addEventListener('change', function() {
        var selectedProfile = this.value;
        var commentOptions = document.querySelectorAll('#comment option');
        
        // Hide all comment options
        commentOptions.forEach(function(option) {
            option.style.display = 'none';
        });

        // Show only comment options related to the selected profile
        commentOptions.forEach(function(option) {
            if (option.dataset.profile === selectedProfile || !selectedProfile) {
                option.style.display = 'block';
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        setInterval(function() {
            var ether = $('#ether').val();
            // console.log(ether);
            $("#tx").load(window.location.href + " #tx");
        }, 1000);
        setInterval(function() {
            $("#rx").load(window.location.href + " #rx");
        }, 1000);
        setInterval(function() {
            $("#inter").load(window.location.href + " #inter");
        }, 1000);


    });

    function convertToReadableFormat(bytes) {
        var sizes = ['Bytes', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (!bytes) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function requestData() {
        var selectedInterface = $("#interface").val();
        console.log("Selected Interface:", selectedInterface);
        var rx = parseInt(document.getElementById('nilaiRX').value);
        var tx = parseInt(document.getElementById('nilaiTX').value);
        // console.log('ini rx :' + rx);
        // console.log('ini tx :' + tx);

        $.ajax({
            url: "{{ url('graf') }}/" + selectedInterface,
            datatype: "json",
            // type: 'POST',
            success: function(data) {
                // console.log(data);
                // console.log("Data dari server:", data);
                if (data.length > 0) {
                    var TX = parseInt(data[0].data[0]);
                    var RX = parseInt(data[1].data[0]);
                    // console.log("TX dari server:", TX);
                    // console.log("RX dari server:", RX);

                    var TXFormatted = convertToReadableFormat(TX);
                    var RXFormatted = convertToReadableFormat(RX);
                    // console.log("TX yang sudah diformat:", TXFormatted);
                    // console.log("RX yang sudah diformat:", RXFormatted);

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

                    // console.log("Trafik data TX (Mbps):", TX);
                    // console.log("Trafik data RX (Mbps):", RX);
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
            console.log("Selected Interface (jQuery):", selectedInterface);
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
                    'TX'; // Menentukan nilai 'type' berdasarkan nama seri
                    var formattedValue = convertToReadableFormat(this.y);
                    return '<b>' + type + '</b><br/>Timestamp: ' + Highcharts.dateFormat(
                        '%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + formattedValue + ' ' + type;
                }
            }


        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault();

            $(this).hide();
            $('#loading').removeClass('d-none');

            // Melakukan submit form (Anda dapat menggantinya dengan AJAX jika diperlukan)
            $('#profileForm').submit();

            // Mengembalikan tombol submit dan menyembunyikan elemen loading setelah 3 detik
            // setTimeout(function () {
            //     $('#submitBtn').show();
            //     $('#loading').addClass('d-none');
            // }, 1000);
        });
    });
</script>
