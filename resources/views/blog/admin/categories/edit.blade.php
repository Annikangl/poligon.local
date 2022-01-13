@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp

    <form action="{{ route('blog.admin.categories.update', $item->id) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @php
                        /** @var \Illuminate\Support\ViewErrorBag $errors */
                    @endphp
                    @if($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @include('blog.admin.categories.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.categories.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
