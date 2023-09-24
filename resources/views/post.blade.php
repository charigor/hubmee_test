<x-main-layout>
    <div class="relative sm:flex sm:justify-center min-h-screen bg-dots-darker bg-center  dark:bg-dots-lighter  selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl w-full p-6 lg:p-8">
            <div class="mt-16 w-full">
                @if($post)
                    <div class="p-4 w-full mb-2  border bg-gray-100 rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <h2 class="mb-3 text-3xl font-extrabold  text-gray-900">{{Str::upper($post->title)}}</h2>
                        {!!$post->body!!}
                        <hr class="my-4">
                        <div class="my-2 flex sm:justify-between">
                            <div class="border-b">author: {{$post->user->name}}</div>
                            <span class="text-sm">{{date("d-m-Y H:i:s", strtotime($post->created_at)) }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-main-layout>

