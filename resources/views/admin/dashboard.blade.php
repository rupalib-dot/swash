@extends('admin.inc.index')
@section('content')
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>10</h3>
              <p>Total Booking</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>3</h3>

              <p>Total Locations</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>20</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>5</h3>

              <p>Block Date</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">

            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Booking Chart</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Latest Register Client</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                      </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>
                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>
                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>
                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>
                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>
                        <tr>
                            <td><a href="#">10</a></td>
                            <td>Rekha Rani</td>
                            <td>
                                rekha@gmail.com
                            </td>
                            <td>8764454177</td>
                        </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    },{
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    },{
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    },{
      data: [700,800,2000,5000,7000,4000,2000,1000,600,100],
      borderColor: "yellow",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
        </script>
@endsection

