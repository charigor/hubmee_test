<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white  text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{route('dashboard.index')}}"
                           class="mr-1 font-medium inline-block border text-gray-600 hover:text-gray-500  p-2">{{ __('Back') }}</a>
                    </div>

                    <form method="POST" action="{{route('dashboard.store')}}">
                        @csrf
                        <div class="grid gap-6 mb-6">
                            <div>
                                <label for="title"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Title') }}</label>
                                <input type="text" id="title" name="title" value="{{old('title')}}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                            </div>
                            <div>
                                <label for="body"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Body') }}</label>
                                <textarea id="body" name="body" rows="4"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Write your thoughts here...">{!! old('body') !!}</textarea>
                                <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                            </div>
                            <div>
                                <label for="user_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Author') }}</label>
                                <select name="user_id" class="w-full">
                                    @foreach ($users as $item)
                                        <option value="{{ $item['key'] }}"
                                                @if ($item['key'] == old('user_id'))
                                                    selected="selected"
                                                @endif
                                                @if($item['key'] == null) class="hidden" @endif
                                        >{{ $item['value'] }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                            </div>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
