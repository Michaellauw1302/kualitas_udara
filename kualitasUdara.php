<?php
include "koneksi.php";
$sql = mysqli_query($conn, "SELECT * FROM udara ORDER BY id DESC");
$data = mysqli_fetch_array($sql);
$udara = $data['kualitas_udara'];
echo $udara;
if ($udara < 40.0) {
    echo "
               &#176;C<br>
           <div class='alert alert-danger' role='alert' style='width: 100%; margin-top:2%;'>
                <div style='font-size: 12px;'>
                    Buruk
                </div>
              </div>
                    
              ";
} else if ($udara == (50.0 and 75)) {
    echo "
             <br>
           <div class='alert alert-primary' role='alert' style='width: 100%; margin-top:2%;'>
                <div style='font-size: 12px;'>
                Sedang
                </div>
              </div>
            
  ";
} else {
    echo "
   <br>
 <div class='alert alert-primary' role='alert' style='width: 100%; margin-top:2%;'>
      <div style='font-size: 12px;'>
      Baik
      </div>
    </div>
  
";
}
