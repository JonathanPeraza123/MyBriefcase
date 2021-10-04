<template>
    <div>
        <form @submit.prevent="submit">
                    <!-- @csrf -->
                    <div class="card-body">
                        <label>Nombre</label>
                        <input v-model="name" class="form-control me-2 mb-2" name="name" type="text" required>
                        <label>Descripcion</label>
                        <textarea v-model="description" class="form-control mb-2" name="description" required></textarea>
                        <span></span>
                        <label>Slug</label>
                        <input v-model="slug" class="form-control mb-2" type="text" name="slug" required>
                        <label>Repositorio</label>
                        <input v-model="repository"type="text" name="repository" class="form-control mb-2" required>
                        <label>Live action link</label>
                        <input v-model="link" class="form-control me-2 mb-2" type="text" name= 'link' required>
                        <label  class="form-label">Subir imagenes</label> <br>
                        <input class="" type="file" @change="imageChange" accept="image/*" multiple name="image" ref="files">
                        <div class="mt-2">
                            <p v-for="(image,index) in images" :key="index">{{image.name}}</p>
                        </div>
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
                slug : '',
                repository : '',
                link : '',
                images: [],
                erres: []
            }
        },
        methods: {
            submit(){
                this.erres = []
                let formData = new FormData();

                formData.append('name', this.name)
                formData.append('description', this.description)
                formData.append('slug', this.slug)
                formData.append('repository', this.repository)
                formData.append('link', this.link)

                for(let i = 0; i < this.images.length; i++ ){
                    console.log(this.images[i]);
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
                        this.images = []
                    })
                    .catch(err => {
                        this.erres.push(err.response.data)
                    })
            },
            imageChange(){
                // console.log(this.$refs.files.files)
                for(let i = 0; i< this.$refs.files.files.length; i++){
                    this.images.push(this.$refs.files.files[i]);
                    // console.log(this.images);
                }
            }
        }
    }
</script>
