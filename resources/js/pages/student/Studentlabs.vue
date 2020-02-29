<template>
    <v-container class="my-5">
        <v-card>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h1>Our Labs</h1>
                    <v-toolbar
                        ><v-tabs background-color="transparent" v-model="tabs">
                            <v-tab style="text-decoration : none;" to=""
                                >All</v-tab
                            >
                            <v-tab style="text-decoration : none;" to=""
                                >Enrolled</v-tab
                            >
                            <v-tab style="text-decoration : none;" to=""
                                >Pending</v-tab
                            >
                            <v-tabs-slider
                                color="white"
                            ></v-tabs-slider> </v-tabs
                    ></v-toolbar>
                    <v-row dense>
                        <v-col v-for="(item, i) in labs" :key="i" cols="12">
                            <v-card>
                                <div
                                    class="d-flex flex-no-wrap justify-space-between"
                                >
                                    <div>
                                        <v-card-title
                                            class="headline"
                                            v-text="item.course_name"
                                        ></v-card-title>

                                        <v-card-subtitle
                                            v-text="item.professor_name"
                                        ></v-card-subtitle>
                                    </div>

                                    <v-card-actions>
                                        <v-btn class="ma-2" :href="/lab/ + item.course_id"
                                            >Join This Lab</v-btn
                                        >
                                    </v-card-actions>

                                    <!-- <v-avatar class="ma-3" size="125" tile>
                            <v-img :src="item.src"></v-img>
                        </v-avatar> -->
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-card>
    </v-container>
</template>

<script>
export default {
    mounted() {
        this.getLabData();
    },
    data: () => ({
        labs: [],
        tabs: null
    }),
    created() {
        this.getLabData();
    },
    methods: {
        getLabData() {
            axios.get("/api/lab").then(Response => {
                this.labs = Response.data;
                console.log(this.labs);
            });
        }
    },
    computed: {
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        }
    }
};
</script>
