export default {
    'CHANGE_ID'(state, payload){
        state.id = payload;
    },
    'CHANGE_PARTICIPANTE'(state, payload){
        state.participante = payload;
    },
    'CHANGE_TIMES'(state, payload){
        state.times = payload;
    },
    'CHANGE_JOGADORES'(state, payload){
        state.jogadores = payload;
    },
    'CHANGE_JOGOS'(state, payload){
        state.jogos = payload;
    },
    'CHANGE_RESULTADOS'(state, payload){
        state.resultados_finais = payload;
    }
}