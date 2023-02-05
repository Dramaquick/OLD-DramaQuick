<script>
    import { Link, page } from "@inertiajs/inertia-svelte";
    import {onMount} from "svelte";
    import Button from "../Components/Button.svelte";
    import RadioButton from "../Components/RadioButton.svelte";
    import Checkbox from "@/Components/Checkbox.svelte";
    import Slider from "../Components/Slider.svelte";
    import TextBox from "../Components/TextBox.svelte";
    import SelectList from "@/Components/SelectList.svelte";
    import TextArea from "../Components/TextArea.svelte";
    import TimeDisplay from "../Components/TimeDisplay.svelte";
    import Counter from "../Components/Counter.svelte";

    // export let canLogin;
    // export let canRegister;
    // export let laravelVersion;
    // export let phpVersion;
    // Les exportations ci-dessus sont définies dans "/routes/web.php"

    // export let errors;
    // /** @type {{date: Date, email: string, email_verified_at: null, id: int, name: string, updated_at: Date}}*/
    // export let auth;
    let form = {selected: 1, slidersimple: [5], sliderdouble: [0,5], text: "", textArea: "", checked: false, selectValue: 0, counter: 0};
    // Celles-ci sont définies automatiquement par Inertia
    // A savoir que la variable auth est un objet qui permet d'accéder aux attributs publics de l'utilisateur :

    // created_at (date): La date & l'heure de création de l'utilisateur
    // email (string): L'email de l'utilisateur
    // email_verified_at: (date): La date & l'heure à laquelle l'utilisateur a vérifié son email (pas fait pour le moment)
    // id: (int) L'identifiant de l'utilisateur
    // name: (string) Le pseudo de l'utilisateur
    // updated_at: (date) La date & l'heure de dernière mise à jour de l'utilisateur

    // Mise à jour en temps réel de TimeDisplay
    let minutes = new Date().getMinutes();
    let seconds = new Date().getSeconds();

    onMount(() => {
        setInterval(() => {
            minutes = new Date().getMinutes();
            seconds = new Date().getSeconds();
        }, 1000);
    });
</script>

<!-- Permet de modifier l'head de la page -->
<svelte:head>
    <title>DramaQuick</title>
</svelte:head>

<!-- Contenu de la page -->
<main class="min-h-screen w-full">
    <div>
        <Button class="">Rejoindre une session</Button>
        <Button class="outline">Créer une session</Button>
        <Button class="" disabled>Disabled</Button>
        <Button class="outline" disabled>Disabled outline</Button>
        <RadioButton class="" name="test" value={1} bind:selected={form.selected}></RadioButton>
        <RadioButton class="" name="test" value={2} bind:selected={form.selected} disabled></RadioButton>
        <RadioButton class="" name="test" value={3} bind:selected={form.selected}></RadioButton>
        <RadioButton class="" name="test" value={4} bind:selected={form.selected} disabled></RadioButton>
        <Slider type="simple" class="" bind:values={form.slidersimple} min={0} max={10}></Slider>
        <Slider type="double" bind:values={form.sliderdouble} min={0} max={10}></Slider>
        <Checkbox bind:checked={form.checked}/>
        <TextBox bind:value={form.text} placeholder="Entrez du texte..."/>
        <SelectList bind:value={form.selectValue} placeholder="Sélectionnez une valeur..."/>
        <TextArea bind:value={form.textArea} placeholder="Entrez du texte..."/>
        <TimeDisplay minutes={minutes} seconds={seconds}/>
        <Counter max={15} min={-10} bind:value={form.counter}/>
        <p>{form.selected}</p>
        <p>{form.slidersimple}</p>
        <p>{form.sliderdouble}</p>
        <p>{form.checked}</p>
        <p>{form.text}</p>
        <p>{form.selectValue}</p>
        <p>{form.textArea}</p>
        <p>{form.counter}</p>
    </div>
    <div>
        <h1>Une nouvelle version de DramaQuiz</h1>
    </div>
    <div>
        <p>DramaQuick est une version de DramaQuiz accélérée ; des questionnaires temporaires, des sessions de quiz... Tout cela a été créé avec une idée : l’éphémérité !</p>
    </div>
</main>

<!-- Ici j'utilise style pour styliser le fond qui est un peu compliqué -->
<style>
    main::before {
        background: url("/img/landing/square.png") 0 0 no-repeat;
        background-size: cover;
        content: "";
        position: absolute;
        width: 60rem;
        height: 60rem;
        z-index: -1;
        transform: rotate(45deg);
        bottom: -32rem;
        right: -8rem;
        overflow: hidden;
        border-radius: 5rem;
    }

    h1 {
        position: absolute;
        width: 37.875rem;
        height: 8.375rem;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 600;
        font-size: 3rem;
        line-height: 4.5rem;
        color: #000000;
    }
    p {
        position: absolute;
        width: 37.875rem;
        height: 9.125rem;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 1.5rem;
        line-height: 2.25rem;
        color: #000000;
    }
</style>