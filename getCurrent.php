<?php
  include('antares-php.php');
  $antares = new antares_php();
  $antares->set_key('29618496cc237e51:97bfc3c190e3e7b9');

  $yourdata = $antares->get('RealDevice', 'RoomOccupancyCounter');
  $data = $yourdata[0]['People'];
  if($data != ""){
    $_SESSION['count'] = (int)$data;
    echo $data;
  }else{
    echo $_SESSION['count'];
  }
?>