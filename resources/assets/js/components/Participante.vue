<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>
    <br/>
      <!-- CLASSIFAICAÇÃO -->
      <h6>1ºColocado: {{this.$store.state.participante.apostas_colocacao.primeiro}}</h6>
      <h6>2ºColocado: {{this.$store.state.participante.apostas_colocacao.segundo}}</h6>
      <h6>3ºColocado: {{this.$store.state.participante.apostas_colocacao.terceiro}}</h6>
      <h6>4ºColocado: {{this.$store.state.participante.apostas_colocacao.quarto}}</h6>
      <br/>

      <!-- PREMIAÇÃO -->
      <h6>Artilheiro: {{this.$store.state.participante.apostas_premiacao.artilheiro}}</h6>
      <h6>Melhor Ataque: {{this.$store.state.participante.apostas_premiacao.ataque}}</h6>
      <h6>Melhor Defesa: {{this.$store.state.participante.apostas_premiacao.defesa}}</h6>
      <br/>
      <!-- APOSTAS -->
      <table class="highlight">
        <thead>
          <tr>
              <th>Apostas</th>
          </tr>
        </thead>

        <tbody>

          <tr class="line reset"  v-for="item in this.$store.state.participante.apostas" :key="item.id">
            <td>
              <div v-if="item.status == 1" class="row reset red">
                  <div class="col s12"></div>
              </div>
              <div v-if="item.status == 2" class="row reset blue">
                  <div class="col s12"></div>
              </div>
              <div v-if="item.status == 3" class="row reset green">
                  <div class="col s12"></div>
              </div>
              <div class="row valign-wrapper reset">
                <div class="col s2 center-align"><h6>{{item.time1}}</h6></div>
                <div class="col s2 center-align">
                  <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
                </div>
                <div class="col s4">
                    <div v-if="item.escore1<item.escore2">
                      <div class="status_aposta status_left red"></div>
                      <div class="status_aposta status_right green"></div>
                    </div>
                    <div v-if="item.escore1>item.escore2">
                      <div class="status_aposta status_left green"></div>
                      <div class="status_aposta status_right red"></div>
                    </div>
                    <div v-if="item.escore1 == item.escore2">
                      <div class="status_aposta status_left blue"></div>
                      <div class="status_aposta status_right blue"></div>
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
            </td>
          </tr>
        </tbody>
      </table>  
      <!-- FINAIS   -->
        <div class="row">
            <h5>Oitavas</h5>
              <div class="col s12"  v-for="(item,index) in this.$store.state.participante.apostas_finais.oitavas" :key="item.id">
                <span>{{index+1}} - {{$store.state.participante.apostas_finais.oitavas[index].time}}</span>
            </div>
        </div>
        <br/>

        <div class="row">
            <h5>Quartas</h5>
              <div class="col s12"  v-for="(item,index) in this.$store.state.participante.apostas_finais.quartas" :key="item.id">
                <span>{{index+1}} - {{$store.state.participante.apostas_finais.quartas[index].time}}</span>
            </div>
        </div>
        <br/>

        <div class="row">
            <h5>Semi-Final</h5>
              <div class="col s12"  v-for="(item,index) in this.$store.state.participante.apostas_finais.semi" :key="item.id">
                <span>{{index+1}} - {{$store.state.participante.apostas_finais.semi[index].time}}</span>
            </div>
        </div>
        <br/>

        <div class="row">
            <h5>Final</h5>
              <div class="col s12"  v-for="(item,index) in this.$store.state.participante.apostas_finais.final" :key="item.id">
                <span>{{index+1}} - {{$store.state.participante.apostas_finais.final[index].time}}</span>
            </div>
        </div>
        <br/>

        <div class="row">
            <h5>Terceiro e Quarto</h5>
              <div class="col s12"  v-for="(item,index) in this.$store.state.participante.apostas_finais.tquarto" :key="item.id">
                <span>{{index+1}} - {{$store.state.participante.apostas_finais.tquarto[index].time}}</span>
            </div>
        </div>
        <br/>
    </div>
</template>
<script>
export default {
}
</script>
<style>
  .reset{padding: 0px!important; margin: 0px!important;}
	.line{border-bottom: solid 1px #ddd; padding: 0px!important; margin: 0px!important;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
  .bandeira{max-width: 40px!important;}
  .horario{font-size: 13px; color: #888;}
  .status_aposta{width: 10px!important; height: 10px!important;}
  .status_left{float: left!important;}
  .status_right{float: right!important;}
</style>