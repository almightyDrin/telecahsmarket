const pageLevelScript = function() {
    const initCustomerDataTables = ()   => {
        var id='';
        
        var table = $('#customersTable').DataTable({
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
                url: './cms_admin/get_customers',
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
            initCustomerDataTables()
        }
    }
}();

$(() => {
    pageLevelScript.init();
})