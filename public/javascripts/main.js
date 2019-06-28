$(document).ready(
    function(){
        $("#feedbackForm").on("submit",function(event){
            event.preventDefault();
            var form=$('#feedbackForm'),
            inputName=$("#feedbackName"),
            inputEmail=$("#feedbackEmail"),
            textAreaMsg=$("#feedbackMessage"),
            submitButton=$("#buttonFeedbackSubmit");

            $.ajax({
                type: "POST",
                url: "../src/FormHandler.php",
                data: form.serialize(),
                //dataType:'json',
                //contentType:'application/json',
                success: function (response) {
                    console.log(typeof response);
                    console.log(response);
                    //обработка ответа
                    var result=JSON.parse(response);
                    if(result['successful']){
                        inputName.addClass('is-valid');
                        inputEmail.addClass('is-valid');
                        textAreaMsg.addClass('is-valid');
                        alert('Форма успешно отправлена');
                    }else if(result['duplicateRecord']){
                        alert('Ошибка: попытка отправить две одинаковые формы');
                    }else{
                        (result['name'])? inputName.addClass('is-invalid'):inputName.addClass('is-valid');
                        (result['email'])?inputEmail.addClass('is-invalid'):inputEmail.addClass('is-valid');
                        (result['message'])?textAreaMsg.addClass('is-invalid'):textAreaMsg.addClass('is-valid');
                        alert('Ошибка: проверьте правильность заполненных полей.');
                    }
                }
            });
        })
    }
);
