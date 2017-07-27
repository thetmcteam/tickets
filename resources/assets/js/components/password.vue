<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="password" maxlength="60" required>
        </div>
        <div class="form-group no-margin-bottom">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['id'],

        data() {
            return {
                password: null
            };
        },

        methods: {
            update() {
                let id = this.id;
                
                axios.put(`/api/users/${id}/password`, { password: this.password })
                    .then(response => {
                        sweetAlert('Account Updated', 'Nice! Your account has been updated successfully.', 'success');
                        this.password = null;
                    })
                    .catch(error => {
                        sweetAlert('Something Went Wrong', 'Whoops, something on our end went wrong while processing this request.', 'error');
                    });
            }
        }
    }
</script>
