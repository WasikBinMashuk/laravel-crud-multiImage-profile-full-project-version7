@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} --}}
                    
                    <form action="{{ url('Store/Category/'.$categories->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update category</label>
                          <input type="text" class="form-control" name="category_name" aria-describedby="emailHelp" value="{{ $categories->category_name }}">
                          
                          @error('category_name')
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
