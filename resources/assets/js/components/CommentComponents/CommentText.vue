<template>
    <div>
        <div class="container" id="profile">
            <div class="jumbotron bg-white box-shadow">
                <comment-area @deleteComment="onDeleteComment"
                              ref="ca"
                              v-bind:my-message="commentText"
                              v-bind:my-rating="this.rating"
                              v-bind:my-comment-type="Type"
                              v-bind:user-name="this.userName"
                              />
                <div class="media" v-show="this.userName">
                    <h4 class="col-sm-2">发表评论</h4>
                    <textarea rows="5" cols="120" class="mt-3" placeholder="请填写评论内容" v-model="commentText"></textarea>
                    <star-rating @rating-selected="setRating" v-bind:star-size="30" v-bind:inline="true"></star-rating>
                    <p class="col-sm-4">
                        <button class="btn float-right mr-lg-4" v-show="this.commentText!=null" @click="addComment">发表</button>
                        <button class="btn float-right mr-lg-3" v-show="this.commentText!=null" @click="cancelComment">取消</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentArea from './CommentArea'
    export default {
        name: "comment-text",
        props: ['commentData','commentType','userName'],
        data() {
            return{
                rating: this.rating,
                Type: this.commentType,
                commentText: this.commentText,
                commentID: this.commentData,
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
                        console.log(response.status)
                    },function(response){
                        console.log(response.status)
                    }
                );
                this.$refs.ca.addItem();
                this.commentText = ""
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
            cancelComment: function () {
                this.commentText = ""
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