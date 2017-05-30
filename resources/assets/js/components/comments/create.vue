<template>
    <form @submit.prevent="reply">
        <div class="form-group">
            <textarea class="form-control" rows="6" placeholder="Post a reply to this ticket..." v-model="data.content" required></textarea>
        </div>
        <button class="btn btn-primary pull-right">reply</button>
        <div style="clear: both"></div>
    </form>
</template>

<script>
    export default {
        props: ['ticket'],

        created() {
            this.data.ticket = this.ticket;
        },

        data() {
            return {
                data: {
                    ticket: null,
                    content: null
                }
            };
        },

        methods: {
            reply() {
                axios.post('/api/comments', this.data)
                    .then(response => {
                        Bus.$emit('comments:refresh');
                    });
            }
        }
    }
</script>
