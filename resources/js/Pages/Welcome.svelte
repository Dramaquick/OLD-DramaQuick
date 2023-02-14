<script>
    import Button from '../Components/Button.svelte';
    import NavLink from "@/Components/NavLink.svelte";
    import Value from "@/Components/Value.svelte";
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden">
    <div class="flex justify-between">
    <div class="title">
        <h1>DramaQuick</h1>
    </div>
    <nav class="">
        <NavLink href="/">Accueil</NavLink>
        <NavLink href="">Rejoindre une session</NavLink>
        <NavLink href="/login">Se connecter</NavLink>
        <NavLink href="/register">S'inscrire</NavLink>
    </nav>
    </div>
    <div class="contenu">
    <div class="left h-[90%]">
        <div class="flex flex-col gap-6 w-1/4">
            <h1 class="font-w600 text-[3rem] text-black width-606">
                Une nouvelle version de DramaQuiz
            </h1>
            <p class="text-lg font-w400 width-606 text-[1.5rem] lineh">
                DramaQuick est une version de DramaQuiz accélérée ; des
                questionnaires temporaires, des sessions de quiz... Tout cela a
                été créé avec une idée : l’éphémérité !
            </p>
        </div>
        <div class="margint flex flex-row">
            <div class="space">
            <Button class="" on:click={() => (window.location.href = "/login")}
                >Rejoindre une session</Button
            >
            </div>
            <Button
                class="outline"
                on:click={() => (window.location.href = "/login")}
                >Créer une session</Button
            >
        </div>
        <div class="flex flex-row gap-20 text-center margint2">
            <div>
                <Value value="15"/>
                <p
                    class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                >
                    Quiz<br />réalisés
                </p>
            </div>
            <div>
                <Value value="3"/>
                <p
                    class="text-2xl text-[#273C33] leading-9 font-w400 w-fit"
                >
                    Sessions<br />actives
                </p>
            </div>
            <div>
                <Value value="124"/>
                <p class="text-2xl text-[#273C33] leading-9 font-w400 w-fit">
                    Participa-<br />tions
                </p>
            </div>
        </div>
    </div>
        <div class="right">
            <img class="arrow" src="/img/landing/arrow.svg" alt="" />
            <img class="logo" src="/img/landing/logo.svg" alt="" />
            <img class="louping" src="/img/landing/louping.svg" alt="" />
        </div>
    </div>
</main>

<!-- Ici j'utilise style pour styliser le fond qui est un peu compliqué -->
<style>
    main {
        background-image: url("/img/landing/bg.png");
        background-size: cover;
        background-repeat: no-repeat;
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

    .title {
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 32px;
        line-height: 48px;
        color: #000000;
        margin-left: 14.25rem;
        margin-top: 2.5625rem;
    }

    nav {
        margin-top: 3.125rem;
        margin-right: 12.125rem;
    }

    .left {
        margin-top: 6.5625rem;
        margin-left: 14.25rem;
    }

    .lineh {
        line-height: 2.25rem;
    }

    .margint {
        margin-top: 3rem;
    }

    .margint2 {
        margin-top: 7rem;
    }

    .space {
        margin-right: 2.7%;
    }

    .contenu {
        display: flex;
        flex-direction: row;
    }

    .right {
        display: flex;
    }

    .arrow {
        width: 277.5px;
        height: 202.26px;
        margin-left: 104px;
        margin-top: 340px;
    }

    .logo {
        width: 522.1px;
        height: 522.1px;
        margin-top: 172px;
        margin-left: 0;


    }

    .louping {
        width: 68.74px;
        height: 181.49px;
        margin-top: 61px;
    }
</style>
