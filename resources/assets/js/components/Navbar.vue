<template>
<div>
  <nav>
    <div class="nav-wrapper default-color-1">
      <a href="#"><span class="brand-logo center">bardojoao.com.br</span></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">

        <li><router-link to="/resumo"><i class="material-icons left">timeline</i>Resumo</router-link></li>
        <li><router-link to="/tabela"><i class="material-icons left">view_list</i>Tabela</router-link></li>
        <li><router-link to="/regulamento"><i class="material-icons left">receipt</i>Regulamento</router-link></li>

      </ul>
      
      <ul class="sidenav" id="mobile-demo">

                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/resumo">
                    <i class="material-icons">timeline</i>Resumo
                  </router-link>
                </li>
                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/tabela">
                    <i class="material-icons">view_list</i>Tabela
                  </router-link>
                </li>
                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/regulamento">
                    <i class="material-icons">receipt</i>Regulamento
                  </router-link>
                </li>
      </ul>

    </div>
  </nav>
</div>
</template>

<script>
export default {
  methods: {
    esconder: function (event) {
        $('.sidenav').sidenav('close')
    }
  },
  created()
  {
    $(document).ready(function(){
      $('.sidenav').sidenav();
    });
        
  }
}
</script>

<style>
</style>
