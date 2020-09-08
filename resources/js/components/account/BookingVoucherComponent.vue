<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="bv-inp" v-for="(voucher, index) in vouchers.vouchers" :key="index">
                    <input type="checkbox"
                           :id="voucher.id"
                           :value="voucher.id"
                           v-model="voucher_ids"
                           @click="getDate"
                    >
                    <label :for="voucher.id"><strong>{{voucher.code}}</strong> {{voucher.item.title}}</label>
                </div>
            </div>
            <div class="col-sm-8">
                <vc-calendar
                    v-model='calendarData'
                    :columns="3"
                    :disabled-dates='calendarConfigs.disabledDates'
                />
            </div>
        </div>
        {{voucher_ids}}
    </div>
</template>

<script>
    import {VCalendar} from 'v-calendar';

    export default {
        components: {
            VCalendar
        },
        name: "BookingVoucherComponent",
        props: ['vouchers'],
        data() {
            return {
                voucher_ids: [],
                calendarData: {},
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
                blockCalendar: true,
                blockBuyBooking: false,
                disabledDates: false,
                checked: [],
                month: [],
                datesActive: [],
                datesDisabled: this.vouchers.params.datesDisabled,
                isActive: true,
                errorClass: false,
                text: 'My timeout is set to 2000.',
                timeout: 5000,
                message: {
                    show: true,
                    title: ''
                }
            };
        },
        mounted() {

        },
        methods: {
            getDate() {
                this.calendarConfigs.disabledDates = [
                    {
                        start: null,
                        end: null
                    }
                ];
                axios.post('/api/v1/getAvailableBookableDaysMulti', {
                    'voucher_ids': this.voucher_ids
                })
                    .then(response => {
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
            },
        }
    }
</script>

<style scoped>
    .bv-inp label:after {
        position: absolute;
        left: 24.17%;
        right: 12.5%;
        top: 29.33%;
        bottom: 20.83%;

        background: url(/catalog/view/theme/oct_techstore/image/Vector.png) no-repeat;
    }

    .bv-inp input:checked + label {
        background-color: #D01E71;
    }


</style>
