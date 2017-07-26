<template>
    <div class="modal fade" id="editAuthorizationsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Authorizations for {{ user.name }}</h4>
                </div>
                <div class="modal-body" v-if="authorizations.length === 0 && nonAuthorizedDepartments.length === 0">
                    <i class="fa fa-spinner fa-spin"></i> &nbsp; One second, we are fetching the data for you.
                </div>
                <table class="table authorizations" v-else>
                    <tbody>
                        <tr v-for="authorization in authorizations">
                            <td>{{ authorization.department.department }}</td>
                            <td>
                                <button class="btn btn-danger btn-xs" @click="destroy(authorization.id)">Deauthorize</button>
                            </td>
                        </tr>
                        <tr v-for="department in nonAuthorizedDepartments">
                            <td>{{ department.department }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" @click="create(department.id)">Authorize</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        created() {
            Bus.$on('authorizations:edit', (data) => {
                this.user.id = data.id;
                this.user.name = data.name;
                this.refresh();
                this.refreshDepartments();
                $('#editAuthorizationsModal').modal('show');
            })
        },

        data() {
            return {
                user: {
                    id: null,
                    name: null
                },
                departments: [],
                authorizations: []
            };
        },

        computed: {
            nonAuthorizedDepartments() {
                for (let key in this.authorizations) {
                    let authorization = this.authorizations[key];

                    for (let key in this.departments) {
                        let department = this.departments[key];

                        if (authorization.department.id === department.id) {
                            this.departments.splice(key, 1);
                        }
                    }
                }

                return this.departments;
            }
        },

        methods: {
            create(department) {
                let data = {
                    user: this.user.id,
                    department: department
                };

                axios.post('/api/authorizations', data)
                    .then(response => {
                        this.refresh();
                        this.refreshDepartments();
                        sweetAlert('Department Authorized', 'This department has been successfully authorized for this user.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Looks like something on our end went wrong, please try again.', 'error');
                    });
            },

            destroy(id) {
                axios.delete(`/api/authorizations/${id}`)
                    .then(response => {
                        let name = this.user.name;
                        sweetAlert('Authorization Deleted', `${name}s authorization for this department has been disabled.`, 'success');
                        this.refresh();
                        this.refreshDepartments();
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops! Looks like something went wrong when processing your request.', 'error');
                    });
            },

            refresh() {
                axios.get('/api/authorizations/' + this.user.id)
                    .then(response => {
                        this.authorizations = response.data;
                    });
            },

            refreshDepartments() {
                axios.get('/api/departments')
                    .then(response => {
                        this.departments = response.data;
                    });
            }
        }
    }
</script>
