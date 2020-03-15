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
                        <v-col v-for="(item, i) in getta" :key="i" cols="12">
                            <div v-for="(lab, i) in item.labs" :key="i">
                                <v-card>
                                    <div
                                        class="d-flex flex-no-wrap justify-space-between"
                                    >
                                        <div>
                                            <v-card-title
                                                class="headline"
                                                v-text="lab.course_name"
                                            ></v-card-title>

                                            <v-card-subtitle
                                                v-text="lab.professor_name"
                                            ></v-card-subtitle>
                                        </div>

                                        <v-card-actions>
                                            <v-btn
                                                class="ma-2"
                                                :href="
                                                    '/ta/lab/' + lab.course_id
                                                "
                                                >Enter This Lab</v-btn
                                            >
                                        </v-card-actions>
                                    </div>
                                </v-card>
                            </div>
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
        this.$store.dispatch("loadTas");
    },
    data: () => ({
        labs: [],
        tabs: null
    }),
    created() {},
    methods: {
    },
    computed: {
        tas() {
            return this.$store.state.tas;
        },
        currentuser() {
            return this.$store.state.selectedUser;
        },
        getta() {
            let talab =
                this.tas.filter(ta => ta.id == this.currentuser.ta.id) || {};
            return talab;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        }
    }
};
</script>
