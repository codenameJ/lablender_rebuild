<template>
    <div id="app" v-if="curprof">
        <v-container class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                                        ><v-icon class="mr-2">add</v-icon>Add
                                        New Lab</v-btn
                                    >
                                </template>
                                <v-card>
                                    <v-form v-model="valid">
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
                                                        type="number"
                                                        label="Course ID"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.course_name
                                                        "
                                                        :rules="[required('Lab name')]"
                                                        label="Course Name"
                                                    ></v-text-field>
                                                </v-col>
                                                <!-- <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        disabled
                                                        v-model="
                                                            editedItem.professor_name
                                                        "
                                                        label="Professor"
                                                    ></v-text-field>
                                                </v-col> -->
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
                                            :disabled="!valid"
                                            >Save</v-btn
                                        >
                                    </v-card-actions>
                                    </v-form>
                                </v-card>
                            </v-dialog>
                        </v-row>
                    </v-col>
                    <v-row dense>
                        <v-toolbar class="mb-3"
                            ><v-tabs
                                background-color="transparent"
                                v-model="tabs"
                            >
                                <!-- <v-tab style="text-decoration : none;" to=""
                                    >All</v-tab
                                >
                                <v-tabs-slider color="white"></v-tabs-slider> -->
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
                                <v-card class="mb-3">
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
                                            ><v-icon
                                                >delete_outline</v-icon
                                            ></v-btn
                                        >

                                        <v-spacer></v-spacer>
                                        <v-btn
                                            dark
                                            class="ma-2 elevation-2 no-underline white--text"
                                            color="#1a73e8"
                                            :href="
                                                '/professor/lab/' +
                                                    item.course_id +
                                                    '/home'
                                            "
                                            ><v-icon class="mr-2">launch</v-icon>Enter Lab</v-btn
                                        >
                                    </v-card-actions>
                                </v-card>
                            </div>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-container>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadLabs");
        this.seteditname();
        this.setdefaultname();
    },
    data: () => ({
        valid: false,
        required(propertyType) {
                return v =>
                        (v && v.length > 0) || (propertyType) + " is required";
        },
        proflab: {},
        professorname: "",
        dialog: false,
        search: "",
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
    created() {},
    methods: {
        seteditname() {
            this.editedItem.professor_name = this.curprof.name;
            return this.editedItem.professor_name;
        },
        setdefaultname() {
            this.defaultItem.professor_name = this.curprof.name;
            return this.defaultItem.professor_name;
        },
        editItem(item) {
            this.editedIndex = this.labs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.labs.indexOf(item);
            if (
                confirm(
                    "Are you sure you want to delete " + item.course_name + " ?"
                ) &&
                this.labs.splice(index, 1)
            ) {
                axios
                    .delete("/api/lab/" + item.id)
                    .then(response => console.log(response.data));

                this.$store.dispatch("loadLabs");
            }
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
        }
    },
    computed: {
        labs() {
            return this.$store.state.labs;
        },
        curprof() {
            return this.$store.state.selectedUser;
        },
        professorlab() {
            let sellab =
                this.labs.filter(
                    lab => lab.professor_name == this.curprof.name
                ) || {};
            return sellab;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterLab: function() {
            return this.professorlab.filter(lab => {
                return lab.course_name.match(this.search);
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
