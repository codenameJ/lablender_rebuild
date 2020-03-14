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
                        <v-col
                            v-for="(item, i) in getassignlabs"
                            :key="i"
                            cols="12"
                        >
                            <v-card>
                                <div
                                    class="d-flex flex-no-wrap justify-space-between"
                                >
                                    <div>
                                        <v-card-title
                                            class="headline"
                                            v-text="getLabName(item.lab_id)"
                                        ></v-card-title>

                                        <v-card-subtitle
                                            v-text="
                                                getProfessorName(item.lab_id)
                                            "
                                        ></v-card-subtitle>
                                    </div>

                                    <v-card-actions>
                                        <v-btn
                                            class="ma-2"
                                            :href="'/ta/lab/' + getCourseId(item.lab_id)"
                                            >Enter This Lab</v-btn
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
        this.$store.dispatch("loadAssigns");
        this.$store.dispatch("loadLabs");
    },
    data: () => ({
        tabs: null
    }),
    created() {},
    methods: {
        getLabName(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.course_name;
        },
        getProfessorName(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.professor_name;
        },
        getCourseId(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.course_id;
        }
    },
    computed: {
        labs() {
            return this.$store.state.labs;
        },
        assigns() {
            return this.$store.state.assigns;
        },
        curta() {
            return this.$store.state.selectedUser;
        },
        getassignlabs() {
            let assignlab =
                this.assigns.filter(
                    assign => assign.ta_id == this.curta.ta.id
                ) || {};
            return assignlab;
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
