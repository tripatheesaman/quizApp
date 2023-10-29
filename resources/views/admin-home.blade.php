<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>


</head>


<body class="bg-gray-100 font-sans flex flex-col h-screen">


    <header class="bg-blue-700 text-white p-4 flex justify-between">
        <div class="heading text-2xl font-mono font-extrabold ">Admin Dashboard</div>
        <div class="flex items-center justify-end">
            <a href="{{ route('logout') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Logout</a>
        </div>
    </header>

    <main class="flex-1 bg-gray-100 p-8">

        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-4">

            <a href="{{ route('quiz.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 block text-center text-blue-700 hover:bg-blue-100">
                <h2 class="text-xl font-semibold mb-4">Create Quizzes</h2>

            </a>
            <a href="{{ route('quiz.list') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 block text-center text-blue-700 hover:bg-blue-100">
                <h2 class="text-xl font-semibold mb-4">Manage Quizzes</h2>

            </a>


            <a href="{{ route('report-list') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 block text-center text-green-700 hover:bg-green-100">
                <h2 class="text-xl font-semibold mb-4">See Reports</h2>

            </a>

            <a href="{{ route('admin-play') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 block text-center text-indigo-700 hover:bg-indigo-100">
                <h2 class="text-xl font-semibold mb-4">Play Quiz</h2>

            </a>

        </div>

    </main>
</body>

</html>