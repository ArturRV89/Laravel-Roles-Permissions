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

        <a href="{{route('roles.create')}}" class="btn btn-success mt-3" type="submit">Добавить роль</a>

        @foreach($roles as $role)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $role->name }}</h5>
                    <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary">Редактировать</a>
                    <form action="{{route('roles.destroy', $role->id)}}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
