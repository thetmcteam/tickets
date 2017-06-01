<template>
    <form>
        <label><span class="main">priority</span> <a class="pull-right" @click.prevent="update">change</a></label>
        <select class="form-control" v-model="data.priority">
            <option value="1">Low</option>
            <option value="2">Normal</option>
            <option value="3">High</option>
            <option value="4">Urgent</option>
        </select>
    </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket', 'priority'],

        created() {
            this.data.priority = this.priority;
        },

        data() {
            return {
                data: {
                    priority: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;

                axios.put(`/api/tickets/${ticket}/priority`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The priority of this ticket has been updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the priority of this ticket.', 'error');
                    });
            }
        }
    }
</script>
