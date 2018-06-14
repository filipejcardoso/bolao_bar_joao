<template>
<div class="container resumo">
	<div class="row">
		<div class="col s12 m9">
			<classificacao></classificacao>
			<div class="legenda">
				<p>
					P - Pontos / 
					PC - Placar em cheio / 
					PV - Escore do Vencedor / 
					PP - Escore do Perdedor / 
					AV - Acertos dos Vencedores
				</p>
			</div>
		</div>
		<div class="col s12 m3">
			<participante></participante>
			<p><span class="badge red black-text">DERROTA</span><br/>
			<p><span class="badge blue black-text">EMPATE</span></p><br/>
			<p><span class="badge green black-text">VITORIA</span></p>
		</div>
	</div>
</div>	
</template>

<script>
export default {
}
</script>

<style>
	.resumo{margin-top: 25px;}
	.legenda{margin-top: 10px;}
</style>