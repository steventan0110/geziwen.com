<template>
    <div class="form-group mb-3">
        <div v-for="(feature, index) in features" class="mb-2 row">
            <input type="hidden" :name='"features[" + index + "][plan_id]"' :value="plan">
            <div class="col-md-10 form-row">
                <div class="col-md-12 form-group">
                    <input required class="form-control" type="text" :name='"features["+index+"][name]"' v-model="feature.name" placeholder="特点名称">
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block" @click="deleteItem(index)">删除</button>
            </div>
        </div>

        <button type="button" class="btn btn-warning btn-md mb-4" @click="addItem">新建方案特点</button>
    </div>
</template>

<script>
    export default {
        name: "features",
        props: {
            plan : {
                required : false,
            },
            update: {
                required: false,
                default: false,
            },
        },
        mounted() {
            if(this.update){
                this.$http.get('/api/plan/' + this.plan).then(response => {
                    this.features = response.body.data.features;
                }, response => {
                    console.log(response);
                    alert('服务器错误，请联系管理员！');
                });
            }
        },
        data() {
            return {
                features: [],
            }
        },
        methods: {
            addItem() {
                this.features.push({
                    id: 0,
                    name: null,
                    introduction: null,
                });
                // console.log(this.features);
            },
            deleteItem(index) {
                this.features.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>