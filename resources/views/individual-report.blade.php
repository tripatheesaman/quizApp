<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

</head>


<body>
    <header class="bg-blue-700 text-white p-4 flex justify-between">
        <div class="heading text-2xl font-mono font-extrabold ">Create Quiz</div>
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Dashboard</a>
            <a href="{{ route('report-list') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Report List</a>
        </div>

    </header>
    <div class="min-h-screen bg-gray-100 p-4">
        <div class=" w-full">
            <div class=" bg-white shadow-md rounded-lg p-4">
                <h1 class="text-3xl font-semibold mb-4">{{ $report[0]['quiz_title'] }}</h1>

                <div class="mb-6">
                    <p class="text-gray-600"><strong>Played By:</strong> {{ $report[0]['user_name'] }}</p>
                    <p class="text-gray-600"><strong>Played Date:</strong> {{ \Carbon\Carbon::parse($report[0]['created_at'])->format('M d, Y H:i A') }}</p>
                    <p class="text-gray-600"><strong>Score:</strong> {{ $report[0]['score'] }}</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold">Quiz Questions and Answers</h2>
                    @foreach (json_decode($report[0]['question_answers'], true) as $question)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-4 @if ($question['isCorrect']['is_correct']) bg-green-100 @else bg-red-100 @endif">
                        <div class="flex items-start justify-between mb-2">
                            <p class="text-gray-800 font-semibold">{{ $question['question_title'] }}</p>
                            @if ($question['isCorrect']['is_correct'])
                            <span class="inline-block px-2 py-1 bg-green-300 text-green-700 font-semibold rounded-full">Correct</span>
                            @else
                            <span class="inline-block px-2 py-1 bg-red-300 text-red-700 font-semibold rounded-full">Incorrect</span>
                            @endif
                        </div>
                        <ul class="list-inside pl-0 m-4">
                            @foreach ($question['options'] as $option)
                            <li class="text-gray-700 flex items-center @if ($question['selected_answer'] === $option) text-blue-600 font-semibold @endif">
                                <div class="relative">
                                    <input type="checkbox" class="w-5 h-5 mr-2 opacity-0 absolute" @if ($question['selected_answer']===$option) checked @endif disabled>
                                    <div class="w-5 h-5 border border-gray-300 rounded-md flex items-center justify-center @if ($question['selected_answer'] === $option) bg-blue-600 text-white @endif">
                                        @if ($question['selected_answer'] === $option) ✓ @endif
                                    </div>
                                </div>
                                {{ $option }}
                            </li>
                            @endforeach
                        </ul>
                        <p class="text-gray-700 font-semibold">Correct Answer: {{ $question['correct_answer'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>