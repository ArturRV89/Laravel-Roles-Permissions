<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container col-md-12">
        <div class="card mt-3">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('update-post', $post->id)}}" method="POST">
                    @csrf
                    <div class="input-group flex-nowrap">
                        <input type="text" name="name" value="{{$post->name}}" placeholder="Заголовок" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control mt-3" name="text" id="exampleFormControlTextarea1" rows="10">{{$post->text}}</textarea>
                    </div>
                    <button class="btn btn-success ">Изменить</button>
                    <a href="{{route('dashboard')}}" class="btn btn-primary">На главную</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
