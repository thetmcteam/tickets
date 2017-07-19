<template>
    <div class="users">
        <div class="toolbar">
            <div class="pull-left">
                <form class="form-inline" @submit.prevent="">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control" v-model="query">
                            <span class="input-group-btn">
                                <button class="btn btn-success">Filter</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/users/create">
                    New User
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Registered Users</div>
            <table class="table" v-if="filteredUsers.length > 0">
                <tr v-for="user in filteredUsers" class="user">
                    <td style="text-align: left">
                        <img :src="user.image ? user.image : '/images/profile.jpg'" class="pull-left">
                        <h4><a href="">{{ user.name }}</a> <small>{{ user.username }}</small></h4>
                    </td>
                    <td>{{ user.email ? user.email : 'N/A' }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>
                        <button class="btn btn-success btn-xs" v-if="user.active === 0" @click="activate(user.id)">activate</button>
                        <button class="btn btn-danger btn-xs" v-else @click="deactivate(user.id)">deactivate</button>
                    </td>
                </tr>
            </table>
            <div class="panel-body" v-else>
                No users could be found.
            </div>
        </div>
    </div>
</template>

<script>
    let _ = require('lodash');
    let sweetAlert = require('sweetalert');

    export default {
        created() {
            this.refresh();
        },

        data() {
            return {
                users: [],
                query: null
            };
        },

        computed: {
            filteredUsers() {
                let items = this.users.slice(0);
                console.log(items);

                if (this.query === null) {
                    return items;
                }

                return _.filter(items, (item) => {
                    for (let key in item) {
                        if (typeof item[key] == "string") {
                            if (item[key].toLowerCase().indexOf(this.query.toLowerCase()) > -1) {
                                return true;
                            }
                        }
                    }

                    return false;
                })
            }
        },

        methods: {
            refresh() {
                axios.get('/api/users')
                    .then(response => {
                        this.users = response.data;
                    });
            },

            activate(id) {
                axios.post(`/api/users/${id}/activate`)
                    .then(response => {
                        sweetAlert('User Activated', 'This user has been successfully activated.', 'success');
                        this.refresh();
                    });
            },

            deactivate(id) {
                axios.post(`/api/users/${id}/deactivate`)
                    .then(response => {
                        sweetAlert('User Deactivated', 'This user has been successfully deactivated.', 'success');
                        this.refresh();
                    })
            }
        }
    }
</script>
