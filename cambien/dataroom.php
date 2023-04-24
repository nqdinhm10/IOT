<?php
include "config/config.php";
?>

<?php
  $room = $_GET['room'];
  $datetime1  = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
  $datetime2  = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
  $temperature   = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
  $humidity   = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
  $sqlAdmin = mysqli_query($connect, "SELECT datetime,temperature,humidity FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1");
  $data=mysqli_fetch_array($sqlAdmin);
  $sqlMq135 = mysqli_query($connect, "SELECT datetime,quality FROM mq135 a, mq135list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1");
  $dataMq135=mysqli_fetch_array($sqlMq135);
  $sqlAdmin2 = mysqli_query($connect, "SELECT datetime, temperature, humidity FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,20");
  ?>


<script>
  var gauge3 = Gauge(
    document.getElementById("gauge3"),
    {
      min: -40,
      max: 120,
      value: <?php echo $data['temperature'] ?>,
      color: function(value) {
        if(value <= 30) {
          return "#5ee432";
        }else if(value < 40) {
          return "#fffa50";
        }else if(value < 60) {
          return "#f7aa38";
        }else {
          return "#ef4655";
        }
      },
      label: function(value) {
            return (Math.round(value * 100) / 100) + "°C";
            }
    }
  );

  var gauge2 = Gauge(
    document.getElementById("gauge2"),
    {
      value: <?php echo $data['humidity'] ?>,
      color: function(value) {
        if(value <= 30) {
          return "#5ee432";
        }else if(value < 40) {
          return "#fffa50";
        }else if(value < 60) {
          return "#f7aa38";
        }else {
          return "#ef4655";
        }
      },
      label: function(value) {
            return (Math.round(value * 100) / 100) + "%";
            }
    }
  );
</script>

      <h3><center><b>NHIỆT ĐỘ VÀ ĐỘ ẨM</b></h3>
    
<div class="col">
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-temperature shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="m-0 font-weight-bold" style="color: #cf86a5">
                              NHIỆT ĐỘ<i class="fas fa-temperature-low fa-2x" style="float: right"></i>
                          </div>
    
                          <div id="gauge3" class="gauge-container three" style="width: 200px"></div>
                          <hr>
                          <a class="m-0 font-weight-bold" href="dht22list.php?room=<?php echo $room ?>">Dữ liệu</a>
                      </div>
                      
                  </div>
              </div>
          </div>
        </div>

    <div class="panel-body">
      <canvas id="myChart" width="630px" height="350px"></canvas>
      <script>
       var canvas = document.getElementById('myChart');
        var data = {
            labels: [<?php while ($b = mysqli_fetch_array($datetime1)) { echo '"' . $b['datetime'] . '",';}?>],
            datasets: [
            {
                label: "Nhiệt độ (°C)",
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(105, 0, 132, .2)",
                borderColor: "rgba(200, 99, 132, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(200, 99, 132, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($temperature)) { echo  $b['temperature'] . ',';}?>]
            } 
            ]
        };

        var option = 
        {
          showLines: true, responsive: false,
          animation: {duration: 0}
        };
        
        var myLineChart = Chart.Line(canvas,{
          data:data,
          options:option
        });

      </script>          
    </div>
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-sky shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="m-0 font-weight-bold" style="color: #92d3fe">
                          CHẤT LƯỢNG KHÔNG KHÍ<i class="fas fa-wind" style="float: right"></i>
                      </div>
                      <?php
                        if($dataMq135['quality']==0){
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: red"><i class="fas fa-times"></i> Chưa rõ</div>
                      <?php
                        }elseif($dataMq135['quality']==1){
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: green; margin-top: 5px"><i class="fas fa-check-circle"></i> Tốt</div>
                      <?php
                        }else{
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: orange; margin-top: 5px"><i class="fas fa-exclamation-circle"></i> Kém</div>
                      <?php
                        }
                      ?>
                      <hr>
                          <a class="m-0 font-weight-bold" href="mq135list.php?room=<?php echo $room ?>">Dữ liệu</a>
                  </div>
                  
              </div>
          </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-humidity shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="m-0 font-weight-bold" style="color: #4356a2">
                          ĐỘ ẨM<i class="fas fa-tint fa-2x" style="float: right"></i>
                      </div>

                      <div id="gauge2" class="gauge-container three" style="width: 200px"></div>
                      <hr>
                      <a class="m-0 font-weight-bold" href="dht22list.php?room=<?php echo $room ?>">Dữ liệu</a>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>

    <div class="panel-body">
      <canvas id="myChart2" width="630px" height="350px"></canvas>
      <script>
       var canvas = document.getElementById('myChart2');
        var data = {
            labels: [<?php while ($b = mysqli_fetch_array($datetime2)) { echo '"' . $b['datetime'] . '",';}?>],
            datasets: [
            {
                label: "Độ ẩm (%)", 
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(0, 137, 132, .2)",
                borderColor: "rgba(0, 10, 130, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(0, 10, 130, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($humidity)) { echo  $b['humidity'] . ',';}?>]
            }
            ]
        };

        var option = 
        {
          showLines: true, responsive: false,
          animation: {duration: 0}
        };
        
        var myLineChart = Chart.Line(canvas,{
          data:data,
          options:option
        });

      </script>          
    </div>    
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><center>Bảng dữ liệu</h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr >
            <th class='text-center'>Thời gian</th>
            <th class='text-center'>Nhiệt độ (°C)</th>
            <th class='text-center'>Độ ẩm (%)</th>
          </tr>
        </thead>
        
        <tbody>
          <?php

            
            while($data2=mysqli_fetch_array($sqlAdmin2))
            {
              echo "<tr >
                <td><center>$data2[datetime]</center></td> 
                <td><center>$data2[temperature]</td>
                <td><center>$data2[humidity]</td>
              </tr>";
            }
          ?>
        </tbody>
      </table>   
    </div>
  </div>
</div>