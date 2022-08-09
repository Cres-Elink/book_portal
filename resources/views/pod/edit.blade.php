@extends('layouts.authenticated')

@section('content')

<div class="container">
    <div class="container">
        <div class="row justify-content-center align-content-center mt-5">
            <div class="col-md-5">
                <form action="{{ route('pod.update',['pod' => $pod]) }}" method="post" class="card p-4 shadow">
                    <a href="{{ route('pod.index')}}" class="ms-auto text-decoration-none text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </a>
                    <h5 class="text-center">Edit Transaction</h5>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="form-group my-1">
                        <label for="author">Author</label>
                        <select name="author" id="author" class="form-select">
                            <option value="" disabled selected>Select One</option>
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                        @error('author')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="book_title">Book Title</label>
                        <select name="book_title" id="book_title" class="form-select">
                            <option class="text-wrap" value="{{old('book_title') ?? $pod->book_title}}" disabled selected>Select One</option>
                            @foreach ($books as $book)
                            <option class="text-wrap" value="{{$book->id}}">{{$book->title}}</option>
                            @endforeach
                        </select>
                        @error('book_title')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" id="year" value="{{old('year') ?? $pod->year}}">
                        @error('year')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="month">Month</label>
                        <select name="month" id="month" class="form-select">
                            <option value="{{old('month')}}" disabled selected>Select One</option>
                            @foreach ($months as $key => $value)
                                @if (old('month') == $key)
                                    <option value="{{$key}}" selected>{{$value == '' ? 'None' : $value }}</option>
                                @else
                                    <option value="{{$key}}">{{$value == '' ? 'None' : $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('month')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="flag">Flag</label>
                        <select name="flag" class="form-control" required>
                            <option value="" disabled selected>Select one</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        @error('flag')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="" disabled selected>Select one</option>
                            <option value="">Unpaid</option>
                            <option value="Paid">Paid</option>
                        </select>
                        @error('status')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="format">Format</label>
                        <select name="format" class="form-control" required>
                            <option value="" disabled selected>Select one</option>
                            <option value="Paperback">Paperback</option>
                            <option value="Hardback">Hardback</option>
                        </select>
                        @error('format')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"  value="{{old('quantity') ?? $pod->quantity}}">
                        @error('quantity')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{old('price') ?? $pod->price}}">
                        @error('price')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <button type="submit" class="btn btn-primary">Update Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
