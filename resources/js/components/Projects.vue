<template>
    <div>
        <div class="card mb-4 shadow-sm" v-for="project in proyectos">
            <div class="card-body d-flex flex-column">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mt-2" v-text="project.name"></h5>
                            </div>
                    </div>
                </div>
                <div>
                    <p class = "card-text text-secondary" v-text="project.description" ></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['projects'],
    data() {
      return {
          proyectos : []
      }
  },
    mounted() {
    this.proyectos = JSON.parse(this.projects);
  }
}
</script>
