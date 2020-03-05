<template>
    <v-card class="mx-auto p-4" style="max-width:80vw; max-height:90vh;">
        <v-card-text>
            <div
                style="text-align:center; font-size: calc(1em + 1vw);"
                class="font-weight-bold text--primary"
            >
                Lab Lender
            </div>

            <div class="mt-4 mb-3 headsubtext" style="text-align:center; font-size: calc(0.75em + 0.75vw);">
                web application that help you find and lend all equipments in
                the laboratory
            </div>
        </v-card-text>
        
            <center>
                <v-img
                    class="mt-3 mb-3"
                    src="/img/welcome-vector.png"
                    max-width="80%"
                    max-height="80%"
                />
            </center>
            <center>
        <v-btn
            style="text-decoration: none; color : #FFFFFF;"
            href="/login"
            class="button-btn-gradient"
            large
        >
            LOGIN WITH CMU ACCOUNT
        </v-btn></center>
    </v-card>
</template>

<style scoped>
.button-btn-gradient {
    background-color: #0c0b0b;
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}

div.headtext {
    color: "black";
}

@media screen and (min-width: 801px) {
    div.headtext {
        font-size: calc(1em + 1vw);
    }
}
/* font-size: 2.25em; */
/* @media screen and (max-width: 800px) {
    div.headtext {
        font-size: 6vw;
    }
} */

div.headsubtext {
    color: "black";
}

@media screen and (min-width: 801px){
    div.headsubtext {
        font-size: 1.25vw;
    }
}

@media screen and (max-width: 800px) {
    div.headsubtext {
        font-size: 4vw;
    }
}

/* div.login-button {
    display: flex;
}

@media screen and (min-width: 601px) {
  div.login-button {
    justify-content: right;
  }
}

@media screen and (max-width: 600px) {
  div.login-button{
    text-align:center;
  }
} */
</style>
