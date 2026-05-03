document.addEventListener("DOMContentLoaded", function () {
    // Sidebar Toggle
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.getElementById("sidebarCollapse");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("active");
            content.classList.toggle("active");
        });
    }

    // Statistik Pendaftaran Peserta (Bar Chart)
    const registrationChartElement =
        document.getElementById("registrationChart");
    if (registrationChartElement) {
        const ctxBar = registrationChartElement.getContext("2d");
        new Chart(ctxBar, {
            type: "bar",
            data: {
                labels: [
                    "JANUARI",
                    "FEBRUARI",
                    "MARET",
                    "APRIL",
                    "MEI",
                    "JUNI",
                ],
                datasets: [
                    {
                        label: "Pendaftaran",
                        data: [18, 13, 10, 0, 0, 0],
                        backgroundColor: "#F59E0B",
                        borderRadius: 5,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 60,
                        ticks: {
                            stepSize: 10,
                        },
                    },
                },
            },
        });
    }

    // Distribusi Tes (Pie Chart)
    const distributionChartElement =
        document.getElementById("distributionChart");
    if (distributionChartElement) {
        const ctxPie1 = distributionChartElement.getContext("2d");
        new Chart(ctxPie1, {
            type: "pie",
            data: {
                labels: ["TOEFL ITP", "TOEFL EPT-P"],
                datasets: [
                    {
                        data: [60, 40],
                        backgroundColor: ["#6D28D9", "#F59E0B"],
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: "circle",
                        },
                    },
                },
            },
        });
    }

    // Status Peserta (Pie Chart)
    const statusChartElement = document.getElementById("statusChart");
    if (statusChartElement) {
        const ctxPie2 = statusChartElement.getContext("2d");
        new Chart(ctxPie2, {
            type: "pie",
            data: {
                labels: ["Mahasiswa", "Alumni", "Umum"],
                datasets: [
                    {
                        data: [70, 20, 10],
                        backgroundColor: ["#6D28D9", "#C4B5FD", "#F59E0B"],
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: "circle",
                        },
                    },
                },
            },
        });
    }
});
