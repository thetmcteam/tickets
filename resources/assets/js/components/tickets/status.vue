<template>
    <div class="dropdown">
        <a class="tag" :style="{ 'background-color': ticket.status.color }" data-toggle="dropdown">
            {{ ticket.status.status }}
        </a>
        <ul class="dropdown-menu custom-menu">
            <li class="header">Ticket Status</li>
            <li v-for="status in statuses" :class="{ disabled : status.id === ticket.status.id }">
                <a @click="update(status)">
                    <i class="fa fa-square" :style="{ color: status.color }" style="margin-right: 5px"></i>
                    {{ status.status }}
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
            axios.get('/api/status')
                .then(response => {
                    this.statuses = response.data;
                });
        },

        data() {
            return {
                statuses: []
            };
        },

        methods: {
            update(status) {
                this.ticket.status = status;
                let ticket = this.ticket.id;
                
                axios.put(`/api/tickets/${ticket}/status`, { status: status.id })
                    .then(response => {
                        sweetAlert('Success', 'The status of this ticket has been updated.', 'success');
                        Bus.$emit('actions:refresh');
                    })
                    .catch(error => {
                        sweetAlert('Whoops', 'Oh no, looks like there was an issue when updating the status of this ticket.', 'error');
                    });
            }
        }
    }
</script>
