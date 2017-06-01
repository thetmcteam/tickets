<template>
    <form @submit.prevent="create">
        <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control" v-model="data.title" required>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" v-model="data.content" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <label>Department</label>
            <div v-for="department in departments">
                <input type="radio" :value="department.id" v-model="data.department" required> &nbsp; {{ department.department }}
            </div>
        </div>
        <div class="form-group">
            <label>Type</label>
            <div v-for="t in types">
                <input type="radio" :value="t.id" v-model="data.type" required> &nbsp; {{ t.type }}
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Create</button>
        </div>
    </form>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        created() {
            axios.get('/api/departments')
                .then(response => {
                    this.departments = response.data;
                });

            axios.get('/api/types')
                .then(response => {
                    this.types = response.data;
                });
        },

        data() {
            return {
                types: [],
                departments: [],
                data: {
                    title: null,
                    department: null,
                    content: null,
                    type: null
                }
            };
        },

        methods: {
            create() {
                axios.post('/api/tickets', this.data)
                    .then(response => {
                        sweetAlert({
                            title: 'Ticket Created',
                            text: 'Thanks, your ticket has been created. You will receive notifications when there is activity related to your ticket.',
                            type: 'success'
                        }, () => {
                            window.location.href = '/tickets';
                        });
                    })
                    .catch(error => {
                        sweetAlert({
                            title: 'Whoops',
                            text: 'Looks like there was an issue when creating this ticket, please try again',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>
