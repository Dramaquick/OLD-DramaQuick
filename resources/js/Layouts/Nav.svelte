<script>
    import NavLink from "@/Components/NavLink.svelte";
    import UserButton from "@/Components/UserButton.svelte";
    import { page } from '@inertiajs/inertia-svelte';
</script>

<main class="h-screen w-full overflow-hidden bg-cover bg-no-repeat">
    <nav class="flex justify-between fixed w-full py-12 px-56">
        <h1 class="font-semibold text-[2rem] text-black">DramaQuick</h1>
        <div class="content">
            <NavLink href="/">Accueil</NavLink>
            <NavLink href="">Rejoindre une session</NavLink>
            {#if $page.props.auth.user}
                <UserButton user={$page.props.auth.user} />
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
        background-image: url("/img/landing/bg.png");
    }
</style>