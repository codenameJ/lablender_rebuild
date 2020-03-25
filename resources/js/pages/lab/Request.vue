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
                                    label="Search by request id or student id..."
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
                            <v-tab>
                                Wait
                            </v-tab>
                            <v-tab>
                                Ready
                            </v-tab>
                            <v-tab>
                                Recieved
                            </v-tab>

                            <!-- วนลูป status ให้หน่อยสิจ๊ะที่รัก
                                <v-tab v-for="item in items" :key="item">
                                {{ item }}
                            </v-tab> 
                            -->

                        </v-tabs>
                    </template>

                    <v-row>
                        <v-col cols="12">
                            <div
                                v-for="(item, i) in Requestlistsinlab"
                                :key="i"
                            >
                                <v-card class="mb-5">
                                    <v-row>
                                        <v-card-title
                                            class="ml-4"
                                            v-text="'Request No. ' + item.id"
                                        ></v-card-title>
                                        <v-spacer></v-spacer>
                                        <v-card-actions class=" mr-5">
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
                                            v-text="
                                                'Lending date : ' + item.created_at
                                            "
                                        ></v-card-subtitle>
                                    </v-row>

                                    <v-row>
                                        <v-card-subtitle
                                            class="ml-4"
                                            v-text="
                                                'Lend by : ' +
                                                    getstudent(item.student_id)
                                            "
                                        ></v-card-subtitle>
                                    </v-row>

                                <v-row>
                                    <v-card-subtitle
                                        class="ml-4"
                                        v-text=" 'Status : '"
                                    ></v-card-subtitle>
                                    <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
                                </v-row>
                                    <!-- <v-row>
                                        <v-card-subtitle class="ml-4">
                                            <v-select
                                                label="Status"
                                                :items="ReqStatus"
                                                v-model="editedItem.status"
                                                item-text="text"
                                                width="10"
                                            >
                                                dense ></v-select
                                            ></v-card-subtitle
                                        >
                                    </v-row> -->
                                    <div class="col-12">
                                    <v-data-table
                                        class="mt-2"
                                        :headers="detail_headers"
                                        :items="item.request_detail"
                                        hide-default-footer
                                    >
                                    <template #item.equipment_name="{item}">{{getEquipName(item.equipment_id)}}</template>
                                    </v-data-table>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-card-subtitle class="ml-4">
                                            <v-select
                                                label="Status"
                                                :items="ReqStatus"
                                                v-model="editedItem.status"
                                                item-text="text"
                                                width="10"
                                            >
                                                dense ></v-select
                                            ></v-card-subtitle
                                        >
                                        <v-btn
                                            outlined
                                            color="blue darken-1"
                                            @click="save(item)"
                                            >Save</v-btn
                                        >
                                    </v-card-actions></div>
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
        ReqStatus: [
            { value: 1, text: "wait" },
            { value: 2, text: "ready" },
            { value: 3, text: "recieve" }
        ],
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Equipment Name", value: "equipment_name"},
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
        getColor (status) {
        if (status == "wait") return 'blue-grey'
        else if (status == "ready") return 'green'
        else if (status == "broken") return 'red'
        else if (status == "missing") return 'orange accent-2'
        else return '#CE93D8'
      },
        getstudent(stdid) {
            let thisuser =
                this.users.find(user => {
                    return user.student;
                }) || {};
            return thisuser.name;
        },
        getEquipName(equipId) {
            let equipname =
                this.equipments.find(equip => equip.id == equipId) || {};
            return equipname.equip_name;
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
        save(item) {
            console.log(this.editedItem);
            axios
                .put("/api/requestlist/" + item.id, {
                    status: this.editedItem.status
                })
                .then(response => console.log(response.data));
            this.$store.dispatch("loadRequest_lists");
        }
    },
    computed: {
        equipments() {
            return this.$store.state.equipments;
        },
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
        }
        // filterRequestlists: function() {
        //     return this.Requestlistsinlab.student.filter(requestlist => {
        //         return requestlist.st
        //             .toLowerCase()
        //             .includes(this.search.toLowerCase());
        //     });
        // }
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
