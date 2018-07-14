<template>
<div class="container admin">

        <div class="row">
            <div class="col s12 m3">
                  <h6>{{this.$store.state.resultado_colocacao.primeiro.nome}}</h6>
                  <label>1º Lugar</label>
                  <select v-on:change="updateColocacao('primeiro')" v-model="colocacao.primeiro" class="browser-default" >
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.resultado_colocacao.segundo.nome}}</h6>
                  <label>2º Lugar</label>
                  <select v-on:change="updateColocacao('segundo')" v-model="colocacao.segundo" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.resultado_colocacao.terceiro.nome}}</h6>
                  <label>3º Lugar</label>
                  <select v-on:change="updateColocacao('terceiro')" v-model="colocacao.terceiro" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
            <div class="col s12 m3">
                  <h6>{{this.$store.state.resultado_colocacao.quarto.nome}}</h6>
                  <label>4º Lugar</label>
                  <select v-on:change="updateColocacao('quarto')" v-model="colocacao.quarto" class="browser-default">
                    <option v-for="(item) in this.$store.state.times" :key="item.id" :value="item.id" class="left">{{item.nome}}</option>
                  </select>
              </div>
          </div>


	<div class="row">
		<div class="col s12">
			<lista-jogos></lista-jogos>
		</div>
	</div>
        <div class="row">
            <h5>Oitavas</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.oitavas" :key="item.id">
                <span>{{$store.state.resultados_finais.oitavas[index].time.nome}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Quartas</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.quartas" :key="item.id">
                <span>{{$store.state.resultados_finais.quartas[index].time.nome}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Semi-Final</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.semi" :key="item.id">
                <span>{{$store.state.resultados_finais.semi[index].time.nome}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Final</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.final" :key="item.id">
                <span>{{$store.state.resultados_finais.final[index].time.nome}}</span>
                <select v-on:change="updateFinais(item.id)" v-bind:id="`select_${item.id}`" class="browser-default">
                  <option value="" disabled selected>Selecione um time</option>
                  <option v-for="(team) in $store.state.times" :key="team.id" :value="team.id" class="left">{{team.nome}}</option>
                </select>
            </div>
        </div>
        <br/><br/>

        <div class="row">
            <h5>Terceiro e Quarto</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.tquarto" :key="item.id">
                <span>{{$store.state.resultados_finais.tquarto[index].time.nome}}</span>
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
    finais:[],
  }
},created()
{
	this.loadRecursos();
  this.loadResultados();
  this.loadColocacao();
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
    updateFinais(id){
      const time = $(`#select_${id} option:selected`).val();
      const url = `http://${window.api}/api/resultados_finais/${id}`;
      let payload = {"records":[{"time_id":time}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
        alert(e)
      })
	},
    loadResultados() {
        this.axios.get(`http://${window.api}/api/resultados_finais`)
        .then(response => {

          const payload = response.data['records'];
          this.$store.commit('CHANGE_RESULTADOS', payload)
        })
        .catch(e => {
        })
    },
    loadColocacao() {
        this.axios.get(`http://${window.api}/api/resultados_colocacaos`)
        .then(response => {

          const payload = response.data['records'][0];
          this.$store.commit('CHANGE_COLOCACAO', payload)
        })
        .catch(e => {
        })
    },
    updateColocacao($field){
      const url = `http://${window.api}/api/resultados_colocacaos/1`;
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
 }
}
</script>

<style>
	.admin{margin-top: 25px;}
	.legenda{margin-top: 10px;}
</style>