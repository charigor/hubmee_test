<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white  text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{route('dashboard.create')}}"
                           class="mr-1 font-medium inline-block border text-white  p-2 bg-green-700 hover:bg-green-600">Create
                            new post</a>
                    </div>
                    <table class="text-sm text-left w-full text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Title') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Body') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Author') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Date') }}
                            </th>
                            <th>
                                {{ __('Action') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$post->id}}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$post->title}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 break-all dark:text-white">
                                    {!! Str::of($post->body)->limit(200); !!}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="whitespace-nowrap">name: {{$post->user->name}}</div>
                                    <div class="whitespace-nowrap">email: {{$post->user->email}}</div>
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{date("d-m-Y H:i:s", strtotime($post->created_at)) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <a href="{{route('dashboard.edit',$post->id)}}"
                                           class="mr-1 font-medium inline-block border text-blue-600 p-2 text-blue-500 hover:bg-gray-50">Edit</a>
                                        <form method="post" action="{{route('dashboard.destroy',$post->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                    class="font-medium inline-block border text-blue-600 p-2 text-blue-500 hover:bg-gray-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="6" class="text-center py-4">{{__('No Posts')}}</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">{{ $posts->links('vendor.pagination.tailwind')  }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
