<template>
    <v-content>
        <v-container class="mx-auto">
            <div class="row justify-content-center">
                <div class="col-12">
                    <v-col cols="12">
                        <v-row justify="end">
                            <v-spacer></v-spacer>
                            <v-dialog
                                class="mx-auto"
                                max-width="800"
                                v-model="dialog"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        class="white--text"
                                        outlined
                                        v-on="on"
                                        ><v-icon class="mr-2">add</v-icon>Add
                                        Post</v-btn
                                    >
                                </template>
                                <v-card>
                                    <v-card-text>
                                        <v-container>
                                            <v-col>
                                                <v-col cols="12">
                                                    <v-text-field
                                                        color="teal"
                                                        v-model="
                                                            editedItem.announcement_name
                                                        "
                                                    >
                                                        <template v-slot:label>
                                                            <div>
                                                                Announcement
                                                                Subject
                                                            </div>
                                                        </template>
                                                    </v-text-field>
                                                </v-col>
                                            </v-col>
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-textarea
                                                        v-model="
                                                            editedItem.describe
                                                        "
                                                    >
                                                        <template v-slot:label>
                                                            <div>
                                                                Type
                                                                something...
                                                            </div>
                                                        </template>
                                                    </v-textarea>
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
                        <v-col cols="12">
                            <div
                                v-for="(item, i) in Announcementsinlab"
                                :key="i"
                            >
                                <v-card class="my-2">
                                    <div
                                        class="d-flex flex-no-wrap justify-space-between"
                                    >
                                        <div>
                                            <v-card-title
                                                class="headline"
                                                v-text="item.announcement_name"
                                            ></v-card-title>

                                            <v-card-subtitle
                                                v-text="item.describe"
                                            ></v-card-subtitle>
                                        </div>
                                    </div>

                                    <v-card-actions>
                                        <span class="ml-2">{{
                                            getAnnounceBy(item.user_id)
                                        }}</span>
                                        <v-spacer />
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
        this.$store.dispatch("loadAnnouncements");
        this.seteditlab();
        this.setdefaultlab();
        this.seteditUser();
        this.setdefaultUser();
    },
    data: () => ({
        dialog: false,
        search: "",
        tabs: null,
        editedIndex: -1,
        editedItem: {
            announcement_name: "",
            describe: "",
            lab_id: "",
            user_id: ""
        },
        defaultItem: {
            announcement_name: "",
            describe: "",
            lab_id: "",
            user_id: ""
        }
    }),
    created() {},
    methods: {
        seteditlab() {
            this.editedItem.lab_id = this.curlab.id;
            return this.editedItem.lab_id;
        },
        setdefaultlab() {
            this.defaultItem.lab_id = this.curlab.id;
            return this.defaultItem.lab_id;
        },
        seteditUser() {
            this.editedItem.user_id = this.usernow.id;
            return this.editedItem.user_id;
        },
        setdefaultUser() {
            this.defaultItem.user_id = this.usernow.id;
            return this.defaultItem.user_id;
        },
        getAnnounceBy(userid) {
            let announcuser = this.users.find(user => user.id == userid) || {};
            return announcuser.name;
        },
        editItem(item) {
            this.editedIndex = this.announcements.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            const index = this.announcements.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.announcements.splice(index, 1);

            axios
                .delete("/api/announcement/" + item.id)
                .then(response => console.log(response.data));

            this.$store.dispatch("loadAnnouncements");
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
                Object.assign(
                    this.announcements[this.editedIndex],
                    this.editedItem
                );
                axios
                    .put(
                        "/api/announcement/" + this.editedItem.id,
                        this.editedItem
                    )
                    .then(response => console.log(response.data));
            } else {
                this.announcements.push(this.editedItem);
                axios
                    .post("/api/announcement/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
            this.$store.dispatch("loadAnnouncements");
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        },
        usernow() {
            return this.$store.state.selectedUser;
        },
        announcements() {
            return this.$store.state.announcements;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        Announcementsinlab() {
            let selannounce =
                this.announcements.filter(
                    announcement => announcement.lab_id == this.curlab.id
                ) || {};
            return selannounce;
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
