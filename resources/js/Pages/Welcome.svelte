<script>
    import Button from '../Components/Button.svelte';
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full font-['Poppins']">
    <div class="flex flex-col gap-6 w-1/4">
        <h1 class="font-w600 text-[3rem] text-black width-606">Une nouvelle version de DramaQuiz</h1>
        <p class="text-lg font-w400 width-606 text-[1.5rem]">
            DramaQuick est une version de DramaQuiz accélérée ; des
            questionnaires temporaires, des sessions de quiz... Tout cela a été
            créé avec une idée : l’éphémérité !
        </p>
    </div>
    <div>
        <Button class="" on:click={()=>window.location.href='/login'}>Rejoindre une session</Button>
        <Button class="outline" on:click={()=>window.location.href='/login'}>Créer une session</Button>
    </div>
    <div class="flex flex-row gap-6 text-center">
        <div>
            <h2 class="text-[#34FFAD] text-5xl font-w600 margin-r3">15</h2>
            <p class="text-2xl text-[#273C33] leading-9 font-w400 margin-r3">Quizz<br>réalisés</p>
        </div>
        <div>
            <h2 class="text-[#34FFAD] text-5xl font-w600 margin-r3">3</h2>
            <p class="text-2xl text-[#273C33] leading-9 font-w400 margin-r3">Sessions<br>actives</p>
        </div>
        <div>
            <h2 class="text-[#34FFAD] text-5xl font-w600">124</h2>
            <p class="text-2xl text-[#273C33] leading-9 font-w400">Participa-<br>tions</p>
        </div>
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

    .font-w600 {

        font-weight: 600;

    }

    .font-w400 {

        font-weight: 400;

    }

    .width-606 {

        width: 606px;

    }

    .margin-r3 {

            margin-right: 3rem;
    }
</style>
