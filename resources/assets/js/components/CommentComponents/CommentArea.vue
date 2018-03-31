<template>
    <div>
        <ul>
            <li v-for="(comment,index) in list" class="media">
                <!--TODO: src = user's own image-->
                <div class="col-sm-1">
                    <img class="mr-3 img-thumbnail img-responsive rounded-circle" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ comment.name }}</h5>
                    {{ comment.text }}
                </div>
                <star-rating @rating-selected="setRating" v-bind:rating=comment.rate v-bind:star-size="20" v-bind:read-only="true"></star-rating>
                <button v-show="userName==comment.name" class="btn btn-warning btn-sm" @click="deleteItem(index, comment.id)">删除评论</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'comment-area',
        props: ['myMessage','myRating','myCommentType','userName'],
        data () {
            return {
                msg: 'hi',
                // CAN NOT BE RENAMED --This "list" property MUST BE NAME "list", else it will definitely fail
                list: [],

            }
        },
        mounted () {
            this.getItem();
        },
        methods: {
            addItem () {
                this.list.push({name: this.userName, text: this.myMessage, rate: this.myRating});
            },
            initialize (username, text, rating, id) {
                this.list.push({name: username, text: text, rate: rating, id: id})

            },
            getItem () {
                this.$http.post("/api/comment/get", {
                    'commentable_type': this.myCommentType
                }).then(function(response){
                        for (var i=0; i<response.body[0].length; i++) {
                            this.initialize(response.body[0][i],response.body[1][i],response.body[2][i],response.body[3][i])
                        }
                    },function(response){
                        console.log(response.status)
                    }
                )
            },
            deleteItem (index, id) {
                this.list.splice(index,1);
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