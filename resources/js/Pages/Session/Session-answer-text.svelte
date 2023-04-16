<script lang="ts">
    import Button from "../../Components/Button.svelte";
    import AffichageTexte from "../../Components/AffichageTexte.svelte";
    import Notification from "../../Components/Notification.svelte";

    // Mise en place des données de la session pour le texte
    let text = {
        session: "#35878454",
        page: "4/10",
        title: "Pourquoi le Japon ?",
    };

    // Mise en place de la liste des réponses
    let answers = ["C'est génial", "salut c'est Arthur"];

    // Mise en place du role de l'utilisateur
    let user = {
        role: "owner",
    };

    // Fonction qui permet de notifier l'utilisateur
    function notify(title, text, type, duration, format, position, input, placeholder, action, id) {
        if (id != undefined) {
            if (document.getElementById(id) != null) {
                return;
            }
        }
        const notification = document.createElement('div');
        document.body.appendChild(notification);

        new Notification({
            target: notification,
            props: {
                title,
                text,
                type,
                duration,
                format,
                position,
                input,
                placeholder,
                action,
                id
            }
        });
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <h1 class="font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
    <div class="pl-56 pr-56">
    <div class="grid bg-white w-full h-156 shadow rounded-2.5xl px-20 py-12">
        <div>
            <h1 class="title w-144 font-semibold text-[2.25rem] w-fit">Réponses</h1>
            <p class="session text-[1.5rem] color font-normal w-fit">Session {text.session}</p>
            <h1 class="title py-2 w-144 font-semibold text-[1.75rem] w-fit">{text.title} <i class="not-italic font-semibold text-[1.25rem]">({answers.length} réponses)</i></h1>
        </div>
        <div class="affichage px-60">
            <AffichageTexte bind:textes={answers} />
        </div>
        <p class="page font-semibold text-[1.5rem] text-black text-right">{text.page}</p>
        {#if user.role == "owner"}
            <div class="button1 flex justify-start items-end">
                <Button class="">Passer à la page suivante</Button>
            </div>
            <div class="button flex justify-end items-end">
                <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
            </div>
        {:else}
            <div class="button1 flex justify-start items-end">
                <i class="text-lightgray">En attente de l'hôte...</i>
            </div>
            <div class="button flex justify-end items-end">
                <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal",0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
            </div>
        {/if}
    </div>
    </div>
</main>

<style>
    main {
        background-image: url(/img/landing/back.png);
    }

    .shadow {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .color {
        color: #666666;
    }

    .session {
        grid-row: 1;
        grid-column: 1;
    }

    .page {
        grid-row: 1;
        grid-column: 2;
    }

    .title {
        grid-row: 1;
        grid-column: 1;
    }

    .button {
        grid-column: 2;
    }

    .affichage {
        grid-column: 1/3;
        grid-row: 2;
    }
</style>