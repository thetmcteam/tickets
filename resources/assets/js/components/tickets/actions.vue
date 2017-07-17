<template>
    <ul class="actions" v-if="actions.length > 0">
            <li class="action" v-for="action in actions">
                <!-- <i class="fa fa-bell-o"></i> -->
                <img src="/images/alerts.png" class="timebar-icon">
                <span class="heading">
                    <img :src="action.user.image !== null ? action.user.image : 'http://www.mtlwalks.com/images/empty_profile.jpg'">
                    <a class="user">{{ action.user.name }}</a>
                </span>
                <span class="content">
                    <span v-if="action.action == 'priority'">
                        changed the priority to
                    </span>
                    <span v-if="action.action == 'status'">
                        changed the status to
                    </span>
                    <span v-if="action.action == 'type'">
                        changed the type to
                    </span>
                    <span v-if="action.action == 'assign'">
                        assigned
                    </span>
                    <span class="label" :style="{ 'background-color': getData(action.id, action.data).color, 'margin-right': '4px' }">
                        {{ getData(action.id, action.data).value }}
                    </span>
                    <span v-if="action.action == 'assign'">
                        to this ticket
                    </span>
                    <timeago :since="action.created_at"></timeago>
                </span>
            </li>
    </ul>
</template>

<script>
    export default {
        props: ['ticket'],

        created() {
            this.refresh();

            Bus.$on('actions:refresh', () => {
                this.refresh();
            });
        },

        data() {
            return {
                actions: [],
                mapper: []
            };
        },

        methods: {
            getData(id, json) {
                if (this.mapper[id] !== undefined) {
                    return this.mapper[id];
                }

                let data = JSON.parse(json);
                this.mapper[id] = data;
                return data;
            },

            refresh() {
                axios.get('/api/actions/' + this.ticket)
                    .then(response => {
                        this.actions = response.data;
                    });
            }
        }
    }
</script>
