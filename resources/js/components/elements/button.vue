<template lang="pug">
a.fly-btn(
    :class=`{
        'fly-btn_outline': outline,
        'fly-btn_small': small,
    }`
    :href="href"
    @click="$emit('click', $event)"
): span: slot
</template>

<script>
export default {
    name: 'FlyBtn',
    props: {
        value: {
            type: String,
            default: '',
            required: false,
        },
        href: {
            type: String,
            default: '#',
            required: false,
        },
        outline: {
            type: Boolean,
            default: false,
            required: false,
        },
        small: {
            type: Boolean,
            default: false,
            required: false,
        },
    },
    data: () => ({}),
};
</script>

<style lang="scss">
.update-app a, a, .update-app button, button {
    &.fly-btn {
        appearance: none;
        cursor: pointer;
        text-decoration: none;

        width: 100%;
        max-width: 330px;
        height: 60px;
        background: #E72D2D;
        color: #FFFFFF;

        font-family: Proxima Nova;
        font-weight: bold;
        font-size: 20px;
        line-height: 24px;


        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        transition: all .2s;

        &:hover {
            opacity: .75;
        }

        &_small {
            height: 40px;
            font-size: 18px;
            line-height: 20px;
        }

        &_outline {
            background: transparent;
            border: 1px solid #E72D2D;
            color: #E72D2D;

            &:hover {
                background: #E72D2D;
                color: #fff;
            }
        }
    }
}
</style>
