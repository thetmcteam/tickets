<template>
    <form>
        <label><span class="main">status</span> <a class="pull-right" @click.prevent="update">change</a></label>
        <select class="form-control" v-model="data.status">
            <option value="1">Open</option>
            <option value="2">Awaiting Response</option>
            <option value="3">Closed</option>
            <option value="4">Monitor</option>
        </select>
    </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket', 'status'],

        created() {
            this.data.status = this.status;
        },

        data() {
            return {
                data: {
                    status: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;
                
                axios.put(`/api/tickets/${ticket}/status`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The status of this ticket has been updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the status of this ticket.', 'error');
                    });
            }
        }
    }
</script>
