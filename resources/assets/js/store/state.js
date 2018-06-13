export default{
    id: '',
    participante: {
        nome: '',
        apostas: [{
            id:'',
            time1:'',
            time2: '',
            escore1: '',
            escore2: '',
            foto1: '',
            foto2: '',
            data: ''  
        }],
        apostas_finais: {
            oitavas:[{
                id: '',
                time_id: '',
                time: ''
            }],
            quartas:[{
                id: '',
                time_id: '',
                time: ''
            }],
            semi:[{
                id: '',
                time_id: '',
                time: ''
            }],
            final:[{
                id: '',
                time_id: '',
                time: ''
            }],
            tquarto:[{
                id: '',
                time_id: '',
                time: ''
            }],
        },
        apostas_premiacao: {
            id: '',
            artilheiro: '',
            ataque: '',
            defesa: ''
        },
        apostas_premiacao: {
            id: '',
            primeiro: '',
            segundo: '',
            terceiro: '',
            quarto: ''
        }
    },
    times:
    {
        id:'',
        nome:'',
        foto:''
    },
    jogadores:
    {
        id:'',
        nome:'',
        foto:''
    }

}