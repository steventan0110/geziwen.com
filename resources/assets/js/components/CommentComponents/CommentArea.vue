<template>
    <div>
        <ul class="list-unstyled">
            <li v-for="(comment,index) in list" class="media">
                <!--TODO: src = user's own image-->
                <div class="col-sm-2">
                    <img class="mr-3 img-fluid img-thumbnail rounded-circle border-success" width="50%" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image">
                    <p/>
                </div>
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ comment.name }}</h5>
                    {{ comment.text }}
                </div>
                <star-rating @rating-selected="setRating" v-bind:rating=comment.rate v-bind:star-size="20" v-bind:show-rating="false" v-bind:read-only="true" class="mr-lg-5"></star-rating>
                <button v-show="userName==comment.name" class="btn btn-outline-secondary btn-sm" @click="deleteItem(index, comment.id)">删除评论</button>
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
                // CAN NOT BE RENAMED --This "list" property MUST BE NAME "list", else it will definitely fail
                list: [],
            }
        },
        mounted () {
            this.initialize();
        },
        methods: {
            addItem (id) {
                if(this.myMessage!="") {
                    this.list.push({name: this.userName, text: this.myMessage, rate: this.myRating, id: id});
                }
            },
            getItem (username, text, rating, id) {
                this.list.push({name: username, text: text, rate: rating, id: id})
            },
            initialize () {
                this.$http.post("/api/comment/get", {
                    'commentable_type': this.myCommentType,
                    'commentable_id': this.myCommentIndex
                }).then(function(response){
                        for (var i=0; i<response.body[0].length; i++) {
                            this.getItem(response.body[0][i],response.body[1][i],response.body[2][i],response.body[3][i])
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