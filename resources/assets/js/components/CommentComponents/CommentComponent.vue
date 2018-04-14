<template>
    <div>
        <h5 class="border-bottom border-gray pb-2 mb-2">评论 ({{ this.commentList.length }})</h5>
        <h6 class="text-secondary text-muted text-center mt-3" v-show="!this.commentList[0]">没有更多信息</h6>
        <ul class="list-unstyled">
            <li v-for="(comment, index) in commentList" class="media mb-2">
                <img class="mr-3 img-thumbnail" width="50px"  src="http://2e.zol-img.com.cn/product/64/410/ceneo4LyDg8c.jpg" alt="Generic placeholder image">
                <div class="media-body border-bottom border-gray">
                    <button v-if="userName == comment.name" class="btn btn-outline-secondary btn-sm float-right m-2" data-toggle="modal" data-target="#deleteComment" @click="storeIndex(index, comment.id, comment.rate)">删除</button>
                    <div v-if="userName == comment.name" style="margin-top: 250px" class="modal fade" id="deleteComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body"><h5 class="text-center">确认删除吗？</h5></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary col-5" data-dismiss="modal">取消</button>
                                    <button type="button" class="btn btn-danger col-5 mr-4" data-dismiss="modal" @click="deleteItem(currentIndex, currentID, currentRate)">确认</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-1 mb-2">
                        {{ comment.name }}
                        <star-rating v-bind:inline="true"
                                     @rating-selected="setRating"
                                     v-bind:rating=comment.rate
                                     v-bind:star-size="14"
                                     v-bind:show-rating="false"
                                     v-bind:read-only="true"
                                     class="ml-1"/>
                    </h6>
                    <p>{{ comment.text }}</p>
                </div>
            </li>
        </ul>
        <div v-show="this.userName" class="media">
            <img class="mr-3 img-thumbnail" width="50px"  src="http://2e.zol-img.com.cn/product/64/410/ceneo4LyDg8c.jpg" alt="Generic placeholder image">
            <div class="media-body">
                <h6 class="mt-1 mb-2">
                    撰写评论
                    <star-rating @rating-selected="setRating"
                                 v-bind:star-size="14"
                                 v-bind:inline="true"
                                 v-bind:show-rating="false"
                                 class="ml-1"/>
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
    export default {
        name: "comment-component",
        props: [ 'commentType', 'userName', 'commentIndex'],
        data() {
            return{
                currentIndex: 0,
                currentID: 0,
                currentRate: 0,
                newCommentIndex: 0,
                rating: this.rating,
                commentText: this.commentText,
                createdTime: null,
                rateList: [],
                commentList: [],
            }
        },
        mounted() {
            this.$http.post("/api/comment/get", {
                'commentable_type': this.commentType,
                'commentable_id': this.commentIndex
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
        methods: {
            addItem (id, time) {
                if (this.commentText != "") {
                    this.commentList.push({
                        name: this.userName,
                        text: this.commentText,
                        rate: this.rating,
                        id: id,
                        time: time
                    });
                }
            },
            deleteItem (index, id, rate) {
                this.commentList.splice(index, 1);
                this.$http.post("/api/comment/delete", {
                        'id': id
                    }
                ).then(function(response){
                        console.log(response.status)

                    },function(response){
                        console.log(response.status)
                    }
                );
                this.$root.Middle.$emit('deleteRate', rate)
            },
            storeIndex (index, id, rate) {
                this.currentIndex = index;
                this.currentRate = rate;
                this.currentID = id;
            },
            setRating: function (rating) {
                this.rating = rating;
            },
            addComment: function (){
                this.$http.post("/api/comment", {
                        'body': this.commentText,
                        'rate': this.rating,
                        'commentable_id': this.commentIndex,
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
                this.$root.Middle.$emit('addRate', this.rating)
            },
            onAddComment(id, time){
                this.addItem(id, time);
                this.commentText = "";
            },
        }
    }
</script>

<style scoped>

</style>