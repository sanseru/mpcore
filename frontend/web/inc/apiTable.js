function tableApi(cls, url){
    var table = $(cls).DataTable({
        'destroy': true,										
        'ajax': url,
		'lengthMenu': [[10, 25, 50,100,500, -1], [10, 25, 50,100,500,"All"]]
        
    })    
}

function tableApiServerSide(cls, url){
    var table = $(cls).DataTable({
        'processing': true,
        'serverSide': true,
        'destroy': true,										
        'ajax': url,
        'responsive': true,
        'autoWidth': false,
          
        
    })    
}

function tableApiServerSideExcell(cls, url){
    var table = $(cls).DataTable({
        'processing': true,
        'serverSide': true,
        'destroy': true,										
        'ajax': url,
        'responsive': true,
        'autoWidth': false,
        "lengthMenu": [[10, 25, 50, 9999999], [10, 25, 50, "All"]],
        'dom': 'lBfrtip',
        'buttons': [
            'excel',
        ]  
        
    })    
}