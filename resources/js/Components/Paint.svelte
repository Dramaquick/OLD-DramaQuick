<script lang="ts">
    import { onMount } from "svelte";
    import Slider from "./Slider.svelte";

    export let setPaint : any;

    // Déclaration des variables
    let canvas;
    let context;
    let isDrawing;
    let start;
    let color = "#333333";
    let tp_color = "#333333";
    let background = "#ffffff";
    let width = 560;
    let height = 310;
    let lineWidth = [3];
    let undo = [];
    let redo = [];
    let type = "pen";
    let segment = [];
    let lineClicked = false;

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
        context = canvas.getContext("2d", { willReadFrequently: true });
        context.lineWidth = lineWidth[0];
        context.fillStyle = background;
        context.fillRect(0, 0, canvas.width, canvas.height);
    });

    $: if (context) {
        context.strokeStyle = color;
    }

    /*
        🛠️ - OUTILS
    */

    /**
     * Permet de changer d'outil
     * @param {"pen"|"eraser"|"line"|"fill"} tool
     */
    function switchTool(tool) {
        if (tool == "eraser") {
            type = "eraser";
            tp_color = color;
            color = "white";
        } else if (tool == "line") {
            type = "line";
            color = tp_color;
            segment = [];
        } else if (tool == "fill") {
            type = "fill";
            color = tp_color;
        } else {
            type = "pen";
            color = tp_color;
        }
    }

    /*
        🖐️ - HANDLERS
    */

    // handleStart permet de commencer à dessiner
    const startDrawing = ({ offsetX: x, offsetY: y }) => {
        isDrawing = true;
        start = { x, y };
        context.strokeStyle = color;
        context.lineWidth = lineWidth[0];
        if (type == "eraser") {
            context.strokeStyle = background;
            context.lineWidth = 15;
        } else if (type === "line") {
            isDrawing = false;
            if (!lineClicked) {
                segment.push({ x, y });
                lineClicked = true;
            }
        }
    };

    // handleEnd permet de finir de dessiner
    const stopDrawing = ({ offsetX: x, offsetY: y }) => {
        if (type === "line") {
            segment.push({ x, y });
            if (segment.length === 2) {
                context.strokeStyle = color;
                context.beginPath();
                context.moveTo(segment[0].x, segment[0].y);
                context.lineTo(segment[1].x, segment[1].y);
                context.closePath();
                context.stroke();
                segment = [];
                lineClicked = false;
            }
        } else {
            isDrawing = false;
        }
        if (type !== "fill") {
        handleHistory();
        }
    };

    // handleMove permet de dessiner
    const handleMouseMove = ({ offsetX: x1, offsetY: y1 }) => {
        if (!isDrawing) return;

        const { x, y } = start;
        context.beginPath();
        context.moveTo(x, y);
        context.lineTo(x1, y1);
        context.closePath();
        context.stroke();

        start = { x: x1, y: y1 };
    };

    // Fonction qui permet de réinitialiser le canvas
    const handleReset = () => {
        context.clearRect(0, 0, width, height);
        undo = [];
        redo = [];
        context.fillStyle = background;
        context.fillRect(0, 0, canvas.width, canvas.height);
        document.getElementById("pen").checked = true;
        type="pen";
    };

    // Fonction qui permet de changer la couleur du trait
    const handleColor = (e) => {
        color = e.target.value;
        tp_color = color;
        context.strokeStyle = color;
    };

    //Fonction qui enregistre le canvas après chaque action
    const handleHistory = () => {
        undo.push(context.getImageData(0, 0, width, height));
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
        document.getElementById("pen").checked = true;
        type="pen";
    };

    // Fonction qui permet de revenir en avant
    const handleRedo = () => {
        if (redo.length >= 1) {
            undo.push(redo.pop());
            context.putImageData(undo[undo.length - 1], 0, 0);
        }
        document.getElementById("pen").checked = true;
        type="pen";
    };

    // Sauvegarde des coordonnées de la souris pour un futur segment
    const handleMouseClick = (e) => {
        if (type === "fill") {
            handleFill(e);
            handleHistory();
        }
    };

    // function that flood fill in a canvas with a given color
    const handleFill = (e) => {
        let { offsetX: x, offsetY: y } = e;
        let pixelStack = [[x, y]];
        let imageData = context.getImageData(0, 0, width, height);
        let startR = imageData.data[(y * width + x) * 4];
        let startG = imageData.data[(y * width + x) * 4 + 1];
        let startB = imageData.data[(y * width + x) * 4 + 2];
        let startA = imageData.data[(y * width + x) * 4 + 3];
        let targetColor = [startR, startG, startB, startA];
        let replacementColor = hexToRgb(color);
        if (targetColor[0] === replacementColor.r && targetColor[1] === replacementColor.g && targetColor[2] === replacementColor.b && targetColor[3] === replacementColor.a) {
            return;
        }
        while (pixelStack.length) {
            let newPos = pixelStack.pop();
            let x = newPos[0];
            let y = newPos[1];
            let pixelPos = (y * width + x) * 4;
            let reachLeft = true;
            let reachRight = true;
            while (y-- >= 0 && matchStartColor(pixelPos)) {
                pixelPos -= width * 4;
            }
            pixelPos += width * 4;
            ++y;
            while (y++ < height - 1 && matchStartColor(pixelPos)) {
                colorPixel(pixelPos);
                if (x > 0) {
                    if (matchStartColor(pixelPos - 4)) {
                        if (reachLeft) {
                            pixelStack.push([x - 1, y]);
                            reachLeft = false;
                        }
                    } else if (!reachLeft) {
                        reachLeft = true;
                    }
                }
                if (x < width - 1) {
                    if (matchStartColor(pixelPos + 4)) {
                        if (reachRight) {
                            pixelStack.push([x + 1, y]);
                            reachRight = false;
                        }
                    } else if (!reachRight) {
                        reachRight = true;
                    }
                }
                pixelPos += width * 4;
            }
        }
        context.putImageData(imageData, 0, 0);

        function matchStartColor(pixelPos) {
            const r = imageData.data[pixelPos];
            const g = imageData.data[pixelPos + 1];
            const b = imageData.data[pixelPos + 2];
            const a = imageData.data[pixelPos + 3];
            return r === targetColor[0] && g === targetColor[1] && b === targetColor[2] && a === targetColor[3];
        }

        function colorPixel(pixelPos) {
            imageData.data[pixelPos] = replacementColor.r;
            imageData.data[pixelPos + 1] = replacementColor.g;
            imageData.data[pixelPos + 2] = replacementColor.b;
            imageData.data[pixelPos + 3] = replacementColor.a;
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result
                ? {
                      r: parseInt(result[1], 16),
                      g: parseInt(result[2], 16),
                      b: parseInt(result[3], 16),
                      a: 255,
                  }
                : null;
        }
    };

    export function getImage() {
        return canvas.toDataURL('image/jpeg');
    }    
    
</script>

<div class="w-fit h-full inline-flex gap-4">
    <div class="tool-buttons grid grid-rows-6 grid-columns-2 gap-x-2.5 h-80">
        <input
            type="radio"
            class="trash w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #01FC96;`}
            on:click={handleReset}
        />
        <input
            type="radio"
            class="undo w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #00E589;`}
            on:click={handleUndo}
        />
        <input
            type="radio"
            class="redo w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #00E589;`}
            on:click={handleRedo}
        />
        <input
            type="radio"
            class="eraser w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #00E589;`}
            on:click={() => switchTool("eraser")}
        />
        <input
            type="radio"
            class="pen w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            id = "pen"
            checked = {true}
            style={`--color: #00E589;`}
            on:click={() => switchTool("pen")}
        />
        <input
            type="radio"
            class="line w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #00E589;`}
            on:click={() => switchTool("line")}
        />
        <input
            type="radio"
            class="fill w-9.6 h-9.6 rounded-lg cursor-pointer outline-none relative transition-[.2s] bg-center border-none vertical-align-bottom"
            name = "tool"
            style={`--color: #00E589;`}
            on:click={() => switchTool("fill")}
        />
        <div class="slider w-9.6 h-fit">
            <Slider
                type="simple"
                bind:values={lineWidth}
                min={1}
                max={10}
                vertical={true}
            />
        </div>
    </div>

        <canvas
            id = "canvas"
            {width}
            {height}
            bind:this={canvas}
            on:mousedown={startDrawing}
            on:mouseup={stopDrawing}
            on:mousemove={handleMouseMove}
            on:touchstart={startDrawing}
            on:touchend={stopDrawing}
            on:touchmove={handleMouseMove}
            on:click={handleMouseClick}
            class="h-80 w-140 border-6 border-[#00e589] border-solid rounded-md"
            style="background: {background};"
        />

    <div class="color-buttons">
        {#each colors as color}
            <input
                type="radio"
                name="color"
                value={color}
                style={`--color: ${color};`}
                on:click={handleColor}
            />
        {/each}
        
    </div>
</div>

<!-- Déclaration du style -->
<style>

    /* 🛠️ Boutons couleur */

    .tool-buttons input:checked {
        background-color: #5ceb4b;
        animation: bump 0.2s ease-in-out;
    }

    .tool-buttons input:hover {
        background-color: #4de77b;
        transform: scale(1.1);
    }

    @keyframes bump {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    input.trash {
        background: var(--color) url("/img/components/trash.svg") no-repeat
            center;
        grid-column: 2;
        grid-row: 1;
        background-size: 1.4rem;
    }

    .tool-buttons input:not(.trash) {
        margin-top: auto;
        background-size: 1.4rem;
    }

    input.undo {
        background: var(--color) url("/img/components/undo.svg") no-repeat center;
        grid-column: 1;
        grid-row: 2;
    }

    input.redo {
        background: var(--color) url("/img/components/redo.svg") no-repeat
            center;
        grid-column: 2;
        grid-row: 2;
    }

    input.eraser {
        background: var(--color) url("/img/components/gomme.svg") no-repeat
            center;
        grid-column: 1;
        grid-row: 5;
        
    }

    input.pen {
        background: var(--color) url("/img/components/crayon.svg") no-repeat
            center;
        grid-column: 1;
        grid-row: 6;
    }

    input.line {
        background: var(--color) url("/img/components/segment.svg") no-repeat
            center;
        grid-column: 1;
        grid-row: 3;
    }

    input.fill {
        background: var(--color) url("/img/components/fill.svg") no-repeat
            center;
        grid-column: 1;
        grid-row: 4;
    }
    input:focus {
        box-shadow: none;
    }

    .slider {
        grid-column: 2;
        grid-row: 3/span 3;
    }

    /* 🎨 Boutons couleur */
    .color-buttons {
        display: grid;
        grid-template-rows: repeat(6, 1fr);
        grid-template-columns: repeat(2, 1fr);
        column-gap: 0.6rem;
        height: 20rem;
    }
    .color-buttons input[type="radio"]::after {
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: -1rem;
        background: transparent url("/img/components/check.svg") no-repeat
            center;
        transition: .2s;
        opacity: 0;
    }

    .color-buttons input[type="radio"]:checked {
        background: var(--color);
    }

    .color-buttons input[type="radio"]:checked::after {
        opacity: 1;
        transform: translateY(1rem);
    }

    .color-buttons input[type="radio"]:focus {
        box-shadow: none;
    }

    .color-buttons input[type="radio"] {
        width: 2.4rem;
        height: 2.4rem;
        background-color: var(--color);
        border-radius: 10px;
        cursor: pointer;
        outline: none;
        position: relative;
        transition: 0.2s ease-in;
        background-position: center;
        transition: .2s;
    }
</style>
