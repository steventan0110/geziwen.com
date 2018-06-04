<template>
    <div>
        <div v-for="(exam, index) in exams" class="row">
            <input type="hidden" :name='"exams[" + index + "][type]"' :value='exam.type'/>
            <input type="hidden" :name='"exams[" + index + "][id]"' :value="exam.id">
            <input type="hidden" :name='"exams[" + index + "][applicant_id]"' :value="applicant">
            <input type="hidden" :name='"exams[" + index + "][remark]"' :value="exam.remark">
            <div class="col-md-2">
                <input v-model="exam.score.total"
                       v-if="exam.type !== 'sat2' && exam.type !== 'ap'"
                       type="number"
                       class="form-control"
                       :required="type !== 'language' || index !== 0"
                       :name='"exams[" + index + "][score][total]"'
                       :placeholder='examTypes[exam.type] + "总分"'/>
                <input v-else
                       disabled
                       class="form-control-plaintext"
                       :value="examTypes[exam.type]"
                       type="text"/>
            </div>
            <div v-if="exam.type === 'sat'" class="col-md-8 form-row">
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.reading" type="number" class="form-control" :name='"exams[" + index + "][score][reading]"' placeholder="阅读">
                </div>
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.writing" type="number" class="form-control" :name='"exams[" + index + "][score][writing]"' placeholder="语法">
                </div>
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.math" type="number" class="form-control" :name='"exams[" + index + "][score][math]"' placeholder="数学">
                </div>
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.essay.reading" type="number" class="form-control" :name='"exams[" + index + "][score][essay][reading]"' placeholder="阅读"/>
                </div>
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.essay.writing" type="number" class="form-control" :name='"exams[" + index + "][score][essay][writing]"' placeholder="写作"/>
                </div>
                <div class="form-group col-sm-2">
                    <input v-model="exam.score.essay.analysis" type="number" class="form-control" :name='"exams[" + index + "][score][essay][analysis]"' placeholder="分析"/>
                </div>
            </div>
            <div v-if="exam.type === 'act'" class="col-md-8 form-row">
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.reading" type="number" class="form-control" :name='"exams[" + index + "][score][reading]"' placeholder="阅读"/>
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.english" type="number" class="form-control" :name='"exams[" + index + "][score][english]"' placeholder="英语"/>
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.math" type="number" class="form-control" :name='"exams[" + index + "][score][math]"' placeholder="数学">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.science" type="number" class="form-control" :name='"exams[" + index + "][score][science]"' placeholder="科学"/>
                </div>
            </div>
            <div v-if="exam.type === 'toefl'" class="col-md-8 form-row">
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.reading" type="number" class="form-control" :name='"exams[" + index + "][score][reading]"' placeholder="阅读">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.listening" type="number" class="form-control" :name='"exams[" + index + "][score][listening]"' placeholder="听力">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.speaking" type="number" class="form-control" :name='"exams[" + index + "][score][speaking]"' placeholder="口语">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.writing" type="number" class="form-control" :name='"exams[" + index + "][score][writing]"' placeholder="写作"/>
                </div>
            </div>
            <div v-if="exam.type === 'ielts'" class="col-md-8 form-row">
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.reading" type="number" class="form-control" :name='"exams[" + index + "][score][reading]"' placeholder="阅读">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.listening" type="number" class="form-control" :name='"exams[" + index + "][score][listening]"' placeholder="听力">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.speaking" type="number" class="form-control" :name='"exams[" + index + "][score][speaking]"' placeholder="口语">
                </div>
                <div class="form-group col-sm-3">
                    <input v-model="exam.score.writing" type="number" class="form-control" :name='"exams[" + index + "][score][writing]"' placeholder="写作"/>
                </div>
            </div>
            <div v-if="exam.type === 'ap'" class="col-md-8 form-row">
                <div class="form-group col-sm-6">
                    <input v-model="exam.score.subject" type="text" class="form-control" :name='"exams[" + index + "][score][subject]"' placeholder="科目">
                </div>
                <div class="form-group col-sm-6">
                    <input required v-model="exam.score.total" type="number" class="form-control" :name='"exams[" + index + "][score][total]"' placeholder="分数"/>
                </div>
            </div>
            <div v-if="exam.type === 'sat2'" class="col-md-8 form-row">
                <div class="form-group col-sm-6">
                    <input v-model="exam.score.subject" type="text" class="form-control" :name='"exams[" + index + "][score][subject]"' placeholder="科目">
                </div>
                <div class="form-group col-sm-6">
                    <input required v-model="exam.score.total" type="number" class="form-control" :name='"exams[" + index + "][score][total]"' placeholder="分数"/>
                </div>
            </div>
            <div class="col-md-2">
                <button v-if="type === 'standard'" type="button" class="btn btn-danger btn-block" @click="remove(index)">删除</button>
                <div class="form-group" v-else-if="exam.remark === 'before'">
                    <button type="button" class="btn btn-danger" @click="remove(index)">删除培训前</button>
                </div>
                <input v-else-if="exam.remark === 'after'" value="培训后分数" disabled class="form-control-plaintext" />
            </div>
        </div>
        <div class="row mb-4">
            <div v-if="type === 'standard'" class="form-group mb-2 col-sm-2">
                <button type="button" class="btn btn-warning btn-block" @click="create('standard')">新建</button>
            </div>
            <div v-else-if="this.exams.length === 1" class="form-group mb-2 col-sm-2">
                <button type="button" class="btn btn-warning btn-block" @click="create('before')">添加培训前</button>
            </div>
            <div class="form-group mb-2 col-sm-4">
                <select class="form-control" name="exam-type" v-model='selectedType' @change="changeExamType">
                    <option value="sat">SAT</option>
                    <option value="act">ACT</option>
                    <option value="toefl">TOEFL</option>
                    <option value="ielts">IELTS</option>
                    <option value="ap">AP</option>
                    <option value="sat2">SAT II</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "applicant-exams",
        props: {
            type: {
                required: true
            },
            update: {
                required: false,
                default: false
            },
            applicant: {
                required: false,
                default: 0
            }
        },
        mounted: function () {
            if (this.update) {
                this.$http.get('/api/applicant/' + this.applicant + '/exams').then(response => {
                    this.exams = response.body.data;
                    if (this.type === 'language') {
                        this.selectedType = this.exams[0].type;
                    }
                }, response => {
                    alert('服务器错误，请联系管理员！');
                });
            } else {
                this.create();
                if (this.type === 'language') {
                    this.create();
                }
            }
        },
        data: function () {
            return {
                exams: [],
                examTypes: {
                    "sat": "SAT",
                    "act": "ACT",
                    "ielts": "IELTS",
                    "toefl": "TOEFL",
                    "ap": "AP",
                    "sat2": "SAT II"
                },
                selectedType: 'sat',

            }
        },
        methods: {
            create: function (remark="standard") {
                var examTemplates = {
                    "sat": {
                        "reading": null,
                        "writing": null,
                        "math": null,
                        "essay": {
                            "reading": null,
                            "writing": null,
                            "analysis": null
                        }
                    },
                    "act": {
                        "reading": null,
                        "english": null,
                        "math": null,
                        "science": null
                    },
                    "toefl": {
                        "reading": null,
                        "listening": null,
                        "speaking": null,
                        "writing": null
                    },
                    "ielts": {
                        "reading": null,
                        "listening": null,
                        "speaking": null,
                        "writing": null
                    },
                    "ap": {
                        "subject": null,
                        "total": null
                    },
                    "sat2": {
                        "subject": null,
                        "total": null
                    }
                };
                this.exams.push({
                    'id': 0,
                    "type": this.selectedType,
                    "score": examTemplates[this.selectedType],
                    "remark": remark
                });
                if (remark === 'before') {
                    this.exams.sort(function (e1, e2) {
                        return e1.remark === 'after';
                    });
                }
                console.log(this.exams);
            },
            remove: function (index) {
                this.exams.splice(index, 1);
            },
            changeExamType: function () {
                if (this.type === "language") {
                    this.exams = [];
                    this.create('before');
                    this.create('after');
                }
            }
        }
    }
</script>

<style scoped>

</style>