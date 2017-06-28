<template>
    <div class="modal fade" id="ticketTypeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update This Ticket's Type</h4>
                </div>
                <form @submit.prevent="save" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Type</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.type">
                                    <option value="1">Bug</option>
                                    <option value="2">Unknown</option>
                                    <option value="3">Other</option>
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
        props: ['ticket', 'type'],

        created() {
            this.data.type = this.type;
        },

        data() {
            return {
                data: {
                    type: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;
                
                axios.put(`/api/tickets/${ticket}/status`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The type of this ticket has been updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the type of this ticket.', 'error');
                    });
            }
        }
    }
</script>
