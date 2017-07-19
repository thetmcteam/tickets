<template>
    <div class="users">
        <div class="row" v-for="chunkedUsers in getUsers()">
            <div class="col-sm-4 user" v-for="user in chunkedUsers">
                <div class="pull-left">
                    <img :src="user.image ? user.image : '/images/profile.jpg'">
                </div>
                <h4>{{ user.name }}</h4>
                <button class="btn btn-xs btn-primary" v-if="user.active === 1" @click="deactivate(user.id)">deactivate</button>
                <button class="btn btn-xs btn-success" v-if="user.active === 0" @click="activate(user.id)">activate</button>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script>
    let _  = require('lodash');
    let sweetAlert = require('sweetalert');

    export default {
        created() {
            this.refresh();
        },

        data() {
            return {
                users: []
            };
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
            },

            getUsers() {
                return _.chunk(this.users, 3);
            }
        }
    }
</script>
