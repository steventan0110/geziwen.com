<template>
    <ul class="list-unstyled">
        <li v-for="(comment, index) in commentList" class="media mb-2">
            <img class="mr-3 img-thumbnail" width="50px"  src="http://2e.zol-img.com.cn/product/64/410/ceneo4LyDg8c.jpg" alt="Generic placeholder image">
            <div class="media-body border-bottom border-gray">
                <button v-show="userName == comment.name" class="btn btn-outline-secondary btn-sm float-right m-2" @click="deleteItem(index, comment.id)">删除</button>
                <h6 class="mt-1 mb-2">
                    {{ comment.name }}
                    <star-rating v-bind:inline="true"
                                 @rating-selected="setRating"
                                 v-bind:rating=comment.rate
                                 v-bind:star-size="14"
                                 v-bind:show-rating="false"
                                 v-bind:read-only="true"
                                 class="ml-1"></star-rating>
                </h6>
                <p>{{ comment.text }}</p>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'comment-area',
        props: ['myMessage','myRating','myCommentType','myCommentIndex','userName'],
        data () {
            return {
                commentList: [],
                rateList: [],
            }
        },
        mounted () {
            this.initialize();
        },
        methods: {
            addItem (id, time) {
                if (this.myMessage != "") {
                    this.commentList.push({
                        name: this.userName,
                        text: this.myMessage,
                        rate: this.myRating,
                        id: id,
                        time: time
                    });
                }
            },
            initialize () {
                this.$http.post("/api/comment/get", {
                    'commentable_type': this.myCommentType,
                    'commentable_id': this.myCommentIndex
                }).then(function(response){
                        for (var i = 0; i < response.body[0].length; i++) {
                            this.commentList.push({
                                name: response.body[0][i],
                                text: response.body[1][i],
                                rate: response.body[2][i],
                                id: response.body[3][i],
                                time: response.body[4][i]});
                        }
                        console.log(response.status)
                    },function(response){
                        console.log(response.status)
                    }
                )
            },
            deleteItem (index, id) {
                this.commentList.splice(index, 1);
                this.$emit('deleteComment', id);
            },
            setRating: function (rating) {
                this.rating = rating;
            }
        }
    }
</script>

<style scoped>

</style>