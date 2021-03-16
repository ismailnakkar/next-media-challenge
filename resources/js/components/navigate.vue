<template>
    <div>
        <form>
            <div class="form-row align-items-center justify-content-center">
                <div class="form-group col-auto">
                    <label for="sort-by">Sort By</label>
                    <select v-model="options.sortBy" class="form-control">
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                    </select>
                </div>
                <div v-if="options.sortBy" class="form-group col-auto">
                    <label for="sortingType">Sorting Type</label>
                    <select v-model="options.sortingType" class="form-control">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="form-group col-auto">
                    <label for="category">Category</label>
                    <select v-model="options.category" class="form-control">
                        <option selected value="">Select</option>
                        <option v-for="(category, index) in categories" :key="category + index" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row mt-5">
            <div class="col-md-6">
                <products :products="products_data" />
            </div>
            <div class="col-md-6">
                <categories v-on:categoryChange="changeCategory" :categories="categories_data" />
            </div>
        </div>
    </div>
</template>

<script>
import products from './products'
import categories from './categories'
export default {
    props: {
        categories: {
            type: Array,
            required: true
        }
    },
    components: {
        products,
        categories
    },
    data() {
        return {
            options: {
                sortBy: 'name',
                sortingType: 'asc',
                category: ""
            },
            products_data: [],
            categories_data: []
        }
    },
    created() {
        this.fetch();
    },
    methods: {
        async fetch() {
            try {
                if(this.options.category) {
                    const data = (await axios.get('/api/fetch', {params: this.options})).data.data;
                    this.products_data = data.products;
                    this.categories_data = data.categories;
                } else {
                    this.products_data = (await axios.get('/api/fetch', {params: this.options})).data.data;
                }

            } catch (error) {

            }
        },
        changeCategory(event) {
            this.options.category = event;
        }
    },
    watch: {
        options: {
            handler() {
                this.fetch();
            },
            deep: true
        }
    }
}
</script>
