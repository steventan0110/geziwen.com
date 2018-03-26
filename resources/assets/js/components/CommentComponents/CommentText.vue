<template>
    <div>
        <div class="container" id="profile">
            <div class="jumbotron bg-white box-shadow">
                <comment-area ref="ca" v-bind:my-message="commentText" v-bind:my-rating="this.rating"></comment-area>
                <div class="media">
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
        props: ['commentData','commentType'],
        data() {
            return{
                rating:this.rating,
                Type: this.commentType,
                commentText: this.commentText,
                commentID: this.commentData
            }
        },
        methods: {
            addComment: function (){
                if (this.commentType==1) {
                    this.$http.post("/api/teacher/comment", {
                            'body': this.commentText,
                            'commentable_id': this.commentID
                        }
                    ).then(function(response){
                            console.log(response.status)
                        },function(response){
                            console.log(response.status)
                        }
                    );
                    this.$http.post("/api/teacher/rating", {
                            'rate': this.rating,
                            'rateable_id': this.commentID
                        }
                    ).then(function(response){
                            console.log(response.status)
                        },function(response){
                            console.log(response.status)
                        }
                    )
                }
                else if (this.commentType==0) {
                    this.$http.post("/api/agency/comment", {
                            'body': this.commentText,
                            'commentable_id': this.commentID
                        }
                    ).then(function(response){
                            console.log(response.status)
                        },function(response){
                            console.log(response.status)
                        }
                    );
                    this.$http.post("/api/agency/rating", {
                            'rate': this.rating,
                            'rateable_id': this.commentID
                        }
                    ).then(function(response){
                            console.log(response.status)
                        },function(response){
                            console.log(response.status)
                        }
                    )
                }
                else {
                    alert("FAILED")
                }
                this.$refs.ca.addItem();
                this.commentText = ""
            },
            cancelComment: function () {
                this.commentText = ""
            },
            setRating: function(rating){
                this.rating = rating;
            },
        },
        components: {
            CommentArea,
        }
    }
</script>

<style scoped>

</style>