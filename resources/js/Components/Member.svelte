<script lang="ts">
    import { page, router } from '@inertiajs/svelte';
    import type { UserRole } from '@/Types/Types';

    export let user: User = {
        id: 1,
        name: 'Invité',
        user_role: 'USER',
        email: 'guest@localhost',
    };

    const icons: { [key in UserRole]?: string } = {
        ADMIN: '🌵',
        OWNER: '👑'
    };

    const colors = {
        OWNER: "#FFFACC",
        ADMIN: "#CCFFEA",
        USER: "#E0E5EB"
    };

    const highlight = {
        OWNER: "#ffe916",
        ADMIN: "#34FFAD",
        USER: "#8598AE"
    };

    let def = null;

    window.axios.get('/api/user/avatar/'+ user.id).then(function (response) {
        if (response.headers['content-type'] != "image/svg+xml") {
            def = true;
            console.log("user:" + user.id + " has a custom avatar");
        }
    }).catch(function (error) {
        def = true;
    });
    
</script>

<div class="flex items-center justify-start gap-4">
    <div class="relative" style={`--color: ${colors[user.user_role]}; --highlight: ${highlight[user.user_role]}`}>
        {#if def === null}
        <div style={`--color: ${colors[user.user_role]}; --highlight: ${highlight[user.user_role]}`} class={`image ${user.user_role.toLowerCase()}`}>
                <svg width="20" height="28" viewBox="0 0 20 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M4.94924 2.05025C6.28878 0.737497 8.1056 0 10 0C11.8944 0 13.7112 0.737497 15.0508 2.05025C16.3903 3.36301 17.1429 5.14348 17.1429 7C17.1429 8.85651 16.3903 10.637 15.0508 11.9497C13.7112 13.2625 11.8944 14 10 14C8.1056 14 6.28878 13.2625 4.94924 11.9497C3.60969 10.637 2.85714 8.85651 2.85714 7C2.85714 5.14348 3.60969 3.36301 4.94924 2.05025ZM10 2.8C8.86336 2.8 7.77327 3.2425 6.96954 4.03015C6.16581 4.8178 5.71429 5.88609 5.71429 7C5.71429 8.11391 6.16581 9.1822 6.96954 9.96985C7.77327 10.7575 8.86336 11.2 10 11.2C11.1366 11.2 12.2267 10.7575 13.0305 9.96985C13.8342 9.1822 14.2857 8.11391 14.2857 7C14.2857 5.88609 13.8342 4.8178 13.0305 4.03015C12.2267 3.2425 11.1366 2.8 10 2.8ZM7.14286 19.6C6.00622 19.6 4.91613 20.0425 4.1124 20.8302C3.30867 21.6178 2.85714 22.6861 2.85714 23.8V26.6C2.85714 27.3732 2.21755 28 1.42857 28C0.639593 28 0 27.3732 0 26.6V23.8C0 21.9435 0.752549 20.163 2.09209 18.8503C3.43164 17.5375 5.24845 16.8 7.14286 16.8H12.8571C14.7515 16.8 16.5684 17.5375 17.9079 18.8503C19.2474 20.163 20 21.9435 20 23.8V26.6C20 27.3732 19.3604 28 18.5714 28C17.7825 28 17.1429 27.3732 17.1429 26.6V23.8C17.1429 22.6861 16.6913 21.6178 15.8876 20.8302C15.0839 20.0425 13.9938 19.6 12.8571 19.6H7.14286Z"
                          fill="#666666"/>
                </svg>
            </div>
        {/if}
        {#if def}
            <img class={`image ${user.user_role} custom-image`}
            src={"/api/user/avatar/" + user.id + "?" + Date.now()}
            alt="user_image"/>
        {/if}
        <div class="highlight"></div>
        {#if user.user_role != 'USER'}
            <div class="special-tag">{icons[user.user_role]}</div>
        {/if}
    </div>

    <p>{user.name}</p>
</div>

<style>
    .image {
        border-radius: 30%;
        background-color: var(--color);
        height: 3rem;
        padding: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
        position: relative;
        z-index: 2;
        width: 3rem;
    }

    .image:hover {
        /*border-color: #00E589;*/
        box-shadow: 0 2px 3px var(--highlight);
        transform: translateY(-4px);
    }

    .highlight {
        opacity: 0.3;
        transition: .2s;
        position: absolute;
        border-radius: 30%;
        background-color: rgba(0, 0, 0, 0);
        bottom: 0;
        left: 0;
        width: 3rem;
        height: 3rem;
        pointer-events: none;
        z-index: 3;
    }

    .image:hover + .highlight {
        transform: translateY(-4px);
        background-color: var(--highlight);
    }

    .special-tag {
        position: absolute;
        top: 0;
        right: 1rem;
        width: 1.75rem;
        height: 1.75rem;
        border-radius: 50%;
        background-color: var(--highlight);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: .2s;
        pointer-events: none;
        z-index: 1;
    }

    .image:hover ~ .special-tag {
        transform: translate(2.1rem, -.5rem) rotate(45deg);
        opacity: 1;
    }

    .image.custom-image {
        padding: 0;
    }


    .image.owner svg path {
        fill: #E9D949 !important;
    }

    .image.admin svg path {
        fill: #34FFAD;
    }

    .image.member svg path {
        color: #8598AE;
    }

    .image.member svg path {
        background-color: #E0E5EB;
    }

    p {
        width: 8rem;
    }
</style>
