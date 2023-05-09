<script lang="ts">
    import { inertia } from '@inertiajs/svelte';

    export let user: User;

    let src = `/api/user/avatar/${user.id}?` + Date.now();
</script>

<div class="user-button-container">
    <img class="user-image" src={src} alt="user_image"/>
    <!-- svelte-ignore a11y-mouse-events-have-key-events -->
    <div class="user-menu">
        <a class="user-menu-item" href="/profile">Profil</a>
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
        padding: 1.75rem 1.5rem;
        gap: .75rem;
        width: 12rem;

        background: #FFFFFF;
        box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        opacity: 0;
        transform: translateY(90%) scale(0.9);
        transition: .2s;
        pointer-events: none;
    }

    .user-menu-item {
        color: #666666;
        transition: .2s;
    }

    .user-menu-item:hover {
        color: #48db9b;
    }

    .user-button-container:hover .user-menu {
        /* permet d'afficher le menu en dessous */
        transform: translateY(100%);
        opacity: 1;
        pointer-events: all;
    }

    .user-image {
        clip-path: circle(50% at 50% 50%);
        background-color: #deeee7;
        width: 3rem;
        height: 3rem;
        /* padding: 0.75rem; */
    }

    .user-menu::before {
        content: url("/img/components/triangle.svg");
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%) scale(1.5);
    }

    .user-menu::after {
        content: "";
        position: absolute;
        top: -1rem;
        left: 50%;
        width: 12rem;
        height: 1rem;
        transform: translate(-50%);
    }

    .separator {
        width: 100%;
        height: 1px;
        background: #DEEEE7;
    }

</style>
