<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>

    <br/>

        <div class="row">
            <div class="col s12 m3">
                  <label>1º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>1º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <label>2º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>2º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <label>3º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>3º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <label>4º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>4º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
          </div>

          <br/><br/>

        <div class="row">

            <div class="col s12 m4">
                  <label>Artilheiro</label>
                  <select class="browser-default">
                    <option value="" disabled selected>Artilheiro</option>
                    <option v-for="(item) in this.$store.state.jogadores" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m4">
                  <label>Melhor Ataque</label>
                  <select class="browser-default">
                    <option value="" disabled selected>Ataque</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m4">
                  <label>Melhor Defesa</label>
                  <select class="browser-default">
                    <option value="" disabled selected>Defesa</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
          </div>

          <br/><br/>

        <div class="row">
          <div class="col s12 m6"  v-for="(item,index) in this.$store.state.participante.apostas" :key="item.id">
            <div class="row valign-wrapper reset">
              <div class="col s2 center-align"><h6>{{item.id}}</h6><h6>{{item.time1}}</h6></div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
              </div>
              <div class="col s4 center-align">
                  <div class="row">
                    <div class="col s6"><input v-on:change="updateAposta(item.id)" v-bind:id="`input_1_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore1" name="shoe-size"></div>
                    <div class="col s6"><input v-on:change="updateAposta(item.id)" v-bind:id="`input_2_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore2" name="shoe-size"></div>
                  </div>
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
            <div v-if="(index+1)%6==0"><br/><br/><br/><br/><br/></div>
            </div>
          </div>

        <h5>Oitavas</h5>
        <br/>

        <div class="row">
            <div class="col s12 m3">
                  <label>1º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>1º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
        </div>

        <h5>Quartas</h5>
        <br/>

        <div class="row">
            <div class="col s12 m3">
                  <label>1º Lugar</label>
                  <select class="browser-default">
                    <option value="" disabled selected>1º Lugar</option>
                    <option v-for="(item) in this.$store.state.times" :key="item.id" value="" class="left">{{item.nome}}</option>
                  </select>
              </div>
        </div>

    </div>
</template>
<script>
export default {
created()
{
    this.loadRecursos();
  $(document).ready(function(){
    $('select').formSelect();
  });

},
methods: {
 loadRecursos(){
      this.axios.get('http://'+window.api+'/api/times')
      .then(response => {
          const payload = response.data['records'];
          this.$store.commit('CHANGE_TIMES', payload)
      })
      .catch(e => {
        alert(e)
      });

      this.axios.get('http://'+window.api+'/api/jogadores')
      .then(response => {
          const payload = response.data['records'];
          this.$store.commit('CHANGE_JOGADORES', payload)
      })
      .catch(e => {
        alert(e)
      });
    },
 loadApostasFinais(){
      this.axios.get(`http://${window.api}/api/participantes${this.$store.state.id}\apostas_finais`)
      .then(response => {
      })
      .catch(e => {
        alert(e)
      })
    },
    updateAposta($id){
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}/apostas/${$id}`;
      const payload = {"records":[{"escore1":`${$(`#input_1_${$id}`).val()}`,"escore2":`${$(`#input_2_${$id}`).val()}`}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
        alert(e)
      })
    }
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