@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light" style="border: none">
                <div class="card-body" >
                    <form method="POST" action="{{ route('books.update', ['book' => $book->id]) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 cardimg">
                            <img src="{{ asset('storage/'.$book->cover) }}" alt="image" id="image" class="rounded-25">
                            @error('cover')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label for="input-file">Choose image</label>
                            <input type="file" accept="image/jpg , image/png , image/jpeg" id="input-file" name="cover">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $book->title}}" required autocomplete="title" autofocus placeholder="Title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <select id="genre" class="form-select @error('genre') is-invalid @enderror" name="genre" required>
                                    <option value="" selected disabled>{{$book->genre}}</option>
                                    <option value="Action" {{ old('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                                    <option value="Fantasy" {{ old('genre') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                </select>
                        
                                @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ $book->author }}" required autocomplete="author" autofocus placeholder="Author">

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="Publication_Year" type="text" class="form-control @error('publication_Year') is-invalid @enderror" name="publication_Year" value="{{ $book->publication_year }}" required autocomplete="publication_Year" placeholder="Publication_Year">


                                @error('publication_Year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="total_copies" type="number" class="form-control @error('total_copies') is-invalid @enderror" name="total_copies" value="{{ $book->total_copies }}" required autocomplete="total_copies" placeholder="Total_copies">

                                @error('total_copies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="available_copies" type="number" class="form-control @error('available_copies') is-invalid @enderror" name="available_copies" value="{{ $book->available_copies }}" required autocomplete="available_copies" placeholder="Available_copies">

                                @error('available_copies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Description">{{$book->description}}</textarea>

                                @error('description')
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
