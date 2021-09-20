<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">
    </div>
    <div class="flex justify-center m-4">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="bg-white rounded-lg my-4">
                {!! $currentWorkloadChart->render() !!}
            </div>
            <form action="{{ route('jobs') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <div class="my-2">
                        <label for="job_name" class="sr-only">Description</label>
                        <input name="job_name" id="job_name" cols="30" rows="4"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('job_name') border-red-500 @enderror"
                            placeholder="Job Name">
                    </div>

                    <div class="my-2">
                        <label for="description" class="sr-only">Description</label>
                        <textarea name="description" id="description" cols="30" rows="4"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror"
                            placeholder="Description"></textarea>
                    </div>



                    @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Create
                        Job</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
