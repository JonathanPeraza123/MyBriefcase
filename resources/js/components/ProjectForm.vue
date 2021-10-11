<template>
    <div>
        <form @submit.prevent="submit">
                    <!-- @csrf -->
                    <div class="card-body">
                        <label>Nombre</label>
                        <span class="text-danger">{{validationMessage('name')}}</span>
                        <input v-model="name" class="form-control me-2 mb-2" name="name" type="text" required>
                        <label>Descripcion</label>
                        <span class="text-danger">{{validationMessage('description')}}</span>
                        <textarea v-model="description" class="form-control mb-2" name="description" required></textarea>
                        <label>Slug</label>
                        <span class="text-danger">{{validationMessage('slug')}}</span>
                        <input v-model="slug" class="form-control mb-2" type="text" name="slug" required >
                        <label>Repositorio</label>
                        <span class="text-danger">{{validationMessage('repository')}}</span>
                        <input v-model="repository"type="text" name="repository" class="form-control mb-2" required>
                        <label>Live action link</label>
                        <span class="text-danger">{{validationMessage('link')}}</span>
                        <input v-model="link" class="form-control me-2 mb-2" type="text" name= 'link' required>
                        <label  class="form-label">Subir imagenes</label> <br>
                        <input class="" type="file" @change="imageChange" accept="image/*" multiple name="image" ref="files">
                        <div class="mt-2">
                            <p v-for="(image,index) in images" :key="index">{{image.name}}</p>
                        </div>
                        <span class="text-danger">{{validationMessage('files')}}</span>
                    </div>
                    <div class="card-footer">
                            <button class="btn btn-primary btn-block" :disabled="buttonDisable">{{buttonText}}</button>
                    </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                buttonText:'Publicar',
                buttonDisable:false,
                name: '',
                description: '',
                slug : '',
                repository : '',
                link : '',
                images: [],
                errors: [],
            }
        },
        methods: {
            submit(){
                this.errors = [];
                this.buttonDisable=true;
                this.buttonText = 'Publicando....';

                let formData = new FormData();

                formData.append('name', this.name)
                formData.append('description', this.description)
                formData.append('slug', this.slug)
                formData.append('repository', this.repository)
                formData.append('link', this.link)

                for(let i = 0; i < this.images.length; i++ ){
                    // console.log(this.images[i]);
                    let file = this.images[i];
                    formData.append('files[' + i + ']',file);
                }

                const config = {
                    headers: {"content-type" : "multipart/form-data"}
                }

                axios.post('/projects', formData, config
                )
                    .then(res => {
                        EventBus.$emit('project-created', res.data.data)
                        this.name = '';
                        this.description = '';
                        this.slug = '';
                        this.repository = '';
                        this.link = '';
                        this.$refs.files.value = '';
                        this.images = [];
                        this.buttonDisable=false;
                        this.buttonText = 'Publicar'
                    })
                    .catch(err => {
                        if (err.response.status == 422) {
                            this.errors = err.response.data.errors;
                        }
                        this.buttonDisable=false;
                        this.buttonText = 'Publicar'
                        console.log(this.errors);
                    })
            },
            imageChange(){
                // console.log(this.$refs.files.files)
                for(let i = 0; i< this.$refs.files.files.length; i++){
                    this.images.push(this.$refs.files.files[i]);
                    // console.log(this.images);
                }
            },
            validationMessage(value){
                var validation = this.errors[value];
                // console.log(validation);
                if(validation == undefined) return '';
                return validation[0];
            }
        }
    }
</script>
