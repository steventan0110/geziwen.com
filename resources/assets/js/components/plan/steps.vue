<template>
    <div class="form-group mb-3">
        <div v-for="(step, index) in steps" class="mb-2 row">
            <input type="hidden" :name='"steps[" + index + "][plan_id]"' :value="plan">
            <div class="col-md-10 form-row">
                <div class="col-md-8 form-group">
                    <input required class="form-control" type="text" :name='"steps["+index+"][name]"' v-model="step.name" placeholder="阶段名称">
                </div>
                <div class="col-md-4 form-group">
                    <input required class="form-control mb-2" type="text" :name='"steps["+index+"][period]"' v-model="step.period"  placeholder="阶段时间">
                </div>
                <div class="col-md-12 form-group">
                    <textarea required class="form-control mb-3" type="text" :name='"steps["+index+"][introduction]"' id="introduction" v-model="step.introduction" placeholder="阶段简介"></textarea>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block" @click="deleteItem(index)">删除</button>
            </div>
        </div>
        <button type="button" class="btn btn-warning btn-md mb-4" @click="addItem">新建方案阶段</button>
    </div>
    
</template>

<script>
    export default {
        name: "steps",
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
            if(this.update) {
                this.$http.get('/api/plan/' + this.plan).then(response => {
                    this.steps = response.body.data.steps;
                }, response => {
                    console.log(response);
                    alert('服务器错误，请联系管理员！');
                });
            }
        },
        data() {
            return {
                steps: [],
            }
        },
        methods: {
            addItem() {
                this.steps.push({
                    id: 0,
                    name: null,
                    period: null,
                    introduction: null,
                });
                // console.log(this.steps);
            },
            deleteItem(index) {
                this.steps.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>