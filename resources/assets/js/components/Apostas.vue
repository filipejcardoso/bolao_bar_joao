<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>
    <br/>

        <div class="row">
            <div class="col s12 m3">
                  <h6>{{this.$store.state.participante.apostas_colocacao.primeiro}}</h6>
                  <label>1º Lugar</label>
                  <select v-on:change="updateColocacao('primeiro')" v-model="colocacao.primeiro" class="browser-default" >
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.participante.apostas_colocacao.segundo}}</h6>
                  <label>2º Lugar</label>
                  <select v-on:change="updateColocacao('segundo')" v-model="colocacao.segundo" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.participante.apostas_colocacao.terceiro}}</h6>
                  <label>3º Lugar</label>
                  <select v-on:change="updateColocacao('terceiro')" v-model="colocacao.terceiro" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.participante.apostas_colocacao.quarto}}</h6>
                  <label>4º Lugar</label>
                  <select v-on:change="updateColocacao('quarto')" v-model="colocacao.quarto" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
          </div>

          <br/><br/>

        <div class="row">
            <div class="col s12 m4">
                  <h6>{{this.$store.state.participante.apostas_premiacao.artilheiro}}</h6>
                  <label>Artilheiro</label>
                  <select v-on:change="updatePremiacao('artilheiro')" v-model="colocacao.artilheiro" class="browser-default">
                    <option v-for="(item) in this.$store.state.jogadores" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
            </div>
            <div class="col s12 m4">
                  <h6>{{this.$store.state.participante.apostas_premiacao.ataque}}</h6>
                  <label>Melhor Ataque</label>
                  <select v-on:change="updatePremiacao('ataque')" v-model="colocacao.ataque" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
            </div>
            <div class="col s12 m4">
                  <h6>{{this.$store.state.participante.apostas_premiacao.defesa}}</h6>
                  <label>Melhor Defesa</label>
                  <select v-on:change="updatePremiacao('defesa')" v-model="colocacao.defesa" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
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

        <div class="row">
            <h5>Oitavas</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.participante.apostas_finais.oitavas" :key="item.id">
                <span>{{$store.state.participante.apostas_finais.oitavas[index].time}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Quartas</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.participante.apostas_finais.quartas" :key="item.id">
                <span>{{$store.state.participante.apostas_finais.quartas[index].time}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Semi-Final</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.participante.apostas_finais.semi" :key="item.id">
                <span>{{$store.state.participante.apostas_finais.semi[index].time}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Final</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.participante.apostas_finais.final" :key="item.id">
                <span>{{$store.state.participante.apostas_finais.final[index].time}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Terceiro e Quarto</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.participante.apostas_finais.tquarto" :key="item.id">
                <span>{{$store.state.participante.apostas_finais.tquarto[index].time}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

    </div>
</template>
<script>
export default {
data: function () {
  return {
    colocacao: [
      {
        primeiro : '',
        segundo : '',
        terceiro : '',
        quarto : ''
      }
    ],
    colocacao: [
      {
        artilheiro : '',
        ataque : '',
        defesa : ''
      }
    ],
    finais:[],
    fi:0
  }
},
created()
{
    this.loadRecursos();
  $(document).ready(function(){
    $('select').formSelect();
  });

},
methods: {
 loadRecursos(){
      this.axios.get(`http://${window.api}/api/times`)
      .then(response => {
          const payload = response.data['records'];
          this.$store.commit('CHANGE_TIMES', payload)
      })
      .catch(e => {
        alert(e)
      });

      this.axios.get(`http://${window.api}/api/jogadores`)
      .then(response => {
          const payload = response.data['records'];
          this.$store.commit('CHANGE_JOGADORES', payload)
      })
      .catch(e => {
        alert(e)
      });
    },
    updateAposta(id){
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}/apostas/${id}`;
      const payload = {"records":[{"escore1":`${$(`#input_1_${id}`).val()}`,"escore2":`${$(`#input_2_${id}`).val()}`}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
        alert(e)
      })
    },
    updateColocacao($field){
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}/apostas_colocacaos`;
      let payload = '';

      if($field == 'primeiro')
        payload = {"records":[{"primeiro":this.colocacao.primeiro}]};
      else if($field == 'segundo')
        payload = {"records":[{"segundo":this.colocacao.segundo}]};
      else if($field == 'terceiro')
        payload = {"records":[{"terceiro":this.colocacao.terceiro}]};
      else if($field == 'quarto')
        payload = {"records":[{"quarto":this.colocacao.quarto}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
        alert(e)
      })
    },
    updatePremiacao(field){
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}/apostas_premiacaos`;
      let payload = '';

      if(field == 'artilheiro')
        payload = {"records":[{"artilheiro":this.colocacao.artilheiro}]};
      else if(field == 'ataque')
        payload = {"records":[{"ataque":this.colocacao.ataque}]};
      else if(field == 'defesa')
        payload = {"records":[{"defesa":this.colocacao.defesa}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
        alert(e)
      })
    },
    updateFinais(id){
      const time = $(`#select_${id} option:selected`).val();
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}/apostas_finais/${id}`;
      let payload = {"records":[{"time_id":time}]};

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
  .select_finais{margin-bottom: 15px!important;}
</style>