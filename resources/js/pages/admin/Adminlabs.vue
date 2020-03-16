<template>
    <v-container class="mx-auto">
        <div class="row justify-content-center">
            <div class="col-12">
                <v-col cols="12">
                    <v-row justify="end">
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    color="primary"
                                    class="white--text"
                                    outlined
                                    v-on="on"
                                    ><v-icon class="mr-2">add</v-icon>Add New
                                    Lab</v-btn
                                >
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{
                                        formTitle
                                    }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.course_id
                                                    "
                                                    label="Course ID"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.course_name
                                                    "
                                                    label="Course Name"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.professor_name
                                                    "
                                                    label="Professor"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        @click="close"
                                        >Cancel</v-btn
                                    >
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        @click="save"
                                        >Save</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-row>
                </v-col>
                <v-row dense>
                    <v-col cols="12"
                        >
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
                    </v-toolbar></v-col>

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
                                        class="ma-2 elevation-4 no-underline"
                                        @click="editItem(item)"
                                        ><v-icon>mdi-pencil</v-icon></v-btn
                                    >
                                    <v-btn
                                        color="error"
                                        fab
                                        x-small
                                        dark
                                        outlined
                                        class="ma-2 elevation-4 no-underline"
                                        @click="deleteItem(item)"
                                        ><v-icon>delete_outline</v-icon></v-btn
                                    >

                                    <v-spacer></v-spacer>
                                    <v-btn
                                        dark
                                        class="ma-2 btn-gradient no-underline white--text"
                                        :href="'/admin/lab/' + item.course_id + '/home'"
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
export default {
    mounted() {
        // this.getLabData();
        this.$store.dispatch("loadLabs");
        // this.$store.dispatch("loadEquipments");
    },
    data: () => ({
        dialog: false,
        search: "",
        // labs: [],
        tabs: null,
        editedIndex: -1,
        editedItem: {
            course_id: 0,
            course_name: "",
            professor_name: ""
        },
        defaultItem: {
            course_id: 0,
            course_name: "",
            professor_name: ""
        }
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
        editItem(item) {
            this.editedIndex = this.labs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.labs.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.labs.splice(index, 1);

            axios
                .delete("/api/lab/" + item.id)
                .then(response => console.log(response.data));

            this.$store.dispatch("loadLabs");
        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.labs[this.editedIndex], this.editedItem);
                axios
                    .put("/api/lab/" + this.editedItem.id, this.editedItem)
                    .then(response => console.log(response.data));
            } else {
                this.labs.push(this.editedItem);
                axios
                    .post("/api/lab/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
            this.$store.dispatch("loadLabs");
            // location.reload();
        }
    },
    computed: {
        // ...mapState([
        //     'labs'
        // ]),
        labs() {
            return this.$store.state.labs;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterLab: function() {
            return this.labs.filter(lab => {
                return lab.course_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        formTitle() {
            return this.editedIndex === -1 ? "New Lab" : "Edit Lab";
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
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
