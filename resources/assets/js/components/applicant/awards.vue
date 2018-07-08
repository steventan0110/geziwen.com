<template>
    <div>
        <div v-for="(award, index) in awards" class="row">
            <input type="hidden" :name='"awards[" + index + "][id]"' :value='award.id'/>
            <input type="hidden" :name='"awards[" + index + "][applicant_id]"' :value="applicant">
            <div class="col-md-10 form-row">
                <div class="col-md-12 form-group">
                    <input required class="form-control" type="text" v-model="award.name" :name='"awards[" + index + "][name]"' placeholder="奖项介绍">
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
            if (this.update) {
                this.$http.get('/api/applicant/' + this.applicant + '/awards').then(response => {
                    this.awards = response.body.data;
                }, response => {
                    alert('服务器错误，请联系管理员！');
                });
            } else {
                this.create();
            }
        },
        props: {
            update: {
                required: false,
                default: false,
            },
            applicant: {
                required: false,
                default: 0
            }
        },
        data: function () {
            return {
                awards: [],
            }
        },
        methods: {
            create: function () {
                this.awards.push({
                    id: 0,
                    name: null,
                });
                console.log(this.awards);
            },
            remove: function(index) {
                this.awards.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>