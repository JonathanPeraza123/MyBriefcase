<template>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-4">
                <div>
                    <img class="rounded shadow-sm" width="40"  src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
                </div>
                <div class="container ">
                    <div class="row">
                        <div class="col-9 col-md-10">
                            <div class="container">
                                <h5 class="f" v-text="proyecto.name"></h5>
                                <a :href="user_show">Proyecto publicado por <strong>{{perfil.name}}</strong></a>
                            </div>
                        </div>
                        <div class="col-1 col-md-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-1">
                                        <a :href="proyecto.repository" class="btn btn-outline-success" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <a :href="proyecto.link" class="mr-2 btn btn-outline-success" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                                <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class= "text-secondary mb-2" v-text="proyecto.description"></p>
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-primary"></li>
                        <li class="bg-primary" v-for="imagen in imagenes" data-target="#carouselExampleIndicators" :data-slide-to="imgen-1"></li>
                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="https://blogs.iadb.org/conocimiento-abierto/wp-content/uploads/sites/10/2019/12/banner-lecciones-aprendidas-proyectos-desarrollo-2019.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item" v-for="imagen in imagenes">
                        <img :src="imagen.images" class="d-block w-100" alt="">
                        </div>
                        <!-- <div class="carousel-item">
                        <img src="https://www.gettyimages.es/gi-resources/images/500px/983794168.jpg" class="d-block w-100" alt="">
                        </div> -->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only ">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- <div v-for="imagen in imagenes">
                    <img :src="imagen.images" alt="">
                </div> -->
                <!-- <div id="carouselExampleSlidesOnly" class="carousel slide mx-auto col-md-10" data-ride="carousel">
                    <div class="carousel-inner">

                        <div v-for="imagen in imagenes" class="carousel-item active">
                            <img :src="imagen.images" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="http://vanimg.s3.amazonaws.com/darksh-5.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://vanimg.s3.amazonaws.com/darksh-5.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="card-footer">
            <div v-for="comment in comments" class="mb-3">
                <div>
                    <img class="rounded shadow-sm float-left mr-2" width = "32px" src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-2 text-secondary">
                        <div class="d-flex align-items-center">
                            <strong>
                                <a href="#">{{comment.name}}</a>
                            </strong>
                            <div class="small ml-2 mt-1">
                                {{comment.ago}}
                            </div>
                        </div>
                        <div>
                            {{comment.body}}
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="addComment" v-if="isAuthenticated">
                <div class="d-flex align-items-center">
                    <div class="input-group">
                        <textarea class = "form-control border-0 shadow-sm" name="comment" placeholder="Escribe un comentario...." v-model="newComment" rows="1" required></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
  props: ['project', 'user', 'profile', 'images'],
  data() {
      return {
          proyecto : [],
          imagenes: [],
          usuario : [],
          perfil : [],
          user_show : "",
          newComment: '',
          comments : []
      }
    },
    mounted() {
        this.proyecto = JSON.parse(this.project);
        this.usuario = JSON.parse(this.user);
        this.perfil = JSON.parse(this.profile);
        this.imagenes = JSON.parse(this.images);
        this.user_show = `/@${this.usuario.username}`
        axios.get(`/projects/${this.proyecto.id}/comments`)
            .then(res => {
                this.comments = res.data.data
            })
    },
    methods:{
        addComment(){
            axios.post(`/projects/${this.proyecto.slug}/comments`, {body : this.newComment})
                .then(res => {
                    this.comments.push(res.data.data)
                }).catch(err => {
                    console.log(err.response.data)
                });
                this.newComment = ''

        }
    }
}
</script>
