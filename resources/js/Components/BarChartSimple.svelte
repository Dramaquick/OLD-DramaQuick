<script>
    import "@carbon/styles/css/styles.css";
    import "@carbon/charts/styles.css";
    import { BarChartSimple } from "@carbon/charts-svelte";

    export let data = [
      {
        "group": "2V2N 9KYPM version 1",
        "count": 28000
      },
      {
        "group": "L22I P66EP L22I P66EP L22I P66EP",
        "count": 65000
      },
      {
        "group": "JQAI 2M4L1",
        "count": 75000
      },
      {
        "group": "J9DZ F37AP",
        "count": 3200
      },
      {
        "group": "YEL48 Q6XK YEL48",
        "count": 15000
      },
      {
        "group": "Misc",
        "count": 25000
      }
    ];

    export let options={
      height: "300px",
      axes: {
        left: { mapsTo: "value" },
        bottom: { mapsTo: "group", scaleType: "labels" },
      },
      tooltip: {
        enabled: false,
        },
    toolbar: {
        enabled: false,
    },
    };
  </script>
  
  <BarChartSimple
    data={data}
    options={options}
  />