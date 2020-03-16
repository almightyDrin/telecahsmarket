const pageLevelScript = function() {
    const initTelesaleDataTables = ()   => {
        var id='';
        
        var table = $('#telesalesTable').DataTable({
            oLanguage: {
                sInfoEmpty: "No entries to show"
            },
            processing: true,
            serverSide: true,
            pageLength: 10,
            response: true,
            stateSave: true,
            searchHighlight: true,
            order: [[0, 'asc']],
            ajax: {
                url: './cms_admin/get_telesales',
                dataType: 'json',
                type: 'POST',
                data: {
                    telesales_token: token
                },
            }
        });
    },
    initTeleClientsDataTables = ()   => {
        var ts = $('#telesale_info').data('user');
        
        var table = $('#teleClientTable').DataTable({
            oLanguage: {
                sInfoEmpty: "No entries to show"
            },
            processing: true,
            serverSide: true,
            pageLength: 10,
            response: true,
            stateSave: true,
            searchHighlight: true,
            order: [[0, 'asc']],
            ajax: {
                url: './cms_admin/get_tele_clients/'+ts,
                dataType: 'json',
                type: 'POST',
                data: {
                    telesales_token: token
                },
            }
        });
    }
    
    return {
        init:function() {
            initTelesaleDataTables(),
            initTeleClientsDataTables()
        }
    }
}();

$(() => {
    pageLevelScript.init();
})