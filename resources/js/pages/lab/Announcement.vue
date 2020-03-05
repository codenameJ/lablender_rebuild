<template>
    <div>
        <v-card class="mx-auto" max-width="1500">
            <v-col cols="12" rows="5">
                <v-textarea color="teal">
                    <template v-slot:label>
                        <div>
                            Type something...
                        </div>
                    </template>
                </v-textarea>
            </v-col>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    permanent
                    right
                    text
                    type="submit"
                    class="button-btn-gradient mr-1"
                    style="text-decoration : none; color : #FFFFFF; "
                    >Post</v-btn
                ></v-card-actions
            >
        </v-card>

        <v-card class="mx-auto" max-width="1500" max-height="300">
            <v-col cols="12"> </v-col>
            <div class="ml-5">Announcement1</div>
            <br /><small class="ml-5">Posted by Aomsin 1/2/2012 20:20</small>
            <v-divider></v-divider>
            <div class="ml-5">Announcement2</div>
            <br /><small class="ml-5">Posted by Aomsin 1/2/2012 20:20</small>
            <v-divider></v-divider>
        </v-card>
    </div>
</template>

<style scoped>
.button-btn-gradient {
    background-color: #0c0b0b;
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}
</style>
