<template>
    <div id="app">
        <v-content>

            <div class="mx-auto mt-1 mb-1" >
                <div class="flex-container">
                    <v-row>
                        <v-col>
                            <!-- ml-12 mt-5 mb-3  -->
                            <v-img
                                class="m-5 homepic"
                                src="/img/welcome-vector.png"
                            />
                        </v-col>
                        <v-col><center>
                            <br /><br />
                            <h1
                                style="font-size:60px"
                                align="center"
                                class="mt-2 font-weight-bold"
                            >
                                LAB LENDER
                            </h1>
                            <v-col
                                style="font-size: 18px; font-family: 'Kanit' , sans-serif;"
                                align="center"
                                class="mt-7"
                            >
                                ระบบยืม-คืน อุปกรณ์ภายในห้องปฎิบัติการ<br />
                                ภายในภาควิชาวิศวกรรมคอมพิวเตอร์<br />
                                คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่<br />
                            </v-col>
                            <br>
                            <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                     <v-btn :elevation="hover ? 16 : 2" 
                                    color="#2ad4a9"
                                    outlined
                                    style="text-decoration: none; font-family: 'Kanit'; font-size: 20px;"
                                    href="/login"
                                    x-large
                                >
                                    เริ่มต้นใช้งาน
                                </v-btn>
                            </v-hover>
                            </center>
                        </v-col>
                    </v-row>
                </div>

                <v-divider></v-divider>
                <h4 class="mt-7" align="center">
                    Let's get started by joining labs.
                </h4>
                <h5 align="center"></h5>

                <br />
                <div class="flex-container">
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2" class="mx-auto mb-5" max-width="344">
                        <v-img src="/img/labhowto1.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Select lab from lab lists
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เลือกแลปที่ต้องการเข้าร่วม
                        </v-card-subtitle>

                    </v-card>
                    </v-hover>
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2" class="mx-auto mb-5" max-width="400">
                        <v-img src="/img/labhowto2.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Send lab join request
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            กด Request เพื่อขอเข้าร่วมแลป
                        </v-card-subtitle>
                    </v-card>
                    </v-hover>
                    <v-hover
                    v-slot:default="{ hover }"
                    open-delay="200"
                    >
                    <v-card :elevation="hover ? 16 : 2"  class="mx-auto mb-5" max-width="344">
                        <v-img src="/img/labhowto3.png" height="200px"></v-img>

                        <v-card-title class="justify-center">
                            Start lending when got accepted
                        </v-card-title>

                        <v-card-subtitle class="d-flex justify-center">
                            เมื่ออาจารย์รับเข้าแลป สามารถเริ่มต้นยืมของได้ทันที
                        </v-card-subtitle>
                    </v-card>
                    </v-hover>
                </div>
            </div>
        </v-content>
        </div>
</template>

<style scoped>
.button-btn-gradient {
    background-color: #0c0b0b;
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}

div.flex-container {
    display: flex;
}

@media screen and (min-width: 1301px) {
    div.flex-container {
        flex-direction: row;
    }
}

@media screen and (max-width: 1300px) {
    div.flex-container {
        flex-direction: column;
    }
}

div.homepic {
}

@media screen and (min-width: 801px) {
    div.homepic {
        width: 50vw;
    }
}

@media screen and (max-width: 800px) {
    div.homepic {
        width: 80vw;
    }
}

bgcolor{
    background-color: #EEEEEE;
}
</style>

<script>
export default {
    name: "Home",
    mounted() {
        console.log("home show");
    }
};
</script>
