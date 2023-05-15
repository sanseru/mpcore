function tableApi(cls, url){
    var table = $(cls).DataTable({
        'destroy': true,										
        'ajax': url,
		'lengthMenu': [[10, 25, 50,100,500, -1], [10, 25, 50,100,500,"All"]]
        
    })    
}