<script>
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden">
    <div class="title">
        <h1>DramaQuick</h1>
    </div>
    <div class="content">
        <div class="top">
            <p class="session">Session #35878454</p>
            <p class="create">Créé par: Edouard</p>
            <p class="size">9/10</p>
        </div>
        <div class="text">
            <h1 class="session-title">Quiz ultime de la mort qui fait pas trop vivre !</h1>
            <h2>Voici une petit quiz plutôt pipou pour relancer un peu la mode parce qu’en vrai c’était vachement cool ✨</h2>
        </div>
    </div>
    <div class="bottom">
    </div>
</main>

<style>
    main {
        background-image: url(/img/landing/back.png);
        background-size: cover;
        background-repeat: no-repeat;
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
        width: fit-content;
    }

    .content {
        width: 1463px;
        height: 573px;
        margin-left: 228px;
        margin-top: 71px;
        background: #FFFFFF;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }

    .bottom {
        width: 1920px;
        height: 100px;
        margin-top: 98px;
        background: #D6F5FF;
        border-radius: 20px 20px 0 0;
    }

    .top {
        display: flex;
        justify-content: space-between;
        margin-left: 80px;
        margin-right: 80px;
    }

    .top p {
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        line-height: 36px;
        margin-top: 31px;
    }

    .create {
        margin-right: 500px;
        font-size: 20px;
        line-height: 30px;
        font-weight: 400;
    }

    .session {
        font-size: 24px;
        line-height: 36px;
        display: flex;
        align-items: center;
        color: rgba(0, 0, 0, 0.6);
        font-weight: 400;
    }

    .size {
        font-weight: 600;
        font-size: 24px;
        line-height: 36px;
        text-align: right;
        color: #000000;
    }

    .session-title {
        width: 578px;
        height: 94px;
        margin-left: 80px;
        margin-top: 45px;

        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 36px;
        line-height: 54px;

        color: #000000;
    }

    .text h2 {
        width: 577.14px;
        height: 106.19px;
        padding-left: 18.1px;
        margin-left: 80px;
        margin-top: 52.81px;
        font-family: 'Poppins', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 36px;
        color: #000000;
        border-left: 4.76px solid #34FFAD;
    }

</style>
