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
                <form action="{{route('store-post')}}" method="POST">
                    @csrf
                    <div class="input-group flex-nowrap">
                        <input type="text" name="name" placeholder="Заголовок" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" name="text" rows="10" id="floatingTextarea"></textarea>
                    </div>
                    <button class="btn btn-success mt-3">Создать</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
