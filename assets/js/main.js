
	$(document).ready(function(){    

		$('#check').change(function(){
		  if($(this).is(":checked")){
		    $('.input-footer').show();
		  } else if($(this).is(":not(:checked)")){
		    $('.input-footer').hide();
		  }
		});

	});

	//ckeditor
  CKEDITOR.replace('isi_surat'); //, {height: 200}

	//modal pilih pejabat
  $(document).ready(function(){
    $("#kepada").on('click','#pilih',function(){

         var currentRow=$(this).closest("tr");

         var nip = currentRow.find("td:eq(0)").text();
         var nama = currentRow.find("td:eq(1)").text();
         var jabatan = currentRow.find("td:eq(2)").text();

         $('#to_kepada').val(nama);
         $('#nip_kpada').val(nip);
         $('#jab_kep').val(jabatan);

         $('#kepada').modal('hide');

    });

    $("#dari").on('click','#pilih',function(){

         var currentRow=$(this).closest("tr");

         var nip = currentRow.find("td:eq(0)").text();
         var nama = currentRow.find("td:eq(1)").text();
         var jabatan = currentRow.find("td:eq(2)").text();

         $('#from_k').val(nama);
         $('#nip_dari').val(nip);
         $('#jab_dari').val(jabatan);


         $('#dari').modal('hide');

    }); 



    $('#peg_simpeg').on('click', '#pilih', function(){
    	 var currentRow=$(this).closest("tr");

	     var nip = currentRow.find("td:eq(0)").text();
	     var nama = currentRow.find("td:eq(1)").text();
	     var jabatan = currentRow.find("td:eq(2)").text();
	     var pangkat = currentRow.find("td:eq(3)").text();

	     $('#nip_man').val(nip);
	     $('#nam_man').val(nama);
	     $('#pang_man').val(pangkat);
	     $('#jab_man').val(jabatan);

	     $('#peg_simpeg').modal('hide');
	     $('.form-manual').show(); 
    });

    function showmodal(inputValue, modal){
    	var currentRow=$(this).closest("tr");

         var nip = currentRow.find("td:eq(1)").text();
         var nama = currentRow.find("td:eq(2)").text();
         var jabatan = currentRow.find("td:eq(3)").text();

         $(inputValue).val(nama);

         $(modal).modal('hide');
    }


	});



////proses 




