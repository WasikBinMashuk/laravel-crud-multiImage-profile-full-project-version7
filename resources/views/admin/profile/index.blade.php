@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Update profile
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

                    <form action="{{ route('update.user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Name</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  aria-describedby="emailHelp" placeholder="Enter Name">
                          
                          @error('name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label ">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                        
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 15rem;" >
                <img class="card-img-top"  src="{{ asset('img/pronoy.png') }}"   alt="...">
                
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">{{ Auth::user()->email }}</li>
                  <li class="list-group-item"><a href="{{ route('change.password') }}">Change password</a></li>
                  <li class="list-group-item">A third item</li>
                </ul>
                
              </div>
        </div>
    </div>

    
    

    
</div>
@endsection
