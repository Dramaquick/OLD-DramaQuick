<script>
    import {inertia} from '@inertiajs/inertia-svelte';
    import BreezeDropdownLink from "@/components/DropdownLink.svelte";

    export let user = {};

    let src = user.hasCustomIcon ? "/img/users/" + user.id + ".webp" : "/img/components/user.svg";
    let hasCustomImage = user.hasCustomIcon;
</script>

<div class="user-button-container">
    {#if hasCustomImage}
        <img class="user-image custom-image" src={src} alt="user_image"/>
    {:else}
        <img class="user-image" src={src} alt="user_image"/>
    {/if}
    <div class="user-menu">
        <a class="user-menu-item" href="#">Profile</a>
        <div class="separator"></div>
        <a class="user-menu-item" href="#">Paramètres</a>
        <div class="separator"></div>
        <button use:inertia={{ href: "/logout", method: "post" }} class="user-menu-item">Se déconnecter</button>
    </div>
</div>

<style>
    .user-button-container {
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
    }

    .user-menu {
        /* positionner le menu en dessous de l'image & le cacher */
        display: inline-flex;
        position: absolute;
        bottom: -25%;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 2rem 1.5rem;
        gap: .75rem;
        width: 12rem;

        background: #FFFFFF;
        box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        opacity: 0;
        transform: translateY(90%) scale(0.9);
        transition: .2s;
    }

    .user-menu-item {
        color: #666666;
    }

    .user-button-container:hover .user-menu {
        /* permet d'afficher le menu en dessous */
        transform: translateY(100%);
        opacity: 1;
    }

    .user-image {
        clip-path: circle(50% at 50% 50%);
        background-color: #deeee7;
        width: 3rem;
        height: 3rem;
        padding: 0.75rem;
    }

    .user-image.custom-image {
        padding: 0;
    }

    .user-menu::before {
        content: url("/img/components/triangle.svg");
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%) scale(1.5);
    }

    .separator {
        width: 100%;
        height: 1px;
        background: #DEEEE7;
    }

</style>
