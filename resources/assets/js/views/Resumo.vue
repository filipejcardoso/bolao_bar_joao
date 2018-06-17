<template>
<div class="container resumo">
	<div class="row">
		<div class="col s12 m9">
			<jogo-atual></jogo-atual>
			<classificacao></classificacao>
		</div>
		<div class="col s12 m3">
			<p><span class="badge red black-text">DERROTA</span><br/>
			<p><span class="badge blue black-text">EMPATE</span></p><br/>
			<p><span class="badge green black-text">VITORIA</span></p>
			<participante></participante>
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