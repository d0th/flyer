<template lang="pug">
.container.booking-component

    template(v-if="message.show")
        cart-message(v-model="message.show", :title="message.title")

    template(v-if="certificate")
        certificate-dialog(v-model="certificate", @cert="cert")

    v-app.update-app
        .wrap-tab
            v-snackbar(v-model="snackbar" :timeout="timeout") {{ text }}
                v-btn(color="blue" text @click="snackbar = false") Close

            h1.main-h1 Забронируйте полет

            fly-btn.flex-auto-center(@click.prevent="openCertificate") Ввести номер сертификата

            p.main-description  Выберите подходящую программу и&nbsp;забронируйте предпочитаемую дату в&nbsp;IFLY&nbsp;Minsk уже&nbsp;сегодня.

            drop-down(:options="catalog", @click="addToCart", @cert="openCertificate")

</template>

<script>
import FlyBtn from './elements/button';
import DropDown from './elements/drop-down';

import CartMessage from './dialogs/cart-message';
import CertificateDialog from './dialogs/certificate';

    export default {
        props: ['catalog'],
        components: {
            CertificateDialog,
            FlyBtn,
            DropDown,
            CartMessage,
        },
        data() {
            return {
                snackbar: false,
                text: 'My timeout is set to 2000.',
                timeout: 5000,
                message: {
                    show: false,
                    title: ''
                },
                certificate: false,
            };
        },
        mounted() {
        },
        methods: {
            getTitleCategory(index) {
                switch (index) {
                    case '1':
                        return 'Новички';
                    case '2':
                        return 'Спортсмены';
                    case '4':
                        return 'Дети';
                    case '5':
                        return 'Летавшие';
                    case '6':
                        return 'Группы';
                }
            },
            getTitleOfCurrentTab(idx) {
                switch (idx) {
                    case 1:
                    case '1':
                        return 'Программы для новичков';
                    case 2:
                    case '2':
                        return 'Программы для спортсменов';
                    case 4:
                    case '4':
                        return 'Программы для детей';
                    case 5:
                    case '5':
                        return 'Программы для летавших';
                    case 5:
                    case '6':
                        return 'Программы для групп';
                }
            },
            addToCart(e, item) {
                this.message.show = true;
                this.message.title = item['title_ru'];
                this.$store.dispatch('addItem', item);
            },
            openCertificate(e, item) {
                this.certificate = true;
            },
            cert(num) {
                console.log(num);
            },
        }
    }
</script>

<style lang="scss">
.container.booking-component .main-h1, .main-h1 {
    width: 100%;
    text-align: center;
    font-weight: bold;
    font-size: 36px;
    line-height: 122%;
    color: #FFFFFF;
    margin-bottom: 30px;
    @media (min-width: 1000px) {
        font-size: 60px;
        margin-bottom: 40px;
    }
}
.container.booking-component .main-description, .main-description {
    width: 100%;
    text-align: center;
    font-weight: normal;
    font-size: 18px;
    line-height: 133%;
    color: #FFFFFF;
    margin: 30px 0 20px;
    @media (min-width: 1000px) {
        margin: 80px 0 60px 0;
        max-width: 1000px;
        font-size: 24px;
    }
}

.booking-component.container {
    padding: 0;
    margin: 0;
    width: 100%;
    max-width: 100%;
    background-color: #142C60;

    color: #fff;

    @media (min-width: 1000px) {
        max-width: 100%;
        background-image: url('/img/circle.svg');
        background-size: contain;
        background-repeat: repeat;

        padding: 0;
        margin: 0 auto;
    }

    div.v-application {
        background: transparent;
    }
}

header {
    position: relative;
    z-index: 20;
    background-color: #fff;
    .container {
        padding: 0 12px !important;
    }
}
/* 1170 */
</style>
