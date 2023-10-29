<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <style>
        /* .welcome-body {
            background: url('https://images.unsplash.com/photo-1492892132812-a00a8b245c45?auto=format&fit=crop&q=80&w=1770&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-repeat: no-repeat;
            background-size: cover;

        } */
    </style>
</head>


<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit {{$quiz->title}}
        </h2>
        <form action="{{ route('quizzes.update', $quiz->quiz_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold">Quiz Title:</label>
                <input type="text" id="title" name="title" value="{{$quiz->quiz_title}}" class="w-full p-2 border rounded">
                <label for="quiz_status" class="ml-4 inline-flex items-center">
                    Status:
                    <select id="quiz_status" name="quiz_status" class="ml-2 p-1 border rounded">
                        <option value="0" @if ($quiz->status == 0) selected @endif>Inactive</option>
                        <option value="1" @if ($quiz->status == 1) selected @endif>Active</option>
                    </select>
                </label>
                <input id="question_count" type="hidden" name="count" value="{{ count($questions) }}">
                <input type="hidden" id="deleted_ids" name="deleted_ids" value="">
            </div>
            <div id="questions-container">
                @foreach($questions as $index => $question)
                <div class="mb-6 question-container border p-4 rounded shadow-md">
                    <label for="questions" class="block text-gray-700 font-bold">Question {{ $index + 1 }}:</label>
                    <input type="text" name="questions[{{ $index }}][question]" class="w-full p-2 border rounded" value="{{ $question['question_title'] }}">
                    <input type="hidden" name="questions[{{ $index }}][question_id]" value="{{ $question['question_id'] }}">

                    <label class="block text-gray-700 font-bold mt-2">Options:</label>
                    @foreach(json_decode($question['options']) as $optionIndex => $option)
                    <input type="text" name="questions[{{ $index }}][options][{{ $optionIndex }}]" class="w-full p-2 border rounded mb-2" value="{{ $option }}">
                    @endforeach

                    <label for="correct_answer" class="block text-gray-700 font-bold">Correct Answer:</label>
                    <select name="questions[{{ $index }}][correct_answer]" class="w-full p-2 border rounded">
                        @for ($i = 0; $i < 4; $i++) <option value="{{ $i }}" @if ($i==$question['correct_answer']) selected @endif>{{ $i }}</option>
                            @endfor
                    </select>

                    <label for="status" class="block text-gray-700 font-bold">Status:</label>
                    <select name="questions[{{ $index }}][status]" class="w-full p-2 border rounded">
                        <option value="0" @if ($question['status']==0) selected @endif>Inactive</option>
                        <option value="1" @if ($question['status']==1) selected @endif>Active</option>
                    </select>

                    <button type="button" class="remove-question bg-red-500 text-white p-2 rounded hover:bg-red-700 mt-2" data-question-id="{{$question['question_id']}}">Remove Question</button>
                </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center mb-4">
                <button type="button" id="add-question" class="bg-green-500 text-white p-2 rounded hover:bg-green-700">Add Question</button>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover-bg-blue-700">Update Quiz</button>
        </form>
    </div>

    <script>
        let count = document.getElementById('question_count');
        let questionCounter = parseInt(count.value);
        let deletedIds = [];

        document.getElementById('add-question').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const newQuestionContainer = document.querySelector('.question-container').cloneNode(true);
            newQuestionContainer.dataset.questionCounter = questionCounter;
            newQuestionContainer.querySelectorAll('input, select').forEach(input => {
                input.value = '';
                input.name = input.name.replace('[0]', `[${questionCounter}]`);
            });
            newQuestionContainer.querySelector('label[for="questions"]').textContent = `Question ${questionCounter + 1}:`;

            newQuestionContainer.querySelector('select[name="questions[' + questionCounter + '][status]"]').value = "1";

            questionsContainer.appendChild(newQuestionContainer);
            questionCounter++;
        });

        document.getElementById('questions-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-question')) {
                const questionContainer = event.target.closest('.question-container');
                const questionId = questionContainer.querySelector('input[name^="questions["][name$="[question_id]"]');
                if (questionId) {
                    const questionIdValue = questionId.value;
                    deletedIds.push(questionIdValue);
                    document.getElementById('deleted_ids').value = JSON.stringify(deletedIds);
                }

                questionContainer.remove();

                const questionContainers = document.querySelectorAll('.question-container');
                questionContainers.forEach((container, index) => {
                    container.dataset.questionCounter = index;
                    const labels = container.querySelectorAll('label[for="questions"]');
                    if (labels.length > 0) {
                        labels[0].textContent = `Question ${index + 1}:`;
                    }
                });

                questionCounter = questionContainers.length;
            }
        });
    </script>


</body>





</html>