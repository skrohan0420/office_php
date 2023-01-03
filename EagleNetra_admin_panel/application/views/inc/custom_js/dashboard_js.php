<script>  
    $(document).ready(function(){




        loadTable()
        function loadTable(){
            $.ajax({
                url : "<?= base_url('admin/new_users')?>",
                type : 'GET',
                success : function(data){        
                    data = JSON.parse(data)
                    console.log(data)
                    let tbRows = "" 
                    for(let i = 0; i < data.length; i++){
                        tbRows +=`<tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].name}</td>
                                    <td>${data[i].email}</td>
                                    <td>${data[i].phone_number}</td>
                                    <td>${data[i].total_devices}</td>
                                    <td>${data[i].tracking_for}</td>
                                </tr>`;
                    }
                    $('#new_user_table_body').html(tbRows)
                }
            })
        }





    })
</script>