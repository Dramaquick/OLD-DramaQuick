<script lang="ts">
    import Timer from "../../Components/Timer.svelte";
    import Tag from "../../Components/Tag.svelte";
    import Member from "../../Components/Member.svelte";
    import Button from "../../Components/Button.svelte";
    import Notification from "../../Components/Notification.svelte";
    import { page,router } from '@inertiajs/svelte';
    import PageSwitchLayout from '@/Layouts/PageSwitchLayout.svelte';
    import { onMount } from 'svelte';

    export let session;

    onMount(() => {
        window.Echo.join('dramaquick_database_session.' + session.Session_Id)
            .joining((user) => {
                console.log(e);
            });
    });

    // On récupère les données de l'utilisateur
    let profile: User = $page.props.auth.user;

    // Mise en place des données de l'utilisateur
    let user = {
        pseudo: profile.name,
        role: profile.user_role,
        icon: false,
    }

    // On vérifie si l'utilisateur est le créateur de la session
    if (profile.id == $page.props.session.Owner_Id) {
            user.role = "OWNER";
    } else {
            user.role = profile.user_role;
    }

    // Mise en place des tags pour la session
    let tags = {
        tag1 : {
            text: "officiel",
            emoji: "⌛",
            color: "#34FFAD",
        },
        tag2 : {
            text: "halloween",
            emoji: "🎃",
            color: "#FFC634",
        },
        tag3 : {
            text: "nourriture",
            emoji: "🍨",
            color: "#FFA6E6",
        },
    }

    // Mise en place du temps pour le timer
    let timer = {
        minutes: 0,
        seconds: 31,
    };
    let stop = true;

    // Mise en place des membres de la session
    let users: User[] = [
        {
            id: 1,
            name: "Stive",
            user_role: "OWNER",
        },
        {
            id: 1,
            name: "Stive",
            user_role: "ADMIN",
        },
        {
            id: 1,
            name: "Stive",
            user_role: "ADMIN",
        },
        {
            id: 1,
            name: "Stive",
            user_role: "USER",
        },
        {
            id: 1,
            name: "Stive",
            user_role: "USER",
        },
    ]

    // Mise en place des données de la session pour le texte
    let text = {
        title : session.Session_Title,
        description : session.Session_Description,
        session : '#' + session.Session_Id,
        createur : $page.props.owner.name,
        size : Object.keys(users).length + "/" + session.Session_MaxUser,
    }

    // fonction qui fait apparaitre une notification
    function notify(title, text, type, duration, format, position, input, placeholder, action, id) {
        if (id != "") {
            if (document.getElementById(id) != null) {
                return;
            }
        } else {
            id = undefined;
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
    };

    if (Object.keys(users).length >= session.Session_MinUser) {
        stop = true;
    } else {
        stop = false;
    }
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<PageSwitchLayout>
    <main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
        <h1 class="font-semibold text-[2rem] text-black py-12 pl-56 w-full">DramaQuick</h1>
        <div class="pl-56 pr-56">
        <div class="grid bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16 min-w-[92rem] min-h-[39rem]">
            <p class="session text-[1.5rem] color font-normal">Session {text.session}</p>
            <p class="creator text-[1.25rem] font-normal text-right pr-12">Créé par : &nbsp;&nbsp;<i class="not-italic z-0 relative inline-block font-medium creator-style">{text.createur}</i></p>
            <p class="size font-semibold text-[1.5rem] text-black text-right">{text.size}</p>
            <div class="text">
                <h1 class="w-144 font-semibold text-[2.25rem]">{text.title}</h1>
                <h2 class="bordered mt-11.25 pl-6 w-144 font-normal text-[1.5rem] h-fit whitespace-normal break-words">{text.description}</h2>
            </div>
            {#if Object.keys(users).length > 0}
            <div class="members1 flex flex-col gap-3">
                {#each Object.keys(users) as id, i}
                    {#if i < 5}
                        <Member bind:user={users[id]}/>
                    {/if}
                {/each}
            </div>
            {/if}
            {#if Object.keys(users).length > 5}
            <div class="members2 flex flex-col gap-3 justify-left w-[16rem]">
                {#each Object.keys(users) as id, i}
                    {#if i === 9}
                        {#if Object.keys(users).length-9 === 1}
                        <p class="flex h-[3rem] items-center justify-left font-semibold">+{Object.keys(users).length-9} autre participant</p>
                        {:else}
                        <p class="flex h-[3rem] items-center justify-left font-semibold">+{Object.keys(users).length-9} autres participants</p>
                        {/if}
                    {/if}
                    {#if i >= 5 && i < 9}
                        <Member bind:user={users[id]}/>
                    {/if}
                {/each}
            </div>
            {/if}
            <div class="timer-tags flex flex-row items-center gap-10">
                <Timer
                    bind:minutes={timer.minutes}
                    bind:seconds={timer.seconds}
                    action={[{
                        time: [0, 30], action: () => {notify("Début de la session","La session va commencer dans 30 secondes", "info", 5000, "bar", "bottom", false, "", () => {}, "")}}, 
                        {time: [0, 15], action: () => {notify("Début de la session","La session va commencer dans 15 secondes", "info", 5000, "bar", "bottom", false, "", () => {}, "")}}, 
                        {time: [-10, 0], action: () => {window.location.href = "/session-paint"}}]}
                    bind:stop={stop}
                />
                <div class="tags flex flex-row items-center gap-4">
                    {#each Object.keys(tags) as tag}
                        <Tag bind:tag={tags[tag]}/>
                    {/each}
                </div>
            </div>
            <div class="button flex flex-row items-center justify-end gap-4">
                {#if user.role == "OWNER"}
                    {#if Object.keys(users).length >= session.Session_MinUser}
                        <Button>Démarrer</Button>
                    {:else}
                        <Button disabled>Démarrer</Button>
                    {/if}
                {/if}
                <Button class="outline" action={() => {notify("Quitter la session","Souhaitez-vous vraiment quitter la session ?","normal", 0,"box","middle",false,"",() => {window.location.href ="/"},"leave")}}>Quitter la session</Button>
            </div>
        </div>
    </main>
</PageSwitchLayout>

<style>
    main {
        background-image: url(/img/landing/back.png);
    }

    .shadow {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .creator {
        grid-row: 1;
        grid-column: 1;
    }

    .session {
        grid-row: 1;
        grid-column: 1;
    }

    .size {
        grid-row: 1;
        grid-column: 3;
    }

    .color {
        color: #666666;
    }

    .text {
        grid-row: 2/4;
        grid-column: 1;
    }

    .bordered {
        border-left: 4px solid #34FFAD;
    }

    .members1 {
        grid-row: 2/4;
        grid-column: 2;
    }

    .members2 {
        grid-row: 2/4;
        grid-column: 3;
    }

    .timer-tags {
        grid-row: 4;
        grid-column: 1;
    }

    .button {
        grid-row: 4;
        grid-column: 2/4;
    }

    .creator-style::before {
        z-index: -1;
        color: black;
        width: 110%;
        position: absolute;
        bottom: 0.09rem;
        left: -5%;
        background-color: #34FFAD;
        height: 0.75rem;
        content: " ";
    }

    .tags {
        height: 100%;
        padding-top: 8px;
    }
</style>
