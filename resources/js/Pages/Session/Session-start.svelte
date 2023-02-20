<script>
    import Timer from "../../Components/Timer.svelte";
    import { onMount } from "svelte";
    import Tag from "../../Components/Tag.svelte";
    import Member from "../../Components/Member.svelte";
    import Button from "../../Components/Button.svelte";

    let tag = {
        emo1: "⌛",
        emo2: "🎃",
        emo3: "🍨",
        text1: "officiel",
        text2: "halloween",
        text3: "nourriture",
        color1: "#34FFAD",
        color2: "#FFC634",
        color3: "#FFA6E6",
    }

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 1,
        seconds: 10,
    };

    onMount(() => {
        setInterval(() => {
            if (timer.seconds > 0) {
                timer.seconds--;
            } else if (timer.minutes > 0) {
                timer.minutes--;
                timer.seconds = 59;
            }
        }, 1000);
    });

    let users = {
        user1: {
            pseudo: "Ewen.G",
            role: "creator",
            hasCustomIcon: false,
        },
        user2: {
            pseudo: "Pierre-Louis.L",
            role: "admin",
            hasCustomIcon: false,
        },
        user3: {
            pseudo: "Dorian.P",
            role: "admin",
            hasCustomIcon: false,
        },
        user4: {
            pseudo: "Hugo.M",
            role: "admin",
            hasCustomIcon: true,
        },
        user5: {
            pseudo: "Nathan.R",
            role: "admin",
            hasCustomIcon: false,
        },
        user6: {
            pseudo: "Arthur.P",
            role: "admin",
            hasCustomIcon: false,
        },
        user7: {
            pseudo: "Emilio.M",
            role: "admin",
            hasCustomIcon: false,
        },
        user8: {
            pseudo: "Forfait.F",
            role: "member",
            hasCustomIcon: false,
        },
        user9: {
            pseudo: "Jean-Bandonne.B",
            role: "member",
            hasCustomIcon: false,
        },
    }

    let text = {
        title : "Quiz ultime de la mort qui fait pas trop vivre !",
        description : "Voici une petit quiz plutôt pipou pour relancer un peu la mode parce qu’en vrai c’était vachement cool ✨",
        session : "#35878454",
        createur : "Ewen.G",
        size : "9/10",
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
    <div class="content bg-white w-full h-156 shadow rounded-2.5xl px-20 py-16">
        <p class="session text-[1.5rem] color font-normal">Session {text.session}</p>
        <p class="creator text-[1.25rem] font-normal text-right pr-12">Créé par : &nbsp;&nbsp;<i class="not-italic z-0 relative inline-block font-medium creator-style">{text.createur}</i></p>
        <p class="size font-semibold text-[1.5rem] text-black text-right">{text.size}</p>
        <div class="text">
            <h1 class="w-144 font-semibold text-[2.25rem]">{text.title}</h1>
            <h2 class="bordered mt-11.25 pl-6 w-144 font-normal text-[1.5rem] h-fit">{text.description}</h2>
        </div>
        <div class="members1 flex flex-col gap-3 pl-24">
            <Member bind:user={users.user1}/>
            <Member bind:user={users.user2}/>
            <Member bind:user={users.user3}/>
            <Member bind:user={users.user4}/>
            <Member bind:user={users.user5}/>
        </div>
        <div class="members2 flex flex-col gap-3">
            <Member bind:user={users.user6}/>
            <Member bind:user={users.user7}/>
            <Member bind:user={users.user8}/>
            <Member bind:user={users.user9}/>
        </div>
        <div class="timer-tags flex flex-row items-center gap-10">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
            />
            <div class="tags flex flex-row items-center gap-4">
                <Tag bind:text={tag.text1} bind:emoji={tag.emo1} bind:color={tag.color1}/>
                <Tag bind:text={tag.text2} bind:emoji={tag.emo2} bind:color={tag.color2}/>
                <Tag bind:text={tag.text3} bind:emoji={tag.emo3} bind:color={tag.color3}/>
            </div>
        </div>
        <div class="button flex items-center justify-end">
            <Button class="outline">Quitter la session</Button>
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

    .creator {
        grid-row: 1;
        grid-column: 1;
    }
    .content {
        display: grid;
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
        grid-column: 1/3;
    }

    .button {
        grid-row: 4;
        grid-column: 3;
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
</style>
