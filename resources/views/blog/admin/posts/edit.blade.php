@extends('layouts.app')

@section('content')
    @if($item->exists)
        <form action="{{ route('blog.admin.posts.update', $item->id) }}" method="post">
            @method('PATCH')
            @else
                <form action="{{ route('blog.admin.posts.store') }}" method="post">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @php
                                    /** @var \Illuminate\Support\ViewErrorBag $errors */
                                @endphp

                                @include('blog.admin.posts.includes.result_message')

                                @include('blog.admin.posts.includes.post_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.posts.includes.post_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>

                @if($item->exists)
                    <br>
                    <form action="{{ route('blog.admin.posts.destroy', $item->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-block">
                                    <div class="card-body m-lg-auto">
                                        <button type="submit" class="btn btn-danger" >Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
    @endif
@endsection
