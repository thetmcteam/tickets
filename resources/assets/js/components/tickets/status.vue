<template>
    <div class="modal fade" id="ticketStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update This Ticket's Status</h4>
                </div>
                <form @submit.prevent="save" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Status</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.status">
                                    <option value="1">Open</option>
                                    <option value="2">Awaiting Response</option>
                                    <option value="3">Closed</option>
                                    <option value="4">Monitor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
