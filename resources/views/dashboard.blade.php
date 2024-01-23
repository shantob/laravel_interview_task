<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="py-6 sm:py-12 dark:bg-gray-800 dark:text-gray-100">
            <div class="container p-6 mx-auto space-y-8">
                <div class="space-y-2 text-center">
                    <h2 class="text-3xl font-bold">Partem reprimique an pro</h2>
                    <p class="font-serif text-sm dark:text-gray-400">Qualisque erroribus usu at, duo te agam soluta
                        mucius.</p>
                </div>
                <div class=" gap-x-4 gap-y-8 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($blogs as $blog)
                        <article class="flex flex-col dark:bg-gray-900 py-5 my-10 justify-center">
                            <a rel="noopener noreferrer" href="#"
                                aria-label="Te nulla oportere reprimique his dolorum">
                                <img alt="" class="object-cover m-20 w-full h-full dark:bg-gray-500"
                                    src="{{ $blog->image }}">
                            </a>
                            <div class="flex flex-col flex-1 p-6">
                                <a rel="noopener noreferrer" href="#"
                                    aria-label="Te nulla oportere reprimique his dolorum"></a>
                                <a rel="noopener noreferrer" href="#"
                                    class="text-xs tracki uppercase hover:underline dark:text-violet-400">{{ $blog->name }}</a>
                                <h3 class="flex-1 py-2 text-lg font-semibold leadi">{!! $blog->desc !!}
                                </h3>
                                <div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-400">
                                    <span>{{ $blog->created_at->format('d-m-y') }}</span>
                                </div>
                            </div>
                            <div class="w-fullbg-white rounded-lg border p-1 md:p-3 m-10">
                                <h3 class="font-semibold p-1">Discussion</h3>
                                <div class="flex flex-col gap-5 m-3">

                                    <!-- Comment Container -->
                                    <div>
                                        <div class="flex w-full justify-between border rounded-md">
                                            @if ($blog->comment)
                                                @foreach ($blog->comment as $comment)
                                                    <div class="p-3">
                                                        <div class="flex gap-3 items-center">
                                                            <img src="https://avatars.githubusercontent.com/u/22263436?v=4"
                                                                class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400  shadow-emerald-400">
                                                            <h3 class="font-bold">
                                                                {{ $comment->user->name }}
                                                                <br>
                                                                <span class="text-sm text-gray-400 font-normal">{{$comment->created_at->diffForHumans()}}</span>
                                                            </h3>
                                                        </div>
                                                        <p class="text-gray-100 mt-2">
                                                            {{ $comment->comment }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <!-- END Reply Container  -->

                                    </div>
                                    <!-- END Comment Container  -->
                                </div>
                                @auth
                                    <form action="{{route('comment.store')}}" method="post">
                                        @csrf
                                        <div class="w-full px-3 mb-2 mt-6">
                                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                            <textarea
                                                class="bg-gray-800 rounded border border-white-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-gray-600"
                                                placeholder="Comment" name="comment" required></textarea>
                                        </div>

                                        <div class="w-full flex justify-end px-3 my-3">
                                            <button type="submit"
                                                class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500 text-lg">Post
                                                Comment </button>
                                        </div>
                                    </form>
                                @else
                                    <strong class="text-red-900">Login For Comment</strong>
                                @endauth

                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
    </div>
    </section>
    </div>
</x-app-layout>
