<script>
    import NavLink from "@/Components/NavLink.svelte";
    import UserButton from "@/Components/UserButton.svelte";
    import { page } from '@inertiajs/svelte';
    import Notification from "@/Components/Notification.svelte";

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

<main class="h-fit w-full overflow-hidden bg-cover bg-no-repeat">
    <nav class="flex justify-between fixed w-full py-12 px-56 max-[1300px]:pl-16 max-[500px]:pl-8">
        <h1 class="font-semibold text-[2rem] text-black max-[600px]:text-[1.5rem]">DramaQuick</h1>
        <div class="content flex flex-row items-center gap-2" id="links-container">
            <NavLink href="/">Accueil</NavLink>
            <NavLink href="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",() => {window.location.href ="/session-start"},"session")}}>Rejoindre une session</NavLink>
            {#if $page.props.auth.user}
            <div class="pl-2">
                <UserButton user={$page.props.auth.user} />
            </div>
            {:else}
                <NavLink href="/login">Se connecter</NavLink>
                <NavLink href="/register">S'inscrire</NavLink>
            {/if}
        </div>
        <div class="content flex flex-col items-center gap-2 bg-white rounded-xl hidden" id="links-container-mobile">
            <NavLink href="/">Accueil</NavLink>
            <NavLink href="" action={() => {notify("Rejoindre une session","","normal",0,"box","middle",true,"Entrer le code de session",() => {window.location.href ="/session-start"},"session")}}>Rejoindre une session</NavLink>
            {#if $page.props.auth.user}
            <div class="pl-2">
                <UserButton user={$page.props.auth.user} />
            </div>
            {:else}
                <NavLink href="/login">Se connecter</NavLink>
                <NavLink href="/register">S'inscrire</NavLink>
            {/if}
        </div>
    </nav>
    <slot />
</main>

<style>
    main {
        background-image: url("/img/landing/BG_welcome.png");
        background-size: 58%;
        background-position: bottom right;
    }

    nav {
        background: rgba(255, 255, 255, 1);
    }

    #links-container-mobile {
        border: solid 1px #A0A0A0;
    }

    @media screen and (max-width: 1300px) {
        #links-container {
            display: none;
        }

        #links-container-mobile {
            display: none;
        }
    }

    @media screen and (max-width: 1099px) {
        main {
            background-image: none;
        }
    }
</style>