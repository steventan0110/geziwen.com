<template>
    <div>
        <div v-for="(activity, index) in activities" class="row">
            <input type="hidden" :name='"activities[" + index + "][id]"' :value='activity.id'/>
            <input type="hidden" :name='"activities[" + index + "][applicant_id]"' :value="applicant">
            <div class="col-md-10 form-row">
                <div class="col-md-4 form-group">
                    <select required class="form-control" :name='"activities[" + index + "][type_id]"' v-model="activity.type_id">
                        <option :value="0" disabled>请选择活动种类</option>
                        <option v-for="(type, index) in JSON.parse(activityTypes)" :value="type.id">{{ type.name }}</option>
                    </select>
                </div>
                <div class="col-md-8 form-group">
                    <input required class="form-control" type="text" v-model="activity.name" :name='"activities[" + index + "][name]"' placeholder="活动名称">
                </div>
                <div class="col-md-12 form-group">
                    <textarea required class="form-control" type="text" v-model="activity.description" :name='"activities[" + index + "][description]"' placeholder="活动简介"></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <input class="form-control" type="date" v-model="activity.start" :name='"activities[" + index + "][start]"' placeholder="开始日期">
                </div>
                <div class="col-md-6 form-group">
                    <input class="form-control" type="date" v-model="activity.end" :name='"activities[" + index + "][end]"' placeholder="结束日期">
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block" @click="remove(index)">删除</button>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-2">
                <button type="button" class="btn btn-warning align-self-end btn-block" @click="create">新建</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "applicant-activities",
        mounted: function () {
            if (this.update) {
                this.$http.get('/api/applicant/' + this.applicant + '/activities').then(
                    response => {
                        this.activities = response.body.data;
                        console.log(this.activityTypes);
                    }, response => {
                        alert('服务器错误，请联系管理员！');
                    }
                );
            } else {
                this.create();
            }
        },
        props: {
            activityTypes: {
                required: true
            },
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
                activities: [],
            }
        },
        methods: {
            create: function () {
                this.activities.push({
                    id: 0,
                    type_id: null,
                    name: null,
                    description: null,
                    start: null,
                    end: null
                });
                console.log(this.activities);
            },
            remove: function(index) {
                this.activities.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>