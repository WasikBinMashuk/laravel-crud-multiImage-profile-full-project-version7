@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        
        <div class="col-md-8">
            {{-- <div class="card-deck">
                @foreach ($images as $multi_img)
                    <div class="col-md-4 mt-3">
                        <div class="card" >
                            <img src="{{ asset($multi_img->image) }}"  class="card-img-top"  alt="Crd image cap">
                            <div class="card-body">
                            
                                <p class="card-text"><small class="text-muted">amar matha</small></p>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div> --}}
            <div class="card-group">
                @foreach ($images as $multi_img)
                    <div class="col-md-3 m-4">
                        <div class="card">
                            <img src="{{ asset($multi_img->image) }}"  class="card-img-top"  alt="Crd image cap">
                            <div class="card-body">
                                
                                <p class="card-text"><small class="text-body-secondary">Created at {{ $multi_img->created_at->diffForHumans() }}</small></p>
                                <div style="text-align: right">
                                    <a href="{{ url('multi/image/Delete/'.$multi_img->id) }}" class="btn btn-light btn-sm text-right"  onclick=" return confirm('Delete confirm?')"><i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i></a>
                                </div>

                                

                                
                            </div>
                        </div>
                    </div>
                    
                @endforeach
              </div>
            
        </div>

        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">
                    Add Brands
                </div>

                <div class="card-body">
                    <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Multiple Image</label>
                            <input type="file" class="form-control" name="image[]" @error('image')
                            @enderror aria-describedby="emailHelp" multiple>
                            
                            @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                    
                </div>
            </div>
        </div>
    </div>

    
    

    
</div>
@endsection
