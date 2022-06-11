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
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf
                    <div class="input-group flex-nowrap mb-3">
                        <input type="text" name="name" placeholder="Роль" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>

                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault{{$permission->id}}">
                            <label class="form-check-label" for="flexCheckDefault{{$permission->id}}">
                                {{$permission->name}}
                            </label>
                        </div>
                    @endforeach

                    <button class="btn btn-success mt-3">Создать</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
