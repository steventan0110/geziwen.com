<template>
    <div class="row">
        <div class="col-lg-7"></div>
        <div class="col-5 col-lg-2 text-center">
            <strong style="color: #FF972F"><h2><b>{{ this.rateList[0] }}</b></h2></strong>
            <span class="text-secondary">综合评分</span>
        </div>

        <div class="col-7 col-lg-2 border-left border-primary">
            <star-rating v-bind:increment="0.1"
                         v-bind:rating=this.rateList[0]
                         v-bind:show-rating="false"
                         v-bind:star-size="30"
                         v-bind:read-only="true"
                         v-bind:inline="true"
                         class="m-2"></star-rating>
        </div>

    </div>
</template>

<script>
    export default {
        name: "rating-component",
        props: ['myCommentType', 'myCommentIndex'],
        data() {
            return {
                rateList: [],
            }
        },
        mounted() {
            let _this = this;
            this.$http.post("/api/comment/get", {
                'commentable_type': this.myCommentType,
                'commentable_id': this.myCommentIndex
            }).then(function (response) {
                    _this.rateList.push(response.body[5])
                }, function (response) {
                    console.log(response.status)
                }
            )
        },
    }
</script>

<style scoped>

</style>