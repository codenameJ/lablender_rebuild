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
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>
                            </v-toolbar>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="12">
                            <div
                                v-for="(item, i) in Requestlistsinlab"
                                :key="i"
                            >
                                <v-card class="my-2">
                                    <v-row>
                                        <v-card-title
                                            class="ml-4"
                                            v-text="item.id"
                                        ></v-card-title>
                                        <v-spacer></v-spacer>
                                        <v-card-actions class=" mr-5">
                                            <!-- <v-btn
                                                color="primary"
                                                fab
                                                x-small
                                                dark
                                                outlined
                                                class="elevation-4 no-underline"
                                                @click="editItem(item)"
                                                ><v-icon
                                                    >mdi-pencil</v-icon
                                                ></v-btn
                                            > -->
                                            <v-btn
                                                color="error"
                                                fab
                                                x-small
                                                dark
                                                outlined
                                                class="elevation-4 no-underline"
                                                @click="deleteItem(item)"
                                            >
                                                <v-icon>delete_outline</v-icon>
                                            </v-btn>
                                        </v-card-actions>
                                    </v-row>

                                    <!-- --------------------------------------------------------------------- -->
                                    <v-row>
                                        <v-card-subtitle
                                            class="ml-4"
                                            v-text="getstudent(item.student_id)"
                                        ></v-card-subtitle>
                                    </v-row>

                                    <v-row>
                                        <v-card-subtitle class="ml-4">
                                            <v-select
                                                label="Status"
                                                :items="[
                                                    '',
                                                    'wait',
                                                    'ready',
                                                    'recieve'
                                                ]"
                                                width="10"
                                                dense
                                            ></v-select
                                        ></v-card-subtitle>
                                    </v-row>
                                    <!-- <v-card-subtitle
                                                v-text="item.status"
                                            ></v-card-subtitle> -->

                                    <v-data-table
                                        :headers="detail_headers"
                                        :items="item.request_detail"
                                        hide-default-footer
                                    >
                                    </v-data-table>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="save"
                                            >Save</v-btn
                                        >
                                    </v-card-actions>
                                </v-card>
                            </div>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-container>
    </v-content>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadRequest_lists");
    },
    data: () => ({
        dialog: false,
        search: "",
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Len Qty", value: "len_qty" }
        ],
        editedIndex: -1,
        editedItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: ""
        },
        defaultItem: {
            equip_id: "",
            equip_name: "",
            equip_qty: 0,
            lab_id: ""
        }
    }),
    created() {},
    methods: {
        getstudent(stdid) {
            let thisuser =
                this.users.find(user => {
                    return user.student;
                }) || {};
            return thisuser.name;
        },
        deleteItem(item) {
            const index = this.request_lists.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.request_lists.splice(index, 1);

            axios
                .delete("/api/requestlist/" + item.id)
                .then(response => console.log(response.data));

            this.$store.dispatch("loadRequest_lists");
        },
        save(){

        },
    },
    computed: {
        users() {
            return this.$store.state.users;
        },
        request_lists() {
            return this.$store.state.request_lists;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        Requestlistsinlab() {
            let selrequestlist =
                this.request_lists.filter(
                    request_list => request_list.lab_id == this.curlab.id
                ) || {};
            return selrequestlist;
        },
        filterRequestlists: function() {
            return this.Requestlistsinlab.filter(requestlist => {
                return requestlist.student_id
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
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
