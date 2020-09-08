<template>
    <v-app>
        <div class="container">
            <v-dialog v-model="dialog" persistent max-width="570">
                <v-card>
                    <v-card-title class="headline text-center">Доступные временные блоки</v-card-title>
                    <v-card-title class="headline text-center">{{modal.title}}</v-card-title>
                    <v-card-title>
                        <v-alert
                            text
                            outlined
                            color="deep-orange"
                            icon="mdi-fire"
                        >
                            Вам необходимо зарегистрироваться на ресепшн за один час до начала Вашего полета.
                        </v-alert>
                    </v-card-title>
                    <v-card-text>Будни {{modal.price}}</v-card-text>
                    <div class="block-wrap">
                        <div class="wrap-time">
                            <div class="time-item"
                                 v-for="(item, index) in modal.times"
                                 :key="index"
                                 :class="{ activeTime: index === activeItem}"
                                 @click="chooseTime(index, item)">
                                {{item['time_format']}}
                            </div>
                        </div>
                    </div>
                    <v-card-actions class="block-center">
                        <div class="text-center">
                            <v-btn @click="cancelConfirmBookingDay">Отменить</v-btn>
                            <v-btn small color="error" @click="confirmBookingDay">Подтвердить этот временной слот</v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <div class="row justify-content-center wrap-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item tab-booking">
                        <a class="nav-link active" id="pills-cart-tab" data-toggle="pill" href="#pills-cart" role="tab" aria-controls="pills-cart" aria-selected="true">1. Ваша корзина</a>
                    </li>
                    <li class="nav-item tab-booking">
                        <a class="nav-link" id="pills-booking-tab" data-toggle="pill" href="#pills-booking" role="tab" aria-controls="pills-booking" aria-selected="false">2. Подтверждение бронирования</a>
                    </li>
                    <li class="nav-item tab-booking">
                        <a class="nav-link" id="pills-pay-tab" data-toggle="pill" href="#pills-pay" role="tab" aria-controls="pills-pay" aria-selected="false">3. Платеж</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-cart" role="tabpanel" aria-labelledby="pills-cart-tab">
                        <div class="wrap-cart"
                             v-if="$store.getters.getCartItems.length > 0">
                            <div class="cart-items">
                                <div class="item-cart"
                                     v-for="(item, index) in $store.getters.getCartItems">
                                    <div class="cart--block-left">
                                        <div class="item-title">{{item.title}}</div>
                                    </div>
                                    <div class="cart--block-right">
                                        <div class="item--price-from mr-20">
                                            Будни - {{item.price_from}} BYN
                                        </div>
                                        <div class="item--price-to mr-20">
                                            Выходные - {{item.price_to}} BYN
                                        </div>
                                        <div class="cart-counter mr-20">
                                            <div class="cart--button" @click="decrementQuantity(item)">
                                                -
                                            </div>
                                            <span class="cart-counter-result">{{item.quantity}}</span>
                                            <div class="cart--button" @click="incrementQuantity(item)">
                                                +
                                            </div>
                                        </div>
                                        <div class="cart-delete">
                                            <img @click="deleteItemFromCart(item)" src="/images/icon/cart-delete.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-calendar">
                                <div class="btn-calendar">
                                    <a href="" @click="chooseDate" class="btn-data">Нажмите сюда для выбора даты</a>
                                </div>
                            </div>
                            <div class="calendar-desc">
                                <p>
                                    Вы можете забронировать только сертификат на полет, для этого выберите желаемую дату и время
                                    .
                                    Если Вы не выберете дату, Вы получите сертификат, готовый к печати по эл. почте.
                                    Чтобы в дальнейшем забронировать время и дату, введите промокод сертификата на нашем сайте.
                                </p>
                            </div>
                            <div v-if="blockCalendar">
                                <vc-calendar
                                    v-model='calendarData'
                                    :columns="3"
                                    :disabled-dates='calendarConfigs.disabledDates'
                                />
                            </div>
                            <div class="calendar-desc" v-if="blockBuyBooking">
                                <v-alert
                                    text
                                    outlined
                                    color="deep-orange"
                                    icon="mdi-fire"
                                >
                                    <p>Время начала Вашего полета Суббота 18 Апрель 2020 в 11h00</p>
                                    <p>Время начала Вашего полета Суббота 18 Апрель 2020 в 11h00</p>
                                    <p>Время начала Вашего полета Суббота 18 Апрель 2020 в 11h00</p>
                                </v-alert>
                            </div>
                            <div class="block-calendar">
                                <div class="btn-calendar">
                                    <a href="" class="btn-data btn-red">Далее</a>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-center">Добавьте полеты в корзину</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab">222</div>
                    <div class="tab-pane fade" id="pills-pay" role="tabpanel" aria-labelledby="pills-pay-tab">333</div>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
    let getItem = localStorage.getItem('cartItems');
    import {VCalendar} from 'v-calendar';

    export default {
        components: {
            VCalendar
        },
        data() {
            return {
                calendarData: [],
                activeItem: null,
                bookingDay: '',
                blockCalendar: false,
                blockBuyBooking: false,
                date: '2020-03-02',
                calendarConfigs: {
                    sundayStart: false,
                    dateFormat: 'dd/mm/yyyy',
                    isDatePicker: false,
                    isDateRange: false,
                    disabledDates: [
                        {
                            start: null,
                            end: null
                        }
                    ]
                },
                calendarShow: true,
                dialog: false,
                modal: {
                    title: "Четверг 9 Апр.",
                    times: [],
                    price: 0
                }
            };
        },
        mounted() {
            let date = new Date();
            let dateTo = date.setMonth(date.getMonth() + 6);
            let dateToMonth = new Date(dateTo);
            let currentDate = Date.now();
            this.disabledDates.ranges[0].to = currentDate + -1*24*3600*1000;
            this.disabledDates.ranges[1].from = new Date(dateToMonth.getFullYear(), dateToMonth.getMonth(), 1);

            const self = this;

            /*if (getItem) {
                for (let item in newGarnish) {
                    self.addItemToCart(item);
                }
            }*/
        },
        methods: {
            chooseTime(i, item) {
                this.bookingDay = item;
                this.activeItem = i;
            },
            confirmBookingDay() {
                this.dialog = false;
            },
            cancelConfirmBookingDay() {
                this.bookingDay = null;
                this.dialog = false;
            },
            addItemToCart(dish){
                this.$store.dispatch('addDishToCart', dish);
            },
            incrementQuantity(item) {
                this.$store.dispatch('addItem', item);
            },
            decrementQuantity(item) {
                this.$store.dispatch('removeItem', item);
            },
            deleteItemFromCart(item) {
                this.$store.dispatch('deleteItemFromCart', item);
            },
            chooseDay(date) {
                let currentHour = new Date().getHours();
                let currentMinutes = new Date().getMinutes();
                let currentSeconds = (currentHour * 3600) + (currentMinutes * 60);
                let chooseDay = date.getTime()/1000 - currentSeconds;
                let weekDay = date.getDay();

                let catalog_ids = [];
                let cart = [];

                this.$store.getters.getCartItems.forEach(item => {
                    for (var i = 0; i < item.quantity; i++) {
                        catalog_ids.push(item.id);
                        cart.push({
                            catalog_id: item.id,
                            gift: 0,
                            cat_type: "",
                            default_price_cat_id: "6",
                            price_cat_id: "6",
                        });
                    }
                });

                let self = this;

                axios.post('/chooseDay', {
                    'catalog_ids': catalog_ids,
                    'cart': cart,
                    'seconds': chooseDay
                })
                    .then(response => {
                        weekDay === 6 || weekDay === 7 ? self.modal.price = response.data.results.prices[6] : self.modal.price = response.data.results.prices[5];
                        self.modal.title = response.data.results.day;
                        self.modal.times = response.data.results.days;
                        self.dialog = true;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            chooseDate() {
                this.blockCalendar = !this.blockCalendar;
                let catalog_ids = [];
                let cart = [];

                this.$store.getters.getCartItems.forEach(item => {
                    for (var i = 0; i < item.quantity; i++) {
                        catalog_ids.push(item.id);
                        cart.push({
                                catalog_id: item.id,
                                gift: 0,
                                cat_type: "",
                                default_price_cat_id: "6",
                                price_cat_id: "6",
                            });
                    }
                });

                axios.post('/api/v1/getAvailableBookableDaysMulti', {
                    'catalog_ids': catalog_ids,
                    'cart': cart
                })
                    .then(response => {
                        this.calendarShow = true;

                        console.log('data', response.data);
                        var dates = response.data.results;
                        this.calendarConfigs.disabledDates = [];
                        this.calendarConfigs.disabledDates.push({
                            start: null,
                            end: new Date()
                        });
                        dates.forEach(
                            (date, index) => {
                                if (index === 0) {
                                    this.calendarConfigs.disabledDates.push({
                                        start: new Date(date),
                                        end: new Date(date)
                                    });
                                } else if (index === (dates.length - 1)) {
                                    this.calendarConfigs.disabledDates.push({
                                        start: new Date(date),
                                        end: null
                                    });
                                } else {
                                    this.calendarConfigs.disabledDates.push({
                                        start: new Date(date),
                                        end: new Date(date)
                                    });
                                }
                                //
                                // this.calendarConfigs.disabledDates.push(datesPush);
                            }
                        )

                        console.log('date', this.calendarConfigs.disabledDates);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        }
    }
</script>
