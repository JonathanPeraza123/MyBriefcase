<template>
    <div>
        <div class="mb-2 mx-auto d-block">
            <img class="rounded-circle float-left mr-3 mb-3 border border-dark img-fluid" style="width:340px; height: 340px" src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
        </div>
        <div class="container">
            <h4 class="text-wrap mb-0" v-text="profile.name"></h4>
            <p class="text-secondary" v-text="profile.description"></p>
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter mr-1" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
                <div class="" v-text="profile.twitter">
                </div>
            </div>
            <button class="btn btn-success mt-2 btn-block" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope mb-1" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                </svg>
                Contactar
            </button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contactar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="contact">
                        <span class="text-danger">{{validationMessage('name')}}</span>
                        <input v-model="name"  name="name" type="text" class="form-control mb-2" placeholder="Nombre">
                        <span class="text-danger">{{validationMessage('email')}}</span>
                        <input v-model="email" type="text" class="form-control mb-2" placeholder="Email">
                        <span class="text-danger">{{validationMessage('subject')}}</span>
                        <input v-model="subject" type="text"  class="form-control mb-2" placeholder="Asunto">
                        <span class="text-danger">{{validationMessage('body')}}</span>
                        <textarea v-model="body" class="form-control mb-2" rows="4" placeholder="Mensaje"></textarea>
                        <button class="btn btn-primary float-right" :disabled="buttonDisable" >{{buttonText}}</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
  props: ['user','correo'],
  data() {
      return {
            correoUser: '',
            buttonText:'Enviar mensaje',
            buttonDisable:false,
            profile : [],
            name : '',
            email : '',
            subject : '',
            body : '',
            errors: [],
      }
    },
    mounted() {
    this.profile = JSON.parse(this.user);
    this.correoUser = this.correo;
    },
    methods: {
        contact(){

            this.errors = [];
            this.buttonDisable=true;
            this.buttonText = 'Enviando...';
            console.log('Me estoy ejecutando')
            axios.post('contacts/emails', {
                name : this.name,
                email : this.email,
                subject : this.subject,
                body : this.body,
                correo : this.correo
            }).then(res => {
                this.name = '';
                this.email = '';
                this.subject = '';
                this.body = '';
                this.buttonDisable=false;
                this.buttonText = 'Publicar'
            }).catch(err => {
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors;
                }
                this.buttonDisable=false;
                this.buttonText = 'Publicar'
            })
        },
        validationMessage(value){
            var validation = this.errors[value];
            if(validation == undefined) return '';
                return validation[0];
            }
    }
}
</script>
