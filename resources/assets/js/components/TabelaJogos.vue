<template>
	<div>
	  <h5>TABELA</h5>

        <div class="row">
          <div class="col s12 m6"  v-for="(item,index) in this.$store.state.jogos" :key="item.id">
            <div class="row valign-wrapper reset">
              <div class="col s2 center-align"><h6>{{item.time1}}</h6></div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
              </div>
                <div class="col s4 center-align">
                    <div v-if="item.status != 0"><h5>{{item.escore1}}x{{item.escore2}}</h5></div>
                    <h5 v-else>-</h5>
                </div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto2}`">
              </div>
              <div class="col s2 center-align"><h6>{{item.time2}}</h6></div>
            </div>
            <div class="row reset">
                <div class="col s12 gray-text center-align">
                    <span class="horario">{{item.data}}</span>
                </div>
            </div>
            <br/>
            <div v-if="(index+1)%6==0"><br/><br/><br/><br/><br/></div>
            </div>
          </div>
    </div>
</template>
<script>
export default {
methods: {
    loadJogos()
    {
        const url = `http://${window.api}/api/jogos`;
        this.axios.get(url)
        .then(response => {

          const payload = response.data['records'];
          this.$store.commit('CHANGE_JOGOS', payload);
        })
        .catch(e => {
          alert(e)
        })
    },
  },
  created(){
      this.loadJogos();
  }
}
</script>
<style>
  .reset{padding: 0px!important; margin: 0px!important;}
	.line{border-bottom: solid 1px #ddd; padding: 0px!important; margin: 0px!important;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
  .bandeira{max-width: 40px!important;}
  .horario{font-size: 13px; color: #888;}
</style>