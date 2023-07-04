@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Brands
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session('delete')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($brands as $brand)
                            <tr>
                                <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                <td>{{ $brand->brand_name }}</td>
                                <td>
                                    <img src="{{ asset($brand->brand_image) }}" style="height: 50px; width:80px;" alt="">
                                </td>
                                <td>{{ $brand->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{  url('Brand/Edit/'.$brand->id) }}" class="btn btn-primary" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ url('Delete/Brand/'.$brand->id) }}" onclick=" return confirm('Delete confirm?')" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $brands->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Brands
                </div>

                <div class="card-body">
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add brand</label>
                          <input type="text" class="form-control" name="brand_name" aria-describedby="emailHelp" placeholder="Enter Brand">
                          
                          @error('brand_name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" name="brand_image" @error('brand_image')
                            @enderror aria-describedby="emailHelp">
                            
                            @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    
                </div>
            </div>
        </div>
    </div>

    
    

    
</div>
@endsection
