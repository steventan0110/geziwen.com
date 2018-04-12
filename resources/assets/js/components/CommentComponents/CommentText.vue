<template>
    <div class="container" id="applicants">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="row">
                <div class="container">
                    <comment-area @deleteComment="onDeleteComment"
                                  ref="ca"
                                  v-bind:my-message="commentText"
                                  v-bind:my-rating="this.rating"
                                  v-bind:my-comment-type="Type"
                                  v-bind:user-name="this.userName"
                                  v-bind:my-comment-index="this.commentIndex"
                    />

                    <div class="container ml-1" id="text-area" v-show="this.userName">
                        <div >
                            <h5 class="pb-3"><b>我的评论</b></h5>
                            <textarea class="form-control align-middle mb-3" placeholder="请填写评论内容" v-model="commentText"></textarea>
                            <div>
                                <button class="btn btn-primary btn-default float-right" @click="addComment">发表</button>
                                <star-rating @rating-selected="setRating"
                                             v-bind:padding="5"
                                             v-bind:star-size="25"
                                             v-bind:inline="true"
                                             v-bind:show-rating="false"
                                             class="float-left mr-5"></star-rating>
                            </div>

                        </div>
                    </div>
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