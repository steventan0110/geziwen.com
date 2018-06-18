<template>
    <div class="">
        <div class="form-inline">
            <label for="search-box">请输入关键字</label>
            <input id="search-box" type="text" class="form-control mx-sm-4" aria-describedby="search-help-inline" v-model="query"/>
            <small id="search-help-inline" class="text-muted">
                输入关键字，搜索案例、机构和老师。
            </small>
        </div>
        <div class="mt-4">
            <!--Applicant Index Begins-->

            <ais-index :app-id="algoliaAppId"
                       :api-key="algoliaApiKey"
                       :query="query"
                       :index-name="scoutPrefix + 'applicants'">
                <ais-results>
                    <template slot-scope="{ result }">
                        <div class="media">
                            <a :href="agencyHomePage(result.agency.id)">
                                <img class="ml-2 mr-3 img-thumbnail border border-info" width="100px"
                                     :src="'/storage/' + result.agency.logo" alt="所属机构Logo">
                            </a>
                            <div class="media-body border-bottom border-grey">
                                <h5 class="mt-0">{{ result.surname }} |
                                    <a :href="agencyHomePage(result.agency.id)">{{ result.agency.name }}</a>
                                </h5>
                                <p v-if="result.type === 'standard'">
                                    <strong>录取学校：</strong>
                                    <span v-for="offer in result.offers">
                                    <span class="badge badge-pill badge-info">{{ offer.plan_shorthand }}</span>
                                    {{ offer.university }}
                                </span>
                                </p>
                                <p v-else>
                                    <strong>培训结果：</strong>
                                    <span v-for="exam in result.exams" v-if="exam.remark === 'after'">
                                    <span class="badge badge-pill badge-info">
                                        {{ exam.type.toUpperCase() }}
                                        <span v-if="exam.type === 'ap' || exam.type === 'sat2'">
                                            {{ exam.score.subject}}
                                        </span>
                                    </span>
                                    {{ exam.score.total }}
                                </span>
                                </p>
                                <p>{{ result.introduction }}</p>
                            </div>
                        </div>
                    </template>
                </ais-results>
            </ais-index>

            <!--Applicants Index Ends-->
            <!--Teachers Index Begins-->

            <ais-index :app-id="algoliaAppId"
                       :api-key="algoliaApiKey"
                       :query="query"
                       :index-name="scoutPrefix + 'teachers'">
                <ais-results>
                    <template slot-scope="{ result }">
                        <div class="media">
                            <a :href="teacherHomePage(result.id)">
                                <img class="ml-2 mr-3 img-thumbnail border border-info" width="100px"
                                     :src="'/storage/' + result.picture" alt="教师头像">
                            </a>
                            <div class="media-body border-bottom border-grey">
                                <h5 class="mt-0">
                                    <a class="info" :href="teacherHomePage(result.id)">{{ result.name }}</a> |
                                    <a class="successAg" :href="agencyHomePage(result.agency.id)">{{ result.agency.name }}</a>
                                </h5>
                                {{ result.introduction }}
                            </div>
                        </div>
                    </template>
                </ais-results>
            </ais-index>

            <!--Teachers Index Ends-->
            <!--Agencies Index Begins-->

            <ais-index :app-id="algoliaAppId"
                       :api-key="algoliaApiKey"
                       :query="query"
                       :index-name="scoutPrefix + 'agencies'">
                <ais-results>
                    <template slot-scope="{ result }">
                        <div class="media">
                            <a :href="agencyHomePage(result.id)">
                                <img class="ml-2 mr-3 img-thumbnail border border-info" width="100px"
                                     :src="'/storage/' + result.logo" alt="机构Logo">
                            </a>
                            <div class="media-body border-bottom border-grey">
                                <h5 class="mt-0">
                                    <a :href="agencyHomePage(result.id)">{{ result.name }}</a>
                                </h5>
                                {{ result.introduction }}
                            </div>
                        </div>
                    </template>
                </ais-results>
            </ais-index>

            <!--Agencies Index Ends-->
        </div>
    </div>
</template>

<script>
    export default {
        mounted: function () {
            console.log('Component mounted.');
        },
        methods: {
            agencyHomePage: function (id) {
                return "agency/" + id;
            },
            teacherHomePage: function (id) {
                return "teacher/" + id;
            }
        },
        props: {
            algoliaAppId: '',
            algoliaApiKey: '',
            scoutPrefix: '',
            query: '',
        }
    }
</script>