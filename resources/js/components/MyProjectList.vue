<template>
    <div>
        <div class="card mb-4 shadow-sm" v-for="project in myProjects">
            <div class="card-body d-flex flex-column">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a :href="project.link" class="text-dark">
                                    <h5 class="mb-1" href="" v-text="project.name"></h5>
                                </a>
                                <!-- <h5 class="mt-2" v-text="project.name" v-show="!project.editing"></h5> -->
                            </div>
                                <div class="d-flex justify-content-center">
                                    <button v-show= "!project.editing" class="btn btn-outline-success btn-sm ml-5 d-flex align-items-center" @click="edit(project)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil mr-1" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                            Editar
                                    </button>
                                    <button class="btn btn-outline-danger  btn-sm ml-1 d-flex align-items-center" @click="deleteProject(project)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                    </div>
                </div>
                <div>
                        <form v-show="project.editing" @submit.prevent="update(project)">
                            <label>Nombre</label>
                            <input class="form-control mb-2" v-model="project.name">
                            <label>Descripcion</label>
                            <input class="form-control mb-2" v-model="project.description">
                            <div>
                                <button class="btn btn-success btn-sm">Guardar</button>
                                <button v-show="project.editing" class="btn btn-secondary btn-sm" @click="updateDowm(project)">Cancelar</button>
                            </div>
                        </form>
                    <p class = "card-text text-secondary" v-text="project.description" v-show="!project.editing"></p>
                    <div class="small text-muted" v-text="project.ago" v-show="!project.editing"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
        data() {
        return {
            myProjects: [],
        }
    },
    methods:{
            deleteProject(project){
                axios.delete(`projects/${project.id}`)
                    .then(res => {
                        this.myProjects.splice(this.myProjects.indexOf(project), 1)
                    })
            },
            edit(project){
                this.myProjects[this.myProjects.indexOf(project)].editing = true
            },
            updateDowm(project){
                this.myProjects[this.myProjects.indexOf(project)].editing = false
            },
            update(project){
                axios.put(`projects/${project.id}`,{
                    name: project.name,
                    description: project.description
                })
                this.myProjects[this.myProjects.indexOf(project)].editing = false
            }

        },
        mounted() {
            axios.get('myprojects/profile')
                .then(res => {
                    this.myProjects = res.data.data
                })
                .catch(err => {
                    console.log(err.response.data)
                });
                EventBus.$on('project-created', project => {
                    this.myProjects.push(project)
                    // console.log(project)
                })

    }
}
</script>
