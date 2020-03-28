<template
    ><v-row>
        <v-col cols="12">
            <div v-for="(item, i) in filterReady" :key="i">
                <v-card class="mb-5">
                    <v-row>
                        <v-card-title
                            class="ml-4"
                            v-text="'Request No. ' + item.id"
                        ></v-card-title>
                        <v-spacer></v-spacer>
                        <v-card-actions class=" mr-5">
                            <v-btn
                                v-if="item.status == 'wait'"
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
                            v-text="'Lending date : ' + item.created_at"
                        ></v-card-subtitle>
                    </v-row>

                    <v-row>
                        <v-card-subtitle
                            class="ml-4"
                            v-text="'Lend by : ' + getstudent(item.student_id)"
                        ></v-card-subtitle>
                    </v-row>

                    <v-row>
                        <v-card-subtitle
                            class="ml-4"
                            v-text="'Status : '"
                        ></v-card-subtitle>
                        <v-chip :color="getColor(item.status)" dark>{{
                            item.status
                        }}</v-chip>
                    </v-row>
                    <div class="col-12">
                        <v-data-table
                            class="mt-2"
                            :headers="detail_headers"
                            :items="item.request_detail"
                            hide-default-footer
                        >
                            <template #item.equipment_name="{item}">{{
                                getEquipName(item.equipment_id)
                            }}</template>
                        </v-data-table>
                        <v-card-actions>
                            <v-btn
                                outlined
                                color="blue-grey"
                                @click="wait(item)"
                                >wait</v-btn
                            >
                            <v-spacer></v-spacer>
                            <v-btn
                                outlined
                                color="purple lighten-2"
                                @click="receive(item)"
                                >receive</v-btn
                            >
                        </v-card-actions>
                    </div>
                </v-card>
            </div>
        </v-col>
    </v-row>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadRequest_lists");
    },
    data: () => ({
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Equipment Name", value: "equipment_name" },
            { text: "Len Qty", value: "len_qty" }
        ],
        editedIndex: -1,
        waitstatus: "wait",
        receivestatus: "receive"
    }),
    created() {},
    methods: {
        getColor(status) {
            if (status == "wait") return "blue-grey";
            else if (status == "ready") return "green";
            else if (status == "broken") return "red";
            else if (status == "missing") return "orange accent-2";
            else if (status == "returned") return "#1a73e8";
            else return "#CE93D8";
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
        wait(item) {
            axios
                .put("/api/requestlist/" + item.id, {
                    status: this.waitstatus
                })
                .then(response => console.log(response.data));
            this.$store.dispatch("loadRequest_lists");
        },
        receive(item) {
            axios
                .put("/api/requestlist/" + item.id, {
                    status: this.receivestatus
                })
                .then(response => console.log(response.data));
            this.$store.dispatch("loadRequest_lists");
        },
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
        },
        filterReady() {
            let readylist =
                this.Requestlistsinlab.filter(
                    list => list.status == "ready"
                ) || {};
            return readylist;
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
