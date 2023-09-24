<x-main-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16 px-4 border">
            @forelse($posts as $post)
                <div class="p-4 w-100 bg-gray-100 rounded-lg md:p-8 dark:bg-gray-800 my-4" id="about" role="tabpanel"
                     aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold  text-gray-900">{{Str::upper($post->title)}}</h2>
                    {!! Str::of($post->body)->limit(200); !!}
                    <hr class="my-4">
                    <div class="my-2 flex sm:justify-between">
                        <div class="border-b">author: {{$post->user->name}}</div>
                        <span class="text-sm">{{date("d-m-Y H:i:s", strtotime($post->created_at)) }}</span>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{route('front.post',$post->id)}}"
                           class="block border border-blue-600 rounded-lg px-3 py-2 inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                            Learn more
                        </a>
                    </div>
                </div>

            @empty
                <div class="py-4 text-center">
                    No any posts
                </div>
            @endforelse
        </div>
        <div class="flex justify-end mt-4">{{ $posts->links('vendor.pagination.tailwind')  }}</div>
    </div>
</x-main-layout>
