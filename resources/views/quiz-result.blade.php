<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>

</head>

<div class="container mx-auto p-4">
    <div class="flex items-center justify-end">
        <a href="{{ route('user-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back To Home</a>
    </div>
    <h1 class="text-2xl font-semibold mb-4">Quiz Results</h1>
    <p class="mb-4">Your Score: {{ $score }} / {{ count($questions) }}</p>

    <h2 class="mb-4">Feedback:</h2>
    <ul>
        @foreach ($feedback as $questionId => $result)
        <div class="{{ $result['is_correct'] ? 'bg-green-100' : 'bg-red-100' }} p-4 rounded-lg shadow-lg mb-4">
            @foreach($questions as $question)
            @if($question->question_id == $questionId)
            <p class="mb-2 text-lg">{{ $question->question_title }}</p>
            <div class="mb-2 text-blue-600 font-semibold">Your Answer: {{ json_decode($question->options)[$userAnswers[$questionId]] }}</div>
            <div class="text-green-600 font-semibold">Correct Answer: {{ json_decode($question->options)[$result['correct_answer']] }}</div>
            @endif
            @endforeach
        </div>
        @endforeach
    </ul>
</div>

</html>