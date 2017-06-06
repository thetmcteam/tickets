<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="reply" v-for="reply in replies">
            <div class="heading">
                <div class="user">
                    <h4>
                        {{ reply.user.name }}
                        <small>{{ reply.created_at }}</small>
                    </h4>
                </div>
            </div>
            <div class="content">{{ reply.content }}</div>
            <div class="options">
                <ul>
                    <li><a href="">delete</a></li>
                    <li><a href="">reply</a></li>
                </ul>
            </div>
            <div class="notes" v-if="reply.notes.length > 0">
                <div class="reply note" v-for="note in reply.notes">
                    <div class="heading">
                        <div class="user">
                            <h4>
                                {{ note.user.name }}
                                <small>{{ note.created_at }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="content">{{ note.content }}</div>
                    <div class="options">
                        <ul>
                            <li><a href="">delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>
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
