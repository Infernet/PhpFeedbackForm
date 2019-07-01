$(document).ready(
    function(){
        $("#feedbackForm").on("submit",function(event){
            var form=$('#feedbackForm'),
            inputName=$("#feedbackName"),
            inputEmail=$("#feedbackEmail"),
            textAreaMsg=$("#feedbackMessage");
            event.preventDefault();
            $.ajax({
                
                type: "POST",
                url: "../src/handler.php",
                data: form.serialize(),
                success: function (response) {
                    //обработка ответа
                    var result=JSON.parse(response);
                    if(checkInput(result["nameValidStatus"],inputName) &&              
                    checkInput(result["emailValidStatus"],inputEmail) &&
                    checkInput(result["messageValidStatus"],textAreaMsg))
                    {
                            if(result["isDuplicateRecord"])
                                alert('Ошибка: попытка сохранить существующую форму');
                            if(result["insertToDbStatus"])
                            {
                                if(result["sendToEmailStatus"])
                                    alert('Форма успешно сохранена');
                                else
                                    alert('Форма успешно сохранена в базе данных. Ошибка при отправке на почту');
                            }
                    }
                    else
                        {
                            alert('Ошибка: не правильно введенные данные');
                        }
                }
            });
        })
    }
);


function checkInput(nameResult,input){
    if(input.hasClass("is-valid") || input.hasClass("is-invalid")){
        if(input.hasClass("is-valid"))
        {
            if(!nameResult)
            input.toggleClass("is-valid is-invalid");
            return true;
        }
        else{
            if(nameResult)
            input.toggleClass("is-valid is-invalid");
            return false;
        }
    }
    else{
        if(nameResult){
            input.addClass("is-valid");
            return true;
        }
        else{
            input.addClass("is-invalid");
            return false;
        }
    }
}