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
                            <input type="text" class="form-control" v-model="query" placeholder="Filter users...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" data-toggle="modal" data-target="#inviteModal">
                    Invite
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
                    <td>{{ user.admin === 1 ? 'Administrator' : 'Member' }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-xs">
                                Manage
                            </button>
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="disabled"><a>Manage user<br>{{ user.name }}</a></li>
                                <li class="divider"></li>
                                <li v-if="user.active === 1"><a @click="deactivate(user.id)">Deactivate</a></li>
                                <li v-else><a @click="activate(user.id)">Activate</a></li>
                                <li><a @click="authorizations(user.id, user.name)">Authorizations</a></li>
                                <li class="divider"></li>
                                <li><a :href="'/tickets?query='+user.username">Tickets</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="panel-body" v-else>
                No users could be found.
            </div>
        </div>
        <div class="modal fade" id="inviteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Invite Someone</h4>
                    </div>
                    <form class="form-horizontal" @submit.prevent="sendInvite()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-3 text-right">email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" v-model="invite.email" required>
                                </div>
                            </div>
                            <div class="form-group no-margin-bottom">
                                <label class="col-sm-3 text-right">admin</label>
                                <div class="col-sm-7">
                                    <select class="form-control" v-model="invite.admin" required>
                                        <option value="1">yes</option>
                                        <option value="0">no</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">invite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <authorizations></authorizations>
    </div>
</template>

<script>
    let _ = require('lodash');
    let sweetAlert = require('sweetalert');
    let authorizations = require('./authorizations.vue');

    export default {
        components: {
            authorizations
        },

        created() {
            this.refresh();
        },

        data() {
            return {
                users: [],
                query: null,
                invite: {
                    admin: null,
                    email: null
                }
            };
        },

        computed: {
            filteredUsers() {
                let items = this.users.slice(0);

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
            authorizations(user, name) {
                Bus.$emit('authorizations:edit', {
                    id: user,
                    name: name
                });
            },

            sendInvite() {
                axios.post('/api/invite', this.invite)
                    .then(response => {
                        sweetAlert('Invite Sent', 'You have successfully sent an invite.', 'success');
                        $('#inviteModal').modal('hide');
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            sweetAlert('Invite Pending', 'An invite has already been sent to this person.', 'warning');
                            $('#inviteModal').modal('hide');
                        }
                    });
            },

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
