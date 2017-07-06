<template>
    <div class="modal fade" id="ticketTypeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update This Ticket's Type</h4>
                </div>
                <form @submit.prevent="update" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Type</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.type">
                                    <option v-for="type in types" :value="type.id">{{ type.type }}</option>
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

            axios.get('/api/types')
                .then(response => {
                    this.types = response.data;
                });
        },

        data() {
            return {
                types: [],
                data: {
                    type: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;
                
                axios.put(`/api/tickets/${ticket}/type`, this.data)
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
