@extends('layout.dashboard.main')
@section('title', 'Home')
@section('name', 'Home') 
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID Inventaris</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Last Update</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>LP1208901298</td>
                <td>Komputer</td>
                <td>12</td>
                <td><span class="btn btn-outline-success btn-sm">Good Condition</span></td>
                <td>2/12/2023</td>
              </tr>
              <tr>
                <td>LP1208901298</td>
                <td>Meja</td>
                <td>100</td>
                <td><span class="btn btn-outline-success btn-sm">Good Condition</span></td>
                <td>2/12/2023</td>
              </tr>
              <tr>
                <td>LP1208901298</td>
                <td>Kursi</td>
                <td>90</td>
                <td><span class="btn btn-outline-success btn-sm">Good Condition</span></td>
                <td>2/12/2023</td>
              </tr>
              <tr>
                <td>LP1208901298</td>
                <td>Laptop</td>
                <td>10</td>
                <td><span class="btn btn-outline-success btn-sm">Good Condition</span></td>
                <td>2/12/2023</td>
              </tr>
              <tr>
                <td>LP1208901298</td>
                <td>Baju APD</td>
                <td>500</td>
                <td><span class="btn btn-outline-success btn-sm">Good Condition</span></td>
                <td>2/12/2023</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection