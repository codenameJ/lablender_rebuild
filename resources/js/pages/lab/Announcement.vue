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
                                :retain-focus="false"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="#1a73e8"
                                        outlined
                                        v-on="on"
                                        v-if="usernow.type != 'student'"
                                        ><v-icon class="mr-2">add</v-icon>Add
                                        Post</v-btn
                                    >
                                </template>
                                <v-card>
                                    <v-row class="mr-5 ml-5">
                                        <v-img
                                            class="mx-auto"
                                            style="width: 30%;
                                                    max-width: 240px;
                                                    height: auto;"
                                            v-if="editedItem.picture_path"
                                            :src="
                                                '/storage/' +
                                                    editedItem.picture_path
                                            "
                                        />
                                    </v-row>
                                    <v-row>
                                        <input
                                            class="my-4 mx-auto"
                                            id="uploadImage"
                                            type="file"
                                            @change="onImageChange"
                                        />
                                    </v-row>
                                    <v-row>
                                        <v-img
                                            class="mx-auto"
                                            style="width: 30%;
                                                    max-width: 240px;
                                                    height: auto;"
                                            :src="image"
                                            v-if="image"
                                        />
                                    </v-row>
                                    <v-card-text>
                                        <v-container>
                                            <h2 color="#212121" class="my-4">
                                                Add Announcement
                                            </h2>
                                            <v-text-field
                                                color="#1a73e8"
                                                v-model="
                                                    editedItem.announcement_name
                                                "
                                            >
                                                <template v-slot:label>
                                                    <div>
                                                        Announcement Subject
                                                    </div>
                                                </template>
                                            </v-text-field>
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
                                            color="#1a73e8"
                                            text
                                            @click="close"
                                            >Cancel</v-btn
                                        >
                                        <v-btn
                                            class="white--text"
                                            color="#1a73e8"
                                            @click="save"
                                            >Save</v-btn
                                        >
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-row>
                    </v-col>

                    <v-dialog v-model="photoDialog" max-width="1500px">
                <v-card>
                    <v-card-text>
                        <v-container>
                            <img
                                :src="
                                    '/storage/' + this.pictureZoom.picture_path
                                "
                                width="100%"
                            />
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-dialog>

                    <v-row dense>
                        <v-col cols="12">
                            <div v-if="Announcementsinlab.length == 0">
                                <v-row>
                                    <v-img
                                        class="mx-auto mb-4"
                                        style="max-width: 35%;height: auto;"
                                        src="/img/nodata.png"
                                    ></v-img>
                                </v-row>
                                <v-row>
                                    <span class="mx-auto mb-1 title"
                                        >No announcement posted.</span
                                    >
                                </v-row>
                                <v-row>
                                    <span
                                        style="font-family:Prompt;"
                                        class="mx-auto subheading grey--text"
                                        >ยังไม่มีประกาศในห้องปฎิบัติการนี้</span
                                    >
                                </v-row>
                            </div>
                            <div v-else>
                                <div
                                    v-for="(item, i) in Announcementsinlab"
                                    :key="i"
                                >
                                    <v-card class="mb-4">
                                        <v-card-actions>
                                            <v-card-text>
                                                <v-card-title
                                                    class="headline black--text mb-2"
                                                >
                                                    {{ item.announcement_name }}

                                                    <v-spacer />
                                                    <template
                                                        v-if="
                                                            usernow.type !=
                                                                'student'
                                                        "
                                                    >
                                                        <v-btn
                                                            color="primary"
                                                            fab
                                                            x-small
                                                            dark
                                                            outlined
                                                            class="ma-2 elevation-4 no-underline"
                                                            @click="
                                                                editItem(item)
                                                            "
                                                            ><v-icon
                                                                >mdi-pencil</v-icon
                                                            ></v-btn
                                                        >
                                                        <v-btn
                                                            color="error"
                                                            fab
                                                            x-small
                                                            dark
                                                            outlined
                                                            class="ma-2 elevation-4 no-underline"
                                                            @click="
                                                                deleteItem(item)
                                                            "
                                                            ><v-icon
                                                                >delete_outline</v-icon
                                                            ></v-btn
                                                        ></template
                                                    >
                                                </v-card-title>
                                                <v-card-subtitle
                                                    style="font-size:17px; color:#424242;"
                                                >
                                                    {{ item.describe }}
                                                    <br />
                                                    <v-img
                                                        class="mt-4"
                                                        v-if="item.picture_path"
                                                        style="width: 30%;
                                                        max-width: 240px;
                                                        height: auto;"
                                                        :src="
                                                            '/storage/' +
                                                                item.picture_path
                                                        "
                                                        @click="(photoDialog = true), zoom(item)"
                                                    />
                                                </v-card-subtitle>
                                            </v-card-text>
                                        </v-card-actions>
                                        <v-divider> </v-divider>
                                        <v-row
                                            ><v-card-subtitle
                                                class="ml-9 mb-4"
                                                style="font-size:15px; color: #9E9E9E;"
                                                ><b>{{
                                                    "Posted by : " +
                                                        getAnnounceBy(
                                                            item.user_id
                                                        )
                                                }}</b
                                                ><br />
                                                {{
                                                    item.announcement_name
                                                }}</v-card-subtitle
                                            >
                                        </v-row>
                                    </v-card>
                                </div>
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
        photoDialog: false,
        pictureZoom: {},
        search: "",
        tabs: null,
        today: new Date(),
        editedIndex: -1,
        picture_path: null,
        image: null,
        editedItem: {
            announcement_name: "",
            describe: "",
            lab_id: "",
            user_id: "",
            picture_path: null
        },
        defaultItem: {
            announcement_name: "",
            describe: "",
            lab_id: "",
            user_id: "",
            picture_path: null
        }
    }),
    created() {},
    methods: {
        zoom(val) {
            this.pictureZoom = val;
        },
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
            if (
                confirm("Are you sure you want to delete this item?") &&
                this.announcements.splice(index, 1)
            ) {
                axios
                    .delete("/api/announcement/" + item.id)
                    .then(response => console.log(response.data));
            }

            this.$store.dispatch("loadAnnouncements");
        },

        close() {
            this.picture_path = null;
            this.image = null;
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        async save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.announcements[this.editedIndex],
                    this.editedItem
                );
                await axios
                    .put("/api/announcement/" + this.editedItem.id, {
                        announcement_name: this.editedItem.announcement_name,
                        describe: this.editedItem.describe,
                        lab_id: this.editedItem.lab_id,
                        user_id: this.editedItem.user_id,
                        picture_path: this.picture_path,
                        image: this.image
                    })
                    .then(response => console.log(response.data));
            } else {
                this.announcements.push(this.editedItem);
                await axios
                    .post("/api/announcement/", {
                        announcement_name: this.editedItem.announcement_name,
                        describe: this.editedItem.describe,
                        lab_id: this.editedItem.lab_id,
                        user_id: this.editedItem.user_id,
                        picture_path: this.picture_path,
                        image: this.image
                    })
                    .then(response => console.log(response.data));
            }
            this.close();
            await this.$store.dispatch("loadAnnouncements");
        },
        onImageChange(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            this.noUpload = false;
            reader.onloadend = e => {
                this.image = reader.result;
                var date =
                    this.today.getFullYear() +
                    "-" +
                    (this.today.getMonth() + 1) +
                    "-" +
                    this.today.getDate();
                var time =
                    this.today.getHours() + "-" + this.today.getMinutes();
                var x = Math.floor(Math.random() * 100);
                var dateTime = date + "_" + time;
                const file_name = "image_" + dateTime + "_" + x + ".png";
                this.picture_path = file_name;
            };
            reader.readAsDataURL(file);
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
