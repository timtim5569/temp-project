@extends('layouts.main')

@section('content')
    <section class="mx-8">
            <div class="shadow-lg rounded-lg overflow-hidden" >
                <div class="flex justify-center">
                    <div class="w-1/3 p-2">
                        <canvas id="chartLine"></canvas>
                    </div>
                    <div class="w-3/3 p-2">
                        <canvas id="chartPie"></canvas>
                    </div>
                </div>
                <div class="flex justify-center p-2">
                    <div class="w-1/3 p-5">
                        <canvas id="chartBar"></canvas>
                    </div>
                </div>
                <div class="flex justify-end p-2">
                    <button class="app-button-blue" onclick="handlePrintBtn()">พิมพ์</button>
                </div>
            </div>


    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function handlePrintBtn() {
            print();
        }
    </script>
       
            <!-- Chart line -->
                <script>
                    const data = {
                        labels: <?php echo json_encode($labels) ?>,
                        datasets: [
                            {
                                label: "โพสต์ทั้งหมด",
                                backgroundColor: "orange",
                                borderColor: "orange",
                                data: <?php echo json_encode($counts); ?>,
                            },
                        ],
                    };

                    const configLineChart = {
                        type: "line",
                        data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };

                    var chartLine = new Chart(
                        document.getElementById("chartLine"),
                        configLineChart
                    );
                </script>

            <!-- Chart pie -->
                <script>
                const dataPie = {
                    labels: ["ยื่นคำร้อง", "รับคำร้อง", "กำลังดำเนินการ","เสร็จสมบูรณ์"],
                    datasets: [
                    {
                        data: <?php echo json_encode($progesses); ?>,
                        backgroundColor: ["rgba(111, 227, 247, 0.6)",
                        "rgba(230, 129, 184, 0.6)" , 
                        "rgba(255, 182, 56, 0.6)",
                        "rgba(91, 235, 175, 0.6)"
                    ],
                        hoverOffset: 4,
                    },
                    ],
                };

                const configPie = {
                    type: "pie",
                    data: dataPie,
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'สถานะเดือนนี้'
                            }
                        }
                    },
                };
                var chartBar = new Chart(document.getElementById("chartPie"), configPie);
                </script>

            <!-- Chart bar -->
            <script>
                const dataBarChart = {
                    labels: <?php echo json_encode($labels) ?>,
                    datasets: [
                    {
                        backgroundColor: ["rgba(91, 235, 175, 0.6)" ,
                        "rgba(230, 129, 184, 0.6)" , 
                        "rgba(255, 182, 56, 0.6)", 
                        "rgba(111, 227, 247, 0.6)", 
                        "rgba(237, 59, 92, 0.6)", 
                        "rgba(207, 95, 227, 0.6)"
                    ],
                        borderColor: "rgb(133, 105, 241)",
                        pointBackgroundColor: "rgb(133, 105, 241)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgb(133, 105, 241)",
                        data: <?php echo json_encode($count_per_month); ?>,
                    },
                    ],
                };

                const configBarChart = {
                    type: "bar",
                    data: dataBarChart,
                    options: {
                        plugins: {
                            legend: {
                            display: false
                            }
                            ,
                            title: {
                                display: true,
                                text: 'โพสต์เดือนนี้'
                            }
                        }
                    },
                };

                var chartBar = new Chart(
                    document.getElementById("chartBar"),
                    configBarChart
                );
            </script>
    </section>

@endsection
