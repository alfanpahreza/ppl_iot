<?php
  include('antares-php.php');
  include('connect.php');
  session_start();
  $id_ruangan = $_SESSION['room'];

  $sqlHardware = "SELECT * FROM `hardware` WHERE id_ruangan = $id_ruangan";
  $queryHardware = mysqli_query($conn, $sqlHardware);
  $rowHardware = mysqli_fetch_assoc($queryHardware);

  
  $sqlRuangan = "SELECT * FROM `ruangan` WHERE id_ruangan = $id_ruangan";
  $queryRuangan = mysqli_query($conn, $sqlRuangan);
  $rowRuangan = mysqli_fetch_assoc($queryRuangan);

  //get hardware data from antarest
  $antares = new antares_php();
  $antares->set_key($rowHardware['access_key']);
  $yourdata = $antares->get($rowHardware['device_name'], $rowHardware['application_name']);
  $data = $yourdata[0]['People'];
  if($data != ""){
    if($data >= $rowRuangan['batas_pengunjung']){
      echo '<script language="javascript">';
      echo 'alert("JUMLAH PENGUNJUNG MELEBIHI KAPASITAS. SEGERA TINDAK !!")';
      echo '</script>';
      $_SESSION['count'] = (int)$data;
      echo $data;
    }else{
      $_SESSION['count'] = (int)$data;
      echo $data;
    }   
  }else{
    if($_SESSION['count'] >= $rowRuangan['batas_pengunjung']){
      echo '<script language="javascript">';
      echo 'alert("JUMLAH PENGUNJUNG MELEBIHI KAPASITAS. SEGERA TINDAK !!")';
      echo '</script>';
      echo $_SESSION['count'];
    }else{
      echo $_SESSION['count'];
    }

  }  
?>

