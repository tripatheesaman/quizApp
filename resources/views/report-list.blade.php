<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report List</title>
    <style>
        /* .welcome-body {
            background: url('https://images.unsplash.com/photo-1492892132812-a00a8b245c45?auto=format&fit=crop&q=80&w=1770&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-repeat: no-repeat;
            background-size: cover;
        } */
    </style>
</head>




<body class="bg-gray-100 ">
    <header class="bg-blue-700 text-white p-4 flex justify-between">
        <div class="heading text-2xl font-mono font-extrabold ">Create Quiz</div>
        <div class="flex items-center justify-end">
            <a href="{{ route('admin-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Dashboard</a>
        </div>

    </header>
    <div class="py-6 p-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h1 class="text-3xl font-semibold mb-4">Reports</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quiz Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($data as $report)
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg mb-4 p-4 border-b border-gray-300">
                                <td class="px-6 py-2">{{ $loop->iteration }}</td>
                                <td class="px-6 py-2">{{ $report['user_name'] }}</td>
                                <td class="px-6 py-2">{{ $report['quiz_title'] }}</td>
                                <td class="px-6 py-2 bg-blue-100">{{ $report['score'] }}</td>
                                <td class="px-6 py-2">{{ \Carbon\Carbon::parse($report['created_at'])->format('M d, Y') }}</td>
                                <td class="px-6 py-2">
                                    <a href="{{ route('individual-report', ['id' => $report['report_id']]) }}" class="text-blue-500 hover:underline">See Full Report</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>





</html>