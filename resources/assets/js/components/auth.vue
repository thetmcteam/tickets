<template>
    <div class="auth--container">
        <div class="auth--heading text-center">
            <h3>helpdesk</h3>
        </div>
        <div class="auth">
            <ul class="nav nav-tabs nav-justified">
                <li :class="{ 'active': method === 'basic' }"><a @click="authenticate('basic')">Basic</a></li>
                <li :class="{ 'active': method === 'ad' }"><a @click="authenticate('ad')">Active Directory</a></li>
            </ul>
            <form @submit.prevent="login">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user-o"></i>
                        </span>
                        <input type="text" class="form-control" v-model="data.username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" v-model="data.password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group" v-if="method == 'basic'">
                    <label>
                        <input type="checkbox" v-model="data.remember"> Keep me logged in
                    </label>
                </div>
                <div class="form-group no-margin-bottom">
                    <button class="btn btn-primary btn-block">login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        data() {
            return {
                data: {
                    username: null,
                    password: null,
                    remember: false
                },
                method: 'basic'
            };
        },

        methods: {
            authenticate(method) {
                this.method = method;
            },

            login() {
                let route = (this.method == 'basic' ? '/' : '/ldap');

                axios.post(route, this.data)
                    .then(response => {
                        window.location = '/tickets';
                    })
                    .catch(error => {
                        if (error.response.status === 401) {
                            sweetAlert('Invalid Credentials', 'There was an issue logging you in with those credentials.', 'error');
                        } else if (error.response.status === 422) {
                            sweetAlert(
                                'Validation Error', 
                                'There was an issue importing you user from Active Directory. ' + error.response.data[0], 
                                'warning'
                            );
                        }
                    });
            }
        }
    }
</script>
