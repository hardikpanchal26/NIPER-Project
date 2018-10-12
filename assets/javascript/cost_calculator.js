function applicant_total() {
      
      facility = $('#facility').val();
      nos = $('#nos').val();

      if(nos == '') {
        return false;
      }
      else if(nos < 1 || nos > 50) {
        alert('Please Enter No of Samples between 0 to 50');
        $('#nos').val('1');
      }

      if(facility == '-- Select Facility --') {
        $('#nos').val('1');        
        alert('Please Select a Facility');
        return false;
      }

      
      $.ajax({
      type:'POST',
        url:'../database/ajax_data.php',
        data: {facility_id: facility},
        dataType: 'JSON',
        success:function(facility){
          $('#charge').val(facility.institute_charge);
          var gst   = Math.round((0.18) * facility.institute_charge);
          $('#gst').val(gst);
          var total = $('#nos').val() * (parseInt(facility.institute_charge) + parseInt(gst));
          $('#total').val(total);
        }
      }); 

}

function enter_nos() {
  if(nos == '') {
        alert('Please Enter No of Samples between 0 to 50');
        $('#nos').val(1);
        applicant_total();
      }
}

  $(function () {
        $.calculate_basic_charge = function( index_id ) {
          var current_industry_charge  =  $('#'+index_id + ' .industry_charge').attr('data-charge');
          var current_institute_charge  =  $('#'+index_id + ' .institute_charge').attr('data-charge');
          var old_nos          =  $('#'+index_id + ' .the_unit').attr('data-value');
          
          var industry_basic = $('#industry_basic').attr('data-value');
          industry_basic     = industry_basic - (old_nos * current_industry_charge);
          var institute_basic = $('#institute_basic').attr('data-value');
          institute_basic     = institute_basic - (old_nos * current_institute_charge);
          
          var nos              =  $('#'+index_id + ' .the_unit').val();
          industry_basic =  (industry_basic) + (current_industry_charge * nos);
          institute_basic =  (institute_basic) + (current_institute_charge * nos);

          $('#'+index_id + ' .the_unit').attr('data-value', nos); 
          $('#industry_basic').attr('data-value' , industry_basic);
          $('#industry_basic').html('₹ ' + industry_basic);      
          $('#institute_basic').attr('data-value' , institute_basic);
          $('#institute_basic').html('₹ ' + institute_basic);      
        };

        $.calculate_gst_and_total =  function() {

          var industry_basic = $('#industry_basic').attr('data-value');
          
          var industry_gst   = Math.round((0.18) * industry_basic);
          $('#industry_gst').attr('data-value' , industry_gst);
          $('#industry_gst').html('₹ ' + industry_gst );

          var industry_total = +industry_basic + +industry_gst;
          $('#industry_total').attr('data-value' , industry_total);
          $('#industry_total b').html('₹ ' + industry_total);


          var institute_basic = $('#institute_basic').attr('data-value');
          
          var institute_gst   = Math.round((18/100) * institute_basic);
          $('#institute_gst').attr('data-value' , institute_gst);
          $('#institute_gst').html('₹ ' + institute_gst );

          var institute_total = +institute_basic + +institute_gst;
          $('#institute_total').attr('data-value' , institute_total);
          $('#institute_total b').html('₹ ' + institute_total);
        };  


        $(".the_checkbox").click(function () {
            if ($(this).is(":checked")) {
                var index_id = $(this).closest('tr').attr('id');
                if( $('#'+index_id + ' .the_unit').val() < 0 || $('#'+index_id + ' .the_unit').val() >50 || $('#'+index_id + ' .the_unit').val() == '') {
                  alert("Please Enter Unit Value between 0 to 50"); 
                  $(this).attr('checked', false);
                  $('#'+index_id + ' .the_unit').val(1);
                  return;
                }
                $.calculate_basic_charge(index_id);    
            } else {

              var index_id = $(this).closest('tr').attr('id');

              var current_industry_charge  =  $('#'+index_id + ' .industry_charge').attr('data-charge');
              var current_institute_charge  =  $('#'+index_id + ' .institute_charge').attr('data-charge');
              var old_nos          =  $('#'+index_id + ' .the_unit').attr('data-value');
              
              var industry_basic = $('#industry_basic').attr('data-value');
              industry_basic     = industry_basic - (old_nos * current_industry_charge);
              var institute_basic = $('#institute_basic').attr('data-value');
              institute_basic     = institute_basic - (old_nos * current_institute_charge);
          

              $('#'+index_id + ' .the_unit').attr('data-value', 0 ); 
              $('#industry_basic').attr('data-value' , industry_basic);
              $('#industry_basic').html('₹ ' + industry_basic);
              $('#institute_basic').attr('data-value' , institute_basic);
              $('#institute_basic').html('₹ ' + institute_basic);                              
            }
            $.calculate_gst_and_total();
        });

        $(".the_unit").change(function() {
          var index_id = $(this).closest('tr').attr('id');
          if ($('#'+index_id + ' .the_checkbox').is(":checked")) {
            if( $('#'+index_id + ' .the_unit').val() < 0 || $('#'+index_id + ' .the_unit').val() >50 || $('#'+index_id + ' .the_unit').val() == '' ) {
              alert("Please Enter Unit Value between 0 to 50"); 
              $('#'+index_id + ' .the_unit').val($('#'+index_id + ' .the_unit').attr('data-value'));
              return;
            }
            $.calculate_basic_charge(index_id);
          }
          $.calculate_gst_and_total();
          
        });
  });
  

  $(document).ready(function(){  
 
    $("#reset").click(function(){
      
      $('#industry_basic').attr('data-value' , 0);
      $('#industry_basic').html('₹ ' + 0 );

      $('#industry_gst').attr('data-value' , 0);
      $('#industry_gst').html('₹ ' + 0);

      $('#industry_total').attr('data-value' , 0);
      $('#industry_total b').html('₹ ' + 0);  

      $('#institute_basic').attr('data-value' , 0);
      $('#institute_basic').html('₹ ' + 0 );

      $('#institute_gst').attr('data-value' , 0);
      $('#institute_gst').html('₹ ' + 0);

      $('#institute_total').attr('data-value' , 0);
      $('#institute_total b').html('₹ ' + 0);

      $('.the_checkbox').prop('checked', false);
      $('.the_unit').attr('data-value' , 0);
      $('.the_unit').val("1");
    });

  });
  