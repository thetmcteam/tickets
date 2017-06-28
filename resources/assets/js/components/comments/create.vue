<template>
    <div class="replies no-margin-bottom">
        <div class="row">
            <div class="reply">
                <div class="col-sm-1">
                    <div class="image">
                        <img src="http://www.mtlwalks.com/images/empty_profile.jpg">
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="panel panel-default">
                        <div class="panel-heading">Post a reply to this ticket</div>
                        <div class="panel-body">
                            <form @submit.prevent="reply">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Say something..." v-model="data.content"></textarea>
                                </div>
                                <button class="btn btn-primary pull-right">reply</button>
                            </form>
                        </div>
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
                        this.data.content = null;
                    });
            }
        }
    }
</script>
