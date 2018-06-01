<template>
    <div>
        <div v-for="(award, index) in awards" class="row">
            <div class="col-md-10 form-row">
                <div class="col-md-8 form-group">
                    <input required class="form-control" type="text" v-model="award.name" :name='"awards[" + index + "][name]"' placeholder="奖项名称">
                </div>
                <div class="col-md-4 form-group">
                    <input required class="form-control" type="date" v-model="award.received_on" :name='"awards[" + index + "][received_on]"' placeholder="获得日期">
                </div>
                <div class="col-md-12 form-group">
                    <textarea required class="form-control" type="text" v-model="award.description" :name='"awards[" + index + "][description]"' placeholder="奖项简介"></textarea>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block" @click="remove(index)">删除</button>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-2">
                <button type="button" class="btn btn-warning btn-block" @click="create">新建</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "applicant-awards",
        mounted: function () {
            this.create();
        },
        data: function () {
            return {
                awards: [],
            }
        },
        methods: {
            create: function () {
                this.awards.push({
                    name: null,
                    description: null,
                    received_on: null
                });
            },
            remove: function(index) {
                this.awards.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>