<script>
    import "@carbon/styles/css/styles.css";
    import "@carbon/charts/styles.css";
    import { BarChartSimple } from "@carbon/charts-svelte";

    let colors = [
      "#34ffad",
      "#49fca8",
      "#5ef9a4",
      "#73f69f",
      "#88f39b",
      "#9cf196",
      "#b1ee91",
      "#c6eb8c",
      "#dbe888",
      "#f0e583",
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

    export let options={
      height: "300px",
      axes: {
        left: { mapsTo: "value"},
        bottom: { mapsTo: "group", scaleType: "labels" },
      },
      tooltip: {
        enabled: false,
      },
      toolbar: {
          enabled: false,
      },
      legend: {
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

    let classement = {};

    data.forEach((item, index) => {
        classement[item.group] = item.value;
    });

    classement = Object.fromEntries(
        Object.entries(classement).sort(([,a],[,b]) => b-a)
    );
  </script>
  
  <div class="flex flex-row w-full items-center gap-12 h-[300px]">
    <BarChartSimple
      data={data}
      options={options}
    />
    <div class="flex flex-col gap-4 w-fit">
      {#each Object.entries(classement) as [key, value]}
        <div class="flex flex-row gap-4 items-center">
          <div class="w-4 h-4 rounded-full" style="background-color: {CountColor[value]}"></div>
          <div class="w-max">{key}, nombre de votes: {value}</div>
        </div>
      {/each}
    </div>
  </div>