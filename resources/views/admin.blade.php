@extends('layouts.admin_header')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Products Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    <p>{{ $message }}</p>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> <strong>Whoops!</strong><br><br>
    There were some problems with your input.</h5>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </div>
@endif

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                        Add New Product
                    </button>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($items as $item)
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->price}} {{ $item->currency}}</td>
                            <td><img src="{{ asset('images/Products') }}/{{$item->photo}}" width="100px" height="75px"></td>
                            <td>
                              @if($item->status == 'on')
                              <span class="right badge badge-success">Active</span>
                              @else
                              <span class="right badge badge-danger">InActive</span>
                              @endif
                            </td>
                            <td>
                                <button type="button" title="edit" style="border: none; background-color:transparent;"
                                        data-toggle="modal" data-target="#modal-lg_edit{{$item->id}}">
                                    <i class="fas fa-edit fa-lg text-primary"></i>
                                </button>
                                <button type="button" title="delete" style="border: none; background-color:transparent;"
                                        data-toggle="modal" data-target="#modal-danger{{$item->id}}">
                                    <i class="fas fa-trash fa-lg text-danger"></i>
                                </button>
                            </td>
                    </tr>

                    <!-- Edit Store Modal -->
                      <div class="modal fade" id="modal-lg_edit{{$item->id}}">
                          <div class="modal-dialog modal-default">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Edit Product</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">

                                      <form method="POST" action="{{ route('administrator.update', $item->id)}}" enctype="multipart/form-data" class="form-horizontal">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-group row">
                                              <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                                              <div class="col-sm-8">
                                                  <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <label for="inputName" class="col-sm-4 col-form-label">Price</label>
                                              <div class="col-sm-8">
                                                  <input type="number" name="price" class="form-control" value="{{$item->price}}" required>
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Select Currency</label>
                                            <div class="col-sm-8">
                                            <select class="form-control select2" name="currency" style="width: 100%;">
                                              @if($item->currency == "ETB")
                                                <option value="ETB" selected> ETB </option>
                                              @else
                                                <option value="ETB"> ETB </option>
                                              @endif
                                              @if($item->currency == "$")
                                                <option value="$" selected> USD </option>
                                              @else
                                                <option value="$"> USD </option>
                                              @endif
                                            </select>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Product Photo</label>
                                            <div class="col-sm-8">
                                              <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose Photo</label>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                              <label for="remember" class="col-sm-4 col-form-label">Product is Active</label>
                                              <div class="col-sm-8">
                                                @if($item->status == 'on')
                                                <input type="checkbox" name="status" id="remember" value="on" checked>
                                                @else
                                                <input type="checkbox" name="status" id="remember" value="off">
                                                @endif
                                              </div>
                                          </div>

                                          <button type="submit" class="btn btn-primary btn-block">
                                              Update Product</button>
                                      </form>

                                  </div>

                              </div>-->
                              <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                      </div>
                    <!-- /.modal -->

                    <!-- Delete Modal Starts Here-->
                    <div class="modal fade" id="modal-danger{{$item->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Are you sure you want to delete <br> <strong>"{{ $item->name }}"</strong> ?</h4>
                                </div>

                                <form action="{{ route('administrator.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-outline-light">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Add New Store Modal -->
  <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-default">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Add New Product</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

                  <form method="POST" action="{{ route('administrator.store')}}" enctype="multipart/form-data" class="form-horizontal">
                      @csrf
                      <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                              <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Price</label>
                          <div class="col-sm-8">
                              <input type="number" name="price" class="form-control" id="inputName" placeholder="price" required>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Select Currency</label>
                        <div class="col-sm-8">
                        <select class="form-control select2" name="currency" style="width: 100%;">
                            <option value="ETB"> ETB </option>
                            <option value="$"> USD </option>
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Product Photo</label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose Photo</label>
                          </div>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary btn-block">
                          Add Product</button>
                  </form>

              </div>

          </div>-->
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
@endsection