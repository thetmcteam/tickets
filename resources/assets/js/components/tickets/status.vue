<template>
    <div class="modal fade" id="ticketStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update This Ticket's Status</h4>
                </div>
                <form @submit.prevent="update" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Status</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.status">
                                    <option v-for="status in statuses" :value="status.id">{{ status.status }}</option>
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

            axios.get('/api/status')
                .then(response => {
                    this.statuses = response.data;
                });
        },

        data() {
            return {
                statuses: [],
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
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the status of this ticket.', 'error');
                    });
            }
        }
    }
</script>
