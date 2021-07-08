<?php
    //dummy data
    $monthly_visitors = 1469;
    include "connect.php";
    $sql = "SELECT * FROM ruangan WHERE id_ruangan = $_SESSION[room]";
    $login = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($login);


    //variables
    $nama_ruangan = $row["nama_ruangan"];
    $visitor_limit = $row["batas_pengunjung"];
    $current_visitor = $_SESSION['count'];
    $fill_percentage = ($current_visitor / $visitor_limit) * 100;
    $fill_percentage = number_format((float)$fill_percentage, 1, '.', '');
    $status_color = updateColor($fill_percentage);

    //mengubah status warna sesuai persentase pengunjung
    function updateColor($fill_percentage){
        $status_color = "success";
        switch ($fill_percentage){
            case ($fill_percentage >= 75):
                $status_color = "danger";
                break;
            case ($fill_percentage >= 50):
                $status_color = "warning";
                break;
        }
        return $status_color;
    }
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Page Script --> 
    <script type="text/javascript">
    $(document).ready(function(){
          setInterval(function (){
          $('#visitor').load('getCurrent.php');
        },1000);
        });
    </script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Dashboard Ruangan : <?php echo $nama_ruangan?></h1>
</div>

<!-- Content Row -->
    <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Pengunjung(Bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthly_visitors;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Batas Pengunjung</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $visitor_limit;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-<?php echo $status_color?> shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-<?php echo $status_color?> text-uppercase mb-1">
                            Persentase Kapasitas
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php echo $fill_percentage?>%
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-<?php echo $status_color;?>" role="progressbar" style="width: <?php echo $fill_percentage?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Pengunjung</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p class="m-0 font-weight-bold text-primary text-center"  style="font-size: 40px;" id="visitor">0</p>
                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Pengunjung Dalam 7 Hari Terakhir</h6>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>