<template>
    <div id="app">
        <v-app id="inspire">
            <v-card class="mt-4 elevation-4 d-inline-block mx-auto">
                <v-container>
                    <v-row justify="space-between">
                        <v-col cols="auto">
                            <v-img class="ml-3" src="/img/cpe.png"></v-img>
                        </v-col>

                        <v-col cols="auto" class="text-center pl-0">
                            <v-row
                                class="flex-column ma-0 fill-height"
                                justify="center"
                            >
                                <v-col align="center" class="mt-7 mx-3">
                                    เว็บไซต์นี้พัฒนาโดยนักศึกษาวิชาภาควิชาวิศวกรรมคอมพิวเตอร์
                                    มหาวิทยาลัยเชียงใหม่ (CPE#25)<br />
                                    ภาควิชาวิศวกรรมคอมพิวเตอร์ ชั้น 4 ตึก 30 ปี
                                    คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่<br />
                                    239 ถนนห้วยแก้ว ตำบลสุเทพ อำเภอเมือง
                                    จังหวัดเชียงใหม่ 50200<br />
                                    Tel: 08-4614-0006, 0-5394-2023<br />
                                    Fax: 0-5394-2072<br />
                                    E-mail: cpe@eng.cmu.ac.th<br />
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-app>
    </div>
</template>

<script>
export default {
    name: "About",
    mounted() {
        console.log("About");
    }
};
</script>
