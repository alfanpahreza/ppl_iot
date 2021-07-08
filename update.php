<?php
    include "connect.php";
    $saved = false;
    //Get Mode
    if(isset($_GET['mode'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
            $title = "Edit Ruangan";
            $back = "roomList.php";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "device";
            $title = "Edit Alat";
            $back = "deviceList.php";
        }
    }else{
        echo "mode not received";
    }

    //Update
    if(isset($_POST["save"])){
        if($tabel == 'ruangan'){
            $sql = "UPDATE `ruangan` SET `nama_ruangan`= '$_POST[roomName]', `batas_pengunjung`='$_POST[roomLimit]',
             `id_owner`= '$_POST[owner]' WHERE id_ruangan = $_GET[id]";
        }else if($tabel == 'device'){
            $sql = "UPDATE `hardware` SET `access_key`='$_POST[key]', `application_name`='$_POST[appName]',
             `device_name`= '$_POST[deviceName]', `id_ruangan`= '$_POST[ruangan]' WHERE id_hardware = $_GET[id]";
        }
        if($query = mysqli_query($conn, $sql)){
            $saved = true;
        };
    }

    if($tabel == "ruangan"){
        $sql = "SELECT * FROM ruangan WHERE id_ruangan=$_GET[id]";
    }
    if($tabel == "device"){
        $sql = "SELECT * FROM hardware WHERE id_hardware=$_GET[id]";
    }
    if($query = mysqli_query($conn, $sql)){
        $row = mysqli_fetch_assoc($query);
    };
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
                        <input type="text" class="form-control form-control-user"name="roomName" value="<?php echo $row['nama_ruangan']?>">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Batas Pengunjung</label>
                        <input type="number" class="form-control form-control-user"name="roomLimit" value="<?php echo $row['batas_pengunjung']?>">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Owner</label><br>
                        <select class="form-select" aria-label="Default select example" name="owner">
                            <?php
                                $sql = "SELECT * FROM owner";
                                $query = mysqli_query($conn, $sql);
                                while($result = mysqli_fetch_assoc($query)){
                            ?>
                                <option value="<?php echo $result["id_owner"]?>" <?php if($result['id_owner'] == $row["id_owner"]){
                                    echo "selected";}?>><?php echo $result["nama"]?></option>
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
                                while($result = mysqli_fetch_assoc($query)){
                            ?>
                                <option value="<?php echo $result["id_ruangan"]?>"><?php echo $result["nama_ruangan"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="col-12">
                        <?php if($saved){
                                echo "<p class='text-success'>Data Tersimpan</p>";
                            }else{
                                echo "<p class='text-primary'>Silahkan simpan data jika sudah selesai</p>";
                            }
                        ?>
                    </div>
                    <div class="col-12 p-2">
                        <a class="btn btn-danger justify-content-between" href="index.php?content=<?php echo $back?>">Kembali</a>
                        <button type="submit" class="btn btn-success justify-content-between" name="save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
