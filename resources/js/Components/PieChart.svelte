<script>
    import "@carbon/styles/css/styles.css";
    import "@carbon/charts/styles.css";
    import { PieChart } from "@carbon/charts-svelte";

    let colors = [
      "#f0e583",
      "#dbe888",
      "#c6eb8c",
      "#b1ee91",
      "#9cf196",
      "#88f39b",
      "#73f69f",
      "#5ef9a4",
      "#49fca8",
      "#34ffad",
    ];

    export let data = [
      {
        "group": "2V2N 9KYPM version 1",
        "value": 28000
      },
      {
        "group": "L22I P66EP L22I P66EP L22I P66EP",
        "value": 65000
      },
      {
        "group": "JQAI 2M4L1",
        "value": 75000
      },
      {
        "group": "J9DZ F37AP",
        "value": 3200
      },
      {
        "group": "YEL48 Q6XK YEL48",
        "value": 15000
      },
      {
        "group": "Misc",
        "value": 25000
      }
    ];

    export let options = {
        resizable: true,
        "pie": {
        "alignment": "center"
        },
        height: "325px",
        width: "600px",
        theme: "g10",
        toolbar: {
            enabled: false,
        },
        legend: {
            enabled: false,
        },
        tooltip: {
            enabled: false,
        },
        color: {
            scale: {},
        },
    };

    let amoutOfCountDifferently = [];

    data.forEach((item, index) => {
        if (!amoutOfCountDifferently.includes(item.value)) {
            amoutOfCountDifferently.push(item.value);
        }
    });

    //tri de manière décroissante amoutOfCountDifferently
    amoutOfCountDifferently.sort((a, b) => {
        return b - a;
    });

    let colorIndex = 1;
    let countIndex = 1;
    let CountColor = {};

    amoutOfCountDifferently.forEach((item, index) => {
        if (colorIndex === 1) {
            CountColor[item] = colors[0];
            colorIndex++;
            countIndex++;
        }
        else if (countIndex === amoutOfCountDifferently.length) {
            CountColor[item] = colors[colors.length-1];
        }
        else {
        CountColor[item] = colors[Math.round(colorIndex/amoutOfCountDifferently.length*10)-1];
        colorIndex++;
        countIndex++;
        }
    });

    data.forEach((item, index) => {
        options.color.scale[item.group] = CountColor[item.value];
    });

    //On trie les datas en fonction de leur value dans l'ordre croissant
    data.sort((a, b) => {
        return b.value - a.value;
    });
</script>

<div class="flex flex-row items-center justify-center h-[300px]">
<PieChart {data} {options} />
<div class="flex flex-col gap-4">
{#each data as item}
    <div class="flex flex-row items-center">
        <div class="w-4 h-4 rounded-full" style="background-color: {options.color.scale[item.group]}"></div>
        <div class="ml-2">{item.group}, nombre de votes: {item.value}</div>
    </div>
{/each}
</div>
</div>