<template>
    <div class="text-center">
        <h3>Sub Categories</h3>
        <div class="mt-4">
            <div class="card mb-3" v-for="(category, index) in categories" :key="category.name + index">
                <div class="card-body" @click="$emit('categoryChange', category.id)" style="cursor: pointer;">
                    {{ category.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categories: {
            type: Array,
            required: true
        }
    },
}
</script>
