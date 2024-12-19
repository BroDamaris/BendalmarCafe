<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}
$query_chart = mysqli_query($conn, "SELECT nama_menu,tb_daftar_menu.id,SUM(tb_list_order.jumlah)AS total_jumlah
FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.id ASC");

// $result_chart = array();
while ($record_chart = mysqli_fetch_array($query_chart)) {
    $result_chart[] = $record_chart;
}
$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_quote = array_map(function ($menu) {
    return "'" . $menu . "'";
}, $array_menu);
$string_menu = implode(',', $array_menu_quote);
// echo $string_menu."\n";

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
// echo $string_jumlah_pesanan;
?>
<div class="col-lg-9 mt-2">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-slide="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($result as $dataTombol) {
                ($firstSlideButton) ? $aktif = "active" : $aktif = "";
                $firstSlideButton = false;
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
            <?php
                $slide++;
            } ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $firstline = true;
            foreach ($result as $data) {
                ($firstline) ? $aktif = "active" : $aktif = "";
                $firstline = false;
            ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="asset/images/<?php echo $data['gambar'] ?>" class="img-fluid" style="height : 250px;width:1000px;object-fit:cover" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $data['nama_menu'] ?></h5>
                        <h5><?= $data['keterangan'] ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel -->
    <!-- awal judul -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body">
            <h5 class="card-title">BendalmarCafe</h5>
            <p class="card-text">BendalmarCafe adalah surga kuliner yang menawarkan makanan terbaik dengan cita rasa yang tak tertandingi. Cafe ini menghadirkan beragam menu yang memanjakan lidah, mulai dari seafood segar yang diolah dengan bumbu khas, hingga aneka pasta dan steak yang disajikan dengan sempurna. Chef berpengalaman kami menggunakan bahan-bahan berkualitas tinggi untuk menciptakan hidangan yang tidak hanya lezat, tetapi juga sehat dan bergizi. Tidak hanya itu, BendalmarCafe juga menyediakan berbagai pilihan dessert yang menggoda, serta kopi spesial yang akan melengkapi pengalaman bersantap Anda. Dengan suasana yang nyaman dan pelayanan yang ramah, BendalmarCafe menjanjikan pengalaman kuliner yang tak terlupakan bagi setiap pengunjung.</p>
        </div>
    </div>
    <!-- Akhir judul -->

    <!-- awal chart -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('myChart');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $string_menu ?>],
                        datasets: [{
                            label: 'Jumlah Porsi Terjual',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(250, 0, 14, 0.82)',
                                'rgba(0, 133, 250, 0.82)',
                                'rgba(250, 231, 0, 0.82)',
                                'rgba(0, 250, 12, 0.82)',
                                'rgba(190, 0, 250, 0.82)',
                                'rgba(250, 85, 0, 0.82)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- Akhir chart -->
</div>