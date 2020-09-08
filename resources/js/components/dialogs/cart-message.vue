<template lang="pug">
.cart-message(:class="{ 'cart-message_scrolled': scrolled }")
    .cart-message__title ({{ title }}) - добавлена в&nbsp;корзину
    .cart-message__buttons
        fly-btn(small, href="/cart") Перейти в&nbsp;корзину
        fly-btn(outline, small, @click.prevent="$emit('input', false)") Продолжить
</template>

<script>
import FlyBtn from '../elements/button';

export default {
    name: 'CartMessage',
    components: {
        FlyBtn,
    },
    props: {
        value: {
            type: Boolean,
            default: false,
            required: false,
        },
        title: {
            type: String,
            default: '',
            required: false,
        },
    },
    data: () => ({
        scrolled: false,
    }),
    mounted() {
        this.scrolled = window.scrollY > 92;
    },
    created() {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    deactivated() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll (event) {
            // Any code to be executed when the window is scrolled
            this.scrolled = window.scrollY > 92;
        }
    },
};
</script>

<style lang="scss">
.cart-message {
    position: absolute;
    top: 92px; left: 0; right: 0;
    padding: 40px 80px 38px 80px;
    background-color: #fff;
    z-index: 10;

    /* transition: all .2s; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    @media (min-width: 1000px) {
        flex-direction: row;
        padding: 80px;
    }
    &_scrolled {
        position: fixed;
        top: 0;
    }

    &__title {
        font-weight: bold;
        font-size: 20px;
        line-height: 24px;
        color: #142C60;
        text-align: center;
        width: 100%;
    }
    &__buttons {
        max-width: 200px;
        min-width: 200px;
        margin: 20px auto 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        > * + * {
            margin-top: 15px;
             @media (min-width: 1000px) {
                 margin-top: 0;
                 margin-left: 20px;
             }
        }
        @media (min-width: 1000px) {
            flex-direction: row;
            justify-content: flex-end;
            margin-top: 0;
            margin-left: 40px;
            min-width: 420px;
            max-width: 420px;
        }
    }
}
</style>
