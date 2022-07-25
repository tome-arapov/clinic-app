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
                <td>
                    ${valueOfElement.name}
                </td>
                <td>
                    ${valueOfElement.email}
                </td>
                <td>
                    ${valueOfElement.phone_number}
                </td>
                <td>
                    ${valueOfElement.address}
                </td>
                <td>
                    ${valueOfElement.medical_condition}
                </td>
                <td>
                    ${valueOfElement.blood_type}
                </td>
               
                <td>
                
                    <button type="button" id='editPatientInfo_${valueOfElement.id}'
                    class="btn btn-primary mb-2" data-toggle="modal" data-target="#patientModal">Edit</button>
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
});