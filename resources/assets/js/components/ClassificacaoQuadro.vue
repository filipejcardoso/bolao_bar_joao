<template>
	<div class="row">
	  <h5>CLASSIFICAÇÃO</h5>
      <table class="highlight col s3 tabela_quadro">
        <thead>
          <tr>
              <th width="10%">Posição</th>
              <th width="80%">Nome</th>
              <th width="10%" class="center-align">P</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td v-if="index<15">{{ index + 1 }}</td>
            <td v-if="index<15">{{ item.nome }}</td>
            <td v-if="index<15" class="pontos center-align">{{ item.p }}</td>
          </tr>
        </tbody>
      </table>
      <table class="highlight col s3">
        <thead>
          <tr>
              <th width="10%">Posição</th>
              <th width="80%">Nome</th>
              <th width="10%" class="center-align">P</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td v-if="index>= 15 && index<30">{{ index + 1 }}</td>
            <td v-if="index>= 15 && index<30">{{ item.nome }}</td>
            <td v-if="index>= 15 && index<30" class="pontos center-align">{{ item.p }}</td>
          </tr>
        </tbody>
      </table>
      <table class="highlight col s3">
        <thead>
          <tr>
              <th width="10%">Posição</th>
              <th width="80%">Nome</th>
              <th width="10%" class="center-align">P</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td v-if="index>= 30 && index<45">{{ index + 1 }}</td>
            <td v-if="index>= 30 && index<45">{{ item.nome }}</td>
            <td v-if="index>= 30 && index<45" class="pontos center-align">{{ item.p }}</td>
          </tr>
        </tbody>
      </table>
      <table class="highlight col s3">
        <thead>
          <tr>
              <th width="10%">Posição</th>
              <th width="80%">Nome</th>
              <th width="10%" class="center-align">P</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td v-if="index>= 45 && index<60">{{ index + 1 }}</td>
            <td v-if="index>= 45 && index<60">{{ item.nome }}</td>
            <td v-if="index>= 45 && index<60" class="pontos center-align">{{ item.p }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Modal Structure -->
      <div id="modal_apostas" class="modal modal-fixed-footer modal-apostas">
        <div class="modal-content">
    			<participante></participante>
        </div>
      </div>
      
     </div>
</template>
<script>
export default {
  data()
  {
    return{
      participantes: []
    }
  },
  methods: {
    showApostas(index)
    {
      this.loadApostas(index);
      $('#modal_apostas').modal('open');
    },
    loadApostas(index) {
      if(this.participantes.length > 0)
      {
        const payload = this.participantes[index].id;
        this.$store.commit('CHANGE_ID', payload)

        this.axios.get('http://'+window.api+'/api/participantes/'+this.$store.state.id)
        .then(response => {

          const payloadParticipante = response.data['records'];
          this.$store.commit('CHANGE_PARTICIPANTE', payloadParticipante)
        })
        .catch(e => {
        })
      }
      else
      {
          const payloadParticipante = null;
          this.$store.commit('CHANGE_PARTICIPANTE', payloadParticipante)
      }
    },
  },
  created(){
        $(document).ready(function(){
          $('.modal').modal();
        });

      this.axios.get('http://'+window.api+'/api/participantes')
      .then(response => {

        this.participantes = response.data['records'];
        this.loadApostas(0);
      })
      .catch(e => {
      })
  }
}
</script>
<style>
	.line{border-bottom: solid 1px #ddd;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
	.ultimos{float: right!important;}
  .modal-apostas{width:90%!important; height: 80%!important;}
  </style>