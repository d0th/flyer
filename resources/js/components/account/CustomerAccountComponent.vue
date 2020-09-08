<style lang="scss">
.account {
    padding: 20px 15px;
    background-color: #142C60;

    &-card {
        box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.25), -10px -10px 20px #2A4FA0;
        border: 10px solid #142C60;
        padding: 24px 30px 30px;

        background: #FFFFFF;

        &__title {
            width: 100%;
            height: 50px;
            font-weight: bold;
            font-size: 24px;
            line-height: 120%;
            display: flex;
            justify-content: center;
            align-items: center;

            color: #142C60;
            margin-bottom: 20px;
        }

        &__item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            & + & {
                margin-top: 20px;
            }
            &__label, &__val {
                width: 100%;
                height: 20px;
                font-style: normal;
                font-size: 18px;
                line-height: 120%;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #142C60;
            }
            &__label {
                font-weight: normal;
                margin-bottom: 6px;
            }
            &__val {
                font-weight: bold;
            }
        }

        &__separator {
            margin: 20px 0 30px;
            height: 1px;
            width: 100%;
            background:rgba(20, 44, 96, 0.25);
        }
    }
}
</style>
<template lang="pug">
section.account
    .account__drop-down Личные данные

    .account-card
        .account-card__title Личные данные

        .account-card__item
            .account-card__item__label Имя, Фамилия
            .account-card__item__val {{ user.firstname }} {{ user.lastname }}

        .account-card__item
            .account-card__item__label Телефон
            .account-card__item__val {{ user.phone }}

        .account-card__item
            .account-card__item__label Дата рождения
            .account-card__item__val {{ new Date(user.birthdate * 1000).toLocaleDateString() }}

        .account-card__item
            .account-card__item__label E-mail
            .account-card__item__val {{ user.email }}

        .account-card__separator

        .account-card__item
            .account-card__item__label Страна
            .account-card__item__val {{ country[user.country] || '-' }}

        .account-card__item
            .account-card__item__label Улица
            .account-card__item__val {{ user.address || user.address2 || '-' }}

        .account-card__item
            .account-card__item__label Индекс
            .account-card__item__val {{ user.zipCode || '-' }}

        .account-card__item
            .account-card__item__label Город
            .account-card__item__val {{ user.city || '-' }}

        label.account-card__checkbox
            input(type="checkbox")
            span Я&nbsp;согласен(а) получать информацию от&nbsp;iflyminsk.by

        fly-btn(outline, href="/edit-customer") Изменить данные
        fly-btn(hide) Удалить аккаунт
//-
    <div class="container">
        <p>Личные данные</p>
        <p>Имя, Фамилия {{catalog.results.firstname}} {{catalog.results.lastname}}</p>
        <p>Телефон {{catalog.results.phone}}</p>
        <p>Дата рождения {{ new Date(this.catalog.results.birthdate * 1000) | moment("DD.MM.YY") }}</p>
        <p>E-mail {{catalog.results.email}}</p>
        <p>Страна {{this.country}}</p>
        <p>Улица {{catalog.results.address}}</p>
        <p>Индекс {{catalog.results.zipCode}}</p>
        <p>Город {{catalog.results.city}}</p>

        <div class="message-btn">
            <a href="/edit-customer"><button class="desc-btn-red">Изменить данные</button></a>
        </div>
    </div>
</template>

<script>
import FlyBtn from '../elements/button';

export default {
    props: ['user', 'bookings', 'vouchers'],
    components: {
        FlyBtn,
    },
    data() {
        return {
            errors: [],
            country: {
                BY: 'Беларусь',
            },
        };
    },
    mounted() {
    },
    methods: {
        log() {
            console.log({
                user: this.user,
                bookings: this.bookings,
                vouchers: this.vouchers,
            });
        },
    }
}
</script>
