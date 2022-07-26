$(document).ready(function () {


    $.get("../actions/selectPatientsAction.php")
    .then(function(data) {
        let response = JSON.parse(data);
        let counter = 1;
        $.each(response.patients, function (indexInArray, valueOfElement) { 
            $('#patientsInfo').append(`
            <tr>
                <td>
                    ${counter}
                </td>
                <td>
                    ${valueOfElement.clinic_id}
                </td>
                <td class='patientName'>
                    ${valueOfElement.name}
                </td>
                <td class='patientEmail'>
                    ${valueOfElement.email}
                </td>
                <td class='patientPhone'>
                    ${valueOfElement.phone_number}
                </td>
                <td class='patientAddress'>
                    ${valueOfElement.address}
                </td>
                <td class='patientMedicalCondition'>
                    ${valueOfElement.medical_condition}
                </td>
                <td class='patientBloodType'>
                    ${valueOfElement.blood_type}
                </td>
               
                <td>
                
                    <button type="button" id='editPatientInfo_${valueOfElement.id}'
                    class="btn btn-primary" data-toggle="modal" data-target="#patientModal">Edit</button>
                    <button type="button" id='deletePatient_${valueOfElement.id}' class="btn btn-danger">
                        Delete
                    </button>
           
                </td>
            </tr>        
            `)
        counter++;
            
        });
    })
    .catch(function(err) {
        console.log(err);
    });


    $(document).on('click','button[id*="editPatientInfo"]',function(event) {
            
        event.preventDefault();
        $.ajax({
                method: "GET",
                url:"../actions/editPatientAction.php",
                data: {'patient_id' : event.target.id.split("_")[1]}
            })
            .done(function(response){
                let result = JSON.parse(response);
                console.log(result);
                $('#updatePatient').val(result.id);
                $('#editName').val(result.name);
                $('#editEmail').val(result.email);
                $('#editPhone').val(result.phone_number);
                $('#editAddress').val(result.address);
                $('#editMedicalCondition').val(result.medical_condition);
                $('#editBloodType').val(result.blood_type);

            })
            .fail(function(err) {
                console.log(err)
            })
    
    });

    $('#updatePatientInfoBtn').on('click',function(event) {
            
        event.preventDefault();
        let updatedInfo = $('#updatePatientInfo').serialize();

        $.ajax({
                method: "POST",
                url:"../actions/updatePatientInfoAction.php",
                data:  updatedInfo
            })
            .done(function(response){
                let result = JSON.parse(response);
                if(!result.status) {
                    $('#result').html(`<p class='mb-0 text-white text-center bg-danger rounded'>${result.message}</p>`);
                    return;
                }
                
                $('#result').html(``);
                let row = $(`#editPatientInfo_${result.updated['id']}`).parents('tr');
                row.children('td.patientName').text(`${result.updated["name"]}`);
                row.children('td.patientEmail').text(`${result.updated["email"]}`);
                row.children('td.patientPhone').text(`${result.updated["phone_number"]}`);
                row.children('td.patientAddress').text(`${result.updated["address"]}`);
                row.children('td.patientMedicalCondition').text(`${result.updated["medical_condition"]}`);
                row.children('td.patientBloodType').text(`${result.updated["blood_type"]}`);
                $('#patientModal').modal('hide');

                swal('Good job!','Patient\'s info successfully updated.','success');



            })    
            .fail(function(err) {
                console.log(err)
            })
        });

        $(document).on('click','button[id*="deletePatient"]',function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once the patient is deleted, all informations for him/her will be permanently deleted !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "POST",
                        url:"../actions/deletePatientAction.php",
                        data: { 'patient_id' : event.target.id.split("_")[1] },
                        success : function(response) {
                            
                            if(response == 200) {
                                swal('Good job!','Patient file deleted successfully.','success');
                                $(`#deletePatient_${event.target.id.split("_")[1]}`).closest("tr").remove();
                                

                            } else if(response == 500) {
                                swal('Error!','Something went wrong..','error');

                            }
                            
                        }
                    })
                    
                } 
            });
           
        })
        
});