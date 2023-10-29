<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>

<body class="">

    <header class="bg-blue-700 text-white p-4 flex justify-between">
        <div class="heading text-2xl font-mono font-extrabold ">Quiz App</div>
        <div class="flex items-center justify-end">
            <a href="{{ route('logout') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Logout</a>
            <?php
            if (session()->has('user_type')) {
                $userType = session()->get('user_type');
                if ($userType == 0) { ?>
                    <a href="{{ route('admin-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Dashboard</a>
            <?php }
            } ?>

        </div>
    </header>

    <div class="container mx-auto mt-8 p-8">
        <h1 class="text-2xl font-bold mb-4">Choose a Quiz</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($quizzes as $quiz)
            @if ($quiz->status == 1)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 block text-center text-indigo-700 hover:bg-indigo-100">
                <a href="{{ route('start-quiz', ['id' => $quiz->quiz_id]) }}">
                    <h2 class="text-xl font-semibold mb-4">{{ $quiz->quiz_title }}</h2>
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>


</html>