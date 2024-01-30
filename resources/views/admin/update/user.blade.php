@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light" style="border: none">
                <div class="card-body" >
                    <form method="POST" action="{{ route('dashboard.update' , ['dashboard'=>$user->id]) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 cardimg">
                            <img src="{{ asset('storage/'.$user->profile) }}" alt="image" id="image" class="rounded-circle">
                            @error('profile')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label for="input-file">Choose image</label>
                            <input type="file" accept="image/jpg , image/png , image/jpeg" id="input-file" name="profile">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus placeholder="Phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary me-4">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{route('dashboard.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
