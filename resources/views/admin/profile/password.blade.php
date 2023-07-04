@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Update password
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

                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Old Password</label>
                          <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"  aria-describedby="emailHelp" placeholder="Old password">

                          @if (session('error'))
                            <strong class="text-danger">{{session('error')}}</strong>
                          @endif
                        
                          @error('old_password')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label ">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" aria-describedby="emailHelp" placeholder="Enter new password">
                            
                            @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label ">Confirm Password</label>
                            <input type="password" class="form-control @error('email') is-invalid @enderror" name="confirm_password" aria-describedby="emailHelp" placeholder="Confirm password">
                            
                            @if (session('newError'))
                            <strong class="text-danger">{{session('newError')}}</strong>
                            @endif

                            @error('confirm_password')
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
