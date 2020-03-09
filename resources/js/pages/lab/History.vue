<template>
    <div id="app">
        <v-content>
            <h1>History</h1>
            <v-card>
                <v-data-table
                    :headers="headers"
                    :items="requests"
                    class="elevation-1 txt-title"
                >

                    <template v-slot:item.action="{ item }">
                        <v-btn
                            small
                            rounded
                            class="button-btn-gradient elevation-2"
                            color="success"
                            @click="editItem(item)"
                        >
                            <v-icon small class="mr-2" left
                                >add_circle_outline</v-icon
                            >
                            Lend
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card>
        </v-content>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getRequestData();
    },
    data: () => ({
        headers: [
            // { text: "ID", value: "id" },
            // { text: "Equip ID", value: "Equip_id" },
            { text: "Request ID", value: "request_id" },
            { text: "Student Id", value: "Student_id" },
            { text: "Status", value: "status" },
            // { text: "Lab", value: "Lab_id" },
            // { text: "created at", value: "created_at" },
            // { text: "updated at", value: "updated_at" },
            // { text: "Actions", value: "action", sortable: false }
        ],
        requests: [],
    }),


    created() {
        this.getRequestData();
    },

    methods: {

        getRequestData() {
            axios.get("api/request").then(Response => {
                this.requests = Response.data;
                console.log(this.requests);
            });
        },
    }
};
</script>

<style scoped>
.button-btn-gradient {
    background-color: #0c0b0b;
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}
</style>