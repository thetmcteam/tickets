<template>
    <div class="replies" v-if="replies.length > 0">
        <div class="reply" v-for="reply in replies">
            <div class="title">
                <h3>
                    <img src="http://www.mtlwalks.com/images/empty_profile.jpg">
                    {{ reply.user.name }} <small>said on {{ reply.created_at }}</small>
                </h3>
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
                data: {
                    comment: null,
                    note: null
                }
            };
        },

        methods: {
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
