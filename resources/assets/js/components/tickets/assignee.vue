<template>
    <div class="modal fade" id="assignTicketModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign This Ticket</h4>
                </div>
                <form @submit.prevent="save" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Assignee</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.assignee">
                                    <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Assign Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket', 'assignee'],

        created() {
            this.data.assignee = this.assignee;

            axios.get('/api/users')
                .then(response => {
                    this.users = response.data;
                });
        },

        data() {
            return {
                data: {
                    assignee: null
                },
                users: []
            };
        },

        methods: {
            save() {
                let ticket = this.ticket;

                axios.put(`/api/tickets/${ticket}/assignee`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The person assigned to this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the status of this ticket.', 'error');
                    });
            }
        }
    }
</script>
