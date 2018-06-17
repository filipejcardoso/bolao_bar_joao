//============VUE=====================
import Vue from 'vue'
import axios from 'axios'
import router from './routes/web.js'
import VueAxios from 'vue-axios'
import store from './store/store'

//============COMPONENTES=====================
import App from './App.vue'
import Navbar from './components/Navbar.vue'
import Classificacao from './components/Classificacao.vue'
import ClassificacaoQuadro from './components/ClassificacaoQuadro.vue'
import Participante from './components/Participante.vue'
import ListaParticipantes from './components/ListaParticipantes.vue'
import Apostas from './components/Apostas.vue'
import ListaJogos from './components/ListaJogos.vue'
import JogoAtual from './components/JogoAtual.vue'
import TabelaJogos from './components/TabelaJogos.vue'
import QuadroLista from './components/QuadroLista.vue'

//============VUE=====================
Vue.use(VueAxios, axios);

//============COMPONENTES=====================
Vue.component('navbar',Navbar);
Vue.component('classificacao',Classificacao);
Vue.component('classificacao-quadro',ClassificacaoQuadro);
Vue.component('participante',Participante);
Vue.component('lista-participantes',ListaParticipantes);
Vue.component('apostas',Apostas);
Vue.component('lista-jogos',ListaJogos);
Vue.component('jogo-atual',JogoAtual);
Vue.component('tabela-jogos',TabelaJogos);
Vue.component('quadro-lista',QuadroLista);
//============CONSTANTES=====================
// window.api = "dev.joao";
window.api = "bardojoao.com.br";

const app = new Vue({
	store,
	el: '#root',
	template: '<app></app>',
	components: { App },
	router
})