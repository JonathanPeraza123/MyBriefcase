<template>
    <div>
        <div class="mb-2 mx-auto d-block">
            <img class="rounded-circle float-left mr-3 mb-3 border border-dark img-fluid" style="width:340px; height: 340px" src="https://img.freepik.com/vector-gratis/ilustracion-vector-dibujos-animados-lindo-corgi-beber-leche-te-boba-bebida-animal-concepto-aislado-vector-estilo-dibujos-animados-plana_138676-1943.jpg?size=338&ext=jpg" alt="">
        </div>
        <div class="container">
            <h4 class="text-wrap mb-0" v-text="profile.name" v-show="!editing"></h4>
            <h5 class="text-wrap text-secondary" v-text="user.username" v-show="!editing"></h5>
            <p class="text-secondary" v-text="profile.description" v-show="!editing"></p>
            <button  v-show="!editing" class="btn btn-outline-secondary btn-block mb-3" @click="editProfile()">Editar perfil</button>
            <div class="d-flex align-items-center">
                <svg v-show="!editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter mr-1" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
                <div class="" v-text="profile.twitter"  v-show="!editing">
                </div>
            </div>
            <form v-show="editing" @submit.prevent="updateProfile(profile)">
                <input type="text" class="form-control mb-2" v-model="profile.name">
                <label>Biografia</label>
                <textarea class="form-control mb-2" name="descrption" id="" cols="30" rows="10" v-model="profile.description"></textarea>
                <div class="d-flex align-items-center">
                    <svg v-show="editing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter mr-1" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                    <input class="form-control mb-2" type="text" v-model="profile.twitter">
                </div>
                <div>
                    <button class="btn btn-success btn-sm">Guardar</button>
                    <button class="btn btn-secondary btn-sm" @click="editProfileDowm()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  props: ['auth', 'perfil'],
  data() {
    return {
      user: [],
      profile: [],
      editing: false
    }
  },
  mounted() {
    this.user = JSON.parse(this.auth);
    this.profile = JSON.parse(this.perfil);
  },
  methods: {
    editProfile() {
        this.editing = true;
    },
    editProfileDowm(){
        this.editing = false;
    },
    updateProfile(profile) {
        axios.put(`profile/${profile.id}`, {
            description: profile.description,
            twitter : profile.twitter,
            name : profile.name
        }).then(res => {
            console.log(err.response.data)
        })
        .catch(err => {
            console.log(err.response.data)
        });
        this.editing = false;
    }
  },
  filters: {
    moment: function(date) {
      return moment(date).format("D [de] MMMM [de] YYYY ");
    }
  }
}
</script>
