<template>
<main>
  <fieldset>
    <div class="container">
      <div class="row">
      <legend> S'inscrire</legend>
      <hr>
        <form style="margin-top: 5px; border: none" class="form-control" method="post" @submit="Register">

        <div class="col-md-12 d-block">
        <input type="text" class="form-control" name="name" placeholder="Nom d'utilisateur" required="required" v-model="name">
        </div>

        <div class="col-md-12 d-block mt-5">
        <input type="email" class="form-control" name="email" placeholder="Adresse Email " required="required" v-model="email">
        </div>

        <div class="col-md-12 d-block mt-5">
        <input type="password" class="form-control" name="password" v-bind:class="{ errorConfirmation: errorPasswordConfirmation, confirmationOk: !errorPasswordConfirmation }" placeholder="Mot de passe" required="required" v-model="password">
        </div>

        <div class="col-md-12 d-block mt-5">
        <span class="input-group-addon">
        </span>
        <input type="password" class="form-control" name="confirm_password" v-bind:class="{ errorConfirmation: errorPasswordConfirmation, confirmationOk: !errorPasswordConfirmation }" placeholder="Confirmation de mot de passe" v-model="confirmation" required="required">
        </div>

        <div class="col-md-12 d-block mt-5">
        <label class=""><input type="checkbox" required="required"> J'accepte les <a href="#">Termes d'utilisation</a> &amp; <a href="#">Politique de confidentialité</a></label>
        </div>
        <div class="col-md-12 d-block mt-5">
        <div class="text-center">Vous avez déjà un compte? <a href="#">Se connecter ici</a></div>
        <button class="btn btn-primary btn-lg" type="submit">S'ENREGISTRER</button>
        </div>
        </form>
      </div>
    </div>
  </fieldset>
</main>
</template>

<script>
import axios from 'axios'
import { EventBus } from '../event-bus.js'
export default {
  data: function () {
    return {
      name: '',
      email: '',
      password: '',
      confirmation: '',
      errorPasswordConfirmation: false
    }
  },
  methods: {
    Register: function (e) {
      e.preventDefault()

      if (this.checkPasswordConfirmation()) {
        var vord =
        {
          name: this.name,
          email: this.email,
          password: this.password
        }
        axios.post('http://127.0.0.1:8000/api/register', vord)
          .then((response) => {
            // redirection to connection page
            const token = response.data.access_token
            var userAuth = {
              userToken: token,
              userEmail: this.email
            }
            EventBus.$emit('userAuth', userAuth)
            this.$router.push('/')
          })
      }
    },
    checkPasswordConfirmation: function () {
      if (this.password === this.confirmation) {
        this.errorPasswordConfirmation = false
        return true
      } else {
        this.errorPasswordConfirmation = true
        return false
      }
    }
  }
}

</script>

<style scoped>
  .signup-form {
    display: flex;
  }
  .errorConfirmation {
    border: 1px solid darkred !important;
  }
  .confirmationOk {
    border: 1px solid #ccc !important;
  }

  .container {
    display: flex;
    justify-content: center;
    max-width: 25%;
  }

  .btn-lg {
    margin-bottom: 50%!important;
  }

</style>
