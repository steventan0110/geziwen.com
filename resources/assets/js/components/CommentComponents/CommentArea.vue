<template>
    <div>
        <ul>
            <li v-for="(comment,index) in list" class="media">
                <!--TODO: src = user's own image-->
                <img class="mr-3" src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ comment.name }}</h5>
                    {{ comment.text }}
                </div>
                <star-rating @rating-selected="setRating" v-bind:rating=comment.rate v-bind:star-size="20" v-bind:read-only="true"></star-rating>
                <button class="btn btn-warning btn-sm" @click="deleteItem(index)">删除评论</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'comment-area',
        props: ['myMessage','myRating'],
        data () {
            return {
                name: 'Welcome to Your Vue.js App',

                // CAN NOT BE RENAMED --This "list" property MUST BE NAME "list", else it will definitely fail
                list: []
                //
            }
        },
        methods: {
            addItem () {
                //TODO: name: user's own name
                this.list.push({name: 'USER', text: this.myMessage, rate: this.myRating})
            },
            deleteItem (index) {
                this.list.splice(index,1)
            },
            setRating: function(rating){
                this.rating = rating;
            }
        }
    }
</script>

<style scoped>

</style>