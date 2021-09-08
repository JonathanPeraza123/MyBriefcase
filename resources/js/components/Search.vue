<template>
    <div>
        <div class="container mb-3 ">
            <form @submit.prevent="search">
                <div class="input-group">
                    <input class="form-control border-0 shadow-sm" placeholder="Buscar algun proyecto..." v-model="buscar"></input>
                        <div class="input-group-append">
                            <button class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
            return {
                buscar : ''
        }
    },
    methods : {
        search() {
            EventBus.$emit('search', this.buscar)
        }
    }
}
</script>
