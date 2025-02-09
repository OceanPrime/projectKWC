<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <h4 class="page-title">Analisa Data From Chart</h4>
                <label for="customer">Customer</label>
                <select id="customer" name="customer_id">
                    <option value="">-- Pilih Customer --</option>
                    <?php foreach ($customers as $customer) : ?>
                        <option value="<?= $customer['customer_id']; ?>"><?= $customer['customer_name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="model">Model</label>
                <select id="model" name="model_id">
                    <option value="">-- Pilih Model --</option>
                </select>

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
    //chart plan vs actual
$(document).ready(function () {
    $('#model').change(function () {
        var customerId = $('#customer').val();
        var modelId = $(this).val();

        if (customerId && modelId) {
            $.ajax({
                url: 'monitoring/getLeadTimeComparison/' + customerId + '/' + modelId,
                type: 'GET',
                success: function (response) {
                    if (response) {
                        updatePlanVsActualChart(response.leap_time_planning, response.leap_time_actual);
                    } else {
                        updatePlanVsActualChart(0, 0);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    function updatePlanVsActualChart(plan, actual) {
        myPlanVsActualChart.data.datasets[0].data = [plan, actual];
        myPlanVsActualChart.update();
    }
});
</script>
<script>
var planVsActualChart = document.getElementById('planVsActualChart').getContext('2d');

var myPlanVsActualChart = new Chart(planVsActualChart, {
    type: 'bar',
    data: {
        labels: ["Plan", "Actual"],
        datasets: [{
            label: 'Days',
            data: [0, 0], // Default 0, akan diperbarui melalui AJAX
            backgroundColor: ["#1d7af3", "#f3545d"],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: { display: false },
        scales: {
            yAxes: [{
                ticks: { beginAtZero: true }
            }]
        }
    }
});
</script>







<canvas id="multipleBarChart"></canvas>

<script>
   $(document).ready(function () {
    var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');
    var myMultipleBarChart = new Chart(multipleBarChart, {
        type: 'bar',
        data: {
            labels: [], // Label akan diisi dari AJAX
            datasets: [{
                label: "Plan",
                backgroundColor: '#1d7af3',
                borderColor: '#1d7af3',
                data: []
            }, {
                label: "Actual",
                backgroundColor: '#59d05d',
                borderColor: '#59d05d',
                data: []
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
                    stacked: false,
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 90
                    }
                }],
                yAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    function loadChartData(customerId, modelId) {
    $.ajax({
        url: 'monitoring/getLeadTimeComparisonData/' + customerId + '/' + modelId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log("Data dari server:", response);

            if (!Array.isArray(response.leap_time_planning) || !Array.isArray(response.leap_time_actual)) {
                console.error("Data tidak valid: leap_time_planning atau leap_time_actual bukan array!");
                return;
            }

            myMultipleBarChart.data.labels = response.labels;
            myMultipleBarChart.data.datasets[0].data = response.leap_time_planning;
            myMultipleBarChart.data.datasets[1].data = response.leap_time_actual;
            myMultipleBarChart.update();
        },
        error: function (xhr, status, error) {
            console.error("Error mengambil data:", xhr.responseText);
        }
    });
}


    // Panggil saat dropdown berubah
    $('#model').change(function () {
        var customerId = $('#customer').val();
        var modelId = $(this).val();
        if (customerId && modelId) {
            loadChartData(customerId, modelId);
        }
    });
});

</script>





<script>
    //dropdown customer & model
$(document).ready(function () {
    $('#customer').change(function () {
        var customerId = $(this).val();
        $('#model').html('<option value="">Loading...</option>');

        if (customerId) {
            $.ajax({
                url: '/dev/monitoring/getModelsByCustomer/' + customerId,
                type: 'GET',
                success: function (response) {
                    $('#model').html('<option value="">-- Pilih Model --</option>');
                    $.each(response, function (index, model) {
                        $('#model').append('<option value="' + model.id + '">' + model.model_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#model').html('<option value="">-- Pilih Model --</option>');
                }
            });
        } else {
            $('#model').html('<option value="">-- Pilih Model --</option>');
        }
    });
});
</script>








<script>
    //chart persentase
   $(document).ready(function () {
    $('#model').change(function () {
        var customerId = $('#customer').val();
        var modelId = $(this).val();

        if (customerId && modelId) {
            $.ajax({
                url: 'monitoring/getLeadTimeComparison/' + customerId + '/' + modelId,
                type: 'GET',
                success: function (response) {
                    if (response) {
                        updatePlanVsActualChart(response.leap_time_planning, response.leap_time_actual);
                        updatePieChart(response.percentage_plan, response.percentage_actual);
                    } else {
                        updatePlanVsActualChart(0, 0);
                        updatePieChart(0, 0);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    function updatePlanVsActualChart(plan, actual) {
        myPlanVsActualChart.data.datasets[0].data = [plan, actual];
        myPlanVsActualChart.update();
    }

    function updatePieChart(planPercentage, actualPercentage) {
        myPieChart.data.datasets[0].data = [planPercentage, actualPercentage];
        myPieChart.update();
    }
});

var pieChart = document.getElementById('pieChart').getContext('2d');

var myPieChart = new Chart(pieChart, {
    type: 'pie',
    data: {
        datasets: [{
            data: [0, 0], // Default nilai 0
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
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    var value = data.datasets[0].data[tooltipItem.index];
                    return data.labels[tooltipItem.index] + ': ' + value + '%';
                }
            }
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        },
        plugins: {
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: function(value) {
                    return value + '%';
                }
            }
        }
    }
});


    </script>

<?= $this->endSection(); ?>