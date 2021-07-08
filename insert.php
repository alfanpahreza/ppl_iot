<?php
    if(isset($_GET['mode'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
            $title = "Tambahkan Ruangan";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "device";
            $title = "Tambahkan Alat";
        }
    }else{
        echo "mode not received";
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
                        <input type="text" class="form-control form-control-user"name="name">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Batas Pengunjung</label>
                        <input type="number" class="form-control form-control-user"name="limit">
                    </div>
                    <div class="col-md-6 p-3">
                        <label>Owner</label><br>
                        <select class="form-select" aria-label="Default select example">
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
                    <?php
                        }
                    ?>
                    <div class="col-12 p-3">
                        <a class="btn btn-danger justify-content-between" name="save">Batal</a>
                        <button type="submit" class="btn btn-success justify-content-between" name="save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
