<template>
    <div class="auth">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a>Invite</a></li>
            <li><a href="/">Have An Account?</a></li>
        </ul>
        <form @submit.prevent="save()">
            <div class="form-group">
                <label>name</label>
                <input type="text" v-model="data.name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>username</label>
                <input type="text" v-model="data.username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>password</label>
                <input type="password" v-model="data.password" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group no-margin-bottom">
                <button class="btn btn-primary">create</button>
            </div>
        </form>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['invite'],

        created() {
            let invite = JSON.parse(this.invite);

            this.data.uuid = invite.uuid;
            this.data.email = invite.email;
            this.data.admin = invite.admin;
        },

        data() {
            return {
                data: {
                    uuid: null,
                    email: null,
                    name: null,
                    username: null,
                    password: null,
                    admin: null
                }
            };
        },

        methods: {
            save() {
                axios.post('/api/users?token='+this.data.uuid, this.data)
                    .then(response => {
                        sweetAlert({
                            title: 'Account Created',
                            text: 'Nice! Your account has been created, you may now login.',
                            type: 'success'
                        }, () => {
                            window.location.href = '/';
                        });
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            sweetAlert('Validation Error', error.response.data[0], 'warning');
                        }
                    });
            }
        }
    }
</script>
