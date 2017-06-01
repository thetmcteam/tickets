<template>
    <form action="" method="post">
            <label><span class="main">assignee</span> <a class="pull-right" @click.prevent="update">assign</a></label>
            <select class="form-control" v-model="data.assignee">
                <option value="1">Jordan Bardsley</option>
                <option value="2">James Andrews</option>
                <option value="3">Tyson Chavarie</option>
            </select>
        </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket', 'assignee'],

        created() {
            this.data.assignee = this.assignee;
        },

        data() {
            return {
                data: {
                    assignee: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;

                axios.put(`/api/tickets/${ticket}/assignee`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The person assigned to this ticket has been updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the status of this ticket.', 'error');
                    });
            }
        }
    }
</script>
