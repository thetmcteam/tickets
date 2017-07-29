<template>
    <div class="dropdown">
        <a class="tag" :style="{ 'background-color': ticket.department.color }" data-toggle="dropdown">
            {{ ticket.department.department }}
        </a>
        <ul class="dropdown-menu custom-menu">
            <li class="header">Ticket Department</li>
            <li v-for="department in departments" :class="{ disabled : department.id === ticket.department.id }">
                <a @click="update(department)">
                    <i class="fa fa-square" :style="{ color: department.color }" style="margin-right: 5px"></i>
                    {{ department.department }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    let sweetAlert = require('sweetalert');

    export default {
        props: ['ticket'],

        created() {
            axios.get('/api/departments')
                .then(response => {
                    this.departments = response.data;
                });
        },

        data() {
            return {
                departments: []
            };
        },

        methods: {
            update(department) {
                this.ticket.department = department;
                let ticket = this.ticket.id;

                axios.put(`/api/tickets/${ticket}/department`, { department: department.id })
                    .then(response => {
                        sweetAlert('Success', 'The department of this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the department of this ticket.', 'error');
                    });
            }
        }
    }
</script>
