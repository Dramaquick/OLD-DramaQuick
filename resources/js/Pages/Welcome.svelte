<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full">
    <div class="flex flex-col gap-6 w-1/4">
        <h1 class="font-semibold text-[2rem] text-black">Une nouvelle version de DramaQuiz</h1>
        <p class="text-lg">
            DramaQuick est une version de DramaQuiz accélérée ; des
            questionnaires temporaires, des sessions de quiz... Tout cela a été
            créé avec une idée : l’éphémérité !
        </p>
    </div>
    <div>
        <table>
            <tr class="text-[#34FFAD] text-5xl font-['Poppins']" >
                <th class="pr-16">15</th>
                <th class="pr-16">3</th>
                <th class="pr-16">124 </th>
            </tr>
            <tr class="text-2xl text-[#273C33] font-['Poppins'] leading-9">
                <th class="pr-16">Quizz</th>
                <th class="pr-16">Sessions</th>
                <th class="pr-16">Participa-</th>
            </tr>
            <tr class="text-2xl text-[#273C33] font-['Poppins'] leading-9">
                <th class="pr-16">réalisés</th>
                <th class="pr-16">actives</th>
                <th class="pr-16">tions</th>
            </tr>
        </table>
    </div>
</main>

<!-- Ici j'utilise style pour styliser le fond qui est un peu compliqué -->
<style>
    main::before {
        background: url("/img/landing/square.png") 0 0 no-repeat;
        background-size: cover;
        content: "";
        position: absolute;
        width: 60rem;
        height: 60rem;
        z-index: -1;
        transform: rotate(45deg);
        bottom: -32rem;
        right: -8rem;
        overflow: hidden;
        border-radius: 5rem;
    }
</style>
