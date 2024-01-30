<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Blogs') }}
        </h2>
        <!-- component -->
        <form method="GET" action="{{ route('blogs.searchBlog') }}">
          <div class="flex rounded bg-white mt-4">
              <input class=" w-full border-none bg-transparent px-4 py-1 text-gray-400 outline-none focus:outline-none " type="text" name="queryy" id="queryy" placeholder="Search..." />
              <button type="submit" class="m-2 rounded bg-blue-600 px-4 py-2 text-white">
                  <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                  <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                  </svg>
              </button>
          </div>
        </form>

    </x-slot>
    @if(session('success'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6 p-16">
        @foreach ($blogs as $blog)
        <div class="bg-white w-full rounded-lg shadow-md flex flex-col transition-all overflow-hidden hover:shadow-2xl">
            <div class="  p-6">
    
              <div class="pb-3 mb-4 border-b border-stone-200 text-xs font-medium flex justify-between text-blue-900">
                <span class="flex items-center gap-1">
                  {{$blog->created_at}}
                </span>
              </div>
              
              <h3 class="mb-4 font-semibold  text-2xl"><a href="{{route('blogs.viewOne',['id'=>$blog->id])}}" class="transition-all text-blue-900 hover:text-blue-600">{{$blog->title}}</a></h3>
              <p class="text-sky-800 text-sm mb-0">
                {{$blog->description}}
              </p>
            </div>
            <div class="mt-auto">
              <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="w-full h-48 object-cover">
            </div>
          </div>
        @endforeach
        @if ($blogs instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $blogs->links() }}
        @endif
    </div>
</x-app-layout>