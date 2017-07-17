<template>
    <div class="auth">
        <ul class="nav nav-tabs nav-justified">
            <li :class="{ 'active': method === 'basic' }"><a @click="authenticate('basic')">Basic</a></li>
            <li :class="{ 'active': method === 'ad' }"><a @click="authenticate('ad')">Active Directory</a></li>
        </ul>
        <form @submit.prevent="login">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" v-model="data.username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" v-model="data.password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        data() {
            return {
                data: {
                    username: null,
                    password: null
                },
                method: 'basic'
            };
        },

        methods: {
            authenticate(method) {
                this.method = method;
            },

            login() {
                let route;

                if (this.method == 'basic') {
                    route = '/';
                } else {
                    route = '/ldap';
                }

                axios.post(route, this.data)
                    .then(response => {
                        window.location = '/tickets';
                    })
                    .catch(error => {
                        if (error.response.status === 401) {
                            sweetAlert('Invalid Credentials', 'There was an issue logging you in with those credentials.', 'error');
                        }
                    });
            }
        }
    }
</script>
