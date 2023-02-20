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
        minutes: 0,
        seconds: 30,
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
            hasCustomIcon: false,
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
        createur : "Créé par Edouard",
        size : "9/10",
    }
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
            <p class="session">Session {text.session}</p>
            <p class="create">{text.createur}</p>
            <p class="size">{text.size}</p>
        </div>
        <div class="container">
        <div class="left">
            <h1 class="session-title">{text.title}</h1>
            <h2>{text.description}</h2>
        </div>
        <div class="right">
            <div class="left-member">
                <Member bind:user={users.user1}/>
                <Member bind:user={users.user2}/>
                <Member bind:user={users.user3}/>
                <Member bind:user={users.user4}/>
                <Member bind:user={users.user5}/>
            </div>
            <div class="right-member">
                <Member bind:user={users.user6}/>
                <Member bind:user={users.user7}/>
                <Member bind:user={users.user8}/>
                <Member bind:user={users.user9}/>
            </div>
        </div>
    </div>
        <div class="bottom">
            <div class="left-bottom">
            <Timer
                bind:minutes={timer.minutes}
                bind:seconds={timer.seconds}
            />
            <Tag bind:text={tag.text1} bind:emoji={tag.emo1} bind:color={tag.color1}/>
            <Tag bind:text={tag.text2} bind:emoji={tag.emo2} bind:color={tag.color2}/>
            <Tag bind:text={tag.text3} bind:emoji={tag.emo3} bind:color={tag.color3}/>
            </div>
            <div class="right-bottom">
                <Button class="outline">Quitter la session</Button>
            </div>
        </div>

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
        height: 625px;
        margin-left: 228px;
        margin-top: 71px;
        background: #FFFFFF;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }

    .bottom {
        display: flex;
        justify-content: space-between;
    }

    .right-bottom {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-right: 80px;
        margin-top: 160px;
    }

    .left-bottom {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: row;
        margin-left: 80px;
        margin-top: 170px;
        gap: 20px;
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

    .left h2 {
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

    .right {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-right: 200px;
        margin-top: 45px;
    }

    .left-member {
        margin-right: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
        height: 120%;
    }

    .right-member {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 95%;
        align-items: flex-start;
    }


    .container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
    }
</style>
