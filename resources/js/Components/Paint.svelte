<script>
    import { onMount } from 'svelte';


    // Déclaration des variables
    let canvas;
    let context;
    let isDrawing;
    let start;
    let t, l;
    let color = '#333';
    let background = '#fff';
    let width = 560;
    let height = 310;
    let lineWidth = 3;

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
		context.lineWidth = lineWidth
		
		handleSize()
	})
	
	$: if(context) {
			context.strokeStyle = color
	}
	
    // handleStart permet de commencer à dessiner
	const handleStart = (({ offsetX: x, offsetY: y }) => { 
		if(color === background) {
			context.clearRect(0, 0, width, height)
		} else {
			isDrawing = true
			start = { x, y }
		}
	})
	
    // handleEnd permet de finir de dessiner
	const handleEnd = () => { isDrawing = false }

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
    };

    // Fonction qui permet de changer la couleur du trait
    const handleColor = (e) => {
        color = e.target.value;
    };

</script>

<div class="w-fit flex gap-4">

    <div class="buttons right grid w-fit gap-x-4">
        <button style={`--color: #01FC96;`} on:click={handleReset} />
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
    canvas {
        height: 19.875rem;
        width: 35.3125rem;
        border: 6px solid #00E589;
        border-radius: 6px;
    }
    button {
        background: var(--color) url("/img/components/trash.svg") no-repeat center 5px;
        width: 2.4rem;
        height: 2.4rem;
        border-radius: 10px;
        cursor: pointer;
        outline: none;
        position: relative;
        transition: .2s ease-in;
        background-position: center;
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