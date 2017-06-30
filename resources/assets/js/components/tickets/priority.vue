<template>
    <div class="modal fade" id="ticketPriorityModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Ticket Priority</h4>
                </div>
                <form @submit.prevent="update" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Priority</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.priority">
                                    <option value="1">Low</option>
                                    <option value="2">Normal</option>
                                    <option value="3">High</option>
                                    <option value="4">Urgent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Priority</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
