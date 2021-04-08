// (function(){
    function formata_data_hora (data) {
        if (data.toString().length<=0) return data;
        let input = new Date(data);
        input = input.toLocaleDateString('pt-br') + ' ' + input.toLocaleTimeString('pt-br');
        return input;
    }
// }());