
<script type="text/javascript">
            // function get_child_options(){
            //     var parentID = jQuery('#parent').val();
            //     jQuery.ajax({
            //         url: 'child_categories.php',
            //         type: 'POST',
            //         data: {parentID : parentID},
            //         success: function(data){
            //             jQuery('#child').html(data);
            //         },
            //         error: function(){alert("Something went wrong with the child options.")},
            //     });
            // }
            // jQuery('select[name="parent_category"]').change(get_child_options);



function updateSizes(){
    var sizestring='';
    for(var i=1;i<=12;i++){
        if(jQuery('#size'+i).val()!=''){
            sizestring +=jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
        }
    }
        jQuery('#sizes').val(sizestring);
}

</script>