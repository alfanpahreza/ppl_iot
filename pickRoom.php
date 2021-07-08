<?php
    include "connect.php";

    if(isset($_POST['submit'])){
        $id_baru = $_POST["ruangan"];
        $_SESSION['room'] = $id_baru;
    }

    $sql = "SELECT * FROM ruangan WHERE id_ruangan = $_SESSION[room]";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $nama_ruangan = $row['nama_ruangan'];
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
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Ruangan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="user" action="" method="post">
                        <div class="form-group">
                        <select class="form-select" aria-label="Default select example" name="ruangan">
                            <?php
                                $sql = "SELECT * FROM ruangan";
                                $query = mysqli_query($conn, $sql);
                                $i = 1;
                                while($row = mysqli_fetch_assoc($query)){
                                    $selected = "";
                                    if($row['id_ruangan'] == $_SESSION["room"]){
                                        $selected = "selected";
                                    }
                                    echo "<option value='$row[id_ruangan]' $selected>$row[nama_ruangan]</option>";
                                }
                                $batas_ruangan = $row['batas_pengunjung'];
                            ?>
                        </select>
                        <hr>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Change">
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>