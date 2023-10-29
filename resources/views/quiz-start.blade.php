<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

</head>

<body>

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

</body>

</html>