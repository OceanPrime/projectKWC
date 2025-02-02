<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <h4 class="page-title">Analisa Data From Chart</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Overall Project Percentage</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Plan vs Actual PIC</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="multipleBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Plan vs Actual </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="planVsActualChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Chart JS -->
<script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

<script>
    var pieChart = document.getElementById('pieChart').getContext('2d'),
        planVsActualChart = document.getElementById('planVsActualChart').getContext('2d'); // Tambahkan ini untuk chart Plan vs Actual

    var myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50, 35],
                backgroundColor: ["#1d7af3", "#f3545d"],
                borderWidth: 0
            }],
            labels: ['Planning', 'Actual']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    });

    // Tambahkan kode berikut untuk membuat chart Plan vs Actual
    var myPlanVsActualChart = new Chart(planVsActualChart, {
        type: 'bar',
        data: {
            labels: ["Plan", "Actual"],
            datasets: [{
                label: 'Days',
                data: [67, 50], // Contoh data Plan dan Actual
                backgroundColor: ["#1d7af3", "#f3545d"],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var

        pieChart = document.getElementById('pieChart').getContext('2d'),

        multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');

    var myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50, 35],
                backgroundColor: ["#1d7af3", "#f3545d"],
                borderWidth: 0
            }],
            labels: ['Planning', 'Actual']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })


    var myMultipleBarChart = new Chart(multipleBarChart, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Plan",
            backgroundColor: '#1d7af3', // Warna biru untuk Plan
            borderColor: '#1d7af3',
            data: [100, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220], // Data Plan
        }, {
            label: "Actual",
            backgroundColor: '#59d05d', // Warna hijau untuk Actual
            borderColor: '#59d05d',
            data: [95, 110, 125, 135, 145, 155, 165, 175, 185, 195, 205, 215], // Data Actual
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom'
        },
        title: {
            display: true,
            text: 'Plan vs Actual'
        },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        scales: {
            xAxes: [{
                stacked: false, // Tidak menggunakan stacked bar
            }],
            yAxes: [{
                stacked: false, // Tidak menggunakan stacked bar
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
    });

    var myLegendContainer = document.getElementById("myChartLegend");

    // generate HTML legend
    myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

    // bind onClick event to all LI-tags of the legend
    var legendItems = myLegendContainer.getElementsByTagName('li');
    for (var i = 0; i < legendItems.length; i += 1) {
        legendItems[i].addEventListener("click", legendClickCallback, false);
    }
</script>

<?= $this->endSection(); ?>