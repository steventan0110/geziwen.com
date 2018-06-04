<template>
    <div class="container">
        <ais-index :app-id="algoliaAppId"
                   :api-key="algoliaApiKey"
                   :index-name="algoliaIndex">
            <ais-input :placeholder="placeholder" class="form-control"></ais-input>
            <!--<hr class="my-4">-->
            <ais-results>
                <template slot-scope="{ result }">
                    <div class="media my-4 border-top pt-4">
                        <img v-if="searchType != 1" class="mr-3 rounded-circle border border-info" width="64px" alt="logo"
                             src="https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG/tam-ogel/a03f306fc98a8e119dae9d7c5510b656_121_121.jpg">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">
                                <span v-if="searchType == 0">
                                    <a :href="agencyHomePage(result.id)">{{ result.name }}</a>
                                </span>
                                <span v-else-if="searchType == 2">
                                    <a :href="teacherHomePage(result.id)">{{ result.name }}</a> from <strong>{{ result.agency.name }}</strong>
                                </span>
                                <span v-else>
                                    {{ result.surname }} from <strong>{{ result.agency.name }}</strong>
                                </span>
                            </h5>
                            <p v-if="searchType != 1">{{ result.introduction }}</p>
                            <div v-else>
                                <!-- TODO: Decompose applicant and add detailed view  -->
                                {{ result.offers[0].university }} -- {{ result.offers[0].plan + " (" + result.offers[0].plan_shorthand + ")" }}
                            </div>
                        </div>
                    </div>
                </template>
            </ais-results>
            <ais-pagination :padding="5" class="pagination text-center"></ais-pagination>

        </ais-index>
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
            algoliaIndex: ''
        },
        computed: {
            placeholder: function () {
                switch (this.algoliaIndex) {
                    case 'agencies_index': {
                        return '搜索中介';
                    }
                    case 'applicants_index': {
                        return '搜索案例';
                    }
                    case 'teachers_index': {
                        return '搜索老师'
                    }
                }
            },
            searchType: function () {
                switch (this.algoliaIndex) {
                    case 'agencies_index': {
                        return 0;
                    }
                    case 'applicants_index': {
                        return 1;
                    }
                    case 'teachers_index': {
                        return 2;
                    }
                }
            }
        }
    }
</script>