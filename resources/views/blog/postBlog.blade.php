<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('PostBlogs') }}
        </h2>
    </x-slot>
    {{-- <form action="{{ route('blogs.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Content:</label>
        <textarea name="description" id="description" rows="5" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Submit</button>
    </form> --}}
    <!-- component -->
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
<div class=" flex items-center justify-center mt-8">
    <div class="max-w-md w-full dark:bg-gray-800 p-8 rounded-lg shadow-md">
        <form action="{{ route('blogs.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Post Content Section -->
            <div class="mb-6">
                <label for="title" class="block text-white text-sm font-bold mb-2">Post Title:</label>
                <input id="title" name="title" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
  sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Blog Title"/>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-white text-sm font-bold mb-2">Post Content:</label>
                <textarea id="description" name="description" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
  sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="What's on your mind?"></textarea>
            </div>
            <!-- File Attachment Section -->
            <div class="mb-6">
                <label for="image" class="block text-white text-sm font-bold mb-2">Attach Image:</label>
                <div class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                    <input type="file" id="image" name="image" accept="image/*"  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="ml-2 text-sm text-gray-600">Choose a file</span>
                    </div>
                    <span class="text-sm text-gray-500">Max file size: 5MB</span>
                </div>
            </div>
            <!-- Submit Button and Character Limit Section -->
            <div class="flex items-center justify-between">
                <button type="submit" class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2"> Post <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send" fill="#fff">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z"></path>
                    </svg>
                </button>
                
                <span class="text-gray-500 text-sm">Max 280 characters</span>
            </div>
        </form>
    </div>
</div>
</x-app-layout>