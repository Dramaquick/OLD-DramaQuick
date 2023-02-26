<script>
    import SelectList from "./SelectList.svelte";
    export let questions = {
        question1: {
            title: null,
            description: null,
            type: 0,
            options: {},
        },
    };

    let counter_ques = 2;
    
    let items = [
        {id: 1, name: 'Select'},
        {id: 2, name: 'TextArea'},
        {id: 3, name: 'Input'},
        {id: 4, name: 'Checkbox'},
        {id: 5, name: 'Radio'},
        {id: 6, name: 'Paint'}
    ];

    // Function for add a new question
    function addQuestion() {
        let question = {
            title: null,
            description: null,
            type: 0,
            options: {},
        };
        questions["question" + counter_ques] = question;
        counter_ques++;
    }

    // Function for add a new option
    function addOption(question) {
        let option = null;
        questions[question].options["option" + Object.keys(questions[question].options).length] = option;
    }

    // function to delete a question
    function deleteQuestion(question) {
        delete questions[question];
        upadte();
    }

    // function to update the question list
    function upadte() {
        questions['update'] = true;
        delete questions['update'];
    }

    // function to delete an option
    function deleteOption(question, option) {
        delete questions[question].options[option];
        upadte();
    }
</script>

<div class="w-full h-200">
    <div class="text grid pb-4 justify-between px-14">
        <h1 class="title-style z-0 relative inline-block font-semibold text-[1.50rem] w-fit">Questions</h1>
        <div class="Add flex flex-row gap-4 justify-center items-center">
            <button class="rounded-50% bg-[#dbf9ed] text-[#00e589] text-[1.5rem] w-9 font-medium" on:click={addQuestion}>+</button>
            <p class="font-medium text-[1rem] text-[#00E589]">Ajouter une question</p>
        </div>
    </div>
    <hr class="py-4 mx-14">
    <div class="pr-7">
    <div class="questions-container pl-14 pr-5 w-fit">
    {#each Object.keys(questions) as question}
        <div class="question rounded-md shadow-sm bg-[#fafafa] px-4 py-4 mb-5">
            <div class="flex flex-row justify-between items-center">
                <input type="text" class="text-black border-none w-full bg-transparent focus:border-transparent focus:ring-0" bind:value={questions[question].title} placeholder="Titre de la question" />
                <button class="rounded-50% bg-[#ffe2e2] text-[#ffaeae] text-[1.5rem] w-9 font-medium" on:click={() => deleteQuestion(question)}><svg class="pl-2" width="25" height="30" viewBox="0 0 25 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.3184 5.27937H18.3142V2.87772C18.3142 2.24076 18.0612 1.6299 17.6108 1.1795C17.1604 0.729104 16.5495 0.476074 15.9126 0.476074L8.70765 0.476074C8.07069 0.476074 7.45982 0.729104 7.00943 1.1795C6.55903 1.6299 6.306 2.24076 6.306 2.87772V5.27937H0.30188V7.68101H2.70353V25.6934C2.70353 26.6488 3.08307 27.5651 3.75867 28.2407C4.43426 28.9163 5.35056 29.2958 6.306 29.2958H18.3142C19.2697 29.2958 20.186 28.9163 20.8616 28.2407C21.5372 27.5651 21.9167 26.6488 21.9167 25.6934V7.68101H24.3184V5.27937ZM8.70765 2.87772H15.9126V5.27937H8.70765V2.87772ZM19.5151 25.6934C19.5151 26.0118 19.3885 26.3173 19.1634 26.5425C18.9382 26.7677 18.6327 26.8942 18.3142 26.8942H6.306C5.98752 26.8942 5.68209 26.7677 5.45689 26.5425C5.23169 26.3173 5.10518 26.0118 5.10518 25.6934V7.68101H19.5151V25.6934Z" fill="white"/>
                    <path d="M11.1094 12.4844H8.70776V22.091H11.1094V12.4844Z" fill="white"/>
                    <path d="M15.9125 12.4844H13.5109V22.091H15.9125V12.4844Z" fill="white"/>
                    </svg>
                    </button>
            </div>
            <input type="text" class="text-[#656565] border-none w-full bg-transparent focus:border-transparent focus:ring-0" bind:value={questions[question].description} placeholder="Description de la question" />
            <div class="flex flew-rox gap-4 items-center">
                    <SelectList bind:value={questions[question].type} placeholder="Type de question" items={items}
                    />
                {#if questions[question].type == 1 || questions[question].type == 4 || questions[question].type == 5}
                    <button class="rounded-50% bg-[#dbf9ed] text-[#00e589] text-[1.5rem] w-9 font-medium" on:click={() => addOption(question)}>+</button>
                {/if}
            </div>
            {#if questions[question].type == 1 || questions[question].type == 4 || questions[question].type == 5}
                <div class="options-container">
                    {#each Object.keys(questions[question].options) as option}
                        <div class="option flex flex-row justify-start items-center bg-white w-fit mx-4 my-4">
                            <input type="text" class="border-none text-[.75rem] w-fit focus:border-transparent focus:ring-0" bind:value={questions[question].options[option]} placeholder="Option" />
                            <button class="text-[#ffaeae] text-[1.5rem] w-9 font-medium" on:click={() => deleteOption(question, option)}>X</button>
                        </div>
                    {/each}
                </div>
            {/if}
        </div>
    {/each}
</div>
</div>
</div>

<style>
    path {
        fill: #ff8e8e;
    }
    .questions-container {
        height: 35rem;
        overflow-y: auto;
    }
    .questions-container::-webkit-scrollbar {
        width: 4px;
    }

    .questions-container::-webkit-scrollbar-track {
        background: #deeee7;
    }

    .questions-container::-webkit-scrollbar-thumb {
        background-color: #47524e;
        border-radius: 10px;
    }
    
    .option{
        border-left: gray 2px solid;
    }
    .title-style {
        grid-column: 1;
        grid-row: 1;
    }

    .Add {
        grid-column: 2;
        grid-row: 1;
    }

    .question {
        border: 2px solid #F0F0F0;
        width: 28.5rem;
    }

    .title-style::before {
        z-index: -1;
        color: black;
        width: 110%;
        position: absolute;
        bottom: 0.09rem;
        left: -5%;
        background-color: #34FFAD;
        height: 1rem;
        content: " ";
    }
</style>