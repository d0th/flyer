<template>
    <div>
        <div class="busket__icon">
            <div class="busket__iconWrap">
                <a href="/cart">
                    <img src="/images/icon/cart.svg" alt="Корзина">
                </a>
            </div>
            <span class="busket__value" v-if="$store.getters.cartItemTotal > 0">{{ $store.getters.cartItemTotal }}</span>
        </div>
    </div>
</template>

<script>
    let getItems = localStorage.getItem('cartItems');

    export default {
        mounted() {
            const self = this;
            const items = JSON.parse(getItems);

            if (items && this.$store.getters.cartItemTotal === 0) {
                axios.get('/api/v1/getFlying')
                    .then(response => {
                        for (let itemKey in items) {
                            if (items.hasOwnProperty(itemKey)) {
                                response.data.forEach(item => {
                                    if (item.id === items[itemKey].id) {
                                        let itemToCart = {
                                            id: item.id,
                                            title: item.title_ru,
                                            price_from: item.prices[0].price,
                                            price_to: item.prices[0].price,
                                            quantity: items[itemKey].quantity
                                        };

                                        self.addItemToCart(itemToCart);
                                    }
                                });
                            }
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
            console.log('Component mounted.')
        },
        methods: {
            addItemToCart(item){
                this.$store.dispatch('insertItemToCart', item);
            },
        }
    }
</script>
