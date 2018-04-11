<template>
    <div>
        <div class="container" id="profile">
            <div class="jumbotron bg-white box-shadow">
                <h4 class="border-bottom border-gray pb-2 mb-2 mb-5"><b>所有评论</b></h4>
                <comment-area @deleteComment="onDeleteComment"
                              ref="ca"
                              v-bind:my-message="commentText"
                              v-bind:my-rating="this.rating"
                              v-bind:my-comment-type="Type"
                              v-bind:user-name="this.userName"
                              v-bind:my-comment-index="this.commentIndex"
                              />
                <div class="media container-fluid" v-show="this.userName">
                    <img class="img-fluid img-thumbnail rounded mr-5" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image">
                    <div class="container-fluid">
                        <textarea class="form-control ml-5 mt-3" placeholder="请填写评论内容" v-model="commentText"></textarea>
                        <p class="ml-5">
                        <star-rating @rating-selected="setRating" v-bind:star-size="30" v-bind:inline="true" v-bind:show-rating="false" class="mt-5"></star-rating>
                        </p>
                    </div>
                    <div class="col-3 float-right text-center ml-3 mt-3">
                        <button class="btn btn-primary btn-primary btn-lg" v-show="this.commentText!=null" @click="addComment">发表</button>
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
                createdTime: null
            }
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