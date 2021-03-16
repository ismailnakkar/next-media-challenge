<template>
    <div class="text-center">
        <h3 >Products</h3>
        <div class="mt-4">
            <div v-for="(product, index) in products" :key="product.name + index" class="card mb-3">
                <img class="card-img-top" style="max-height: 18rem; object-fit: cover" :src="'/storage/' + product.img_path" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Name: {{ product.name }}</h5>
                    <p class="card-text">Description: {{ product.description }}</p>
                    <p>Price: {{ product.price }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        products: {
            type: Array,
            required: true
        }
    }
}
</script>
