<?php
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
    //Total pengunjung bulan ini
    function getTotalVisitor(){
        include "connect.php";
        $month = date('m');
        $sql = "SELECT * FROM `data pengunjung` WHERE MONTH(tanggal) = $month";
        $result = mysqli_query($conn, $sql);
        $total = 0;
        while($row = mysqli_fetch_assoc($result)){
            $total = $total + $row['jumlah_masuk'];
        };
        return $total;
    }
    //Mendapatkan data ruangan    
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
    $monthly_visitors = getTotalVisitor();
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
    function toggle(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("startButton").innerHTML =
            this.responseText;
        }
        xhttp.open("POST", "toggleRoom.php");
        xhttp.send();
    } 
    </script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Ruangan : <?php echo $nama_ruangan?></h1>
        <a class='btn btn-primary btn-user' id='startButton' onclick = "toggle()">Open</a>
    </div>
    <!-- First Content Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-5 mb-4">
            <div class="card border-bottom-success shadow h-100 pb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success text-uppercase">Pengunjung Bulan ini </h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-700 text-uppercase"><?php echo date("M Y");?> : <?php echo $monthly_visitors;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-5 mb-4">
            <div class="card border-bottom-info shadow h-100 pb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info text-uppercase">Batas Pengunjung</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $visitor_limit;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-5">
            <div class="card shadow mb-4 border-bottom-primary">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">Jumlah Pengunjung</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p class="m-0 font-weight-bold text-primary text-center"  style="font-size: 40px;" id="visitor">0</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-5 col-md-6 mb-4">
            <div class="presentase card border-bottom-<?php echo $status_color?> shadow h-100 pb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase text-<?php echo $status_color?>">Presentase Kapasitas</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
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

    <!--Last Content Row-->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
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