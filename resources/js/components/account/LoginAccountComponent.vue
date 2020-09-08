<template>
    <div class="container">
        <form
            id="app"
            @submit="checkForm"
            action="/api/v1/login"
            method="post"
        >

            <p v-if="errors.length">
                <b>Пожалуйста исправьте указанные ошибки:</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>



            <p>
                <label for="email">Адрес эл. почты</label>
                <input
                    id="email"
                    v-model="email"
                    type="email"
                    name="email"
                    required
                >
            </p>

            <p>
                <label for="password">Пароль</label>
                <input
                    id="password"
                    v-model="password"
                    type="password"
                    name="passwd"
                    required
                >
            </p>

            <p>
                <input
                    type="submit"
                    value="Отправить"
                >
            </p>

        </form>
    </div>
</template>

<script>
    export default {
        props: ['catalog'],
        data() {
            return {
                errors: [],
                email: null,
                age: 1,
                password: null
            };
        },
        mounted() {
        },
        methods: {
            checkForm: function (e) {
                if (this.age) {
                    return true;
                }
                e.preventDefault();
            },
        }
    }
</script>
