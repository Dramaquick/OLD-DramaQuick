<script>
    // Create a notification component using the Portal component
    
    import { onMount, onDestroy } from "svelte";
    import Portal from "./Portal.svelte";
    import Button from "./Button.svelte";
    import TextBox from "./TextBox.svelte";

    export let title = "Notification";
    export let text = "This is a notification";
    export let type = "success";
    export let duration = 3000;
    export let format = "box";
    export let position = "bottom";
    export let showIcon = true;
    export let input = false;
    export let placeholder = "Placeholder";
    export let action = () => {};
    export let id = "";

    let destroy = false;

    let timeout;

    let close = false;

    let inputText ="";

    if (input) {
        duration = 0;
    };

    if (id === "") {
        id = String(Math.random());
    };

    onMount(() => {
        if (duration > 0) {
            timeout = setTimeout(() => {
                Disparition()
                console.log("Notification removed");
            }, duration);
        }
    });

    onDestroy(() => {
        clearTimeout(timeout);
    });

    function Disparition() {
        let div = document.getElementById(id);
        div.classList.add("disparition");
        setTimeout(() => {
            if (!close) {
                action();
            }
            destroy = true;
            close = false;
            clearTimeout(timeout);
        }, 250);
    }

    let classes;

    $: classes = "notification " + type;
    $: if (position === "middle" || position === "left" || position === "right" || position === "corner-top-left" || position === "corner-top-right" || position === "corner-bottom-left" || position === "corner-bottom-right") {
        classes += " " + "box";
        classes += " " + position;
        format = "box";
    } else {
        classes += " " + format;
        classes += " " + position;
    }

</script>

{#if !destroy}
<Portal>
<div id={id} class={classes}>
{#if format === "box"}
    
    {#if input === false}
        <div>
            <button class="close" on:click={() => {close=true; Disparition()}}>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <p>{title}</p>
            <p class="text-black font-normal px-4">{text}</p>
        </div>
    {:else}
        <div>
            <button class="close" on:click={() => {close=true; Disparition()}}>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <p class="pb-2">{title}</p>
            <hr>
            <div class="flex pt-4 px-4 gap-4 items-center">
                <TextBox placeholder={placeholder} bind:value={inputText} showIcon={false}/>
                {#if inputText.length != 8}
                    <Button class="h-12" action={() => {Disparition()}} disabled><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.32834 0.104168C1.20359 0.10359 1.07994 0.122799 0.964454 0.1607C0.848972 0.198599 0.743936 0.254442 0.65537 0.325027C0.56653 0.395824 0.496016 0.480055 0.447896 0.572861C0.399775 0.665667 0.375 0.765209 0.375 0.865746C0.375 0.966284 0.399775 1.06582 0.447896 1.15863C0.496016 1.25143 0.56653 1.33566 0.65537 1.40646L8.39923 7.62855C8.93173 8.05694 9.23082 8.63764 9.23082 9.24309C9.23082 9.84855 8.93173 10.4292 8.39923 10.8576L0.65537 17.0797C0.476888 17.2231 0.376618 17.4176 0.376618 17.6204C0.376618 17.8232 0.476888 18.0178 0.65537 18.1612C0.833852 18.3046 1.07592 18.3851 1.32834 18.3851C1.58075 18.3851 1.82282 18.3046 2.0013 18.1612L9.74516 11.9391C10.1865 11.5854 10.5367 11.1652 10.7756 10.7025C11.0145 10.2399 11.1375 9.74396 11.1375 9.24309C11.1375 8.74222 11.0145 8.24628 10.7756 7.78365C10.5367 7.32103 10.1865 6.90083 9.74516 6.54711L2.0013 0.325027C1.91274 0.254442 1.8077 0.198599 1.69222 0.1607C1.57674 0.122799 1.45308 0.10359 1.32834 0.104168Z" fill="#0D241B"/>
                        </svg></Button>
                {:else}
                    <Button action={() => {Disparition()}}><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.32834 0.104168C1.20359 0.10359 1.07994 0.122799 0.964454 0.1607C0.848972 0.198599 0.743936 0.254442 0.65537 0.325027C0.56653 0.395824 0.496016 0.480055 0.447896 0.572861C0.399775 0.665667 0.375 0.765209 0.375 0.865746C0.375 0.966284 0.399775 1.06582 0.447896 1.15863C0.496016 1.25143 0.56653 1.33566 0.65537 1.40646L8.39923 7.62855C8.93173 8.05694 9.23082 8.63764 9.23082 9.24309C9.23082 9.84855 8.93173 10.4292 8.39923 10.8576L0.65537 17.0797C0.476888 17.2231 0.376618 17.4176 0.376618 17.6204C0.376618 17.8232 0.476888 18.0178 0.65537 18.1612C0.833852 18.3046 1.07592 18.3851 1.32834 18.3851C1.58075 18.3851 1.82282 18.3046 2.0013 18.1612L9.74516 11.9391C10.1865 11.5854 10.5367 11.1652 10.7756 10.7025C11.0145 10.2399 11.1375 9.74396 11.1375 9.24309C11.1375 8.74222 11.0145 8.24628 10.7756 7.78365C10.5367 7.32103 10.1865 6.90083 9.74516 6.54711L2.0013 0.325027C1.91274 0.254442 1.8077 0.198599 1.69222 0.1607C1.57674 0.122799 1.45308 0.10359 1.32834 0.104168Z" fill="#0D241B"/>
                        </svg></Button>
                {/if}
            </div>
        </div>
    {/if}

{:else if format === "bar"}

        <div>
            <div class="flex flex-rox px-32 justify-left gap-8 items-center">
            {#if showIcon}
                {#if type === "success"}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                {:else if type === "error"}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                {:else if type === "warning"}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                {:else if type === "info"}
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_551_26)">
                        <path d="M19.5 0C15.6432 0 11.8731 1.14365 8.66636 3.28634C5.4596 5.42903 2.96024 8.47451 1.48433 12.0377C0.00841856 15.6008 -0.377747 19.5216 0.374665 23.3043C1.12708 27.0869 2.98427 30.5614 5.7114 33.2886C8.43852 36.0157 11.9131 37.8729 15.6957 38.6253C19.4783 39.3777 23.3991 38.9915 26.9623 37.5156C30.5255 36.0397 33.5709 33.5404 35.7136 30.3336C37.8563 27.1269 39 23.3567 39 19.5C38.9944 14.33 36.9381 9.37334 33.2824 5.71759C29.6266 2.06184 24.67 0.00559176 19.5 0V0ZM19.5 35.75C16.286 35.75 13.1443 34.7969 10.472 33.0114C7.79966 31.2258 5.71686 28.6879 4.48694 25.7186C3.25701 22.7493 2.93521 19.482 3.56222 16.3298C4.18923 13.1776 5.73689 10.2821 8.00949 8.00951C10.2821 5.73691 13.1776 4.18925 16.3298 3.56224C19.482 2.93523 22.7493 3.25703 25.7186 4.48696C28.6879 5.71688 31.2258 7.79968 33.0114 10.472C34.7969 13.1443 35.75 16.286 35.75 19.5C35.7453 23.8083 34.0317 27.9388 30.9852 30.9852C27.9388 34.0317 23.8083 35.7453 19.5 35.75V35.75Z" fill="#0077FF"/>
                        <path d="M19.5 16.25H17.875C17.444 16.25 17.0307 16.4212 16.726 16.726C16.4212 17.0307 16.25 17.444 16.25 17.875C16.25 18.306 16.4212 18.7193 16.726 19.0241C17.0307 19.3288 17.444 19.5 17.875 19.5H19.5V29.25C19.5 29.681 19.6712 30.0943 19.976 30.3991C20.2807 30.7038 20.694 30.875 21.125 30.875C21.556 30.875 21.9693 30.7038 22.2741 30.3991C22.5788 30.0943 22.75 29.681 22.75 29.25V19.5C22.75 18.6381 22.4076 17.8114 21.7981 17.2019C21.1886 16.5924 20.362 16.25 19.5 16.25Z" fill="#0077FF"/>
                        <path d="M19.5 13C20.8462 13 21.9375 11.9087 21.9375 10.5625C21.9375 9.21631 20.8462 8.125 19.5 8.125C18.1538 8.125 17.0625 9.21631 17.0625 10.5625C17.0625 11.9087 18.1538 13 19.5 13Z" fill="#0077FF"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_551_26">
                            <rect width="39" height="39" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                {/if}
            {/if}
            <p>{title}</p>
            <p class="text-black font-normal">{text}</p>
            <button class="close-bar" on:click={Disparition}>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button> 
        </div>
        </div>

{/if}
</div>
</Portal>
{/if}

<style>
    .notification {
        position: fixed;
        z-index: 1000;
        padding: 1rem 0;
        border-radius: 0.5rem;
        background-color: #fff;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        color: #666666;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: center;
        width: fit-content;
        min-width: 20rem;
        height: fit-content;
        min-height: 4rem;
    }

    .close {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        cursor: pointer;
        font-size: 1.5rem;
        color: #666666;
    }

    .close-bar {
        position: absolute;
        right: 2rem;
        cursor: pointer;
        font-size: 1.5rem;
        color: #666666;
    }

    .notification.box {
        border: 1px solid #e4e4e4;
    }

    .notification.bar {
        border: 1px solid #e4e4e4;
        padding: 2rem 0;
    }

    .notification.success {
        border: 1px solid #d1fae5;
        background-color: #d1fae5;
        color: #10b981;
    }

    .notification.error {
        border: 1px solid #fed7d7;
        background-color: #fed7d7;
        color: #ef4444;
    }

    .notification.info {
        border: 1px solid #bfdbfe;
        background-color: #bfdbfe;
        color: #0077ff;
    }

    .notification.warning {
        border: 1px solid #fef3c7;
        background-color: #fef3c7;
        color: #f59e0b;
    }

    .notification.normal {
        border: 1px solid #e4e4e4;
        background-color: #fff;
        color: #666666;
    }

    .notification.bottom.box {
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
    }

    .notification.bottom.bar {
        bottom: 0;
        left: 0;
        width: 100%;
        /* round corners */
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .notification.top.box {
        top: 1rem;
        left: 50%;
        transform: translateX(-50%);
    }

    .notification.top.bar {
        top: 0;
        left: 0;
        width: 100%;
        /* round corners */
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .notification.left {
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }
    .notification.right {
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
    }

    .notification.middle {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .notification.corner-top-left {
        top: 1rem;
        left: 1rem;
    }

    .notification.corner-top-right {
        top: 1rem;
        right: 1rem;
    }

    .notification.corner-bottom-left {
        bottom: 1rem;
        left: 1rem;
    }

    .notification.corner-bottom-right {
        bottom: 1rem;
        right: 1rem;
    }



    /* animation d'arrivée */

    .notification.bottom.box {
        animation: slide-in-bottom-box 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.bottom.bar {
        animation: slide-in-bottom-bar 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.top.box {
        animation: slide-in-top-box 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.top.bar {
        animation: slide-in-top-bar 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.left {
        animation: slide-in-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.right {
        animation: slide-in-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.middle {
        animation: scale-in-center 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-top-left {
        animation: slide-in-top-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-top-right {
        animation: slide-in-top-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-bottom-left {
        animation: slide-in-bottom-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-bottom-right {
        animation: slide-in-bottom-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    @keyframes slide-in-bottom-box {
        0% {
            transform: translateX(-50%) translateY(100%);
        }
        100% {
            transform: translateX(-50%) translateY(0);
        }
    }

    @keyframes slide-in-bottom-bar {
        0% {
            transform: translateY(100%);
        }
        100% {
            transform: translateY(0);
        }
    }

    @keyframes slide-in-top-box {
        0% {
            transform: translateX(-50%) translateY(-100%);
        }
        100% {
            transform: translateX(-50%) translateY(0);
        }
    }

    @keyframes slide-in-top-bar {
        0% {
            transform: translateY(-100%);
        }
        100% {
            transform: translateY(0);
        }
    }

    @keyframes slide-in-left {
        0% {
            transform: translateX(-100%) translateY(-50%);
        }
        100% {
            transform: translateX(0) translateY(-50%);
        }
    }

    @keyframes slide-in-right {
        0% {
            transform: translateX(100%) translateY(-50%);
        }
        100% {
            transform: translateX(0) translateY(-50%);
        }
    }

    @keyframes scale-in-center {
        0% {
            transform: translateY(-50%) translateX(-50%) scale(0.5);
        }
        100% {
            transform: scale(1) translateY(-50%) translateX(-50%);
        }
    }

    @keyframes slide-in-top-left {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    @keyframes slide-in-top-right {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    @keyframes slide-in-bottom-left {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    @keyframes slide-in-bottom-right {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    /* animation de disparition */

    .notification.bottom.box.disparition {
        animation: slide-out-bottom-box 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.bottom.bar.disparition {
        animation: slide-out-bottom-bar 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.top.box.disparition {
        animation: slide-out-top-box 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.top.bar.disparition {
        animation: slide-out-top-bar 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.left.disparition {
        animation: slide-out-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.right.disparition {
        animation: slide-out-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.middle.disparition {
        animation: scale-out-center 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-top-left.disparition {
        animation: slide-out-top-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-top-right.disparition {
        animation: slide-out-top-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-bottom-left.disparition {
        animation: slide-out-bottom-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .notification.corner-bottom-right.disparition {
        animation: slide-out-bottom-right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    @keyframes slide-out-bottom-box {
        0% {
            transform: translateX(-50%) translateY(0);
        }
        100% {
            transform: translateX(-50%) translateY(125%);
        }
    }

    @keyframes slide-out-bottom-bar {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(100%);
        }
    }

    @keyframes slide-out-top-box {
        0% {
            transform: translateX(-50%) translateY(0);
        }
        100% {
            transform: translateX(-50%) translateY(-125%);
        }
    }

    @keyframes slide-out-top-bar {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-100%);
        }
    }

    @keyframes slide-out-left {
        0% {
            transform: translateX(0) translateY(-50%);
        }
        100% {
            transform: translateX(-125%) translateY(-50%);
        }
    }

    @keyframes slide-out-right {
        0% {
            transform: translateX(0) translateY(-50%);
        }
        100% {
            transform: translateX(125%) translateY(-50%);
        }
    }

    @keyframes scale-out-center {
        0% {
            transform: scale(1) translateY(-50%) translateX(-50%);
        }
        100% {
            transform: translateY(-50%) translateX(-50%) scale(0.5);
        }
    }

    @keyframes slide-out-top-left {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-125%);
        }
    }

    @keyframes slide-out-top-right {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(125%);
        }
    }

    @keyframes slide-out-bottom-left {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-125%);
        }
    }

    @keyframes slide-out-bottom-right {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(125%);
        }
    }

</style>