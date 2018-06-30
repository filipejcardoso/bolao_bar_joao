<template>
<div class="container admin">
	<div class="row">
		<div class="col s12">
			<lista-jogos></lista-jogos>
		</div>
	</div>
        <div class="row">
            <h5>Oitavas</h5>
              <div class="col s12 m3 select_finais"  v-for="(item,index) in this.$store.state.resultados_finais.oitavas" :key="item.id">
                <span>{{$store.state.resultados_finais.oitavas[index].time}}</span>
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
                <span>{{$store.state.resultados_finais.quartas[index].time}}</span>
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
                <span>{{$store.state.resultados_finais.semi[index].time}}</span>
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
                <span>{{$store.state.resultados_finais.final[index].time}}</span>
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
                <span>{{$store.state.resultados_finais.tquarto[index].time}}</span>
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
    finais:[],
  }
},
created()
{
	this.loadRecursos();
	this.loadResultados()
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
  }
}
</script>

<style>
	.admin{margin-top: 25px;}
	.legenda{margin-top: 10px;}
</style>