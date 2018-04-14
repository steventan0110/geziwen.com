<template>
    <div class="row">
        <div class="col-lg-7"></div>
        <div class="col-5 col-lg-2 text-center">
            <strong style="color: #FF972F"><h2><b>{{ this.rateList[this.rateList.length-1] }}</b></h2></strong>
            <span class="text-secondary">综合评分</span>
        </div>
        <div class="col-7 col-lg-2 border-left border-primary">
            <star-rating v-bind:increment="0.1"
                         v-bind:rating=this.rateList[this.rateList.length-1]
                         v-bind:show-rating="false"
                         v-bind:star-size="30"
                         v-bind:read-only="true"
                         v-bind:inline="true"
                         v-bind:fixed-points="1"
                         class="m-2"/>
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
                num: 0,
                sum: 0
            }
        },
        mounted() {
            this.$http.post("/api/comment/get", {
                'commentable_type': this.myCommentType,
                'commentable_id': this.myCommentIndex
            }).then(function (response) {
                    if(response.body[6] > 0){
                        this.num = response.body[6];
                        this.rateList.push(parseFloat((response.body[5]/this.num).toFixed(1)));
                    }
                    else {
                        this.rateList.push(0);
                    }
                }, function (response) {
                    console.log(response.status)
                }
            );
            this.$root.Middle.$on('addRate', value => {
                this.addRate(value)
            });
            this.$root.Middle.$on('deleteRate', value => {
                this.deleteRate(value)
            })
        },
        methods: {
            addRate(value) {
                this.sum = this.rateList[this.rateList.length - 1] * this.num;
                this.num += 1;
                this.rateList.push(parseFloat(((this.sum + value) / this.num).toFixed(1)));
            },
            deleteRate(value) {
                this.sum = this.rateList[this.rateList.length - 1] * this.num;
                this.num -= 1;
                if(this.num > 0) {
                    this.rateList.push(parseFloat(((this.sum - value) / this.num).toFixed(1)));
                }
                else {
                    this.rateList.push(0);
                }
            }
        }
    }
</script>

<style scoped>

</style>