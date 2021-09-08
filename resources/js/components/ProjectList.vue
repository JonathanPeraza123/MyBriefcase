<template>
    <div>
        <div class="card mb-4 border-0 shadow-sm" v-for="project in projects.data" :key="project.id">
            <div class="card-body">
                <div class="">
                    <img  class="rounded float-left mr-3 shadow-sm" width = "40px" src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
                </div>
                <div class=" d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <a :href="project.link" class="text-dark">
                                <h5 class="mb-1" href="" v-text="project.name"></h5>
                            </a>
                            <a class="medium" :href="project.user_link" v-text="project.user_name"></a>
                            <div class="small text-muted" v-text="project.ago"></div>
                        </div>
                    </div>
                    <p class = "card-text text-secondary"v-text="project.description"></p>
                </div>
            </div>
        </div>
        <pagination :data="projects" @pagination-change-page="getResults" class="float-right"></pagination>
        <div v-if="noProjects">
            <div class="container card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center">No existen resultados ☹</h2>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import pagination from 'laravel-vue-pagination';

export default {
    components : {pagination},
    data() {
        return {
            projects: {},
            noProjects: false
        }
    },
    mounted() {
        this.getResults();
        EventBus.$on('search', buscar => {
            this.projects = {}
            axios.get('/projects?search=' + buscar)
                .then(res => {
                    this.projects = res.data;
                    if(this.projects.data.length === 0){
                        this.noProjects = true
                    }else{
                        this.noProjects = false
                    }
                })
        });
        // axios.get('/projects')
        //     .then(res => {
        //         this.projects = res.data.data
        //     })
        //     .catch(err => {
        //         console.log(err.response.data)
        //     })
    },
    methods: {
        getResults(page = 1) {
			axios.get('/projects?page=' + page)
				.then(response => {
					this.projects = response.data;
				});
		}
    }
}
</script>
