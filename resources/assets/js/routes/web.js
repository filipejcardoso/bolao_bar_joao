import Vue from 'vue'
import VueRouter from 'vue-router'

import NotFound from '../views/NotFound.vue'
import Template from '../views/Template.vue'
import Regulamento from '../views/Regulamento.vue'
import Resumo from '../views/Resumo.vue'
import Admin from '../views/Admin.vue'
import Tabela from '../views/Tabela.vue'
import Quadro from '../views/Quadro.vue'
import QuadroClassificacao from '../views/QuadroClassificacao.vue'
import Jogos from '../views/Jogos.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'hash',
	routes: [
		{ path: '*', component: NotFound },
		{ path: '/quadro_classificacao', component: QuadroClassificacao },
		{ path: '/', component: Template, redirect: '/resumo', 
		  children: [
		  	{
            	path: 'regulamento',component: Regulamento
          	},
		  	{
            	path: 'resumo',component: Resumo
          	},
		  	{
            	path: 'tabela',component: Tabela
          	},
		  	{
            	path: 'quadro',component: Quadro
          	},
		  	// {
            // 	path: 'quadro_classificacao',component: QuadroClassificacao
          	// },
		  	{
            	path: 'updateresults',component: Jogos
          	},
		  	{
            	path: 'everaldo',component: Admin
          	},
          ]
      }
	]
})
export default router
