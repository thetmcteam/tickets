<template>
    <div class="ticket create">
        <h3>Open a new ticket</h3>
        <h3 class="no-margin-top"><small>Please describe your issue in as much detail as possible.</small></h3>
        <hr>

        <div class="tcreate">
            <div class="reply">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="image">
                            <img src="http://www.mtlwalks.com/images/empty_profile.jpg">
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">This ticket will be opened under your name</div>
                            <div class="panel-body">
                                <form @submit.prevent="create">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" v-model="data.title" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control" v-model="data.department" required>
                                                    <option v-for="department in departments" :value="department.id">{{ department.department }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" v-model="data.type" required>
                                                    <option v-for="t in types" :value="t.id">{{ t.type }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <select class="form-control" v-model="data.priority" required>
                                                    <option v-for="priority in priorities" :value="priority.id">{{ priority.priority }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="form-control" v-model="data.content" rows="10" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        created() {
            axios.get('/api/departments')
                .then(response => {
                    this.departments = response.data;
                });

            axios.get('/api/types')
                .then(response => {
                    this.types = response.data;
                });

            axios.get('/api/priorities')
                .then(response => {
                    this.priorities = response.data;
                });
        },

        data() {
            return {
                types: [],
                priorities: [],
                departments: [],
                data: {
                    title: null,
                    department: null,
                    content: null,
                    type: null,
                    priority: null
                }
            };
        },

        methods: {
            create() {
                axios.post('/api/tickets', this.data)
                    .then(response => {
                        sweetAlert({
                            title: 'Ticket Created',
                            text: 'Thanks, your ticket has been created. We will look into this as soon as possible.',
                            type: 'success'
                        }, () => {
                            window.location.href = '/tickets';
                        });
                    })
                    .catch(error => {
                        sweetAlert({
                            title: 'Whoops',
                            text: 'Looks like there was an issue when creating this ticket, please try again',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>
