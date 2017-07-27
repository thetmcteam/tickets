<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="data.name" maxlength="255" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="text" class="form-control" v-model="data.image" maxlength="255">
        </div>
        <div class="form-group no-margin-bottom">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['id', 'name', 'image'],

        created() {
            this.data.name = this.name;
            this.data.image = this.image;
        },

        data() {
            return {
                data: {
                    name: null,
                    image: null
                }
            };
        },

        methods: {
            update() {
                axios.put('/api/users/' + this.id, this.data)
                    .then(response => {
                        sweetAlert('Account Updated', 'Nice! Your account has been updated successfully.', 'success');
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
