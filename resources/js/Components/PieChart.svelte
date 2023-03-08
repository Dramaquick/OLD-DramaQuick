<script>
    import "@carbon/styles/css/styles.css";
    import "@carbon/charts/styles.css";
    import { PieChart } from "@carbon/charts-svelte";

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

    export let options = {
        resizable: true,
        legend: {
            enabled: true,
            position: "bottom",
        },
        "pie": {
        "alignment": "center"
        },
        height: "325px",
        width: "600px",
        theme: "g10",
        toolbar: {
            enabled: false,
        },
    };
</script>

<PieChart {data} {options} />