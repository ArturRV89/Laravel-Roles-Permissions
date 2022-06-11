<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container col-md-12">

        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif

        <a href="{{route('add-post')}}" class="btn btn-success mt-3" type="submit">Добавление новой статьи</a>

        @foreach($posts as $post)
            <div class="card mt-3">
                <div class="card-body">
                    <p>{{$post->created_at}}</p>
                    <a href="#"><h5 class="card-title">{{ $post->name }}</h5></a>
                    <p class="card-text">{{$post->text}}</p>
                    <a href="{{route('edit-post', $post->id)}}" class="btn btn-primary">Редактировать</a>
                    <form action="{{route('delete-post', $post->id)}}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
