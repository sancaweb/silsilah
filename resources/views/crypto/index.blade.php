@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content mt-4">
    <div class="container-fluid">
      <!-- Form -->
      <div class="row">
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Crypto Form</h3>

              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                  </button>
              </div> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Waktu Deposit:</label>
                  <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                      <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-12 col-sm-6"></div>
              </div>

            <div class="row">
              <div class="col-12 col-sm-6">


                <div class="form-group">
                  <label>Crypto</label>
                  <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">DCT</option>
                  <option>DCT2</option>
                  <option>DCT3</option>
                  <option>DCT4</option>
                  <option>DCT5</option>
                  <option>DCT6</option>
                  <option>DCT7</option>
                  </select>
                </div>
              </div>

              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Topup</label>
                  <input class="form-control" type="text" name="" id="" placeholder="topup" value="20.000.000">
                </div>
              </div>

            </div>
            <!-- /.row -->

            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                    <label>Referral</label>
                    <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->


              <div class="col-md-6">
              
                <div class="form-group">
                  <label>Downline</label>
                  <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            
            </div>
            <!-- /.card-body -->
                      <div class="card-footer ">
                      <div class="row">
                          <div class="col-md-10"></div>
                          <div class="col-md-2">
                          
                          <button type="button" class="btn btn-block btn-primary btn-flat float-right">
                              
                              Save & Print
                          </button>
                          </div>
                      </div>
                      </div>
          </div>
        </div>
      </div>
      <!-- ./Form -->


      <div class="row">
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Data Deposito</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Deposit</th>
                  <th>Percentage</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Rp. 10.000.000
                  </td>
                  <td>75%</td>
                  <td>Done</td>
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
        </div>
        <!-- /.col -->
      </div>
          <!-- /.row -->
    </div>
    <!-- ./ .container-fluid -->
  </section>
</div>

@endsection
