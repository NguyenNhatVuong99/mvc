$(function(){
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Quay lại',
            next : 'Tiếp theo',
            finish : 'Hoàn tất',
            current : ''
        },
        onStepChanged: function (event, currentIndex, newIndex)
        {
            switch (currentIndex) {
                // case 1:
                    
                //     break;
                case 2:
                    var checkbox=$('#checkbox-receiver').is(":checked");
                    if(checkbox){
                        
                    }

                default:
                    break;
            }
            
            // if (currentIndex == 0) { //I suppose 0 is the first step
            //     var url = "..."; 

            //     $.ajax({
            //         url: url,
            //         success: function (response) {
            //             // Form fields on second step
            //             $("#EmailAddress").val(response.Email);
            //             $("#FirstName").val(response.Firstname);
            //             $("#LastName").val(response.Lastname);
            //             return true;
            //         },
            //         error: function () {
            //             alert("something went wrong");
            //             return false; //this will prevent to go to next step
            //         }
            //     });
            // }
        },
    });
    $("#date").datepicker({
        dateFormat: "MM - DD - yy",
        showOn: "both",
        buttonText : '<i class="zmdi zmdi-chevron-down"></i>',
    });
});
