<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

</head>

<body>
    @if(!empty($questions) && count($questions) != 0)
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">{{$quiz->quiz_title}}</h1>
        <form method="POST" action="{{route('submit-quiz')}}">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->quiz_id }}">
            @foreach ($questions as $question)
            <div class="bg-white p-4 rounded-lg shadow-lg mb-4">

                <p>{{ $question->question_title }}</p>
                <ul class="space-y-2">
                    @foreach (json_decode($question['options']) as $optionIndex=>$option)
                    <li>
                        <label class="inline-flex items-center">
                            <input type="radio" name="answers[{{ $question->question_id }}]" value="{{ $optionIndex }}" class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-2">{{ $option }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
        </form>
    </div>
    @else
    <div class="min-h-screen">
        <div class="flex items-center justify-end">
            <a href="{{ route('user-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Home</a>
        </div>
        <h1 class="flex justify-center align-middle font-mono text-6xl">NO Quiz Found Try Again Later</h1>
        @endif
    </div>
</body>

</html>