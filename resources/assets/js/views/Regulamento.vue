<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="slider">
                  <!-- hide-on-small-only -->
                    <ul class="slides">
                      <li>
                        <img src="images/index/slider_one.jpg">
                        <div class="caption center-align">
                          <h3>Bolão Bar do João</h3>
                          <h5 class="light grey-text text-lighten-3">Leia o regulamento e participe</h5>
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>

            <div class="col s12">
              <h4> Regulamento </h4>

              <br/>

              <p>1º Na Primeira Fase da Copa cada palpite certo de  cada jogo vale 01 ponto;</p>
              <br/>

              <p>2º Cada palpite certo de cada seleção que irá para as Oitavas de Final vale 02 pontos (não precisa acertar se é 1º ou 2º colocado do grupo);</p>
              <br/>

              <p>3º Cada palpite certo da seleções que irão fazer os confrontos das Quartas de Final vale 03 pontos;</p>
              <br/>

              <p>4º Cada palpite certo das seleções que irão fazer os confrontos da Semi Final vale 04 pontos;</p>
              <br/>

              <p>5º Cada palpite certo da seleção que irá fazer o confronto do 3º e 4º lugar vale 05 pontos;</p>
              <br/>

              <p>6º Cada palpite certo da seleção que irá fazer o confronto da final vale 06 pontos;</p>
              <br/>

              <p>7º Pontuação por palpite certo da colocação final da Copa do Mundo 2018:</p>
              <p>1º Lugar = 10 pontos</p>
              <p>2º Lugar = 06 pontos</p>
              <p>3º Lugar = 04 pontos</p>
              <p>4º Lugar = 02 pontos</p>
              <br/>

              <p>8º Pontuação Extra cada acerto para estes palpites valerá:</p>
              <p>Artilheiro da Copa = 08 pontos</p>
              <p>Melhor Ataque = 06 pontos</p>
              <p>Melhor Defesa = 06 pontos</p>
              <br/>

              <p>9º Divisão da Arrecadação final do Bolão:</p>
              <p>O valor total arrecadado será divido em 04 ganhadores de acordo com a pontuação final da seguinte forma</p>
              <p>1º Lugar = 50%</p>
              <p>2º Lugar = 25%</p>
              <p>3º Lugar = 15%</p>
              <p>4º Lugar = 10%</p>
              <br/>

            </div>


              <!--<div class="col s12">
                <div class="card">
                  <div class="card-image">
                    <img src="images/index/soccer_one.png">
                  </div>
                  <div class="card-content">
                    <span class="card-title">Serelepe da rodada</span>
                    <p>Confira agora mesmo qual foi a opção vencedora na votação Quem é o craque da galera da Rodada do Campeonato!</p>
                  </div>
                </div>
              </div>-->

            </div>
        </div>
    </div>
</template>

<script>
export default {
  created()
  {
    $(document).ready(function(){
      $('.slider').slider();
    });
  }
}
</script>

<style>
    .slider{margin-top: 30px!important; margin-bottom: 20px!important;}
</style>