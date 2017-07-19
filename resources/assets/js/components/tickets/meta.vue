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
                <span>Department</span>
                <a class="label" :style="{ 'background-color': ticket.department.color }" data-toggle="modal" data-target="#ticketDepartmentModal">
                    <i class="fa fa-home"></i>
                    {{ ticket.department.department }}
                </a>
            </li>
            <li>
                <span>Status</span>
                <a class="label" :style="{ 'background-color': ticket.status.color }" data-toggle="modal" data-target="#ticketStatusModal">
                    <i class="fa fa-warning"></i>
                    {{ ticket.status.status }}
                </a>
            </li>
            <li>
                <span>Priority</span>
                <a class="label" :style="{ 'background-color': ticket.priority.color }" data-toggle="modal" data-target="#ticketPriorityModal">
                    <i class="fa fa-eye"></i>
                    {{ ticket.priority.priority }}
                </a>
            </li>
            <li>
                <span>Type</span>
                <a class="label" :style="{ 'background-color': ticket.type.color }" data-toggle="modal" data-target="#ticketTypeModal">
                    <i class="fa fa-tags"></i>
                    {{ ticket.type.type }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['id'],

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
