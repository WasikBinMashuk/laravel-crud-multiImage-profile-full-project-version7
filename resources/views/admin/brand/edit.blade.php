@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Edit Brand
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} --}}
                    
                    <form action="{{ url('Update/Brand/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">

                        <div class="form-group mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                          <input type="text" class="form-control" name="brand_name" @error('brand_image')
                          @enderror aria-describedby="emailHelp" value="{{ $brands->brand_name }}">
                          
                          @error('brand_name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" name="brand_image" @error('brand_image')
                            @enderror aria-describedby="emailHelp">
                            
                            @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <img src="{{ asset($brands->brand_image) }}" style="height: 50px; width:80px;" alt="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
