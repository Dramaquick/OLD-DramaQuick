<script>
    import { onMount } from 'svelte';
    import Slider from './Slider.svelte';

    // Déclaration des variables
    let canvas;
    let context;
    let isDrawing;
    let start;
    let color = '#333';
    let tp_color = '#333';
    let background = '#fff';
    let width = 560;
    let height = 310;
    let lineWidth = [3];
    let undo = [];
    let redo = [];
    let type = "crayon";
    let segment = [];

    let colors = [
        "#ff0000",
        "#ff6b00",
        "#ffb800",
        "#fff500",
        "#42ff00",
        "#00a310",
        "#00ffa3",
        "#00c2ff",
        "#0019ff",
        "#ad00ff",
        "#fa00ff",
        "#c8c8c8",
        "#858585",
        "#000000",
    ];

    // Fonction qui permet de gérer la taille du canvas
    onMount(() => {
		context = canvas.getContext('2d')
		context.lineWidth = lineWidth[0]

	})
	
	$: if(context) {
			context.strokeStyle = color
	}
	
    // handleStart permet de commencer à dessiner
	const handleStart = (({ offsetX: x, offsetY: y }) => { 
		isDrawing = true
		start = { x, y }
        context.strokeStyle = color;
        if (type == "gomme") {
            context.strokeStyle = background;
            context.lineWidth = 15;
        }
        else {
            context.strokeStyle = color;
            context.lineWidth = lineWidth[0];
        }
	})
	
    // handleEnd permet de finir de dessiner
	const handleEnd = () => { 
        isDrawing = false
        handleHist()
    }

    // handleMove permet de dessiner
	const handleMove = (({ offsetX: x1, offsetY: y1 }) => {
		if(!isDrawing) return
		
		const { x, y } = start
		context.beginPath()
		context.moveTo(x, y)
		context.lineTo(x1, y1)
		context.closePath()
		context.stroke()
		
		start = { x: x1, y: y1 }
	})

    // Fonction qui permet de réinitialiser le canvas
    const handleReset = () => {
        context.clearRect(0, 0, width, height);
        undo = [];
        redo = [];
    };

    // Fonction qui permet de changer la couleur du trait
    const handleColor = (e) => {
        color = e.target.value;
        tp_color = color;
        context.strokeStyle = color;
    };

    //Fonction qui enregistre le canvas après chaque action
    const handleHist = () => {
        undo.push(context.getImageData(0, 0, width, height));
        console.log("save")
        console.log(undo.length)
    };

    // Fonction qui permet de revenir en arrière
    const handleUndo = () => {
        if (undo.length >= 2) {
            redo.push(undo.pop());
            context.putImageData(undo[undo.length - 1], 0, 0);
        } else if (undo.length === 1) {
            context.clearRect(0, 0, width, height);
            redo.push(undo.pop());
        }
        console.log(undo.length)
    };

    // Fonction qui permet de revenir en avant
    const handleRedo = () => {
        if (redo.length >= 1) {
            undo.push(redo.pop());
            context.putImageData(undo[undo.length - 1], 0, 0);
        }
        console.log(undo.length)
    };

    // Fonction met en place la gomme
    const handleGomme = () => {
        type = "gomme";
        tp_color = color;
        color = "white";
    };

    // Fonction qui permet de revenir au crayon
    const handleCrayon = () => {
        type = "crayon";
        color = tp_color;
    };

    // Fonction qui permet de dessiner une ligne
    const handleLine = () => {
        type = "line";
        color = tp_color;
        segment = [];
    };

    // Sauvegarde des coordonnées de la souris pour un futur segment
    const handleMouse = (e) => {
        if (type === "line") {
        segment.push({ x: e.offsetX, y: e.offsetY });
        if (segment.length === 2) {
            context.strokeStyle = color;
            context.beginPath();
            context.moveTo(segment[0].x, segment[0].y);
            context.lineTo(segment[1].x, segment[1].y);
            context.closePath();
            context.stroke();
            segment.reverse();
            segment.pop();
        }
    };
    };

</script>

<div class="w-fit flex gap-4">

    <div class="buttons right grid w-fit gap-x-4">
        <button class="trash" style={`--color: #01FC96;`} on:click={handleReset} />
        <button class="undo" style={`--color: #00E589;`} on:click={handleUndo} />
        <button class="redo" style={`--color: #00E589;`} on:click={handleRedo} />
        <button class="gomme" style={`--color: #00E589;`} on:click={handleGomme} />
        <button class="crayon" style={`--color: #00E589;`} on:click={handleCrayon} />
        <button class="line" style={`--color: #00E589;`} on:click={handleLine} />
        <div class="slider">
            <Slider
            type="simple"
            class=""
            bind:values={lineWidth}
            min={0}
            max={10}
            vertical={true}
        />
        </div>
    </div>

    <div class="canvas">
        <canvas
            {width}
            {height}
            bind:this={canvas}
            on:mousedown={handleStart}
            on:mouseup={handleEnd}
            on:mousemove={handleMove}
            on:touchstart={handleStart}
            on:touchend={handleEnd}
            on:touchmove={handleMove}
            on:click={handleMouse}
            style="background: {background};" 
        />
    </div>

    <div class="buttons left grid w-fit gap-x-4">
        {#each colors as color}
            <input type="radio" name="color" value={color} style={`--color: ${color};`} on:click={handleColor} />
        {/each}
    </div>

</div>

<!-- Déclaration du style -->
<style>
    .slider {
        width: 2.4rem;
        height: 12rem;
        grid-column: 2;
        grid-row: 3/6;
    }
    canvas {
        height: 19.875rem;
        width: 35.3125rem;
        border: 6px solid #00E589;
        border-radius: 6px;
    }
    button {
        width: 2.4rem;
        height: 2.4rem;
        border-radius: 10px;
        cursor: pointer;
        outline: none;
        position: relative;
        transition: .2s ease-in;
        background-position: center;
    }

    button.trash {
        background: var(--color) url("/img/components/trash.svg") no-repeat center 5px;
        grid-column: 2;
    }

    button.undo {
        background: var(--color) url("/img/components/undo.svg") no-repeat center 5px;
    }

    button.redo {
        background: var(--color) url("/img/components/redo.svg") no-repeat center 5px;
    }

    button.gomme {
        background: var(--color) url("/img/components/gomme.svg") no-repeat center 5px;
    }

    button.crayon {
        background: var(--color) url("/img/components/crayon.svg") no-repeat center 5px;
        grid-row: 4;
    }

    button.line {
        background: var(--color) url("/img/components/segment.svg") no-repeat center 5px;
        grid-row: 4;
    }
    button:focus {
        box-shadow: none;
    }
    .buttons {
        grid-template-columns: repeat(2, 1fr);
    }
    .buttons.left input[type="radio"]:checked {
        background: var(--color) url("/img/components/check.svg") no-repeat center 5px;

    }

    .buttons.left input[type="radio"]:focus {
        box-shadow: none;
    }

    .buttons.left input[type="radio"] {
        width: 2.4rem;
        height: 2.4rem;
        background-color: var(--color);
        border-radius: 10px;
        cursor: pointer;
        outline: none;
        position: relative;
        transition: .2s ease-in;
        background-position: center;
    }
</style>