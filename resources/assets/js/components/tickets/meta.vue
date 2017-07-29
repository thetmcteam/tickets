<template>
    <div class="meta">
        <ul>
            <li>
                <span>Assignee</span>
                
                <a data-toggle="modal" data-target="#assignTicketModal">
                    <span v-if="ticket.assignee !== null">{{ ticket.assignee.name }}</span>
                    <span v-else>No one has been assigned yet.</span>
                </a>
            </li>
            <li>
                <span>
                    Department
                    <a><i class="fa fa-cog pull-right"></i></a>
                </span>
                <department :ticket="ticket"></department>
            </li>
            <li>
                <span>
                    Status
                    <a href=""><i class="fa fa-cog pull-right" data-toggle="dropdown"></i></a>
                </span>
                <status :ticket="ticket"></status>
            </li>
            <li>
                <span>
                    Priority
                    <a href=""><i class="fa fa-cog pull-right" data-toggle="dropdown"></i></a>
                </span>
                <priority :ticket="ticket"></priority>
            </li>
            <li>
                <span>
                    Type
                    <a href=""><i class="fa fa-cog pull-right" data-toggle="dropdown"></i></a>
                </span>
                <type :ticket="ticket"></type>
            </li>
        </ul>
    </div>
</template>

<script>
    let type = require('./type.vue');
    let status = require('./status.vue');
    let priority = require('./priority.vue');
    let department = require('./department.vue');

    export default {
        props: ['id'],

        components: {
            department,
            status,
            priority,
            type
        },

        data() {
            return {
                ticket: null
            };
        },

        created() {
            this.ticket = JSON.parse(this.id);
        }
    }
</script>
