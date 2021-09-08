<template>
    <div>
        <form @submit.prevent="submit">
                    <!-- @csrf -->
                    <div class="card-body">
                        <label>Nombre</label>
                        <input v-model="name" class="form-control me-2 mb-2" name="name" type="text" required>
                        <!-- <div v-if="error && errors.name" class="text-danger">
                            El campo nombre tiene que tener minimo 5 caracteres
                        </div> -->
                        <!-- <p v-if="error && errors.name">Hay errores</p> -->
                        <label>Descripcion</label>
                        <textarea v-model="description" class="form-control mb-2" name="description" required></textarea>
                        <!-- <div v-if="error && errors.description" class="text-danger">
                            La descripcion tiene que tener minimo 10 caracteres
                        </div> -->
                        <label>Link</label>
                        <input class="form-control me-2" type="text">
                    </div>
                    <div class="card-footer">
                            <button class="btn btn-primary btn-block">Publicar</button>
                    </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                // error: false,
                name: '',
                description: '',
                // errors: []
            }
        },
        methods: {
            submit(){
                axios.post('/projects', {
                    name: this.name,
                    description:this.description
                    })
                    .then(res => {
                        EventBus.$emit('project-created', res.data.data)
                        this.name = ''
                        this.description = ''
                        this.error = false
                    })
                    .catch(err => {
                        console.log(err.response.data)
                        // this.errors = err.response.data;
                        // if()
                        // this.error = true;
                    })
            }
        }
    }
</script>
