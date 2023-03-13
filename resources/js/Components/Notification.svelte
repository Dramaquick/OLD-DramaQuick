<script>
    // Create a notification component using the Portal component
    
    import { onMount, onDestroy } from "svelte";
    import Portal from "./Portal.svelte";

    export let text = "Notification";
    export let type = "success";
    export let duration = 3000;

    let timeout;

    onMount(() => {
        timeout = setTimeout(() => {
            document.body.removeChild(portal);
        }, duration);
    });

    onDestroy(() => {
        clearTimeout(timeout);
    });

    $: classes = "notification " + type;

</script>

<Portal>
    <div class={classes}>
        <p>{text}</p>
    </div>
</Portal>

<style>
    .notification {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1rem;
        border-radius: 0.5rem;
        background-color: #fff;
        box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .notification.success {
        background-color: #d1fae5;
        color: #10b981;
    }

    .notification.error {
        background-color: #fed7d7;
        color: #ef4444;
    }

    .notification.warning {
        background-color: #fef3c7;
        color: #f59e0b;
    }

    .notification.info {
        background-color: #bfdbfe;
        color: #3b82f6;
    }

    .notification p {
        margin: 0;
    }

</style>