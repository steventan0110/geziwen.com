<template>
    <div>
        <comment-area @deleteComment="onDeleteComment"
                      ref="ca"
                      v-bind:my-message="commentText"
                      v-bind:my-rating="this.rating"
                      v-bind:my-comment-type="Type"
                      v-bind:user-name="this.userName"
                      v-bind:my-comment-index="this.commentIndex"
        />

        <div v-show="this.userName" class="media">
            <img class="mr-3 img-thumbnail" width="50px"  src="http://2e.zol-img.com.cn/product/64/410/ceneo4LyDg8c.jpg" alt="Generic placeholder image">
            <div class="media-body">
                <h6 class="mt-1 mb-2">
                    撰写评论
                    <star-rating @rating-selected="setRating"
                                 v-bind:star-size="14"
                                 v-bind:inline="true"
                                 v-bind:show-rating="false"
                                 class="ml-1"></star-rating>
                </h6>
                <textarea class="form-control align-middle mb-3" placeholder="请填写评论内容" v-model="commentText"></textarea>
                <div>
                    <button class="btn btn-primary btn-sm float-right" @click="addComment">发表</button>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import CommentArea from './CommentArea'
    export default {
        name: "comment-text",
        props: ['commentData', 'commentType', 'userName', 'commentIndex'],
        data() {
            return{
                rating: this.rating,
                Type: this.commentType,
                commentText: this.commentText,
                commentID: this.commentData,
                newCommentIndex: 0,
                createdTime: null,
                rateList: []
            }
        },
        mounted() {
        },
        methods: {
            addComment: function (){
                this.$http.post("/api/comment", {
                        'body': this.commentText,
                        'rate': this.rating,
                        'commentable_id': this.commentID,
                        'commentable_type': this.commentType,
                        'username': this.userName
                    }
                ).then(function(response){
                        console.log(response.status);
                        this.newCommentIndex = response.body[0];
                        this.createdTime = response.body[1].date;
                        this.onAddComment(this.newCommentIndex, this.createdTime)
                    },function(response){
                        alert(response.body);
                        console.log(response.status);
                    }
                );
            },
            onAddComment(id, time){
                this.$refs.ca.addItem(id, time);
                this.commentText = "";
            },
            onDeleteComment (id) {
                this.$http.post("/api/comment/delete", {
                        'id': id
                    }
                ).then(function(response){
                        console.log(response.status)
                    },function(response){
                        console.log(response.status)
                    }
                );
            },
            setRating: function(rating){
                this.rating = rating;
            }
        },
        components: {
            CommentArea,
        }
    }
</script>

<style scoped>

</style>