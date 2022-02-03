<section class="w-full h-full bg-tcc-orange rounded-xl flex flex-col justify-start items-center">
    <!-- <nav class="w-full h-10 bg-tcc-emerald rounded-t-xl grid grid-cols-2">
        <span class="cursor-pointer font-bold text-lg text-center rounded-tl-xl bg-tcc-darkEmerald" id="createNav">Create Form</span>
        <span class="cursor-pointer font-bold text-lg text-center rounded-tr-xl" id="listNav">List Form</span>
    </nav> -->
    <div class="w-4/5 h-4/5 flex flex-col items-center px-4 py-4 gap-y-6 mt-10">
        <h2 class="w-full text-4xl font-bold py-2 pl-10">Quiz Builder</h2>
        <div class="w-4/5">
            <label class="text-xl pb-1">Quiz Name</label>
            <input type="text" id="quizName" placeholder="Quiz Name" class="px-3 py-1 w-full">
        </div>
        <div class="w-4/5">
            <label class="text-xl pb-1">Quiz Start Time</label>
            <input type="datetime-local" id="quizStartTime" placeholder="Quiz Start Time" class="px-3 py-1 w-full">
        </div>
        <div class="w-4/5">
            <label class="text-xl pb-1">Quiz End Time</label>
            <input type="datetime-local" id="quizEndTime" placeholder="Quiz End Time" class="px-3 py-1 w-full">
        </div>
        <div class="flex justify-end w-4/5 gap-x-2 pt-8">
            <button class="px-5 py-1 text-white rounded-lg bg-red-500 text-lg" id="btnResetForm">Reset</button>
            <button class="px-5 py-1 text-white rounded-lg bg-blue-500 text-lg" id="btnCreateQuiz">Create</button>
        </div>
    </div>
</section>