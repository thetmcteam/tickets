<template>
    <div class="modal fade" id="ticketDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Ticket Department</h4>
                </div>
                <form @submit.prevent="update" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 text-right">Department</label>
                            <div class="col-sm-7">
                                <select class="form-control" v-model="data.department">
                                    <option v-for="department in departments" :value="department.id">{{ department.department }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket', 'department'],

        created() {
            this.data.department = this.department;

            axios.get('/api/departments')
                .then(response => {
                    this.departments = response.data;
                });
        },

        data() {
            return {
                departments: [],
                data: {
                    department: null
                }
            };
        },

        methods: {
            update() {
                let ticket = this.ticket;

                axios.put(`/api/tickets/${ticket}/department`, this.data)
                    .then(response => {
                        sweetAlert('Success', 'The department of this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the department of this ticket.', 'error');
                    });
            }
        }
    }
</script>
