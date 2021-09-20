<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Site Analysis') }}
        </h2>
    </x-slot>
    <h1 class="bg-green-300 border-solid border-black rounded-lg p-4 m-2">
        Showing results for <strong>{{ $year['year'] }}</strong>
    </h1>
    <div class="flex justify-center">
        <div class="bg-gray-200 rounded-lg my-4" style="width:75%;">
            {!! $userRegistrationChart->render() !!}
        </div>
    </div>
    <form action="{{ route('site-analysis') }}" method="post" class="mb-4">
        @csrf
        <div class="mb-4">
            @error('year')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex justify-center">
            <div class="px-4">
                {!! Form::selectRange('year', 2021, 1900, $year['year']) !!}
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>
