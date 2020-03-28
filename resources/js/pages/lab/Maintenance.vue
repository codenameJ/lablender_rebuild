<template>
    <v-content>
        <v-container class="my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <v-row dense>
                        <v-col cols="12">
                            <v-toolbar>
                                <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search by student id..."
                                    single-line
                                    hide-details
                                ></v-text-field>
                            </v-toolbar>
                        </v-col>
                    </v-row>

                    <template>
                        <v-tabs
                            fixed-tabs
                            color="#1a73e8"
                            background-color="white"
                            class="mt-3 mb-1"
                        >
                            <v-tab @click="setcomp('missinglist')">missing</v-tab>
                            <v-tab @click="setcomp('brokenlist')">broken </v-tab>
                        </v-tabs>
                    </template>
                    <missinglist v-if="currentComp=='missinglist'" />
                    <brokenlist v-if="currentComp=='brokenlist'" />
                </div>
            </div>
        </v-container>
    </v-content>
</template>

<script>
import missinglist from "./maintenancecomponent/missing.vue";
import brokenlist from "./maintenancecomponent/broken.vue";
export default {
    components: {
        'missinglist': missinglist,
        'brokenlist': brokenlist,
    },
    mounted() {
        this.$store.dispatch("loadRequest_lists");
    },
    data: () => ({
        currentComp: "missinglist",
        search: "",
        ReqStatus: [
            { value: 1, text: "wait" },
            { value: 2, text: "ready" },
            { value: 3, text: "recieve" }
        ],
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Equipment Name", value: "equipment_name" },
            { text: "Len Qty", value: "len_qty" }
        ],
        editedIndex: -1,
        editedItem: {
            status: ""
        },
        defaultItem: {
            status: ""
        }
    }),
    created() {},
    methods: {
        setcomp(compname) {
            this.currentComp = compname;
        },
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
        },
    },
    watch: {}
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
