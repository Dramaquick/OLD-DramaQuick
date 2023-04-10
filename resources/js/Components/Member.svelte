<script>
    export let user = {
        id: 1,
        pseudo: "Invité",
        role: "member",
        hasCustomIcon: false
    };

    const colors = {
        creator: "#FFFACC",
        admin: "#CCFFEA",
        member: "#E0E5EB"
    }

    const highlight = {
        creator: "#ffe916",
        admin: "#34FFAD",
        member: "#8598AE"
    }

    let src = user.hasCustomIcon ? "/img/users/" + user.id + ".webp" : "/img/components/user.svg";
    let pseudo = user.pseudo;
    let role = user.role;
</script>

<div class="flex items-center justify-start gap-4">
    <div class="relative" style={`--color: ${colors[role]}; --highlight: ${highlight[role]}`}>

        <img class={`image ${role} custom-image`}
            src={"/user/avatar/" + user.id + "?" + Date.now()}
            alt="user_image"/>
        <div class="highlight"></div>

        {#if role === 'admin'}
            <div class="special-tag">🌵</div>
        {/if}

        {#if role === 'creator'}
            <div class="special-tag">👑</div>
        {/if}
    </div>

    <p>{pseudo}</p>
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


    .image.creator svg path {
        fill: #E9D949;
    }

    .image.admin svg path {
        fill: #34FFAD;
    }

    .image.member svg path {
        fill: #8598AE;
    }

    .image.member svg path {
        background-color: #E0E5EB;
    }

    p {
        width: 8rem;
    }
</style>
