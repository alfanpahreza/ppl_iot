<?php
    include "connect.php";

    if(isset($_POST['submit'])){
        $batas_ruangan = $_POST["limit"];
        //Cek Input Username & Pass
        $sql = "UPDATE ruangan SET batas_pengunjung = $batas_ruangan WHERE id_ruangan = $_SESSION[room]" ;
        $query = mysqli_query($conn, $sql);
        
        $sql = "SELECT * FROM ruangan WHERE id_ruangan = $_SESSION[room]";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        $batas_ruangan = $row['batas_pengunjung'];
    }

    $sql = "SELECT * FROM ruangan WHERE id_ruangan = $_SESSION[room]";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $nama_ruangan = $row['nama_ruangan'];
    $batas_ruangan = $row['batas_pengunjung'];
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $nama_ruangan?></h1>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 text-center">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Batas Pengunjung</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p class="m-0 font-weight-bold text-primary text-center"  style="font-size: 40px;" id="visitor"><?php echo $batas_ruangan?></p>
                    <form class="user" action="" method="post">
                        <hr>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user"
                                name="limit" placeholder="Batas Baru">
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Change">
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>