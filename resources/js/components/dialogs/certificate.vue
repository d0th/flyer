<style lang="scss" scoped>
.certificate-dialog {
    position: relative;
    z-index: 21;
    &__overlay {
        position: fixed;
        top: 0; bottom: 0;
        left: 0; right: 0;
        background: rgba(20, 44, 96, 0.8);
        z-index: 1;
    }
    &__window {
        position: fixed;
        transform: translate(-50%, -50%);
        left: 50%; top: 50%;
        z-index: 2;
        width: calc(100% - 30px);
        background: #FFFFFF;
        padding: 30px;

        @media (min-width: 1000px) {
            width: 1125px;
            padding: 60px;
        }
    }

    &__close {
        user-select: none;
        cursor: pointer;
        text-decoration: none;
        appearance: none;
        position: absolute;
        top: 18px; right: 18px;
        will-change: transform;

        transition: all .2s;
        color: rgba(0, 0, 0, .2);
        @media (min-width: 1000px) {
            top: 30px; right: 48px;
        }
        path {
            fill: currentColor;
        }
        &:hover {
            transform: rotate(90deg);
            color: #E72D2D;
        }
    }

    &__header {
        display: none;
        font-weight: bold;
        font-size: 48px;
        line-height: 122%;
        text-align: center;
        color: #142C60;
        margin-bottom: 20px;
        width: 100%;

        height: 60px;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        @media (min-width: 1000px) {
            display: flex;
        }
    }

    &__title {
        font-weight: normal;
        font-size: 22px;
        line-height: 122%;
        color: #142C60;
        text-align: center;
        margin-bottom: 25px;
        @media (min-width: 1000px) {
            font-size: 24px;
            margin-bottom: 30px;
            height: 60px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
    }
    &__input {
        appearance: none;
        border: 5px solid #142C60;
        height: 60px;
        width: 100%;
        padding: 0 10px;
        outline: none;
        font-family: 'Proxima Nova', sans-serif;
        margin-bottom: 8px;
        color: #142C60;
        &:focus {
            border-color: #E72D2D;
        }
        &::placeholder {
            opacity: .3;
        }
        @media (min-width: 1000px) {
            min-width: 66%;
            max-width: 66%;
            width: 66%;
            margin-bottom: 0;
        }
    }
    &__controls {
        @media (min-width: 1000px) {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            > * + * {
                margin-left: 8px;
            }
        }
    }
}
</style>

<template lang="pug">
.certificate-dialog
    .certificate-dialog__overlay(@click="close")
    .certificate-dialog__window
        svg.certificate-dialog__close(@click="close", xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" weight="24" height="24")
            path(d="M15 12l8.37-8.38a2.12 2.12 0 00-2.99-3L12 9 3.62.62a2.12 2.12 0 10-3 3L9 12 .62 20.38a2.12 2.12 0 103 3L12 15l8.38 8.38a2.12 2.12 0 003-3L14.99 12z")
        .certificate-dialog__header Использовать подарочный сертификат
        .certificate-dialog__title Если&nbsp;у&nbsp;вас&nbsp;есть подарочный&nbsp;сертификат, пожалуйста, введите&nbsp;его&nbsp;номер

        .certificate-dialog__controls
            input.certificate-dialog__input(v-model="num", placeholder="Номер подарочного сертификата")

            fly-btn(@click.prevent="send") Ввести номер
</template>

<script>
import FlyBtn from '../elements/button';

export default {
    name: 'CertificateDialog',
    components: {
        FlyBtn,
    },
    props: {
        value: {
            type: Boolean,
            default: false,
            required: false,
        },
    },
    data: () => ({
        num: '',
    }),
    mounted() {
        document.querySelector('html').classList.add('toggled');
    },
    created() {
        document.querySelector('html').classList.add('toggled');
    },
    destroyed() {
        document.querySelector('html').classList.remove('toggled');
    },
    deactivated() {
        document.querySelector('html').classList.remove('toggled');
    },
    methods: {
        close() {
            this.$emit('input', false);
        },
        send() {
            this.$emit('cert', this.num);
            this.close();
        },
    },
};
</script>
