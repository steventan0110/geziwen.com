<template>
    <div>
        <div v-for="(offer, index) in offers" class="row">
            <div class="col-md-10 form-row">
                <div class="col-md-8 form-group">
                    <select required class="form-control" v-model="offer.university_id" :name='"offers[" + index + "][university_id]"'>
                        <option disabled value="0">--请选择录取学校--</option>
                        <option v-for="(university, index) in universities" :value="university.id">{{ university.name }}</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <select required class="form-control" v-model="offer.plan_id" :name='"offers[" + index + "][plan_id]"'>
                        <option disabled value="0">--请选择录取时期--</option>
                        <option v-for="(plan, index) in plans" :value="plan.id">{{ plan.shorthand }}--{{ plan.name }}</option>
                    </select>
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
        name: "applicant-offers",
        mounted: function () {
            this.create();
            this.$http.get('/api/university').then(response => {
                this.universities = response.body.data;
                console.log(this.universities);
            }, response => {
                alert('服务器错误，请联系管理员。');
            });
            this.$http.get('/api/application/plan').then(response => {
                this.plans = response.body.data;
                console.log(this.plans);
            }, response => {
                alert('服务器错误，请联系管理员');
            })
        },
        data: function () {
            return {
                offers: [],
                universities: [],
                plans: []
            }
        },
        methods: {
            create: function () {
                this.offers.push({
                    university_id: null,
                    plan_id: null,
                });
            },
            remove: function(index) {
                this.offers.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>