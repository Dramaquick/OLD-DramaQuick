<script>
    import { PieChart } from 'framework7-svelte';

    export let answers = [];
    export let colors = ["#34FFAD", "#FF34AD", "#34ADFF", "#FFAD34", "#AD34FF", "#ADFF34", "red", "gray", "maroon"];

    function unique_answers() {
        let unique = [];
        for (let i = 0; i < answers.length; i++) {
            if (!unique.includes(answers[i])) {
                unique.push(answers[i]);
            }
        }
        return unique;
    }

    function count (arr, value) {
        let count = 0;
        for (let i = 0; i < arr.length; i++) {
            if (arr[i] == value) {
                count++;
            }
        }
        return count;
    }

    function createData(answers) {
        let unique = unique_answers();
        let data = [];
        for (let i = 0; i < unique.length; i++) {
            data.push({
                value: count(answers, unique[i]),
                color: colors[i],
                label: unique[i],
            });
        }
        return data;
    }

    let pourcent = [];

    function Pourcentage() {
        let data = createData(answers);
        for (let i = 0; i < data.length; i++) {
            pourcent.push(data[i].value / answers.length * 100);
        }
    }

    Pourcentage();

    let form = {
        data: createData(answers),
    };
</script>

<div class="flex gap-4 pl-52">
<PieChart
    tooltip={true}
    datasets={form.data}
/>
<div class="legend flex items-start flex-col">
    {#each form.data as data}
        <div class="legend-item">
            <div class="legend-color" style="background-color: {data.color}"></div>
            <div class="legend-label">{data.label}</div>
            <div class="legend-label">({Math.round(pourcent[form.data.indexOf(data)])}%)</div>
        </div>
    {/each}
</div>
</div>

<style>
    .legend {
        width: fit-content;
        max-height: 20rem;
        height: fit-content;
        overflow-y: auto;
    }

    .legend-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 5px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .legend-label {
        font-size: 1.2rem;
    }

    .legend::-webkit-scrollbar {
        width: 4px;
    }

    .legend::-webkit-scrollbar-track {
        background: #deeee7;
    }

    .legend::-webkit-scrollbar-thumb {
        background-color: #47524e;
        border-radius: 10px;
    }
</style>