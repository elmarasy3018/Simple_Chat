<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($users) > 0)
                    <ul>
                        @foreach($users as $user)
                        <a href="chat/{{$user->id}}">
                            <li style="
                            list-style-type: none;
                            border: 1px solid;
                            border-radius: 5px;
                            background: #D3D3D3;
                            padding: 18px;
                            margin: 5px;
                            ">{{$user->name}}</li>
                        </a>
                        @endforeach
                    </ul>
                    @else
                    <p>There Is No Users To Chat With</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>