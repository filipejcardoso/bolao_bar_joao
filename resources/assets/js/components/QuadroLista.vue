<template>
	<div class="total">
	  <h5>PARTICIPANTES</h5>
      <table class="highlight">
        <thead>
          <tr>
              <th width="80%">Nome</th>
              <th width="20%" class="center-align">P</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td><h6>{{ item.nome }}</h6></td>
            <td class="pontos center-align"><h6>{{ item.p }}</h6></td>
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
      participantes: [],
    }
  },
  methods: {
    rolar()
    {
        // alert($(".total").height());
        // alert($(window).scrollTop());
        // window.scrollTo(0, $(window).scrollTop() + 53);

        let scrollHeight = $(document).height();
        let scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            window.scrollTo(0, 0);
        }
        else
        window.scrollTo(0, $(window).scrollTop() + 53);
    },
    showApostas(index)
    {
      this.loadApostas(index);
      $('#modal_apostas').modal('open');
    },
    loadQuadro()
    {
        this.axios.get('http://'+window.api+'/api/quadro')
        .then(response => {
            this.participantes = response.data['records'];
              M.toast({html: 'Atualizado'});
        })
        .catch(e => {

        })
    },
  },
  created(){
        $(document).ready(function(){
          $('.modal').modal();
        });

    this.loadQuadro();
    this.timer = setInterval(this.loadQuadro, 5000)
    this.timer = setInterval(this.rolar, 3000)
    
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