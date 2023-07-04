@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Category
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} --}}

                    {{-- @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                    @endif --}}

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
                            <th scope="col">Added by</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{  url('Category/Edit/'.$category->id) }}" class="btn btn-primary" style="margin-right: 10px;">Edit</a>
                                    <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Category
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} --}}
                    
                    <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add category</label>
                          <input type="text" class="form-control" name="category_name" aria-describedby="emailHelp" placeholder="Enter Category">
                          
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

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Trash list
                </div>
    
                <div class="card-body">
    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Added by</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($trashCat as $category)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{  url('Category/restore/'.$category->id) }}" class="btn btn-success" style="margin-right: 10px;">Restore</a>
                                    <a href="{{  url('Category/p-delete/'.$category->id) }}" class="btn btn-danger">Permanent Delete</a>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $trashCat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="col-md-4"></div>
    </div>
    

    
</div>
@endsection
