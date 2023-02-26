<script>
    import { onMount } from "svelte";
    import Button from "../Components/Button.svelte";
    import RadioButton from "../Components/RadioButton.svelte";
    import Checkbox from "@/Components/Checkbox.svelte";
    import Slider from "../Components/Slider.svelte";
    import TextBox from "../Components/TextBox.svelte";
    import SelectList from "@/Components/SelectList.svelte";
    import TextArea from "../Components/TextArea.svelte";
    import TimeDisplay from "../Components/TimeDisplay.svelte";
    import Counter from "../Components/Counter.svelte";
    import NavLink from "../Components/NavLink.svelte";
    import Value from "../Components/Value.svelte";
    import UserButton from "../Components/UserButton.svelte";
    import Member from "../Components/Member.svelte";
    import Timer from "../Components/Timer.svelte";
    import Tag from "../Components/Tag.svelte";
    import Paint from "../Components/Paint.svelte";
    import QuestionCreator from "../Components/QuestionCreator.svelte";

    // export let canLogin;
    // export let canRegister;
    // export let laravelVersion;
    // export let phpVersion;
    // Les exportations ci-dessus sont définies dans "/routes/web.php"

    // export let errors;
    // /** @type {{date: Date, email: string, email_verified_at: null, id: int, name: string, updated_at: Date}}*/

    // export let auth;
    let form = {
        selected: 1,
        slidersimple: [5],
        sliderdouble: [0, 5],
        text: "",
        textArea: "",
        checked: false,
        selectValue: 0,
        counter: 0,
        value: "120",
        emoji: "👍",
        tag: "Tag",
        color: "#34FFAD",
        canvasImage: "",
    };
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

    // Décompteur en temps réel pour Timer
    let timer = {
        minutes: 0,
        seconds: 10,
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

    let questions = [
        {
            title: "Titre de la question",
            description: "Description de la question",
            type: 1,
            options: {
                option1: "Option 1",
                option2: "Option 2",
                option3: "Option 3",
            },
        },
    ];

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
        <RadioButton
            class=""
            name="test"
            value={1}
            bind:selected={form.selected}
        />
        <RadioButton
            class=""
            name="test"
            value={2}
            bind:selected={form.selected}
            disabled
        />
        <RadioButton
            class=""
            name="test"
            value={3}
            bind:selected={form.selected}
        />
        <RadioButton
            class=""
            name="test"
            value={4}
            bind:selected={form.selected}
            disabled
        />
        <Slider
            type="simple"
            class=""
            bind:values={form.slidersimple}
            min={0}
            max={10}
        />
        <Slider
            type="double"
            bind:values={form.sliderdouble}
            min={0}
            max={10}
        />
        <Checkbox
            bind:checked={form.checked} 
        />
        <TextBox 
            bind:value={form.text} placeholder="Entrez du texte..." 
        />
        <SelectList
            bind:value={form.selectValue}
            placeholder="Sélectionnez une valeur..."
        />
        <TextArea
            bind:value={form.textArea} placeholder="Entrez du texte..." 
        />
        <TimeDisplay 
            {minutes} {seconds} 
        />
        <Counter 
            max={15} min={-10} bind:value={form.counter} 
        />
        <NavLink href="/login">Login</NavLink>
        <Value 
            bind:value={form.value} 
        />
        <div class="test">
        <UserButton src="https://cdn.discordapp.com/avatars/394156737558741004/70b75a1870c4a43fa348c7bde4f23d6c.png?size=1024" />
        </div>
        <div class="test">
        <Member src="https://cdn.discordapp.com/avatars/394156737558741004/70b75a1870c4a43fa348c7bde4f23d6c.png?size=1024" />
        </div>
        <Timer
            bind:minutes={timer.minutes}
            bind:seconds={timer.seconds}
        />
        <Tag
            bind:text={form.tag}
            bind:color={form.color}
            bind:emoji={form.emoji}
        />
        <div class="draw">
        <Paint setPaint={(img) => form.canvasImage = img } />
        </div>
        <QuestionCreator
            bind:questions={questions}
        />
        <div class="flex gap-8">
            <p>{form.selected}</p>
            <p>{form.slidersimple}</p>
            <p>{form.sliderdouble}</p>
            <p>{form.checked}</p>
            <p>{form.text}</p>
            <p>{form.selectValue}</p>
            <p>{form.textArea}</p>
            <p>{form.counter}</p>
            <p>{form.value}</p>
            <p>{minutes}</p>
            <p>{seconds}</p>
            <p>{timer.minutes}</p>
            <p>{timer.seconds}</p>
            <p>{form.tag}</p>
            <p>{form.color}</p>
            <p>{form.emoji}</p>
            <p>{questions}</p>
            <img src={form.canvasImage} />
        </div>
    </div>
</main>


<style>
    .test {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .draw {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 100px;
        margin-bottom: 100px;
    }
</style>