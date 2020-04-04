<template>
    <div id="app" v-if="curlab">
        <v-content>
            <div class="mx-auto mt-1 mb-2" max-width="1500">
                <!-- <h1 align="center">{{ $route.params.course_id }}</h1> -->
                <!-- <h1 align="center">LAB LENDER</h1> -->
                <v-row>
                    <v-col class="ml-12">
                        <h1 align="right">{{ curlab.course_name }}</h1>
                        <h2 align="right">{{ curlab.course_id }}</h2>
                        <h4 align="right">Welcome, username</h4>
                    </v-col>
                    <v-col>
                    <img align="left" 
                            class="ml-4"
                            src="/img/ta.png" 
                            style="width: auto;
                            height: 100%;" />
                    <div class="studentpic">
                        <img 
                            align="left" 
                            src="/img/student.png" 
                            class="ml-4"
                            style="width: auto;
                            height: 100%;" />
                    </div>
                    </v-col>
                </v-row>
                <br>
                <v-divider></v-divider>
                <h5 align="center" class="mt-10">
                    Easy steps to lend any equipments in the lab!
                </h5>
                <br />
                <div class="flex-container">
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2" class="mx-auto mb-5" max-width="344">
                        <v-img src="/img/howto1.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Select equipments to lend
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เลือกอุปกรณ์ที่ต้องการยืม
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href="/equipment"
                                color="#0091EA"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                SEE EQUIPMENTS
                            </v-btn>
                        </v-card-actions>
                    </v-card></v-hover>
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2" class="mx-auto mb-5" max-width="344">
                        <v-img src="/img/howto2.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Confirm your lend request
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            ยืนยันส่งคำขอยืม
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn color="green darken-3" text right>
                                LENDING CART
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-hover>
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2"  class="mx-auto mb-5" max-width="344">
                        <v-img src="/img/howto3.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Recieve your equipments
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            รับอุปกรณ์เมื่อคำขอเปลี่ยนสถานะเป็น Ready
                        </v-card-subtitle>

                        <v-card-actions class="justify-center">
                            <v-btn
                                href="/request"
                                color="pink accent-2"
                                style="text-decoration : none;"
                                text
                                right
                            >
                                YOUR REQUESTS
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-hover>
                </div>
            </div>
        </v-content>
    </div>
</template>

<script>
export default {
    // props: ["course_id"],
    data: () => ({}),
    mounted() {
        // this.getLabData();
    },
    computed: {
        curlab() {
            return this.$store.state.selectedLab;
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

div.flex-container {
    display: flex;
}

@media screen and (min-width: 1351px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 1350px) {
    div.flex-container {
        flex-direction: column;
    }
}

div.studentpic {
    display: block;
}

@media screen and (max-width: 415px) {
    div.studentpic {
        display: none;
    }
}
</style>
