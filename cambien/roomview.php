<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php
include "config/config.php";
?>

<?php
  $room = $_GET['room'];
  $userid = Session::get('userId');
    if(isset($_POST['submit'])){
        $date = $_POST['date'];
        $date2 = $_POST['date2'];
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE date(datetime) BETWEEN '$date' AND '$date2' ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE date(datetime) BETWEEN '$date' AND '$date2' ORDER BY ID ASC");
        
        $temperature = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE date(datetime) BETWEEN '$date' AND '$date2' ORDER BY ID ASC");
      $humidity = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE date(datetime) BETWEEN '$date' AND '$date2' ORDER BY ID ASC");
  }elseif(isset($_POST['today'])){
        $date = date("Y-m-d");
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE date(datetime) = '$date' ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE date(datetime) = '$date' ORDER BY ID ASC");
        
        $temperature = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE date(datetime) = '$date' ORDER BY ID ASC");
      $humidity = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE date(datetime) = '$date' ORDER BY ID ASC");
    }elseif(isset($_POST['7day'])){
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 7 day ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 7 day ORDER BY ID ASC");
        
        $temperature = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 7 day ORDER BY ID ASC");
      $humidity = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 7 day ORDER BY ID ASC");
    }elseif(isset($_POST['1month'])){
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 1 month ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 1 month ORDER BY ID ASC");
        
        $temperature = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 1 month ORDER BY ID ASC");
      $humidity = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 1 month ORDER BY ID ASC");
    }elseif(isset($_POST['3month'])){
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 3 month ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 3 month ORDER BY ID ASC");
        
        $temperature = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 3 month ORDER BY ID ASC");
      $humidity = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC) Var1 WHERE datetime >= now() - interval 3 month ORDER BY ID ASC");
    }else{
        $datetime1 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
        $datetime2 = mysqli_query($connect, "SELECT datetime FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
        $temperature   = mysqli_query($connect, "SELECT temperature FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
      $humidity   = mysqli_query($connect, "SELECT humidity FROM ( SELECT a.* FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC");
  }
  
  
  $sqlAdmin = mysqli_query($connect, "SELECT datetime,temperature,humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC LIMIT 0,1");
  $data=mysqli_fetch_array($sqlAdmin);
  $sqlMq135 = mysqli_query($connect, "SELECT datetime,quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC LIMIT 0,1");
  $dataMq135=mysqli_fetch_array($sqlMq135);
  $sqlMhrd = mysqli_query($connect, "SELECT datetime,quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC LIMIT 0,1");
  $dataMhrd=mysqli_fetch_array($sqlMhrd);
  $datemin = mysqli_query($connect, "SELECT date(datetime) as date FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID ASC LIMIT 1");
  $daten=mysqli_fetch_array($datemin);
  $datemax = mysqli_query($connect, "SELECT date(datetime) as date FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID DESC LIMIT 1");
  $datem=mysqli_fetch_array($datemax);
  
  $sqlHighT = mysqli_query($connect, "SELECT alarm_temp_high FROM dht22list WHERE room_id = '$room'");
  $dataHighT=mysqli_fetch_array($sqlHighT);
  
  $sqlHighH = mysqli_query($connect, "SELECT alarm_hum_high FROM dht22list WHERE room_id = '$room'");
  $dataHighH=mysqli_fetch_array($sqlHighH);
?>

<div class="container">

  <script type="text/javascript" src="vendor/chart.js/Chart.js"></script>
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  
  <div id="responsecontainer">
  
<form action="" method="post">
  <center><b><td>
    Từ: <input type="date" name="date" min="<?php echo $daten['date'] ?>" max="<?php echo $datem['date'] ?>"/>
  </td>&emsp;
  <td>
    Đến: <input type="date" name="date2" min="<?php echo $daten['date'] ?>" max="<?php echo $datem['date'] ?>"/>
  </td>            
  <td>&emsp;
        <input class = "btn btn-green" type="submit" name="submit" Value="Duyệt" /></br></br>
        <input class = "btn btn-blue" type="submit" name="today" Value="Hôm nay" />&ensp;
        <input class = "btn btn-blue" type="submit" name="7day" Value="7 ngày" />&ensp;
        <input class = "btn btn-blue" type="submit" name="1month" Value="1 tháng" />&ensp;
        <input class = "btn btn-blue" type="submit" name="3month" Value="3 tháng" />&ensp;
        <input class = "btn btn-green" type="submit" name="reset" Value="Reset" />
  </td></b></center>

</form>
<hr>
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
                          <u><i><a class="h6 m-0 font-weight-bold text-primary" href="dht22list.php?room=<?php echo $room ?>">Dữ liệu</a></i></u>
                      </div>
                      
                  </div>
              </div>
          </div>
        </div>

    <div class="panel-body">
      <h6><center><b>Nhiệt độ (°C)</b></center></h6>
      <canvas id="myChart" width="630px" height="350px"></canvas>
      <script>
      const temp = <?php echo $dataHighT['alarm_temp_high'] ?>;
    // setup 
    const data = {
      labels: [<?php while ($b = mysqli_fetch_array($datetime1)) { echo '"' . $b['datetime'] . '",';}?>],
      datasets: [{
        label: 'Nhiệt độ (°C)',
        data: [<?php while ($b = mysqli_fetch_array($temperature)) { echo  $b['temperature'] . ',';}?>],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)'
          
        ],

        fill: {
          target: {
            value: temp
          },
          below: (context) => {
            console.log(context)
            const chart = context.chart;
            const { ctx, chartArea, data, scales } = chart;
            if(!chartArea){
              return null;
            }
            return belowGradient(ctx, chartArea, data, scales)
          },
          above: (context) => {
            console.log(context)
            const chart = context.chart;
            const { ctx, chartArea, data, scales } = chart;
            if(!chartArea){
              return null;
            }
            return aboveGradient(ctx, chartArea, data, scales)
          },
        },
        borderColor: (context) => {
          console.log(context)
          const chart = context.chart;
          const { ctx, chartArea, data, scales } = chart;
          if(!chartArea){
            return null;
          }
          return getGradient(ctx, chartArea, data, scales)
        },
        tension: 0.4,
        pointRadius: 0,
        pointHitRadius: 10,
        hoverPointRadius: 0
      }]
    };

    // config 
    const config = {
      type: 'line',
      data,
      options: {
        scales: {
          xAxes: {
            ticks: {
              autoSkip: true,
              maxTicksLimit: 10
            }
          },
          y: {
            beginAtZero: false
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      },
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    function getGradient(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBorder = ctx.createLinearGradient(0, y.getPixelForValue(temp), 0, bottom);
      gradientBorder.addColorStop(0, 'rgba(255, 26, 104, 1)');
      gradientBorder.addColorStop(0, 'rgba(75, 192, 192, 1)');
      return gradientBorder;
    };

    function belowGradient(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBackground = ctx.createLinearGradient(0, y.getPixelForValue(temp), 0, bottom);
      gradientBackground.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
      gradientBackground.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
      return gradientBackground;
    };

    function aboveGradient(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBackground = ctx.createLinearGradient(0, y.getPixelForValue(temp), 0, top);
      gradientBackground.addColorStop(0, 'rgba(255, 26, 104, 0.1)');
      gradientBackground.addColorStop(1, 'rgba(255, 26, 104, 0.5)');
      return gradientBackground;
    }
    </script>          
    </div>
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-sky shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="m-0 font-weight-bold" style="color: #4baedd">
                          CHẤT LƯỢNG KHÔNG KHÍ<i class="fas fa-wind" style="float: right"></i>
                      </div>
                      <br><br>
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
                      <div style="margin-top: 8rem">
                      <hr>
                          <u><i><a class="h6 m-0 font-weight-bold text-primary" href="mq135list.php?room=<?php echo $room ?>">Dữ liệu</a></i></u>
                      </div>
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
                      <u><i><a class="h6 m-0 font-weight-bold text-primary" href="dht22list.php?room=<?php echo $room ?>">Dữ liệu</a></i></u>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
  <div class="panel-body">
      <h6><center><b>Độ ẩm (%)</b></center></h6>
      <canvas id="myChart2" width="630px" height="350px"></canvas>
      <script>
      const hum = <?php echo $dataHighH['alarm_hum_high'] ?>;
    // setup 
    const data2 = {
      labels: [<?php while ($b = mysqli_fetch_array($datetime2)) { echo '"' . $b['datetime'] . '",';}?>],
      datasets: [{
        label: 'Độ ẩm (%)',
        data: [<?php while ($b = mysqli_fetch_array($humidity)) { echo  $b['humidity'] . ',';}?>],
        backgroundColor: [
          'rgba(0, 137, 132, .2)'
          
        ],

        fill: {
          target: {
            value: hum
          },
          below: (context) => {
            console.log(context)
            const chart = context.chart;
            const { ctx, chartArea, data, scales } = chart;
            if(!chartArea){
              return null;
            }
            return belowGradient2(ctx, chartArea, data, scales)
          },
          above: (context) => {
            console.log(context)
            const chart = context.chart;
            const { ctx, chartArea, data, scales } = chart;
            if(!chartArea){
              return null;
            }
            return aboveGradient2(ctx, chartArea, data, scales)
          },
        },
        borderColor: (context) => {
          console.log(context)
          const chart = context.chart;
          const { ctx, chartArea, data, scales } = chart;
          if(!chartArea){
            return null;
          }
          return getGradient2(ctx, chartArea, data, scales)
        },
        tension: 0.4,
        pointRadius: 0,
        pointHitRadius: 10,
        hoverPointRadius: 0
      }]
    };

    // config 
    const config2 = {
      type: 'line',
      data: data2,
      options: {
        scales: {
          xAxes: {
            ticks: {
              autoSkip: true,
              maxTicksLimit: 10
            }
          },
          y: {
            beginAtZero: false
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    };

    // render init block
    const myChart2 = new Chart(
      document.getElementById('myChart2'),
      config2
    );

    function getGradient2(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBorder = ctx.createLinearGradient(0, y.getPixelForValue(hum), 0, bottom);
      gradientBorder.addColorStop(0, 'rgba(255, 26, 104, 1)');
      gradientBorder.addColorStop(0, 'rgba(75, 192, 192, 1)');
      return gradientBorder;
    };

    function belowGradient2(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBackground = ctx.createLinearGradient(0, y.getPixelForValue(hum), 0, bottom);
      gradientBackground.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
      gradientBackground.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
      return gradientBackground;
    };

    function aboveGradient2(ctx, chartArea, data, scales){
      const {left, right, top, bottom, width, height} = chartArea;
      const {x, y} = scales;
      const gradientBackground = ctx.createLinearGradient(0, y.getPixelForValue(hum), 0, top);
      gradientBackground.addColorStop(0, 'rgba(255, 26, 104, 0.1)');
      gradientBackground.addColorStop(1, 'rgba(255, 26, 104, 0.5)');
      return gradientBackground;
    }
    </script>          
    </div>
    
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-sky shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="m-0 font-weight-bold" style="color: #ebba2d">
                          RÒ RỈ NƯỚC<i class="fas fa-water" style="float: right"></i>
                      </div>
                      <br><br>
                      <?php
                        if($dataMhrd['quality']==0){
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: red"><i class="fas fa-times"></i> Chưa rõ</div>
                      <?php
                        }elseif($dataMhrd['quality']==1){
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: green; margin-top: 5px"><i class="fas fa-check-circle"></i> Tốt</div>
                      <?php
                        }else{
                      ?>
                      <div class="h5 mb-0 font-weight-bold" style="color: orange; margin-top: 5px"><i class="fas fa-exclamation-circle"></i> Rò rỉ</div>
                      <?php
                        }
                      ?>
                      <div style="margin-top: 8rem">
                      <hr>
                          <u><i><a class="h6 m-0 font-weight-bold text-primary" href="mhrdlist.php?room=<?php echo $room ?>">Dữ liệu</a></i></u>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
    </div>  
  </div>

</div>
  </div>  
</div>

<script>
  var gauge3 = Gauge(
    document.getElementById("gauge3"),
    {
      min: -40,
      max: 120,
      value: <?php echo $data['temperature'] ?>,
      color: function(value) {
        if(value >= 19 && value <= 22) {
          return "#5ee432";
        }else if(value >= 15 && value < 19 || value > 22 && value <= 26) {
          return "#fffa50";
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
        if(value >= 45 && value <= 50) {
          return "#5ee432";
        }else if(value >= 40 && value < 45 || value > 50 && value <= 55) {
          return "#fffa50";
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
<?php include 'inc/footer.php'?>