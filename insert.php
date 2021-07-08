<?php
    //Get Mode
    if(isset($_GET['mode'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
            $title = "Tambahkan Ruangan";
            $back = "roomList.php";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "device";
            $title = "Tambahkan Alat";
            $back = "deviceList.php";
        }
    }else{
        echo "mode not received";
    }
    //Insert
    if(isset($_POST["save"])){
        include "connect.php";
        if($tabel == 'ruangan'){
            $sql = "INSERT INTO `ruangan` (`nama_ruangan`, `batas_pengunjung`, `id_owner`) 
            VALUES ( '$_POST[roomName]','$_POST[roomLimit]', '$_POST[owner]')";
        }else if($tabel == 'device'){
            $sql = "INSERT INTO `hardware` (`access_key`, `application_name`, `device_name`, `id_ruangan`) 
            VALUES ( '$_POST[key]','$_POST[appName]', '$_POST[deviceName]', '$_POST[ruangan]')";
        }
        if($query = mysqli_query($conn, $sql)){
            header("Location:index.php?content=$back");
        };
    }
?>
<html>
    <body>
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?> </h1>
        <div class = "container px-4 px-lg-5 mt-4">
            <div class="card shadow mb-4">
                <form action="" class="row g-3 p-3" method="post">
                    <!-- Jika mode ruangan -->
                    <?php
                        if($tabel == 'ruangan'){
                    ?>
                    <div class="col-md-6 p-3">
                        <label>Nama Ruangan</label>
                        <input type="text" class="form-control form-control-user"name="roomName">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Batas Pengunjung</label>
                        <input type="number" class="form-control form-control-user"name="roomLimit">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Owner</label><br>
                        <select class="form-select" aria-label="Default select example" name="owner">
                            <?php
                                include "connect.php";
                                $sql = "SELECT * FROM owner";
                                $query = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($query)){
                            ?>
                                <option value="<?php echo $row["id_owner"]?>"><?php echo $row["nama"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <!-- Jika mode device -->
                    <?php
                        }else{
                    ?>
                    <div class="col-md-6 p-3">
                        <label>Access Key</label>
                        <input type="text" class="form-control form-control-user"name="key">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Nama Aplikasi</label>
                        <input type="text" class="form-control form-control-user"name="appName">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Nama Device</label>
                        <input type="text" class="form-control form-control-user"name="deviceName">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Ruangan</label><br>
                        <select class="form-select" aria-label="Default select example" name="ruangan">
                            <?php
                                include "connect.php";
                                $sql = "SELECT * FROM ruangan";
                                $query = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($query)){
                            ?>
                                <option value="<?php echo $row["id_ruangan"]?>"><?php echo $row["nama_ruangan"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="col-12 p-3">
                        <a class="btn btn-danger justify-content-between" href="index.php?content=<?php echo $back?>">Batal</a>
                        <button type="submit" class="btn btn-success justify-content-between" name="save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
