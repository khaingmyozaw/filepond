<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>File Pond Tutorial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <div class="w-screen h-screen flex items-center justify-center p-5 bg-gray-200">
        <div class="w-1/3 p-5 bg-red-500 rounded">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" id="title" class="w-full block min-w-0 grow py-1.5 pr-3 pl-1 border mb-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="janesmith">
                <input type="file" name="file" id="file" class="w-full block mb-3 pond">
                <div class="w-full flex justify-end">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>