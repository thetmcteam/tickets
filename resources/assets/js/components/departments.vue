<template>
    <div class="departments">
        <div class="toolbar">
            <div class="pull-left">
                <form class="form-inline" @submit.prevent="">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control" v-model="query" placeholder="Filter departments...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary">
                    Add
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Helpdesk departments</div>
            <div class="panel-body" v-if="departments.length === 0">
                No departments could be found.
            </div>
            <table class="table" v-else>
                <tbody>
                    <tr v-for="department in departments">
                        <td><i class="fa fa-square" :style="{ color: department.color }"></i></td>
                        <td>#{{ department.id }}</td>
                        <td><span style="text-transform: capitalize">{{ department.department }}</span></td>
                        <td>{{ Boolean(department.public) ? 'Public' : 'Private' }}</td>
                        <td>{{ Boolean(department.active) ? 'Active' : 'Deactive' }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xs">
                                    Manage
                                </button>
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="disabled"><a>Department<br>{{ department.department }}</a></li>
                                    <li class="divider"></li>
                                    <li v-if="department.public === 1"><a @click="makePrivate(department)">Make private</a></li>
                                    <li v-else><a @click="makePublic(department)">Make public</a></li>
                                    
                                    <li><a :href="'/tickets?query=' + department.department">View tickets</a></li>
                                    
                                    <li class="divider"></li>
                                    <li v-if="department.active === 1"><a @click="deactivate(department)">Deactivate</a></li>
                                    <li v-else><a @click="activate(department)">Activate</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        data() {
            return {
                departments: []
            };
        },

        created() {
            this.refresh();
        },

        methods: {
            refresh() {
                axios.get('/api/departments')
                    .then(response => {
                        this.departments = response.data;
                    });
            },

            activate(department) {
                let id = department.id;
                
                axios.put(`/api/departments/${id}/activate`)
                    .then(response => {
                        this.refresh();
                        sweetAlert('Department Activated', 'Nice! This department has been successfully activated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops. Looks like something went wrong while processing your request.', 'error');
                    });
            },

            deactivate(department) {
                let id = department.id;

                axios.put(`/api/departments/${id}/deactivate`)
                    .then(response => {
                        this.refresh();
                        sweetAlert('Department Deactivated', 'This department has been successfully deactivated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops. Looks like something went wrong while processing your request.', 'error');
                    });
            },

            makePrivate(department) {
                let id = department.id;

                axios.put(`/api/departments/${id}/private`)
                    .then(response => {
                        this.refresh();
                        sweetAlert('Department Updated', 'This department has been successfully updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops. Looks like something went wrong while processing your request.', 'error');
                    });
            },

            makePublic(department) {
                let id = department.id;

                axios.put(`/api/departments/${id}/public`)
                    .then(response => {
                        this.refresh();
                        sweetAlert('Department Updated', 'This department has been successfully updated.', 'success');
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops. Looks like something went wrong while processing your request.', 'error');
                    });
            }
        }
    }
</script>
