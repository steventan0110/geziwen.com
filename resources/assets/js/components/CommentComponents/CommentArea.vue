<template>
    <div>
        <ul class="list-unstyled">
            <li v-for="(comment, index) in list" class="media border-bottom border-gray mb-5">
                <!--TODO: src = user's own image-->
                <div class="col-1">
                    <img class="img-fluid img-thumbnail rounded" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image">
                    <p/>
                </div>
                <!--<div class="col-2">-->
                    <!--<a href="#"><h4 class="mt-0 mb-1">{{ comment.name }}</h4></a>-->
                <!--</div>-->
                <div class="media-body pb-2 mb-1 container">
                    <h5 class="mt-0 mb-1"><a href="#">{{ comment.name }}</a>
                        <span class="ml-2 text-muted" style="font-size: 14px">{{ comment.time }}</span>
                    </h5>
                    <p style="font-size: 18px">
                        {{ comment.text }}
                    </p>
                </div>
                <star-rating @rating-selected="setRating" v-bind:rating=comment.rate v-bind:star-size="20" v-bind:show-rating="false" v-bind:read-only="true" class="mr-5"></star-rating>
                <button v-show="userName == comment.name" class="btn btn-outline-secondary btn-sm float-right" @click="deleteItem(index, comment.id)">删除评论</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'comment-area',
        props: ['myMessage','myRating','myCommentType','myCommentIndex','userName'],
        data () {
            return {
                list: [],
            }
        },
        mounted () {
            this.initialize();
        },
        methods: {
            addItem (id, time) {
                if(this.myMessage != "") {
                    this.list.push({name: this.userName, text: this.myMessage, rate: this.myRating, id: id, time: time});
                }
            },
            getItem (username, text, rating, id, time) {
                this.list.push({name: username, text: text, rate: rating, id: id, time: time})
            },
            initialize () {
                this.$http.post("/api/comment/get", {
                    'commentable_type': this.myCommentType,
                    'commentable_id': this.myCommentIndex
                }).then(function(response){
                        for (var i=0; i<response.body[0].length; i++) {
                            this.getItem(response.body[0][i], response.body[1][i], response.body[2][i], response.body[3][i], response.body[4][i])
                        }
                    },function(response){
                        console.log(response.status)
                    }
                )
            },
            deleteItem (index, id) {
                this.list.splice(index, 1);
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