<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <style>
        /* .welcome-body {
            background: url('https://images.unsplash.com/photo-1492892132812-a00a8b245c45?auto=format&fit=crop&q=80&w=1770&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-repeat: no-repeat;
            background-size: cover;
        } */
    </style>
</head>


<body class="bg-gray-100">
    <header class="bg-blue-700 text-white p-4 flex justify-between">
        <div class="heading text-2xl font-mono font-extrabold ">Create Quiz</div>
        <div class="flex items-center justify-end">
            <a href="{{ route('admin-home') }}" class="text-lg font-semibold bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 ml-4">Back to Dashboard</a>
        </div>
    </header>
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Create Quiz</h2>
        <form action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold">Quiz Title:</label>
                <input type="text" id="title" name="title" class="w-full p-2 border rounded">
            </div>

            <div id="questions-container">
                <div class="mb-6 question-container" data-question-counter="0">
                    <label for="questions" class="block text-gray-700 font-bold">Add a Question:</label>
                    <input type="text" name="questions[0][question]" class="w-full p-2 border rounded">

                    <label class="block text-gray-700 font-bold mt-2">Options:</label>
                    @for ($i = 0; $i < 4; $i++) <input type="text" name="questions[0][options][]" class="w-full p-2 border rounded mb-2">
                        @endfor

                        <label for="correct_answer" class="block text-gray-700 font-bold">Correct Answer:</label>
                        <select name="questions[0][correct_answer]" class="w-full p-2 border rounded">
                            @for ($i = 0; $i < 4; $i++) <option value="{{ $i }}">Option {{ $i + 1 }}</option>
                                @endfor
                        </select>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <button type="button" id="add-question" class="bg-green-500 text-white p-2 rounded hover:bg-green-700">Add Question</button>
                <button type="button" id="remove-question" class="bg-red-500 text-white p-2 rounded hover:bg-red-700">Remove Question</button>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">Create Quiz</button>
        </form>
    </div>

    <script>
        let questionCounter = 1;

        document.getElementById('add-question').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const newQuestionContainer = document.querySelector('.question-container').cloneNode(true);
            newQuestionContainer.dataset.questionCounter = questionCounter;
            newQuestionContainer.querySelectorAll('input, select').forEach(input => {
                input.value = '';
                input.name = input.name.replace('[0]', `[${questionCounter}]`);
            });
            newQuestionContainer.querySelector('label[for="questions"]').textContent = `Question ${questionCounter + 1}:`;

            questionsContainer.appendChild(newQuestionContainer);
            questionCounter++;
        });

        document.getElementById('remove-question').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionContainers = questionsContainer.querySelectorAll('.question-container');
            if (questionContainers.length > 1) {
                questionsContainer.removeChild(questionContainers[questionContainers.length - 1]);
                questionCounter--;
            }
        });
    </script>
</body>





</html>