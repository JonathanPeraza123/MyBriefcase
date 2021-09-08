<template>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="Container d-flex mb-4">
                <div>
                    <img class="rounded shadow-sm" width = "60px" src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
                </div>
                <div class="container d-flex flex-column">
                    <h2 v-text="proyecto.name"></h2>
                    <a :href="user_show">Proyecto publicado por <strong>{{perfil.name}}</strong></a>
                </div>
            </div>
            <p class= "text-secondary"v-text="proyecto.description"></p>
            <div class="container">
                <div id="carouselExampleSlidesOnly" class="carousel slide mx-auto col-md-10" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://vanimg.s3.amazonaws.com/darksh-5.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://vanimg.s3.amazonaws.com/darksh-5.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://vanimg.s3.amazonaws.com/darksh-5.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
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
  props: ['project', 'user', 'profile'],
  data() {
      return {
          proyecto : [],
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
        this.user_show = `/@${this.usuario.username}`
        axios.get(`/projects/${this.proyecto.id}/comments`)
            .then(res => {
                this.comments = res.data.data
            })
    },
    methods:{
        addComment(){
            axios.post(`/projects/${this.proyecto.id}/comments`, {body : this.newComment})
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
