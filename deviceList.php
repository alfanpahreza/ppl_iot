<?php
    include "connect.php";
    $sql = "SELECT * FROM hardware JOIN ruangan ON hardware.id_ruangan = ruangan.id_ruangan";
    $query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Alat</h1>
        <i class="fas fa-cogs"></i>
    </div>
    <div class="row">
        <div class="col-xl-10 col-lg-5">
            <div class="card shadow mb-4 text-center">
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">AppName</th>
                                <th scope="col">DeviceName</th>
                                <th scope="col">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($query)){

                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id_hardware']?></th>
                                <td><?php echo $row['application_name']?></td>
                                <td><?php echo $row['device_name']?></td>
                                <td><?php echo $row['nama_ruangan']?></td>
                                <td>
                                    <a href="index.php?content=update.php&amp;id=<?php echo $row['id_ruangan']?>&amp;mode=device" class="btn btn-primary btn-sm fas fa-edit" name="edit" ></a>
                                </td>
                                <td>
                                    <a href="delete.php?id=<?php echo $row['id_hardware']?>" class="btn btn-danger btn-sm fas fa-trash-alt" name="delete" ></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="index.php?content=insert.php&amp;mode=device" class="btn btn-success btn-sm " name="new" >
                        New +
                    </a>
                </div>
            </div>
        </div>
    </div>
</html>