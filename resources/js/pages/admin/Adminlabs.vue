<template>
    <v-container class="my-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <v-col cols="12">
                    <v-row justify="end">
                        <v-spacer></v-spacer>
                        <v-btn color="primary" class="white--text" outlined
                            ><v-icon class="mr-2">add</v-icon>Add New Lab</v-btn
                        >
                    </v-row>
                </v-col>
                <v-row dense>
                    <v-toolbar
                        ><v-tabs background-color="transparent" v-model="tabs">
                            <v-tab style="text-decoration : none;" to=""
                                >All</v-tab
                            >
                            <v-tabs-slider color="white"></v-tabs-slider>
                        </v-tabs>
                        <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-toolbar>
                    <v-col cols="12">
                        <div v-for="(item, i) in filterLab" :key="i">
                            <v-card class="my-2">
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
                                </div>

                                <v-card-actions>
                                    <v-btn
                                        color="primary"
                                        fab
                                        x-small
                                        dark
                                        outlined
                                        class="ma-2 no-underline"
                                        :href="'/admin/lab/' + item.course_id"
                                        ><v-icon>mdi-pencil</v-icon></v-btn
                                    >
                                    <v-btn
                                        color="error"
                                        fab
                                        x-small
                                        dark
                                        outlined
                                        class="ma-2 elevation-4 no-underline"
                                        :href="'/admin/lab/' + item.course_id"
                                        ><v-icon>delete_outline</v-icon></v-btn
                                    >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        dark
                                        class="ma-2 btn-gradient no-underline white--text"
                                        :href="'/admin/lab/' + item.course_id"
                                        >Enter This Lab</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </div>
    </v-container>
</template>

<script>
import {mapState} from 'vuex'
export default {
    mounted() {
        // this.getLabData();
        this.$store.dispatch('loadLabs');
    },
    data: () => ({
        search: "",
        lab: [],
        tabs: null
    }),
    created() {
        // this.getLabData();
    },
    methods: {
        // getLabData() {
        //     axios.get("/api/lab").then(Response => {
        //         this.labs = Response.data;
        //         console.log(this.labs);
        //     });
        // },
    },
    computed: {
        ...mapState([
            'labs'
        ]),
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterLab: function() {
            return this.labs.filter(lab => {
                return lab.course_name.match(this.search);
            });
        },
    }
};
</script>

<style scoped>
.btn-gradient {
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}

.blackhref {
    text-decoration: none;
    color: #000000;
}

.whitehref {
    text-decoration: none;
    color: #ffffff;
}

.no-underline {
    text-decoration: none;
}
</style>
