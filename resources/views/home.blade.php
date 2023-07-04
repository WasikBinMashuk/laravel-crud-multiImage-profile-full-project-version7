@extends('layouts.admin_master')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    {{ Auth::user()->name }} <span class="badge text-bg-success">Active now</span>
                    <b style="float:right">Total Users <span class="badge text-bg-danger">{{ count($users) }}</span></b>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} --}}

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

