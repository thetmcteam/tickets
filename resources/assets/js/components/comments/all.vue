<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="reply" v-for="reply in replies">
            <div class="heading">
                <div class="user pull-left">
                    <h4>{{ reply.user.name }}</h4>
                    <h5>{{ reply.created_at }}</h5>
                </div>
                <button class="btn btn-primary btn-sm pull-right">reply</button>
                <div style="clear: both"></div>
            </div>
            <div class="content">{{ reply.content }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ticket'],

        created() {
            Bus.$on('comments:refresh', () => {
                this.refresh();

                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 1000);
            });
            this.refresh();
        },

        data() {
            return {
                replies: [],
                isReplying: false,
                data: {
                    comment: null,
                    note: null
                }
            };
        },

        methods: {
            setReplying(reply) {
                this.isReplying = true;
                this.data.comment = reply.id;
            },

            cancelReply() {
                this.isReplying = false;
                this.data.note = null;
            },

            postReply() {
                axios.post('/api/notes', this.data)
                    .then(response => {
                        this.refresh();
                        this.cancelReply();
                    });
            },

            refresh() {
                let ticket = this.ticket;

                axios.get(`/api/comments/${ticket}`)
                    .then(response => {
                        this.replies = response.data;
                        console.log(this.replies);
                    });
            }
        }
    }
</script>
