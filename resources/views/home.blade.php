<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Quản lý - Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
    }

    .admin-sidebar {
      position: fixed;
      width: 250px;
      height: 100%;
      background-color: #343a40;
      padding-top: 20px;
      color: #ffffff;
      transition: width 0.3s;
    }

    .admin-content {
      margin-left: 275px;
      padding: 20px;
      transition: margin-left 0.3s;
    }

    .admin-sidebar a {
      color: #ffffff;
      text-decoration: none;
      padding: 10px;
      display: block;
    }

    .admin-sidebar a:hover {
      background-color: #555;
      border-radius: 10px;
    }

    .admin-sidebar a.active {
      background-color: #007bff;
      border-radius: 10px;
    }

    .admin-sidebar i {
      margin-right: 8px;
      font-size: 16px;
    }

    @media (max-width: 768px) {
      .admin-sidebar {
        width: 65px;
      }

      .admin-sidebar span {
        display: none;
      }

      .admin-content {
        margin-left: 70px;
      }
    }

    .custom-card {
      height: 100%;
    }

    .custom-card .card-body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    /* Add background color for cards */
    .custom-card:nth-child(odd) {
      background-color: #f8f9fa;
    }

    .custom-card:nth-child(even) {
      background-color: #e9ecef;
    }
  </style>
</head>

<body>

  <div class="container-fluid">

    <div class="row">

      <div class="col-lg-3  admin-sidebar">
        <h3 style="height: 52px;"><span>Quản Trị</span></h3>
        <a href="admin.html" class="active"><i class="fas fa-chart-bar"></i><span>Thống Kê</span></a>
        <a href="user.html" class=""><i class="fas fa-user"></i><span>User</span></a>
        <a href="product.html" class=""><i class="fas fa-box"></i><span>Product</span></a>
        <a href="order.html" class=""><i class="fas fa-shopping-cart"></i><span>Order</span></a>
        <a href="#" class=""><i class="fas fa-sign-out-alt"></i><span>Thoát</span></a>
      </div>

      <div class="col-lg-9 admin-content">
        <h1 class="mb-4">Thống Kê</h1>

        <div class="row mt-4">
          <div class="mb-3 col-lg-3">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h5 class="card-title">Đơn Hàng Hôm Nay</h5>
                <p class="card-text">0</p>
              </div>
            </div>
          </div>
          <div class="mb-3 col-lg-3">
            <div class="card bg-success text-white">
              <div class="card-body">
                <h5 class="card-title">Doanh Thu Hôm Nay</h5>
                <p class="card-text">0</p>
              </div>
            </div>
          </div>
          <div class="mb-3 col-lg-3">
            <div class="card bg-info text-white">
              <div class="card-body">
                <h5 class="card-title">Đơn Hàng Tháng Này</h5>
                <p class="card-text">0</p>
              </div>
            </div>
          </div>
          <div class="mb-3 col-lg-3">
            <div class="card bg-warning text-white">
              <div class="card-body">
                <h5 class="card-title">Doanh Thu Tháng Này</h5>
                <p class="card-text">0</p>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-12">
            <h2 class="mt-4">Doanh Thu Tháng Này</h2>
            <canvas id="areaChart" style="width: 100%;"></canvas>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8">
            <h2 class="mt-4">Doanh Thu Năm</h2>
            <canvas id="orderChart" style="width: 100%;"></canvas>
          </div>
          <div class="col-lg-4">
            <h2 class="mt-4">Tỷ Lệ Sản Phẩm</h2>
            <canvas id="pieChart" style="width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    $(document).ready(function () {
      $(".admin-sidebar a").click(function () {
        $(".admin-sidebar a").removeClass("active");
        $(this).addClass("active");
      });

      var today = new Date();

      var areaData = {
        labels: Array.from({ length: today.getDate() }, (_, i) => (i + 1).toString()), // Sử dụng ngày hiện tại làm độ dài
        datasets: [{
          label: 'Triệu',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: Array.from({ length: today.getDate() }, (_, i) => (Math.random() * (8.78 - 3) + 3).toFixed(2)),
        }]
      };

      var orderData = {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
          label: 'Triệu',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: [20, 35, 45, 30, 55, 25, 35, 45, 30, 55, 25, 20],
        }]
      };

      var pieData = {
        labels: ['Áo', 'Quần', 'Phụ Kiện'],
        datasets: [{
          label: "%",
          data: [67, 27, 6],
          backgroundColor: ['#ffcc00', '#ff6666', '#99ff99'],
          borderWidth: 1,
        }]
      };



      var ctxArea = document.getElementById('areaChart').getContext('2d');
      var areaChart = new Chart(ctxArea, {
        type: 'line',
        data: areaData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      var ctxOrder = document.getElementById('orderChart').getContext('2d');
      var orderChart = new Chart(ctxOrder, {
        type: 'bar',
        data: orderData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      var ctxPie = document.getElementById('pieChart').getContext('2d');
      var pieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: pieData,
      });

    });
  </script>
</body>

</html>