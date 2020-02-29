<template>
    <v-card id="lateral">
        <v-toolbar dark tabs flat src="/img/navlayout.png" height="100">
            <v-toolbar-title>
                <v-list-item>
                    <v-img
                        class="m-2"
                        src="/img/icon.png"
                        max-width="50"
                        max-height="50"
                    >
                    </v-img>
                    <h2 class="m-3 text-uppercase">
                        <b>Lab Lender</b>
                    </h2>
                </v-list-item>

                <!-- <v-list-title
                    class="m-4 font-weight-bold"
                    style="font-size: 20px"
                >
                    Lab List
                </v-list-title> -->
                
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
            <v-toolbar-title>
                <v-menu bottom left>
                    <template v-slot:activator="{ on }">
                        <v-btn icon color="white" v-on="on">
                            <v-icon>mdi-account</v-icon>
                        </v-btn>
                    </template>

                    <v-card>
                        <v-list>
                            <v-list-item>
                                <v-list-item-avatar>
                                    <img
                                        src="https://cdn.vuetifyjs.com/images/john.jpg"
                                        alt="John"
                                    />
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title>{{
                                        username
                                    }}</v-list-item-title>
                                    <v-list-item-subtitle>{{
                                        type
                                    }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                style="text-decoration : none; color : #000000;"
                                href="/logout"
                                text
                                @click="menu = false"
                                >Log out</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-menu>
            </v-toolbar-title>
            <!-- background-color="#2ad4a9" -->
            <template v-slot:extension>
                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'admin'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/user"
                        >Manage User</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </template>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'professor'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/professor/user"
                        >Manage User</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'ta'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'student'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-spacer></v-spacer>
                <v-text-field
                    class="mx-4"
                    flat
                    hide-details
                    label="Search for lab..."
                    prepend-inner-icon="search"
                ></v-text-field>
            </template>
        </v-toolbar>
    </v-card>
</template>

<script>
export default {
    props: ["username", "type"],

    data: () => ({
        fab: false,
        hidden: false,
        tabs: null
    }),

    computed: {
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        }
    }
};
</script>

<style scoped></style>
