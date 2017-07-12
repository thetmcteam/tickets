<template>
    <div v-if="data.length > 0 && labels.length > 0">
        <chartjs-bar datalabel="ticket counts by department" :labels="labels" :data="data" :backgroundcolor="colors" :bordercolor="colors"></chartjs-bar>
    </div>
</template>

<script>
    export default {
        created() {
            this.refresh();
        },

        data() {
            return {
                metrics: [],
                data: [],
                labels: [],
                colors: []
            };
        },

        methods: {
            refresh() {
                axios.get('api/metrics/department')
                    .then(response => {
                        this.metrics = response.data;

                        for (let key in this.metrics) {
                            this.labels.push(this.metrics[key]['department']);
                            this.colors.push(this.metrics[key]['color']);
                            this.data.push(parseInt(this.metrics[key]['total']));
                        }
                    });
            }
        }
    }
</script>
